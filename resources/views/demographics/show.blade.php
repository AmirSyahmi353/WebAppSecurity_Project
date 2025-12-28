@extends('layouts.app')
@php
    // BMI calculation
    $bmi = round($demographics->weight_kg / pow($demographics->height_cm / 100, 2), 1);

    // Determine status & color
    if ($bmi < 18.5) { $status = "Underweight"; $color = "#1e90ff"; }
    elseif ($bmi < 24.9) { $status = "Normal"; $color = "#2ecc71"; }
    elseif ($bmi < 29.9) { $status = "Overweight"; $color = "#f1c40f"; }
    else { $status = "Obese"; $color = "#e74c3c"; }

    // Map BMI (0–40) to angle (−90° to +90°)
    $angle = (($bmi / 40) * 180) - 90;
    $angle = max(-90, min($angle, 90));
@endphp

@section('content')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">

<div class="demo-body d-flex justify-content-center align-items-center">
    <div class="demo-card shadow-lg p-5 rounded-4">

        <h2 class="text-center mb-2">Your MySCAT Profile</h2>
        <p class="text-center mb-4">Below is your recorded demographic information.</p>

        <!-- Full Name -->
        <div class="row mb-3">
            <div class="col-12 mb-3">
                <label class="form-label fw-semibold">Full Name</label>
                <input type="text" class="form-control" value="{!! $demographics->full_name !!}" readonly>
            </div>
        </div>

        <!-- Two-column info -->
        <div class="row mb-3">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="text" class="form-control" value="{!! $demographics->email !!}" readonly>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Occupation</label>
                <input type="text" class="form-control" value="{!! $demographics->occupation !!}" readonly>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4 mb-3">
                <label class="form-label fw-semibold">Age</label>
                <input type="text" class="form-control" value="{{ $demographics->age }}" readonly>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label fw-semibold">Gender</label>
                <input type="text" class="form-control" value="{{ ucfirst($demographics->gender) }}" readonly>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label fw-semibold">Race</label>
                <input type="text" class="form-control" value="{{ $demographics->race }}" readonly>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Education Level</label>
                <input type="text" class="form-control" value="{!! $demographics->education !!}" readonly>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Postcode</label>
                <input type="text" class="form-control" value="{{ $demographics->postcode }}" readonly>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Height (cm)</label>
                <input type="text" class="form-control" value="{{ $demographics->height_cm }}" readonly>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Weight (kg)</label>
                <input type="text" class="form-control" value="{{ $demographics->weight_kg }}" readonly>
            </div>
        </div>

        @php
            $bmi = round($demographics->weight_kg / pow($demographics->height_cm / 100, 2), 1);
            if ($bmi < 18.5) { $status = 'Underweight'; $color = '#A8DADC'; }  /* Soft Blue */
            elseif ($bmi < 24.9) { $status = 'Normal'; $color = '#B7E4C7'; }   /* Soft Green */
            elseif ($bmi < 29.9) { $status = 'Overweight'; $color = '#FFD6A5'; } /* Soft Orange */
            else { $status = 'Obese'; $color = '#FFADAD'; }                     /* Soft Red */

            $angle = min(max(($bmi / 40) * 180, 0), 180);
        @endphp

        <!-- BMI Meter -->
        <div class="bmi-bar-container">
    <h5 class="text-center mb-3">Your BMI Result</h5>

    <!-- BMI Line + Meter -->
    <div class="bmi-meter-wrapper">
        <div class="bmi-bar">
            <div class="bmi-segment underweight"><span>Underweight</span></div>
        <div class="bmi-segment normal"><span>Normal</span></div>
        <div class="bmi-segment overweight"><span>Overweight</span></div>
        <div class="bmi-segment obese"><span>Obese</span></div>
        </div>

        <!-- The thin meter line -->
        <div class="bmi-meter-line"></div>

        <!-- Needle pointer -->
        <div id="bmi-needle"></div>
    </div>

    <!-- BMI text -->
    <div class="bmi-value text-center mt-4">
        <strong style="color: {{ $color }}; font-size:1.7rem;">BMI = {{ $bmi }}</strong><br>
        <span style="color: {{ $color }};">({{ $status }})</span>
    </div>

    <p class="text-center mt-3">Healthy range: 18.5 – 24.9 kg/m²</p>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const bmi = {{ $bmi }};
    const needle = document.getElementById("bmi-needle");

    // Keep BMI within range 10–40 for clean UI scale
    let capped = Math.min(Math.max(bmi, 10), 40);

    // Convert BMI → 0–100% position
    const percent = ((capped - 10) / 30) * 100;

    // Move needle
    needle.style.left = `calc(${percent}% - 7px)`;
});
</script>






        <!-- Buttons -->
        <div class="text-center mt-5">
            @if(!isset($readonly) || !$readonly)
                <a href="{{ route('demographics.edit') }}" class="btn-submit">
                    Edit Profile
                </a>
            @endif

            <a href="{{ route('home') }}" class="btn-back-home mt-2">
                Back to Home
            </a>
        </div>
    </div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const angle = {{ $angle }};
        const needle = document.getElementById("needle");
        needle.style.transform = `rotate(${angle}deg)`;
        needle.style.transition = "transform 1.2s ease-out";
    });
</script>

@endsection
