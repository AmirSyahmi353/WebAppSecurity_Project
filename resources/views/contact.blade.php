@extends('layouts.app')

@section('content')
<section class="contact-hero">
    <div class="container">
        <h1 class="contact-title text-center mb-5">Contact Us</h1>

        <div class="contact-hero-row">
            <!-- Left: Logo -->
            <div class="contact-logo">
                <img src="{{ asset('images/kuliyyah-logo.png') }}" alt="Kulliyyah of Allied Health Sciences Logo">
            </div>

            <!-- Right: Info -->
            <div class="contact-info">
                <h2>Kulliyyah of Allied Health Sciences</h2>

                <div class="contact-item">
                    <i class="bi bi-geo-alt-fill"></i>
                    <span>International Islamic University Malaysia (IIUM), Jalan Sultan Ahmad Shah, 25200 Kuantan, Pahang, Malaysia</span>
                </div>

                <div class="contact-row">
                    <div class="contact-item">
                        <i class="bi bi-telephone-fill"></i>
                        <span>09-5704000 ext. 3283</span><span>09-5705218</span>
                    </div>

                    <div class="contact-item">
                        <i class="bi bi-clock-fill"></i>
                        <span>Mon – Fri, 8:00 AM – 5:00 PM</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="{{ asset('css/contact-us.css') }}">
</section>
@endsection
