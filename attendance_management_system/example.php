<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tailwind Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* Tailwind doesn't support named grid areas directly */
    .grid-areas-dashboard {
      display: grid;
      grid-template-columns: 300px auto;
      grid-template-rows: 80px auto;
      grid-template-areas:
        "menu search"
        "menu content";
    }

    .area-menu {
      grid-area: menu;
    }




  @keyframes fadeInUp {
    0% {
      opacity: 0;
      transform: translateY(24px);
    }
    100% {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .animate-fade-in-up {
    animation: fadeInUp 0.6s ease-out forwards;
  }


  </style>
</head>
<body class="w-full h-screen overflow-hidden bg-[#f5f5fa] text-[#99a0b0] font-sans">

  <div class="grid-areas-dashboard w-content h-content">

    <!-- Sidebar Menu -->
    <aside class="area-menu overflow-auto pb-12 px-12 pt-12">
      <nav>  
        <section>
          <h3 class="text-sm uppercase font-semibold text-[#4b84fe]    animate-fade-in-up bg-white p-6 rounded shadow-md">Discover</h3>
          <ul class="mt-4 space-y-4">
            <li><a href="#" class="block text-sm font-semibold text-[#99a0b0] hover:text-[#1b253d] transition-colors animate-fade-in-up bg-white p-6 rounded shadow-md">contact us</a></li>
            <li><a href="#" class="block text-sm font-semibold text-[#99a0b0] hover:text-[#1b253d] transition-colors animate-fade-in-up bg-white p-6 rounded shadow-md">collage website</a></li>
            <li><a href="#" class="block text-sm font-semibold text-[#99a0b0] hover:text-[#1b253d] transition-colors animate-fade-in-up bg-white p-6 rounded shadow-md">create new class</a></li>
            <li><a href="#" class="block text-sm font-semibold text-[#99a0b0] hover:text-[#1b253d] transition-colors animate-fade-in-up bg-white p-6 rounded shadow-md">home page</a></li>
          </ul>
        </section>
      </nav>
    </aside>

    

    <!-- Main Content Area
    <main class="area-content p-6">
      <h2 class="text-xl font-bold text-[#1b253d] mb-4">Welcome to Dashboard</h2>
      <p class="text-sm">Start building your content here...</p>
    </main>
    -->
  </div>

</body>
</html>




 <div class="max-w-7xl mx-auto flex justify-between items-center">
      <div class="flex items-center space-x-4">
        <img src="kcem.png" alt="Logo" class="h-16 w-16">
        <span class="font-bold text-lg">KCEM</span>
      </div>
      <div class="hidden md:flex space-x-6">
        <a href="#" class="hover:text-blue-600">Home Page</a>
        <a href="#" class="hover:text-blue-600">College Website</a>
        <a href="contactus.php" class="hover:text-blue-600">Contact Us</a>
        <a href="home1.html" class="hover:text-blue-600">Create New Class</a>
      </div>
      <div class="hidden md:block">
        <?php if (!$isLoggedIn): ?>
          <a href="login.html" class="bg-black text-white px-4 py-2 rounded" id="loginbtn">Login</a>
        <?php else: ?>
          <a href="logout.php" class="bg-red-600 text-white px-4 py-2 rounded">Logout</a>
        <?php endif; ?>
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