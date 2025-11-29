<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MySCAT: Sugar Craving Assessment Tool</title>

  <!-- Favicons -->
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/favicons/apple-touch-icon.png') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicons/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/favicons/favicon-16x16.png') }}">
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicons/favicon.png') }}">
  <meta name="theme-color" content="#ffffff">

  <!-- Styles -->
  {{-- @vite(['resources/css/main.css', 'resources/js/app.js']) --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  



  <style>

    #mainNavbar {
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 999;
      background-color: #F9F6F3 !important;
      transition: box-shadow 0.3s ease, border-radius 0.3s ease;
      padding: 12px 0;
    }

    #mainNavbar:hover {
      box-shadow: 0 4px 20px rgba(79, 183, 179, 0.3);
      border-radius: 15px;
    }

    .nav-link {
      color: #2F5755 !important;
      font-family: "Courier New", monospace;
      font-weight: 600;
      transition: color 0.3s ease, transform 0.2s ease;
      border-radius: 20px;
      padding: 8px 18px;
    }

    .nav-link:hover {
      color: #fff !important;
      background-color: #A1C2BD;
      box-shadow: 0 0 14px rgba(90, 150, 144, 0.6);
      border-radius: 25px;
      transform: scale(1.05);
    }

    .btn-login {
      border: 2px solid #4FB7B3;
      color: #2F5755;
      font-family: "Courier New", monospace;
      font-weight: 600;
      background: transparent;
      border-radius: 10px;
      padding: 8px 24px; /* ✅ Restored padding */
      transition: all 0.3s ease;
    }

    .btn-login:hover {
      background-color: #A1C2BD;
      color: #FEFAE0;
      border-color: #A1C2BD;
    }

    .language-toggle {
      font-family: "Courier New", monospace;
      font-weight: 600;
      color: #2F5755;
    }

    .language-toggle .lang-link {
      color: #2F5755;
      text-decoration: none;
      transition: color 0.3s ease;
    }

    .language-toggle .lang-link:hover {
      color: #A1C2BD;
    }

    .language-toggle .lang-link.active {
      font-weight: bold;
      color: #4FB7B3;
    }

    /* Default desktop */
.hero-title {
  font-size: 5rem;
  font-family: 'Fredoka', serif;
  font-weight: 700;
  color: #294544;
  line-height: 1.2;
}

.hero-text {
  font-size: 1.3rem;
  font-family: 'Poppins', sans-serif;
  color: #2F5755;
}

/* Tablet */
@media (max-width: 992px) {
  .hero-title { font-size: 4rem; }
  .hero-text { font-size: 1.1rem; }
}

/* Mobile */
@media (max-width: 768px) {
  .hero-title { 
    font-size: 3rem; 
    text-align: ;
  }
  .hero-text { 
    font-size: 1rem; 
    text-align: ; 
  }
  .hero-section {
    text-align: center;
    padding-top: 100px;
  }
}

