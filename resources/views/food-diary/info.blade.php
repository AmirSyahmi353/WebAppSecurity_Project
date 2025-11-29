@extends('layouts.app')

@section('content')
<section class="fooddiary-hero" style="background: url('{{ asset('assets/img/fooddiary/bg.png') }}') no-repeat center/cover; min-height:100vh; padding:60px 0;"> <!-- Background wrapper -->
    <div class="fooddiary-box"> <!-- Transparent card like questionnaire -->

        <h2 class="mb-4 fw-bold text-center">Food Diary Instructions 🍽️</h2>

        <p>
            As part of this assessment, you are required to <strong>record your meals for 3 selected days within a week</strong>.
            This helps the dietitian understand your eating habits and sugar intake pattern.
        </p>

        <p><strong>For each meal entry, please provide:</strong></p>
        <ul>
            <li><strong>Meal Type:</strong> Breakfast, Lunch, Dinner, Supper, or Snack.</li>
            <li><strong>Time of Meal:</strong> Example: Breakfast at 11:00 AM (even if it's late).</li>
            <li><strong>Food Items & Description:</strong> e.g. “Nasi lemak with egg and sambal”, “1 cup Milo kurang manis”.</li>
            <li><strong>Portion Size:</strong> Full plate, half plate, quarter plate, 1 chicken piece, 1 scoop rice, etc.</li>
            <li><strong>Image (Optional):</strong> You may upload a photo of your meal for validation.</li>
        </ul>

        <hr>

        <h5 class="mt-4">📸 Portion Size Visual Guide</h5>
        <p class="text-muted mb-3">These images help you estimate your portion size better:</p>

        <div class="row text-center portion-row">
            <div class="col-4">
                <p class="fw-bold">Full Plate</p>
                <img src="{{ asset('images/portion/full_plate.jpg') }}" class="food-portion-img" alt="Full Plate">
            </div>
            <div class="col-4">
                <p class="fw-bold">Half Plate</p>
                <img src="{{ asset('images/portion/half_plate.jpg') }}" class="food-portion-img" alt="Half Plate">
            </div>
            <div class="col-4">
                <p class="fw-bold">Quarter Plate</p>
                <img src="{{ asset('images/portion/quarter_plate.jpg') }}" class="food-portion-img" alt="Quarter Plate">
            </div>
        </div>

        <p class="mt-4">✅ You can view, edit, or delete your entries before submitting all 3 days.</p>

        <div class="text-center mt-4">
            <a href="{{ route('food-diary.day') }}" class="btn btn-soft">
                Start Logging My Meals
            </a>
        </div>
    </div>
</section>
@endsection
