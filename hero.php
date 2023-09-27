<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles.css" rel="stylesheet">
</head>

<body>
    <?php
    include('profile.php');
    include('header.php');


    ?>

    <main class="bg-[#F4F1E8] min-h-screen w-full pt-28 p-10 ">

        <div class="mb-5 relative ">
            <img class="absolute top-1.5 left-2 w-5" src="public/images/search.png" alt="" />
            <input class="w-80 pl-10" type="text" placeholder="Search your instructor" />
        </div>
        <div class="hero items-center justify-center mr-96">
            <div class="flex items-center h-32 bg-white w-96 space-x-3 p-5 rounded-xl shadow-md">
                <div>
                    <img class="w-14" src="public/images/profile.png" />
                </div>
                <div class="space-y-1">
                    <div>
                        <h3 class="font-bold text-xl">Cristian Amparo</h3>
                    </div>
                    <div class="flex space-x-2">
                        <h4 class="bg-green-700 px-2 rounded-2xl border-2 border-black">In</h4>
                        <h4 class="bg-yellow-500 px-2 rounded-2xl border-2 border-black">Available</h4>
                        <h4 class="bg-gray-300 px-2 rounded-2xl border-2 border-black">DIT Faculty</h4>
                    </div>
                </div>
            </div>





        </div>
    </main>





</body>

</html>