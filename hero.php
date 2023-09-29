<?php
include('database.php');
include('header.php');
include('profile.php');

// Check if the user is logged in
if (empty($_SESSION['loggedin'])) {
    header("Location: login.php");
} else {
    $departments = ["Department of Information Technology", "Department of Engineering", "Department of Architecture"];
}

// Initialize the search query variable
$searchQuery = '';

// Check if a search query has been submitted
if (isset($_GET['search'])) {
    $searchQuery = mysqli_real_escape_string($conn, $_GET['search']);
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

    <main class=" bg-[#F4F1E8] min-h-screen w-full pt-28 p-10 ">
        <div class="mb-5 fixed ">
            <img class="absolute top-1.5 left-2 w-5" src="public/images/search.png" alt="" />
            <form method="GET" action="">
                <input class="w-80 pl-10" type="text" name="search" placeholder="Search your instructor" value="<?php echo $searchQuery; ?>" />
                <button type="submit" class="absolute top-1.2 border-2 border-black right-2 px-2 py-1 bg-green-700 text-white text-sm rounded hover:bg-black">Search</button>
            </form>
        </div>


        <?php
        foreach ($departments as $department) {
            $sql = "SELECT * FROM users WHERE department = '$department'";

            // Append a search filter if a search query exists
            if (!empty($searchQuery)) {
                $sql .= " AND (fName LIKE '%$searchQuery%' OR lName LIKE '%$searchQuery%')";
            }

            $result = mysqli_query($conn, $sql);

            // Display the department name
            echo '<div class="text-2xl p-10 flex"><div class="mr-96 text-center  w-full">' . $department . '</div></div>';
            echo '<div class="hero items-center justify-center mr-96">';

            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $bgColorClass = "";

                    if ($row['status'] === "In") {
                        $bgColorClass = "bg-green-700";
                    } elseif ($row['status'] === "Out") {
                        $bgColorClass = "bg-red-600";
                    } else {
                        $bgColorClass = "bg-gray-400";
                    }

                    // Display user data for the current department
                    echo '<div class="flex items-center h-32 bg-white w-96 space-x-3 p-5 rounded-xl shadow-md">';
                    echo '<div>';
                    echo '<img class="w-14" src="images/' . ($row['image'] ? $row['image'] : 'profile.png') . '"/>';
                    echo '</div>';
                    echo '<div class="space-y-1">';
                    echo '<div>';
                    echo '<h3 class="font-bold text-xl">' . ucfirst($row['fName']) . ' ' . ucfirst($row['lName']) . '</h3>';
                    echo '</div>';
                    echo '<div class="flex space-x-2">';
                    echo $row['status'] ?  '<h4 class="' . $bgColorClass . ' px-2 rounded-2xl border-2 border-black">' . $row['status'] . '</h4>' : "";
                    echo $row['availability'] ? ' <h4 class="' . ($row['availability'] === "Available" ? 'bg-yellow-500' : 'bg-gray-200') . ' px-2 rounded-2xl border-2 border-black">' . $row['availability'] . '</h4>' : "";
                    echo $row['location'] ? '<h4 class="bg-gray-300 px-2 rounded-2xl border-2 border-black">' . $row['location'] . '</h4>' : "";
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            }

            // Close the current department section
            echo '</div>';
        }

        // Include other parts of your page, such as profile and header, outside the loop




        ?>


    </main class='text'>
</body>

</html>