/* Small phones */
@media (max-width: 576px) {
  .hero-title { font-size: 2.2rem; }
  .hero-text { font-size: 0.9rem; }
}


    .who-section {
        padding: 1000px 0;
    }

    .who-card {
        background: #ffe2e2;
        padding: 20px;
        border-radius: 15px;
        text-align: center;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        height: 100%;
    }

    .who-card img {
        width: 100%;
        height: 200px;
        object-fit: contain; /* Keeps image proportional without cropping */
        margin-bottom: 15px;
    }

    .who-card h4 {
        font-weight: bold;
        color: #2F5755;
        margin-bottom: 8px;
    }

    .who-card p {
        font-size: 0.9rem;
        color: #555;
    }

    @media (max-width: 768px) {
        .who-card img {
            height: 150px;
        }
        .section-title {
            font-size: 1.6rem;
        }
    }

    /* About Section Background */
    .about-section {
      background-image: url('{{ asset('assets/img/hero/about.png') }}'); 
      background-size: cover;        /* Makes image cover full section */
      background-position: center top 200px;
      background-position: center;   /* Centers the image */
      background-repeat: no-repeat;  /* Prevents tiling */
      min-height: 100vh;
      height:auto;                 /* Make it full screen like other sections */
      color: white;                  /* Text readable on image (optional) */
    }

    .about-section .container {
        position: relative;
        z-index: 2;
        text-align: center;
        padding-top: 150px; /* 🔹 Push text downward */
    }

    .about-text h2 {
        font-size: 2.3rem;
        font-weight: 700;
        color: #2F5755;
        font-family: 'Poppins', serif;
    }

    .about-desc {
        font-family: 'Poppins', sans-serif;
        color: #555;
        font-size: 1rem;
        margin-top: 15px;
        line-height: 1.7;
    }

    .about-image img {
        width: 100%;         /* Make it full width of its container */
        max-width: 1000px;    /* Increase this value to make it bigger */
        height: auto;        /* Keep the aspect ratio */
        display: block;
        margin: 0 auto;      /* Center the image */
    }

    /* Responsive for mobile */
    @media (max-width: 768px) {
        .about-section .container {
            flex-direction: column;
            text-align: center;
        }
        .about-text, .about-image {
            margin-bottom: 25px;
        }
    }

    .myscat-footer {
        background: linear-gradient(to bottom, #ffffff, #c5c2c2);
        padding: 40px 20px;
        text-align: center;
        font-family: 'Poppins', sans-serif;
        color: #2F5755;
    }

    /* Partners Logo Row */
    .footer-partners img {
        width: 100px;
        margin: 0 15px;
        opacity: 0.9;
        transition: transform 0.3s;
    }

    .footer-partners img:hover {
        transform: scale(1.05);
    }

    /* Links */
    .footer-links {
        margin: 20px 0;
    }

    .footer-links a {
        margin: 0 15px;
        color: #2F5755;
        font-weight: 500;
        text-decoration: none;
    }

    .footer-links a:hover {
        text-decoration: underline;
    }

    /* Divider */
    .footer-line {
        width: 80%;
        margin: 20px auto;
        border: 0.5px solid #ccc;
    }

    /* Bottom */
    .footer-bottom {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        max-width: 800px;
        margin: auto;
    }

    .footer-bottom p {
        margin: 0;
    }

    .footer-social img {
        width: 28px;
        margin: 0 8px;
        opacity: 0.8;
    }

    .footer-social img:hover {
        opacity: 1;
    }

  </style>
</head>

<body style="background-color:#ffffff;">

  <main class="main" id="top">
    <nav id="mainNavbar" class="navbar navbar-expand-lg navbar-light sticky-top" 
     style="background-color: rgb(220, 244, 244);">
  
  <div class="container d-flex justify-content-between align-items-center">

    <!-- Logo -->
    <a class="navbar-brand fw-bold fs-4 text-uppercase"
       href="#"
       style="color: #2F5755; font-family: 'Courier New', monospace;">
      MySCAT
    </a>

    <!-- Hamburger -->
    <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Collapsible Section -->
    <div class="collapse navbar-collapse" id="navbarNav">

      <!-- Center menu (desktop centered, mobile LEFT) -->
      <ul class="navbar-nav mx-lg-auto ms-0 mt-3 mt-lg-0 gap-2"
          style="font-family: 'Courier New', monospace; font-weight: 600; text-align: left;">
        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Questionnaire</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Food Diary</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Result</a></li>
      </ul>

      <!-- Login + Language (mobile LEFT, desktop RIGHT) -->
      <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center gap-3 ms-lg-auto mt-3 mt-lg-0">

        <a href="{{ route('login') }}" class="btn btn-login px-3 py-2">Login</a>

        <div class="language-toggle">
          <a href="#" class="lang-link active">EN</a> |
          <a href="#" class="lang-link">BM</a>
        </div>

      </div>

    </div>

  </div>
</nav>



    <!-- HERO Section -->
    <section class="hero-section d-flex align-items-center" 
        style="min-height: 100vh; 
               background: url('{{ asset('assets/img/hero/3s.png') }}') no-repeat center center/cover;
               padding-top: 120px;">

      <div class="container text-start">
        <div class="row align-items-center">
          <div class="col-md-6">
            <h1 class="hero-title">
              Take Control with <span style="color:#FF76CE;">MySCAT</span>
            </h1>

            <p class="hero-text mt-3" style="max-width: 90%;">
              Understand your sugar cravings. <br>
              Live healthier, one mindful choice at a time.
            </p>

            <div class="mt-4">
              <a href="{{ route('login') }}" 
                class="btn btn-login px-20 py-10" 
                style="font-size: 1.2rem; border-radius: 12px;">
                Start MySCAT
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>


    <!-- Who Can Take the Test Section -->
    <section id="who-can" class="who-section py-5" 
        style="background: url('{{ asset('assets/img/hero/who.png') }}') no-repeat center/cover;">
      <div class="container text-center">
        <h2 class="mb-5 section-title">Who Can Take the Test?</h2>

        <div class="row justify-content-center">

          <!-- Diabetic -->
          <div class="col-md-4 col-sm-6 mb-4">
            <div class="who-card">
              <img src="{{ asset('assets/img/who/1.png') }}" alt="Diabetic Individuals">
              <h4>Diabetic Individuals</h4>
              <p>People who need to monitor sugar levels regularly and manage intake.</p>
            </div>
          </div>

          <!-- Obese -->
          <div class="col-md-4 col-sm-6 mb-4">
            <div class="who-card">
              <img src="{{ asset('assets/img/who/2.png') }}" alt="Obese Individuals">
              <h4>People with Obesity</h4>
              <p>Those who want to reduce sugar and maintain a healthier weight.</p>
            </div>
          </div>

          <!-- Heart Disease -->
          <div class="col-md-4 col-sm-6 mb-4">
            <div class="who-card">
              <img src="{{ asset('assets/img/who/3.png') }}" alt="Heart Patients">
              <h4>Heart Disease Patients</h4>
              <p>Individuals who require diet awareness to protect cardiovascular health.</p>
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- About MySCAT Section -->
    <section id="about-myscat" class="about-section py-5">
      <div class="container d-flex align-items-center justify-content-between flex-wrap">

        <!-- Left Content (Text) -->
        <div class="about-text" style="flex: 1; min-width: 300px;">
          <h2 class="section-title">What is MySCAT?</h2>
          <p class="about-desc">
            MySCAT (Malaysian Sugar Craving Assessment Tool) is a scientifically developed tool created under the 
            Department of Nutrition Sciences, Kulliyyah of Allied Health Sciences (KAHS), IIUM.
            It aims to assess and identify levels of sugar craving among individuals in a simple, structured, and meaningful way.
          </p>
          <p class="about-desc">
            This tool helps you understand emotional and physical triggers of sugar cravings, empowering you to 
            take control of your health with better self-awareness and informed lifestyle choices.
          </p>
          <p class="about-desc">
            Whether you are managing diabetes, obesity, heart-related conditions, or simply want to build healthier habits. 
            MySCAT provides the first step toward mindful sugar control and improved well-being.
          </p>
        </div>

        <!-- Right Content (Image) -->
        <div class="about-image text-center" style="flex: 1; min-width: 300px;">
          <img src="{{ asset('assets/img/hero/about-img.png') }}" 
              alt="MySCAT App Preview" 
              class="img-fluid"
              style="width: 100%; max-width: 700px; border-radius: 10px;">
        </div>
      </div>
    </section>



  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

<footer class="bg-light py-4">
  <div class="container">

    <!-- Partners Section -->
<div class="d-flex align-items-center justify-content-center gap-3 mb-3">
  <p class="fw-bold mb-0">Partners:</p>
  <div class="d-flex gap-3 overflow-auto" style="white-space: nowrap;">
    <img src="{{ asset('assets/img/hero/icon1.png') }}" alt="Partner 1" height="40">
    <img src="{{ asset('assets/img/hero/icon1.png') }}" alt="Partner 2" height="40">
    <!-- Add more logos -->
  </div>
</div>



    <!-- Links -->
    <div class="text-center mb-3">
      <a href="#about-myscat" class="text-dark text-decoration-none mx-2">About</a>
      <a href="#" class="text-dark text-decoration-none mx-2">Contact Us</a>
      <a href="{{ route('terms-policy') }}" class="text-dark text-decoration-none mx-2">Terms</a>
      <a href="{{ route('terms-policy') }}" class="text-dark text-decoration-none mx-2">Policy</a>

    </div>

    <!-- Divider -->
    <hr class="mt-0 mb-2">

    <!-- Bottom Section -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
      <p class="mb-2 mb-md-0 text-muted">&copy; 2025 MySCAT Program. All rights reserved.</p>
      <div>
        <span class="me-2">Follow us:</span>
        <a href="https://www.youtube.com/@kulliyyahofalliedhealthsci9297" class="text-dark mx-1"><i class="bi bi-youtube"></i></a>
        <a href="https://kulliyyah.iium.edu.my/kahs/kulliyyah-allied-health-sciences/#" class="text-dark mx-1"><i class="bi bi-globe2"></i></a>
      </div>
    </div>
  </div>
</footer>

</html>
