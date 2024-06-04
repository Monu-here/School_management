 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
         integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
         crossorigin="anonymous" referrerpolicy="no-referrer" />
     @php
         $setting = getSetting();
     @endphp
     @if ($setting == null)
         <title>School Management</title>
     @else
         <title> {{ $setting->titletext }} @yield('title') </title>
     @endif
 </head>

 <body>
     <div class="min-h-screen flex items-center justify-center bg-zinc-100 dark:bg-blue-900">
         <div
             class="bg-white white:bg-zinc-800 shadow-lg rounded-lg overflow-hidden flex flex-col md:flex-row w-full max-w-4xl">
             <div class="md:w-1/2 p-8 flex flex-col items-center justify-center">
                 <h2 class="text-2xl font-bold text-zinc-800 dark:text-dark-200 mb-2">Admin Login</h2>
                 <p class="text-zinc-600 dark:text-dark-400">Please enter valid data</p>
                 <img src="{{ asset('img/students_09.png') }}" alt="Student Illustration" class="mb-4">
             </div>
             <div class="md:w-1/2 p-8 bg-zinc-50 dark:bg-zinc-700">
                 <div class="flex justify-end">
                 </div>
                 <div class="flex flex-col items-center mb-6">
                     @if ($setting == null)
                         <img src="https://placehold.co/100x100" alt="UNNES Logo" class="w-24 h-24 mb-4">
                     @else
                         <img src="{{ asset($setting->websiteimage) }}" alt="" class="w-24 h-24 mb-4">
                     @endif
                     <h3 class="text-xl font-bold text-zinc-800 dark:text-zinc-200">
                         @if ($setting == null)
                             School Management
                         @else
                             {{ $setting->webistename }}
                         @endif
                     </h3>
                     <p class="text-zinc-600 dark:text-zinc-400"></p>
                 </div>
                 <form action="{{ route('adminLogin.login') }}" method="POST" class="w-full">
                     @csrf

                     <div class="mb-4">
                         <label class="block text-zinc-600 dark:text-zinc-400 mb-2" for="student-id">Email</label>
                         <div class="relative">
                             <input type="text" id="student-id" name="email"
                                 class="w-full px-4 py-2 border rounded-lg text-zinc-800 dark:text-zinc-200 bg-white dark:bg-zinc-800 border-zinc-300 dark:border-zinc-600 focus:outline-none focus:ring-2 focus:ring-yellow-500"
                                 placeholder="Type Your Email">
                             <span
                                 class="absolute inset-y-0 right-0 flex items-center pr-3 text-zinc-400 dark:text-zinc-500">
                                 <i class="fa-solid fa-envelope" style="color: white;"></i>
                             </span>
                         </div>
                     </div>
                     <div class="mb-4">
                         <label class="block text-zinc-600 dark:text-zinc-400 mb-2" for="password">Password</label>
                         <div class="relative">
                             <input type="password" id="password-input"
                                 class="w-full px-4 py-2 border rounded-lg text-zinc-800 dark:text-zinc-200 bg-white dark:bg-zinc-800 border-zinc-300 dark:border-zinc-600 focus:outline-none focus:ring-2 focus:ring-yellow-500"
                                 placeholder="Type Your Password" name="password">
                             <span
                                 class="absolute inset-y-0 right-0 flex items-center pr-3 text-zinc-400 dark:text-zinc-500">
                                 <i class="fas fa-eye    password-toggle" id="password-toggle"
                                     onclick="togglePasswordVisibilitydd()" style="color: white;"></i>

                             </span>
                         </div>
                     </div>

                     <button type="submit"
                         class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-yellow-500">LOGIN</button>
                 </form>
             </div>
         </div>
     </div>
     <script src="https://cdn.tailwindcss.com"></script>
     <script>
         function togglePasswordVisibilitydd() {
             var passwordInput = document.getElementById('password-input');
             var passwordToggle = document.getElementById('password-toggle');

             if (passwordInput.type === 'password') {
                 passwordInput.type = 'text';
                 passwordToggle.classList.remove('fa-eye');
                 passwordToggle.classList.add('fa-eye-slash');
             } else {
                 passwordInput.type = 'password';
                 passwordToggle.classList.remove('fa-eye-slash');
                 passwordToggle.classList.add('fa-eye');
             }
         }
     </script>
 </body>

 </html>
