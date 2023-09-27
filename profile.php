<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles.css" rel="stylesheet">
</head>

<body>
    <section class="fixed right-0 top-0  z-0 h-screen pt-28 w-96 bg-[#F8EFD1] shadow-2xl">
        <div class="flex flex-col items-center">
            <img class='w-32' src="public/images/profile.png" alt="" />
            <h3 class="text-2xl font-bold">Cristian Amparo</h3>
            <h3>Department of Information Technology</h3>
            <div class="mt-5 justify-center bg-black w-3/4 h-0.5"></div>
        </div>
        <div>
            <h1 class='pt-2'>WhereAbouts</h1>
            <div class="flex justify-center gap-3">
                <label>
                    <input type="radio" name="status" value="In" class="hidden" />
                    <h4 class=" bg-green-700 text-lg font-bold w-max px-4 rounded-2xl border-2 border-black">In</h4>
                </label>
                <label>
                    <input type="radio" name="status" value="Out" onChange={handleStatusChange} class="hidden" />
                    <h4 class=" bg-red-600 text-lg font-bold w-max px-4 rounded-2xl border-2 border-black">Out</h4>
                </label>
                <label>
                    <input type="radio" name="status" value="Absent" class="hidden" />
                    <h4 class=" bg-gray-400 text-lg font-bold w-max px-4 rounded-2xl border-2 border-black">Absent</h4>
                </label>
            </div>
            <h3 class='text-center pt-3'>Choose your status!</h3>
            <div class="my-5 justify-center bg-black w-3/4 h-0.5 mx-auto"></div>

            <div class="flex justify-center gap-3">

                <label>
                    <input type="radio" name="availability" value="Available" class="hidden" />
                    <h4 class="bg-yellow-500 text-sm font-bold w-max py-1 px-4 rounded-2xl border-2 border-black">Available</h4>
                </label>
                <label>
                    <input type="radio" name="availability" value="Unavailable" class="hidden" />
                    <h4 class="bg-gray-200 text-sm font-bold w-max py-1 px-4 rounded-2xl border-2 border-black">Unavailable</h4>
                </label>
            </div>
            <h3 class='text-center pt-3'>Choose your availability!</h3>
            <div class="my-5  bg-black w-3/4 h-0.5 mx-auto"></div>

            <div class=' text-center mb-16'>
                <input type="text" name="location" class='shadow-md  w-2/3 p-4 ' placeholder='Type your current location' />
                <h3 class='text-center pt-3'>Where are you?</h3>
            </div>
            <div class='text-center'>
                <button class='mx-auto w-2/3 p-2 rounded-lg shadow-lg bg-slate-500 text-white text-lg self-center'>Update</button>
            </div>
        </div>
    </section>

</body>

</html>