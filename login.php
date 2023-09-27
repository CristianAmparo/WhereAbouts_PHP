<?php
session_start();
include('database.php');
$result = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

    if (mysqli_connect_error()) {
        echo json_encode(["error" => "Database connection error"]);
        exit();
    } else {
        if ($username != "" && $password != "") {
            // Retrieve the hashed password associated with the username
            $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->bind_result($hashedPassword);
            $stmt->fetch();
            $stmt->close();


            // Compare the entered password with the hashed password
            if (password_verify($password, $hashedPassword)) {
                // Login Successfully
                $_SESSION['username'] = $username;
                $_SESSION['loggedin'] = true;
                $result = "Login Successfully";
                header("Location: index.php");
            } else {
                $result = "Invalid username or password";
            }
        } else {
            $result = "Invalid username or password";
        }
    }
}

?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles.css" rel="stylesheet">
</head>

<body>
    <div class='w-full h-screen flex items-center justify-center'>
        <div class='bg-[#F4F1E8] w-96 h-96 mx-auto p-10 shadow-2xl rounded-lg'>

            <form class='flex flex-col justify-evenly h-full  items-center' method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <h1 class=" -mb-5">WhereAbouts</h1>
                <div class="flex flex-col w-full ">
                    <label htmlFor="">Username</label>
                    <input type="email" name="username" required />
                    <label htmlFor="">Password</label>
                    <input type="password" name="password" required />
                    <div class='<?php echo $result === "Login Successfully" ? "text-green-500" : "text-red-500"; ?> text-center'>
                        <?php echo $result; ?>
                    </div>

                    <button type="submit" class='p-2  w-full mt-5 bg-[#577F98] text-white'>Login</button>
                    <h2 class='w-full text-center'>Don't have an account <a href="signup.php"><span class='text-blue-500'>Signup</span></h2></a>
                </div>
            </form>
        </div>
    </div>

</body>

</html>