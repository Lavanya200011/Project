<?php
session_start();
$isLoggedIn = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Attendance Management for Teachers</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet"/>

  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    @keyframes fadeInUp {
      0% { opacity: 0; transform: translateY(24px); }
      100% { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-up {
      animation: fadeInUp 0.6s ease-out forwards;
    }
  </style>

  <script defer>
    function toggleMenu() {
      const mobileMenu = document.getElementById('mobile-menu');
      const sidebarMenu = document.getElementById('sidebar-menu');
      mobileMenu.classList.toggle('hidden');

      if (window.innerWidth < 768) {
        if (!mobileMenu.classList.contains('hidden')) {
          sidebarMenu.classList.add('hidden');
        } else {
          sidebarMenu.classList.remove('hidden');
        }
      }
    }

    window.addEventListener('resize', () => {
      const sidebarMenu = document.getElementById('sidebar-menu');
      const mobileMenu = document.getElementById('mobile-menu');
      if (window.innerWidth >= 768) {
        sidebarMenu.classList.remove('hidden');
        mobileMenu.classList.add('hidden');
      }
    });
  </script>
</head>
<body class="bg-gray-800 text-white">

  <!-- Navbar -->
  <nav class="bg-white text-black px-4 py-4">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
      <div class="flex items-center space-x-4">
        <img src="kcem.png" alt="Logo" class="h-16 w-16">
        <span class="font-bold text-lg">KCEM</span>
      </div>
      <div class="md:hidden">
        <button onclick="toggleMenu()" class="focus:outline-none">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M4 6h16M4 12h16M4 18h16"></path>
          </svg>
        </button>
      </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="md:hidden hidden mt-4 px-4 space-y-2">
      <a href="#" class="block hover:text-blue-600">Home Page</a>
      <a href="#" class="block hover:text-blue-600">College Website</a>
      <a href="home1.html" class="block hover:text-blue-600">Create New Class</a>
      <?php if (!$isLoggedIn): ?>
        <a href="login.php" class="block bg-black text-white px-4 py-2 mt-2 rounded">Sign Up/Login</a>
      <?php else: ?>
        <a href="logout.php" class="block bg-red-600 text-white px-4 py-2 mt-2 rounded">Logout</a>
      <?php endif; ?>
    </div>
  </nav>

  <!-- Main Section -->
  <section class="flex flex-col lg:flex-row justify-between px-6 py-16 gap-12">

    <!-- Hero Section -->
    <div class="lg:w-2/3">
      <p class="text-sm tracking-wide uppercase text-gray-300">Attendance</p>
      <h1 class="text-3xl md:text-4xl font-bold mt-2 mb-4">KCEM Attendance Management</h1>
      <p class="text-gray-300 max-w-2xl">
        Our platform allows teachers to easily input attendance records. Additionally, they can generate attendance reports in PDF format for their records.
      </p>

      <div class="grid md:grid-cols-3 gap-8 mt-12">
        <div class="bg-gray-900 p-6 rounded-lg">
          <div class="text-3xl mb-4">🚹</div>
          <h3 class="text-xl font-semibold mb-2">Total Boys</h3>
          <p class="text-gray-400">300</p>
        </div>
        <div class="bg-gray-900 p-6 rounded-lg">
          <div class="text-3xl mb-4">🚺</div>
          <h3 class="text-xl font-semibold mb-2">Total Girls</h3>
          <p class="text-gray-400">300</p>
        </div>
        <div class="bg-gray-900 p-6 rounded-lg">
          <div class="text-3xl mb-4">🧑🏻‍🎓</div>
          <h3 class="text-xl font-semibold mb-2">Total Students</h3>
          <p class="text-gray-400">600</p>
        </div>
      </div>

      <div class="mt-8">
        <a href="checkattendance.php" class="bg-white text-black px-6 py-2 rounded-full border border-blue-300 hover:bg-blue-200">
          Check your Attendance info
        </a>
      </div>

      <?php if ($isLoggedIn): ?>
        <div class="mt-10 flex flex-wrap gap-4">
          <a href="markattendance.php" class="bg-white text-black px-6 py-2 rounded-full border border-blue-300 hover:bg-blue-200">
            Input Attendance
          </a>
          <a href="attendancereport.php" class="bg-white text-black px-6 py-2 rounded-full border border-blue-300 hover:bg-blue-200">
            Get Attendance report
          </a>
        </div>
      <?php endif; ?>
    </div>

    <!-- Sidebar -->
    <aside id="sidebar-menu" class="lg:w-1/3 overflow-auto text-center animate-fade-in-up hidden md:block">
      <nav>
        <h3 class="text-sm uppercase font-semibold mb-4">Menu</h3>
        <ul class="space-y-4">
          <li><a href="#" class="block text-sm font-semibold text-[#99a0b0] hover:text-white p-6 rounded-lg transition transform hover:-translate-y-1 shadow-lg shadow-blue-500/50">Contact Us</a></li>
          <li><a href="#" class="block text-sm font-semibold text-[#99a0b0] hover:text-white p-6 rounded-lg transition transform hover:-translate-y-1 shadow-lg shadow-blue-500/50">College Website</a></li>
          <li><a href="home1.html" class="block text-sm font-semibold text-[#99a0b0] hover:text-white p-6 rounded-lg transition transform hover:-translate-y-1 shadow-lg shadow-blue-500/50">Create New Class</a></li>
          <li>
            <?php if (!$isLoggedIn): ?>
              <a href="login.html" class="block text-sm font-semibold text-[#99a0b0] hover:text-white p-6 rounded-lg transition transform hover:-translate-y-1 shadow-lg shadow-blue-500/50">Login</a>
            <?php else: ?>
              <a href="logout.php" class="block text-sm font-semibold text-[#99a0b0] hover:text-white p-6 rounded-lg transition transform hover:-translate-y-1 shadow-lg shadow-blue-500/50">Logout</a>
            <?php endif; ?>
          </li>
          <br>
        </ul>
      </nav>
    </aside>
  </section>

  <!-- Footer -->
  <footer class="bg-white text-black py-10 px-4">
    <div class="max-w-6xl mx-auto grid md:grid-cols-4 gap-8">
      <div>
        <img src="attendance1.jpg" alt="" class="h-48 max-w-65">
      </div>
      <div>
        <h4 class="font-semibold mb-2">Developer Team</h4>
        <ul class="text-sm space-y-1">
          <li><a href="#" class="hover:text-blue-600">Lavanya Thawkar</a></li>
          <li><a href="#" class="hover:text-blue-600">Akash Durutkar</a></li>
          <li><a href="#" class="hover:text-blue-600">Rahul Kosame</a></li>
        </ul>
      </div>
      <div>
        <h4 class="font-semibold mb-2">Other Information</h4>
        <ul class="text-sm space-y-1">
          <li><a href="#" class="hover:text-blue-600">xxxxxx</a></li>
          <li><a href="#" class="hover:text-blue-600">xxxxxx</a></li>
          <li><a href="#" class="hover:text-blue-600">xxxxxx</a></li>
        </ul>
      </div>
      <div>
        <h4 class="font-semibold mb-2">Other Information</h4>
        <ul class="text-sm space-y-1">
          <li><a href="#" class="hover:text-blue-600">xxxxxx</a></li>
          <li><a href="#" class="hover:text-blue-600">xxxxxx</a></li>
          <li><a href="#" class="hover:text-blue-600">xxxxxx</a></li>
        </ul>
      </div>
    </div>
    <div class="text-center text-xs text-gray-500 mt-10">
      <p>&copy; 2025 KCEM. All rights reserved.</p>
      <div class="space-x-4 mt-2">
        <a href="#" class="hover:underline">Terms of Service</a>
      </div>
    </div>
  </footer>

</body>
</html>
