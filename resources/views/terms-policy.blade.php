@extends('layouts.app')

@section('content')
<section class="terms-policy-page">
    <div class="container terms-policy-container" >
        <h1 class="text-center mb-5">Terms & Policy</h1>

        <!-- Terms Section -->
        <div class="mb-5" id="terms">
            <h2 class="mb-3">Terms and Conditions</h2>
            <p>MySCAT is a web-based platform designed to assist users in managing sugar craving assessments. By using our services, you agree to abide by the following terms and conditions.</p>

            <h3>Services Offered</h3>
            <p>MySCAT provides patients with access to sugar craving assessments, record keeping, and monitoring through dietitians. This platform does not replace professional medical diagnosis or treatment.</p>

            <h3>User Responsibilities</h3>
            <p>Users must provide accurate information. Providing false data may affect the validity of assessments.</p>

            <h3>Privacy and Data Usage</h3>
            <p>We respect your privacy. Your data is handled according to our Privacy Policy.</p>

            <h3>Proper Use & Disclaimer</h3>
            <p>Users agree to use MySCAT responsibly. The platform does not provide medical treatment.</p>
        </div>

        <!-- Policy Section -->
        <div class="mb-5" id="policy">
            <h2 class="mb-3">Privacy Policy</h2>
            <p>MySCAT collects and stores your demographic and assessment data securely. Information is only used for the purpose of providing assessment results and reporting to your assigned dietitian.</p>

            <h3>Data Protection</h3>
            <p>Your data is encrypted and access is restricted to authorized personnel only.</p>

            <h3>Consent</h3>
            <p>By using MySCAT, you consent to the collection, storage, and use of your information as described above.</p>
        </div>
    </div>

    <!-- Link CSS -->
    <link rel="stylesheet" href="{{ asset('css/terms-policy.css') }}">
</section>
@endsection
