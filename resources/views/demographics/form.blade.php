@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">

<section class="demo-body">
  <div class="demo-card">
    <h2>Demographic Information</h2>
    <p class="text-muted text-center mb-4">
      Please fill in your basic information before proceeding to MySCAT questionnaire.
    </p>

    {{-- Validation errors --}}
    @if ($errors->any())
      <div class="alert alert-error">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('demographics.store') }}" method="POST">
      @csrf

      {{-- Full Name --}}
      <div class="form-group full-width">
        <label for="full_name">Full Name (as per IC)</label>
        <input id="full_name" type="text" name="full_name"
               placeholder="Enter your full name as per IC"
               value="{{ old('full_name') }}" required>
      </div>

      {{-- Email --}}
      <div class="form-group full-width">
        <label for="email">Email</label>
        @if(Auth::check())
          <input id="email" type="email" name="email"
                 value="{{ old('email', Auth::user()->email) }}" readonly>
        @else
          <input id="email" type="email" name="email"
                 value="{{ old('email') }}" placeholder="Enter your email" required>
        @endif
      </div>

      {{-- Age --}}
      <div class="form-group">
        <label>Age</label>
        <input type="number" name="age" min="1" placeholder="Enter your age"
               value="{{ old('age') }}" required>
      </div>

      {{-- Gender --}}
      <div class="form-group">
        <label>Gender</label>
        <select name="gender" required>
          <option value="">-- Select Gender --</option>
          <option value="Male" {{ old('gender')=='Male'?'selected':'' }}>Male</option>
          <option value="Female" {{ old('gender')=='Female'?'selected':'' }}>Female</option>
        </select>
      </div>

      {{-- Race --}}
      <div class="form-group">
        <label>Race</label>
        <select name="race" required>
          <option value="">-- Select Race --</option>
          <option value="Malay" {{ old('race')=='Malay'?'selected':'' }}>Malay</option>
          <option value="Chinese" {{ old('race')=='Chinese'?'selected':'' }}>Chinese</option>
          <option value="Indian" {{ old('race')=='Indian'?'selected':'' }}>Indian</option>
          <option value="Others" {{ old('race')=='Others'?'selected':'' }}>Others</option>
        </select>
      </div>

      {{-- Height --}}
      <div class="form-group">
        <label>Height (cm)</label>
        <input type="number" name="height" step="0.1" placeholder="e.g. 170"
               value="{{ old('height') }}" required>
      </div>

      {{-- Weight --}}
      <div class="form-group">
        <label>Weight (kg)</label>
        <input type="number" name="weight" step="0.1" placeholder="e.g. 65"
               value="{{ old('weight') }}" required>
      </div>

      {{-- Education --}}
      <div class="form-group">
        <label>Education Level</label>
        <select name="education" required>
          <option value="">-- Select Education Level --</option>
          <option value="Primary" {{ old('education')=='Primary'?'selected':'' }}>Primary</option>
          <option value="Secondary" {{ old('education')=='Secondary'?'selected':'' }}>Secondary</option>
          <option value="Diploma" {{ old('education')=='Diploma'?'selected':'' }}>Diploma</option>
          <option value="Bachelor" {{ old('education')=='Bachelor'?'selected':'' }}>Bachelor</option>
          <option value="Master" {{ old('education')=='Master'?'selected':'' }}>Master</option>
          <option value="PhD" {{ old('education')=='PhD'?'selected':'' }}>PhD</option>
        </select>
      </div>

      {{-- Occupation --}}
      <div class="form-group">
        <label>Occupation</label>
        <input type="text" name="occupation" placeholder="e.g. Student, Teacher, Engineer"
               value="{{ old('occupation') }}" required>
      </div>

      {{-- Postcode --}}
      <div class="form-group">
        <label>Postcode</label>
        <input type="text" name="postcode" placeholder="Enter your postcode"
               value="{{ old('postcode') }}" required>
      </div>

      {{-- Income --}}
      <div class="form-group">
        <label>Monthly Income (RM)</label>
        <select name="income" required>
          <option value="">-- Select Range --</option>
          <option value="Below 1000" {{ old('income')=='Below 1000'?'selected':'' }}>Below RM1000</option>
          <option value="1000-2999" {{ old('income')=='1000-2999'?'selected':'' }}>RM1000 - RM2999</option>
          <option value="3000-4999" {{ old('income')=='3000-4999'?'selected':'' }}>RM3000 - RM4999</option>
          <option value="5000-9999" {{ old('income')=='5000-9999'?'selected':'' }}>RM5000 - RM9999</option>
          <option value="10000+" {{ old('income')=='10000+'?'selected':'' }}>RM10000 and above</option>
        </select>
      </div>

      {{-- Submit --}}
      <div class="form-group text-center">
        <button type="submit" class="btn-submit">Submit</button>
      </div>
    </form>
  </div>
</section>
@endsection
