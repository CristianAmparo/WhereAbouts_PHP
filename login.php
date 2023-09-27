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

            <form onSubmit={handleSubmit} class='flex flex-col justify-evenly h-full  items-center' action="">
                <h1 class="-mb-5">WhereAbouts</h1>
                <div class="flex flex-col w-full ">
                    <label htmlFor="">Username</label>
                    <input type="email" name="username" />
                    <label htmlFor="">Password</label>
                    <input type="password" name="password" />
                    <div class="text-red-500 -mb-3 mt-3 text-sm text-center">Incorrect Email or Password</div>
                    <div class="text-green-500 -mb-3 mt-3  text-sm text-center">Successfully Login</div>

                    <button type="submit" class='p-2  w-full mt-5 bg-[#577F98] text-white'>Login</button>
                    <h2 class='w-full text-center'>Don't have an account <a href="signup.php"><span class='text-blue-500'>Signup</span></h2></a>
                </div>
            </form>
        </div>
    </div>







</body>

</html>