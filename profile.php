<?php
session_start();
include('database.php');



$username = $_SESSION['username'];
$error = "";



if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (empty($_POST['status'])) {
        $error = "<div>Choose your Status to update!</div>";
    }
    $newStatus = isset($_POST['status']) ?  $_POST['status'] : "";
    $newAvailability = isset($_POST['availability']) ? $_POST['availability'] : "";
    $newLocation = isset($_POST['location']) ? $_POST['location'] : "";

    if (empty($errors)) {
        // Update the user's status, availability, and location in the database
        $updateSql = "UPDATE users SET status = '$newStatus', availability = '$newAvailability', location = '$newLocation' WHERE username = '$username'";
        if (mysqli_query($conn, $updateSql)) {
            // Update successful
            $status = $newStatus;
            $availability = $newAvailability;
            $location = $newLocation;
        } else {
            // Update failed
            echo "Error updating data: " . mysqli_error($conn);
        }
    }
}

$sql = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $name = ucfirst($row['fName']) . " " .  ucfirst($row['lName']);
    $department = $row['department'];
    $status = $row['status'];
    $availability = $row['availability'];
    $location = $row['location'];
}

$bgColorClass = "";

if ($status === "In") {
    $bgColorClass = "bg-green-700";
} elseif ($status === "Out") {
    $bgColorClass = "bg-red-600";
} else {
    $bgColorClass = "bg-gray-400";
}

?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles.css" rel="stylesheet">
</head>
<style>
    /* Style for the "status" and "availability" radio buttons when checked */
    .radio-button:checked+label h4 {
        transform: scale(1.10);
        outline-style: dashed;
        outline-color: rgb(234 179 8);

    }
</style>

<body>
    <section class="fixed right-0 top-0  z-0 h-screen pt-28 w-96 bg-[#F8EFD1] shadow-2xl">
        <div class="flex flex-col items-center">
            <img class='w-32' src="public/images/profile.png" alt="" />
            <h3 class="text-2xl font-bold"><?php echo $name ?></h3>
            <h3>Department of Information Technology</h3>
            <div class="mt-5 justify-center bg-black w-3/4 h-0.5"></div>
        </div>
        <div>
            <h1 class='pt-2'>WhereAbouts</h1>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="flex justify-center gap-3">
                    <input type="radio" name="status" value="In" class="radio-button hidden" id="status-in" required <?php if ($status === "In") echo "checked"; ?>>
                    <label for="status-in">
                        <h4 class="bg-green-700 text-lg font-bold w-max px-4 rounded-2xl border-2 border-black ">In</h4>
                    </label>

                    <input type="radio" name="status" value="Out" class="radio-button hidden" id="status-out" <?php if ($status === "Out") echo "checked"; ?>>
                    <label for="status-out">
                        <h4 class="bg-red-600 text-lg font-bold w-max px-4 rounded-2xl border-2 border-black">Out</h4>
                    </label>

                    <input type="radio" name="status" value="Absent" class="radio-button hidden" id="status-absent" <?php if ($status === "Absent") echo "checked"; ?>>
                    <label for="status-absent">
                        <h4 class="bg-gray-400 text-lg font-bold w-max px-4 rounded-2xl border-2 border-black">Absent</h4>
                    </label>
                </div>
                <h3 class='text-center pt-3'>Choose your status!</h3>
                <?php if (!empty($errors)) { ?>
                    <div class='text-red-500 text-center'><?php echo $errors; ?></div>
                <?php } ?>

                <!-- Availability Radio Buttons -->
                <div class="my-5 justify-center bg-black w-3/4 h-0.5 mx-auto"></div>
                <div class="flex justify-center gap-3">
                    <input type="radio" name="availability" value="Available" class="radio-button hidden" id="availability-available" <?php if ($availability === "Available") echo "checked"; ?>>
                    <label for="availability-available">
                        <h4 class="bg-yellow-500 text-sm font-bold w-max py-1 px-4 rounded-2xl border-2 border-black">Available</h4>
                    </label>

                    <input type="radio" name="availability" value="Unavailable" class="radio-button hidden" id="availability-unavailable" <?php if ($availability === "Unavailable") echo "checked"; ?>>
                    <label for="availability-unavailable">
                        <h4 class="bg-gray-200 text-sm font-bold w-max py-1 px-4 rounded-2xl border-2 border-black">Unavailable</h4>
                    </label>
                </div>
                <h3 class='text-center pt-3'>Choose your availability!</h3>
                <div class="my-5  bg-black w-3/4 h-0.5 mx-auto"></div>

                <div class=' text-center'>
                    <input type="text" name="location" class='shadow-md  w-2/3 p-4 ' placeholder='Type your location (Optional)' value="<?php echo $location; ?>" />
                    <h3 class='text-center pt-3 '>Where are you?</h3>
                </div>

                <div class='text-center mt-3'>
                    <a href="hero.php"><button class='mx-auto w-2/3 p-2 rounded-lg shadow-lg bg-slate-500 text-white text-lg self-center'>Update</button></a>
                </div>

                <?php
                echo $error;
                echo ' <div class="w-3/4 mx-auto bg-white space-x-3 p-5 rounded-xl shadow-md font-bold flex items-center justify-center mt-3 ">';
                echo '<div class="flex space-x-2">';
                echo $status ? '<h4 class="' . $bgColorClass . ' px-4 py-0.5 rounded-2xl border-2 border-black">' . $status . '</h4>' : "";
                echo $availability ? '<h4 class="' . ($availability === "Available" ? 'bg-yellow-500' : 'bg-gray-200') . ' px-4 py-0.5 rounded-2xl border-2 border-black">' . $availability . '</h4>' : "";
                echo $location ? '<h4 class=" bg-gray-300 px-4 py-0.5 rounded-2xl border-2 border-black">' . $location . '</h4>' : "";
                echo '</div>';
                ?>
        </div>
        </form>
        </div>
    </section>

    <script>
        // JavaScript to add a 'checked' class to the selected radio button label
        const radioButtons = document.querySelectorAll('.radio-button');
        radioButtons.forEach((radioButton) => {
            radioButton.addEventListener('change', () => {
                radioButtons.forEach((rb) => {
                    rb.nextElementSibling.classList.remove('checked');
                });
                radioButton.nextElementSibling.classList.add('checked');
            });
        });
    </script>
</body>

</html>