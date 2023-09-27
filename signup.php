<?php
$errors = ""; // Initialize the variable to store validation errors

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form using $_POST
    $firstName = $_POST["fname"];
    $lastName = $_POST["lname"];
    $department = $_POST["department"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $repeatPassword = $_POST["repeatPassword"];

    // Perform validation and processing
    if (empty($firstName) || empty($lastName) || $department == "Select Department" || empty($username) || empty($password) || empty($repeatPassword)) {
        $errors = "Please complete all fields";
    } elseif ($password !== $repeatPassword) {
        $errors = "Passwords do not match";
    }

    // Check if there are any validation errors
    if (empty($errors)) {
        // If there are no errors, you can proceed with further processing

        // You can perform database operations, save the data, or perform any other actions here

        // For demonstration purposes, we'll simply display the received data
        echo "First Name: " . htmlspecialchars($firstName) . "<br>";
        echo "Last Name: " . htmlspecialchars($lastName) . "<br>";
        echo "Department: " . htmlspecialchars($department) . "<br>";
        echo "Username: " . htmlspecialchars($username) . "<br>";

        // Note: In a real application, do not display sensitive data; instead, store it securely.
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
            <form id="signup-form" class='flex flex-col' method="post" action="signup.php">
                <div class="flex gap-2">
                    <div class="flex flex-col">
                        <label for="fname">First Name</label>
                        <input name='fname' type="text">
                    </div>
                    <div class="flex flex-col">
                        <label for="lname">Last Name</label>
                        <input name='lname' type="text">
                    </div>
                </div>
                <label for="department">Department</label>
                <select name="department">
                    <option value="Select Department">Select Department</option>
                    <option value="Department of Information Technology">Department of Information Technology</option>
                    <option value="Department of Engineering">Department of Engineering</option>
                    <option value="Department of Architecture">Department of Architecture</option>
                </select>
                <label for="username">Username</label>
                <input type="email" name="username">
                <label for="password">Password</label>
                <input type="password" name="password">
                <label for="repeatPassword">Repeat Password</label>
                <input class="mb-4" type="password" name="repeatPassword">
                <input type="file" name="image" accept=".png, .jpg, .jpeg">

                <button class='p-2 mt-5 bg-[#577F98] text-white' type="submit">Submit</button>
                <?php if (!empty($errors)) { ?>
                    <div class='text-red-500 text-center'><?php echo $errors; ?></div>
                <?php } ?>

                <h2 class='w-full text-center'>Already have an account <a href="login.php"><span class='text-blue-500'>Login</span></a></h2>
            </form>
        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Get a reference to the form
            var form = document.getElementById("signup-form");

            // Add a form submit event listener
            form.addEventListener("submit", function(event) {
                event.preventDefault(); // Prevent the default form submis
            });
        });
    </script>



</body>

</html>