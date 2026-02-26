<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>School | Auth</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* انميشن دخول ناعم */
    .fade-up {
      animation: fadeUp 0.7s ease forwards;
    }
    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(40px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* انميشن تكبير/تصغير للبراندينج */
    .branding-animate {
      animation: brandingPulse 0.7s ease;
    }
    @keyframes brandingPulse {
      0% { transform: scale(1); }
      50% { transform: scale(1.05); }
      100% { transform: scale(1); }
    }
  </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#0f172a] via-[#1e3a8a] to-[#3b82f6]">

  <div class="w-full max-w-5xl bg-white text-gray-900 rounded-2xl shadow-2xl overflow-hidden flex flex-col md:flex-row">

    <!-- Left: Branding -->
    <div id="branding" class="md:w-1/2 flex flex-col items-center justify-center p-10 bg-gradient-to-br from-indigo-600 to-blue-700 text-white">
      <img src="https://cdn-icons-png.flaticon.com/512/2232/2232688.png" alt="Logo" class="w-24 h-24 mb-6 drop-shadow-xl">
      <h1 class="text-4xl font-bold mb-2 tracking-wide">School</h1>
      <p class="text-lg text-gray-200">منصة لإدارة بيانات الطلبة بشكل ذكي وسهل</p>
    </div>

    <!-- Right: Auth Forms -->
    <div class="md:w-1/2 p-10 flex flex-col justify-center relative">

      <!-- Switch buttons -->
      <div class="flex justify-center mb-8 space-x-4">
        <button id="loginBtn" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">Login</button>
        <button id="registerBtn" class="px-6 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition">Register</button>
      </div>
      <!-- Validation Errors -->
@if ($errors->any())
    <div class="mb-6 p-4 rounded-lg bg-red-50 border border-red-200">
        <ul class="list-disc list-inside text-sm text-red-600">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


      <!-- Login Form -->
      <form id="loginForm" method="POST" action="{{ route('login') }}" class="space-y-4 fade-up">
        @csrf
        <div>
          <label class="block mb-1 font-medium">Email</label>
          <input type="email" name="email" class="w-full p-3 rounded-lg bg-gray-100 border focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>
        <div>
          <label class="block mb-1 font-medium">Password</label>
          <input type="password" name="password" class="w-full p-3 rounded-lg bg-gray-100 border focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>
        <button type="submit" class="w-full py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-semibold shadow-lg">Login</button>
      </form>

      <!-- Register Form -->
      <form id="registerForm" method="POST" action="{{ route('register') }}" class="space-y-4 hidden">
        @csrf
        <div>
          <label class="block mb-1 font-medium">Name</label>
          <input type="text" name="name" class="w-full p-3 rounded-lg bg-gray-100 border focus:outline-none focus:ring-2 focus:ring-purple-500">
        </div>
        <div>
          <label class="block mb-1 font-medium">Email</label>
          <input type="email" name="email" class="w-full p-3 rounded-lg bg-gray-100 border focus:outline-none focus:ring-2 focus:ring-purple-500">
        </div>
        <div>
          <label class="block mb-1 font-medium">Password</label>
          <input type="password" name="password" class="w-full p-3 rounded-lg bg-gray-100 border focus:outline-none focus:ring-2 focus:ring-purple-500">
        </div>
        <div>
          <label class="block mb-1 font-medium">Confirm Password</label>
          <input type="password" name="password_confirmation" class="w-full p-3 rounded-lg bg-gray-100 border focus:outline-none focus:ring-2 focus:ring-purple-500">
        </div>
        <button type="submit" class="w-full py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition font-semibold shadow-lg">Register</button>
      </form>
    </div>
  </div>

  <script>
    const loginBtn = document.getElementById('loginBtn');
    const registerBtn = document.getElementById('registerBtn');
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    const branding = document.getElementById('branding');

    loginBtn.addEventListener('click', () => {
      branding.classList.add('branding-animate');
      registerForm.classList.add('hidden');
      loginForm.classList.remove('hidden');
      loginForm.classList.add('fade-up');
    });

    registerBtn.addEventListener('click', () => {
      branding.classList.add('branding-animate');
      loginForm.classList.add('hidden');
      registerForm.classList.remove('hidden');
      registerForm.classList.add('fade-up');
    });
  </script>
</body>
</html>
