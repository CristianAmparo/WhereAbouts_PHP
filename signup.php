<?php
include('database.php');
$errors = ""; // Initialize the variable to store validation errors

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form using $_POST
    $firstName = filter_input(INPUT_POST, "fname", FILTER_SANITIZE_SPECIAL_CHARS);
    $lastName = filter_input(INPUT_POST, "lname", FILTER_SANITIZE_SPECIAL_CHARS);
    $department = $_POST["department"];
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
    $repeatPassword = filter_input(INPUT_POST, "repeatPassword", FILTER_SANITIZE_SPECIAL_CHARS);
    $image = $_FILES['image'];

    if ($image['error'] === UPLOAD_ERR_OK) {
        $fileTmpName = $image['tmp_name'];
        $fileName = basename($image['name']);
        $uniqueFileName = uniqid() . '_' . $fileName;

        // Construct the destination path
        $uploadDir = './images/'; // Change this to your desired upload directory
        $uploadPath = $uploadDir . $uniqueFileName;

        // Move the uploaded file to the destination directory
        if (move_uploaded_file($fileTmpName, $uploadPath)) {
            // File moved successfully
        } else {
            $errors = "File upload failed";
        }
    } else {
        $errors = "File upload failed with error code: " . $image['error'];
    }


    // Perform validation and processing
    if ($password !== $repeatPassword) {
        $errors = "Passwords do not match";
    } else {
        // Check if the username already exists in the database
        $checkQuery = "SELECT username FROM users WHERE username = ?";
        $checkStmt = mysqli_prepare($conn, $checkQuery);
        mysqli_stmt_bind_param($checkStmt, "s", $username);
        mysqli_stmt_execute($checkStmt);
        mysqli_stmt_store_result($checkStmt);

        if (mysqli_stmt_num_rows($checkStmt) > 0) {
            $errors = "Username already exists";
        } else {
            // Use prepared statement to insert data safely
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $insertQuery = "INSERT INTO users (fName, lName, department, username, password, image) 
            VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $insertQuery);
            mysqli_stmt_bind_param(
                $stmt,
                "ssssss",
                $firstName,
                $lastName,
                $department,
                $username,
                $hash,
                $uniqueFileName
            );


            if (mysqli_stmt_execute($stmt)) {
                header("location: login.php");
                exit;
            } else {
                echo "Registration failed";
            }

            mysqli_stmt_close($stmt);
        }

        mysqli_stmt_close($checkStmt);
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles.css" rel="stylesheet">
</head>

<body>
    <div class='w-full h-screen flex items-center justify-center'>
        <div class='bg-[#F4F1E8] w-max h-max mx-auto p-10 shadow-2xl rounded-lg'>
            <h1>WhereAbouts</h1>
            <form id="signup-form" class='flex flex-col' method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                <div class="flex gap-2">
                    <div class="flex flex-col">
                        <label for="fname">First Name</label>
                        <input name='fname' type="text" required>
                    </div>
                    <div class="flex flex-col">
                        <label for="lname">Last Name</label>
                        <input name='lname' type="text" required>
                    </div>
                </div>
                <label for="department">Department</label>
                <select name="department" required>
                    <option value="Select Department">Select Department</option>
                    <option value="Department of Information Technology">Department of Information Technology</option>
                    <option value="Department of Engineering">Department of Engineering</option>
                    <option value="Department of Architecture">Department of Architecture</option>
                </select>
                <label for="username">Username</label>
                <input type="email" name="username" autocomplete="username" required>
                <label for="password">Password</label>
                <input type="password" name="password" required>

                <label for="repeatPassword">Repeat Password</label>
                <input class="mb-4" type="password" name="repeatPassword" required>

                <input type="file" name="image" accept=".png, .jpg, .jpeg">

                <button class='p-2 mt-5 bg-[#577F98] text-white' type="submit">Submit</button>
                <?php if (!empty($errors)) { ?>
                    <div class='text-red-500 text-center'><?php echo $errors; ?></div>
                <?php } ?>

                <h2 class='w-full text-center'>Already have an account <a href="login.php"><span class='text-blue-500'>Login</span></a></h2>

</html>