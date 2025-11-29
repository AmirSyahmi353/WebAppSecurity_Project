@extends('layouts.app')

<section class="home-hero" style="background: url('{{ asset('assets/img/hero/3s.png') }}') no-repeat center/cover;">
  <div class="container">
    <div class="hero-inner">
      <!-- left -->
      <div class="hero-left">
        <h1 class="hero-title">
          Hey <span class="accent">{{ Auth::user()->name ?? 'there' }}</span>, ready to feel better?
        </h1>
        <p class="hero-sub">
          Let’s track your sugar cravings, log your meals, and uncover what your body is trying to tell you — in the sweetest way possible.
        </p>
        <a href="{{ route('questionnaire.intro') }}" class="hero-cta">Start Now</a>
      </div>
    </div>
  </div>
</section>

<section class="features-section section-bg" >
  <div class="container">
    <div class="row text-center">

      <!-- Option 1: Questionnaire -->
      <div class="col-md-4">
        <div class="feature-card">
          <img src="{{ asset('assets/img/home/13.png') }}" alt="Questionnaire">
          <h3>Questionnaire</h3>
          <p>Evaluate your sugar cravings in just a few minutes.</p>
          <a href="{{ route('questionnaire.intro') }}" class="btn-feature">Start</a>
        </div>
      </div>

      <!-- Option 2: Food Diary -->
      <div class="col-md-4">
        <div class="feature-card">
          <img src="{{ asset('assets/img/home/14.png') }}" alt="Food Diary">
          <h3>3-Days Food Diary</h3>
          <p>Log your meals daily and track your sugar intake.</p>
          <a href="{{ route('food-diary.info') }}" class="btn-feature">Open</a>
        </div>
      </div>

      <!-- Option 3: Result -->
      <div class="col-md-4">
        <div class="feature-card">
          <img src="{{ asset('assets/img/home/15.png') }}" alt="Result">
          <h3>Results</h3>
          <p>See your progress and personalized recommendations.</p>
          <a href="{{ route('home') }}" class="btn-feature">View</a>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- About MySCAT Section -->
    <section id="about-myscat" class="about-section py-5" style="background: url('{{ asset('assets/img/hero/about.png') }}') no-repeat center/cover;">
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