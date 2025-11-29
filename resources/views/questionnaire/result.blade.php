@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="p-5 rounded shadow text-center" style="background-color: #ffe4e1; max-width: 600px; width: 100%;">

        <h2 class="mb-4 fw-bold">Your Craving Results</h2>

        <!-- Total Score -->
        <p class="fs-4">
            <strong>Total Score:</strong> {{ $totalScore }}/{{ $maxScore }}
        </p>

        <!-- Craving Level -->
        <div class="p-3 mb-4 rounded fw-bold fs-5" style="background-color: {{ $color }};">
            {{ $level }} Craving
        </div>

        <!-- Message -->
        <p class="fs-5">{{ $message }}</p>

        <!-- Buttons -->
        <div class="mt-4 d-flex flex-column gap-3">

            <!-- Take Again -->
            <a href="{{ route('questionnaire.intro') }}"
               class="btn"
               style="background-color: #ffdac1; border:none; padding:10px 25px; border-radius:15px;">
                Take Again
            </a>

            <!-- ⭐ View Food Diary Log -->
            <a href="{{ route('food-diary.view') }}"
               class="btn"
               style="background-color:#b5ead7; border:none; padding:10px 25px; border-radius:15px;">
                View Food Diary Log
            </a>

        </div>

    </div>
</div>
@endsection
