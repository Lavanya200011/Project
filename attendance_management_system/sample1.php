<html>
<body>
<div class="bg-gray-800 text-white py-4">
  <div class="max-w-6xl mx-auto px-4">
    <ul class="flex space-x-8 justify-center">
      <li class="relative group">
        <span class="cursor-pointer">Home</span>
        <span class="absolute top-0 left-0 w-0 h-0 border-t-2 border-l-2 border-transparent group-hover:border-white transition-all duration-300"></span>
        <span class="absolute bottom-0 right-0 w-0 h-0 border-b-2 border-r-2 border-transparent group-hover:border-white transition-all duration-300"></span>
      </li>
      <li class="relative group">
        <span class="cursor-pointer">About</span>
        <span class="absolute top-0 left-0 w-0 h-0 border-t-2 border-l-2 border-transparent group-hover:border-white transition-all duration-300"></span>
        <span class="absolute bottom-0 right-0 w-0 h-0 border-b-2 border-r-2 border-transparent group-hover:border-white transition-all duration-300"></span>
      </li>
      <li class="relative group">
        <span class="cursor-pointer">Blog</span>
        <span class="absolute top-0 left-0 w-0 h-0 border-t-2 border-l-2 border-transparent group-hover:border-white transition-all duration-300"></span>
        <span class="absolute bottom-0 right-0 w-0 h-0 border-b-2 border-r-2 border-transparent group-hover:border-white transition-all duration-300"></span>
      </li>
      <li class="relative group">
        <span class="cursor-pointer">Projects</span>
        <span class="absolute top-0 left-0 w-0 h-0 border-t-2 border-l-2 border-transparent group-hover:border-white transition-all duration-300"></span>
        <span class="absolute bottom-0 right-0 w-0 h-0 border-b-2 border-r-2 border-transparent group-hover:border-white transition-all duration-300"></span>
      </li>
      <li class="relative group">
        <span class="cursor-pointer">Contact</span>
        <span class="absolute top-0 left-0 w-0 h-0 border-t-2 border-l-2 border-transparent group-hover:border-white transition-all duration-300"></span>
        <span class="absolute bottom-0 right-0 w-0 h-0 border-b-2 border-r-2 border-transparent group-hover:border-white transition-all duration-300"></span>
      </li>
    </ul>
  </div>
</div>
</body>
</html>



<div id="mobile-menu" class="md:hidden hidden mt-4 px-4 space-y-2">
      <a href="#" class="block hover:text-blue-600">Home Page</a>
      <a href="#" class="block hover:text-blue-600">College Website</a>
      <a href="feedback.php" class="hover:text-blue-600">Feedback</a>
      <a href="createclass.php" class="block hover:text-blue-600">Create New Class</a>
      <?php if (!$isLoggedIn): ?>
        <a href="login.php" class="block bg-black text-white px-4 py-2 mt-2 rounded">Sign Up/Login</a>
      <?php else: ?>
        <a href="logout.php" class="block bg-red-600 text-white px-4 py-2 mt-2 rounded">Logout</a>
      <?php endif; ?>
    </div>