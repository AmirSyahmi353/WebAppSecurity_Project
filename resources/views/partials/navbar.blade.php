@php
    // Only PATIENT needs demographics
    $needsDemographic =
        Auth::check()
        && Auth::user()->role === 'patient'
        && is_null(Auth::user()->demographic);
@endphp

<nav id="mainNavbar" class="navbar navbar-expand-lg navbar-light sticky-top" style="background-color: #DCF4F4;">
  <div class="container d-flex align-items-center">

    <!-- LEFT: LOGO -->
    <a class="navbar-brand fw-bold fs-4 text-uppercase"
       href="{{ $needsDemographic ? route('demographics.create') : route('home') }}"
       style="color: #2F5755; font-family: 'Courier New', monospace;">
      MySCAT
    </a>

    <!-- MOBILE TOGGLER -->
    <button class="navbar-toggler ms-auto" type="button"
            data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- COLLAPSE CONTENT -->
    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">

      <!-- CENTER MENU -->
      <ul class="navbar-nav gap-4 mt-3 mt-lg-0 mx-auto"
          style="font-family: 'Courier New', monospace; font-weight: 600;">
          
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
            href="{{ $needsDemographic ? route('demographics.create') : route('home') }}">
            Home
          </a></li>

        <li class="nav-item"><a class="nav-link {{ request()->routeIs('questionnaire.*') ? 'active' : '' }}"
            href="{{ $needsDemographic ? route('demographics.create') : route('questionnaire.intro') }}">
            Questionnaire
          </a></li>

        <li class="nav-item"><a class="nav-link {{ request()->routeIs('food-diary.*') ? 'active' : '' }}"
            href="{{ $needsDemographic ? route('demographics.create') : route('food-diary.info') }}">
            Food Diary
          </a></li>

        <li class="nav-item"><a class="nav-link {{ request()->routeIs('result.show') ? 'active' : '' }}"
            href="{{ $needsDemographic ? route('demographics.create') : route('result.show') }}">
            Result
          </a></li>
      </ul>

      <!-- MOBILE-ONLY PROFILE & LANGUAGE -->
      <!-- MOBILE-ONLY PROFILE & LANGUAGE -->
<div class="d-lg-none text-start mt-3 ps-2">

    <!-- Profile -->
    <a class="nav-link mb-2 ps-1"
       href="{{ $needsDemographic ? route('demographics.create') : route('demographics.show') }}">
      <i class="bi bi-person-circle" style="font-size: 1.5rem;"></i> Profile
    </a>

    <!-- Logout -->
    <a class="nav-link mb-3 ps-1" href="{{ route('logout') }}"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
      Logout
    </a>

    <!-- Language -->
    <div class="language-toggle ps-1">
      <a href="#" class="lang-link active">EN</a> |
      <a href="#" class="lang-link">BM</a>
    </div>
</div>


    </div>

    <!-- DESKTOP RIGHT SIDE -->
    <div class="d-none d-lg-flex align-items-center gap-3 ms-lg-auto">

      <!-- Profile Dropdown -->
      <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle"
           id="navbarDropdown" role="button" data-bs-toggle="dropdown">
          <i class="bi bi-person-circle" style="font-size: 1.8rem; color:#2F5755;"></i>
        </a>

        <ul class="dropdown-menu dropdown-menu-end">
          <li>
            <a class="dropdown-item"
               href="{{ $needsDemographic ? route('demographics.create') : route('demographics.show') }}">
               Profile
            </a>
          </li>
          <li><hr class="dropdown-divider"></li>
          <li>
            <a class="dropdown-item" href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              Logout
            </a>
          </li>
        </ul>
      </div>

      <!-- Language -->
      <div class="language-toggle">
        <a href="#" class="lang-link active">EN</a> |
        <a href="#" class="lang-link">BM</a>
      </div>

    </div>

  </div>

  <form id="logout-form" action="{{ route('logout') }}" method="POST" hidden>@csrf</form>
</nav>
