<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->

    <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a style="height:150px !important;" class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <div class="sidebar-brand-icon">
          <i class="fas fa-user-cog"></i>
        </div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item @if (\Request::is('/')) active @endif">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span class="sidebar-title">Dashboard</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider my-0">
      <!-- Nav Item - Admins -->
      <li class="nav-item @if (\Request::is('admins')) active @endif">
        <a class="nav-link" href="{{ route('admins') }}">
          <i class="fas fa-fw fa-user-lock"></i>
          <span class="sidebar-title">Admins</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider my-0">
      <!-- Nav Item - Players -->
      <li class="nav-item @if (\Request::is('players/*') || \Request::is('players')) active @endif">
        <a class="nav-link" href="{{ route('players') }}">
          <i class="fas fa-fw fa-users"></i>
          <span class="sidebar-title">Players</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider my-0">
      <!-- Nav Item - Categories -->
      <li class="nav-item @if (\Request::is('categories/*') || \Request::is('categories')) active @endif">
        <a class="nav-link" href="{{ route('categories') }}">
          <i class="fas fa-fw fa-bars"></i>
          <span class="sidebar-title">Categories</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider my-0">
      <!-- Nav Item - Subcategories -->
      <li class="nav-item @if (\Request::is('subcategories/*') || \Request::is('subcategories')) active @endif">
        <a class="nav-link" href="{{ route('subcategories') }}">
          <i class="fas fa-fw fa-database"></i>
          <span class="sidebar-title">Subcategories</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider my-0">
      <!-- Nav Item - Quizzes -->
      <li class="nav-item @if (\Request::is('quizzes/*') || \Request::is('quizzes')) active @endif">
        <a class="nav-link" href="{{ route('quizzes') }}">
          <i class="fas fa-fw fa-cubes"></i>
          <span class="sidebar-title">Quizzes</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider my-0">
      <!-- Nav Item - Text Questions -->
      <li class="nav-item @if (\Request::is('textquestions/*') || \Request::is('textquestions')) active @endif">
        <a class="nav-link" href="{{ route('textquestions.categories') }}">
          <i class="fas fa-text-width fa-fw"></i>
          <span class="sidebar-title">Text Questions</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider my-0">
      <!-- Nav Item - Text Questions -->
      <li class="nav-item @if (\Request::is('imagequestions/*') || \Request::is('imagequestions')) active @endif">
        <a class="nav-link" href="{{ route('imagequestions.categories') }}">
          <i class="fas fa-fw fa-images"></i>
          <span class="sidebar-title">Image Questions</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider my-0">
      <!-- Nav Item - Text Questions -->
      <li class="nav-item @if (\Request::is('audioquestions/*') || \Request::is('audioquestions')) active @endif">
        <a class="nav-link" href="{{ route('audioquestions.categories') }}">
          <i class="fas fa-fw fa-volume-up"></i>
          <span class="sidebar-title">Audio Questions</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider my-0">
       <!-- Nav Item - Daily Quiz -->
      <li class="nav-item @if (\Request::is('dailyquiz/*') || \Request::is('dailyquiz')) active @endif">
        <a class="nav-link" href="{{ route('dailyquiz') }}">
          <i class="fas fa-hourglass-half"></i>
          <span class="sidebar-title">Daily Quiz</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item @if (\Request::is('withdraws/*')) active @endif">
        <a class="nav-link" href="{{ route('withdraws') }}">
          <i class="fas fa-money-bill-wave"></i>
          <span class="sidebar-title">Withdraws</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item @if (\Request::is('paymentmethods/*')) active @endif">
        <a class="nav-link" href="{{ route('paymentmethods') }}">
          <i class="fab fa-cc-visa"></i>
          <span class="sidebar-title">Payment Methods</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item @if (\Request::is('ads/*')) active @endif">
        <a class="nav-link" href="{{ route('ads') }}">
          <i class="fab fa-buysellads"></i>
          <span class="sidebar-title">Ads Management</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item @if (\Request::is('settings/*')) active @endif">
        <a class="nav-link" href="{{ route('settings') }}">
          <i class="fas fa-cogs"></i>
          <span class="sidebar-title">Settings</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->
