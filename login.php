<!-- @extends('layouts.app') -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="./src/output.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
        <div class="w-full p-10 flex content-center justify-center items-center">
            <div class="w-full sm:w-1/2 lg:w-1/4 border-2 border border-gray-500 rounded-tl-3xl rounded-br-3xl p-8 shadow-lg">
                <div class="mx-auto text-center flex content-center justify-center mb-5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-camera" viewBox="0 0 16 16">
                        <path d="M15 12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h1.172a3 3 0 0 0 2.12-.879l.83-.828A1 1 0 0 1 6.827 3h2.344a1 1 0 0 1 .707.293l.828.828A3 3 0 0 0 12.828 5H14a1 1 0 0 1 1 1zM2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4z"/>
                        <path d="M8 11a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5m0 1a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7M3 6.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0"/>
                    </svg>
                </div>
                <div class="text-xl text-center font-semibold mb-7">Login</div>
                <form action="ceklogin.php" method="POST">
                    <div class="w-full">
                        <div class="mb-2">
                            <div class="mb-2 text-sm">Username</div>
                            <div class="relative mb-6">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-check-fill" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0"/>
                                        <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                                    </svg>
                                </div>
                                <input type="text" name="username" id="input-group-1" placeholder="Enter Username" class="text-xs border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com" required>
                            </div>
                            <!-- <input type="text" name="username" placeholder="Username" class="text-xs border w-full p-1 rounded-lg"> -->
                        </div>
                        <div class="mb-2 text-sm">
                            <div class="mb-2">Password</div>
                            <div class="relative mb-6">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-key-fill" viewBox="0 0 16 16">
                                            <path d="M3.5 11.5a3.5 3.5 0 1 1 3.163-5H14L15.5 8 14 9.5l-1-1-1 1-1-1-1 1-1-1-1 1H6.663a3.5 3.5 0 0 1-3.163 2M2.5 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
                                        </svg>
                                    </div>
                                    <input type="password" name="password" id="input-group-1" class="text-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter Password" required>
                                </div>
                            <!-- <input type="password" name="password" placeholder="Password" class="text-xs border w-full p-1 rounded-lg"> -->
                        </div>
                        <div class="my-10">
                            <div class="mb-2 text-sm text-center">
                                <input type="submit" name="login" class="hover:shadow-lg hover:bg-gray-700 hover:text-white duration-300 font-semibold border-2 border-gray-700 px-6 py-1 rounded-lg shadow-lg" value="Login">
                            </div>
                            <div class="mb-2 text-sm">
                                <div class="text-sx text-center">Doesn't have an account? <a href="register.php" class=" text-blue-500 font-semibold hover:text-red-700 hover:underline hover:duration-300">Register</a></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
</body>
</html>
<!-- @extends('layouts.app') -->