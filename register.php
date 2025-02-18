<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link href="./src/output.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
        <div class="p-10 w-full flex content-center justify-center">
            <div class="w-full md:w-1/2 border-2 border border-gray-500 rounded-tl-3xl rounded-br-3xl p-8 shadow-lg">
            <div class="mx-auto text-center flex content-center justify-center mb-5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-camera" viewBox="0 0 16 16">
                        <path d="M15 12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h1.172a3 3 0 0 0 2.12-.879l.83-.828A1 1 0 0 1 6.827 3h2.344a1 1 0 0 1 .707.293l.828.828A3 3 0 0 0 12.828 5H14a1 1 0 0 1 1 1zM2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4z"/>
                        <path d="M8 11a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5m0 1a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7M3 6.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0"/>
                    </svg>
                </div>
                <div class="text-xl text-center font-semibold mb-7">Register</div>
                <form action="cekregister.php" method="post" onsubmit="return validateUsername()">
                    <div class="w-full flex">
                        <div class="w-1/2">
                            <div class="mb-2">
                                <div class="mb-2 text-sm">Username (max 12 characters)</div>
                                    <div class="relative mb-6">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0"/>
                                                <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                                            </svg>
                                        </div>
                                        <input type="text" name="username" id="username" placeholder="Enter Username" class="text-xs border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" required>
                                    </div>
                                    <div id="error-message" class="text-red-500 text-xs hidden">Username must be exactly 12 characters long.</div>
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
                            <div class="mb-2 text-sm">
                                <div class="mb-2">Full Name</div>
                                <div class="relative mb-6">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-check-fill" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0"/>
                                            <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                                        </svg>
                                    </div>
                                    <input type="text" name="full_name" placeholder="Full Name" id="input-group-1" class="text-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                </div>
                                <!-- <input type="text" name="full_name" placeholder="Full Name" class="text-xs border w-full p-1 rounded-lg"> -->
                            </div>
                        </div>
                        <div class="w-1/2 ml-3">
                            <div class="mb-2">
                                <div class="mb-2 text-sm">E-mail</div>
                                <div class="relative mb-6">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                                            <path d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z"/>
                                            <path d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z"/>
                                        </svg>
                                    </div>
                                    <input type="text" name="email" id="input-group-1" class="text-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@gmail.com" required>
                                </div>
                                <!-- <input type="email" name="email" placeholder="E-mail" class="text-xs border w-full p-1 rounded-lg"> -->
                            </div>
                            <div class="mb-2 text-sm">
                                <div class="mb-2">Alamat</div>
                                <div class="relative mb-6">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
                                            <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z"/>
                                            <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293z"/>
                                        </svg>
                                    </div>
                                <textarea placeholder="Alamat" name="alamat" id="input-group-1" class="text-xs border w-full p-1 rounded-lg h-full focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                                </div>
                            </div>
                            <div class="mb-2 text-sm text-center">
                                <input type="submit" name="register" class="hover:shadow-lg hover:bg-gray-700 hover:text-white duration-300 font-semibold border-2 border-gray-700 px-6 py-1 rounded-lg shadow-lg" value="Register">
                            </div>
                            <div class="mb-2 text-sm">
                                <div class="text-sx text-center">Have an account? <a href="login.php" class=" text-blue-500 font-semibold hover:text-gray-500 hover:underline hover:duration-300">Login</a></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <script>
    function validateUsername() {
        const usernameInput = document.getElementById('username');
        const errorMessage = document.getElementById('error-message');
        const username = usernameInput.value;

        if (username.length >= 12) {
            errorMessage.classList.remove('hidden');
            return false;
        } else {
            errorMessage.classList.add('hidden');
            return true; 
        }
    }
</script>
</body>
</html>