@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">

<section class="demo-body">
  <div class="demo-card">
    <h2>Edit Your Demographic Profile</h2>
    <p class="text-muted" style="text-align:center; margin-bottom:25px;">
      Update your demographic information below.
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

    <form action="{{ route('demographics.update', $demographics->_id) }}" method="POST">
    @csrf
    @method('PUT')

      {{-- Full Name --}}
      <div>
        <label for="full_name">Full Name (as per IC)</label>
        <input id="full_name" type="text" name="full_name"
               value="{{ old('full_name', $demographics->full_name) }}" required>
      </div>

      {{-- Email --}}
      <div>
        <label for="email">Email</label>
        <input id="email" type="email" name="email"
               value="{{ old('email', $demographics->email) }}" readonly>
      </div>

      {{-- Age --}}
      <div>
        <label>Age</label>
        <input type="number" name="age" min="1"
               value="{{ old('age', $demographics->age) }}" required>
      </div>

      {{-- Gender --}}
      <div>
        <label>Gender</label>
        <select name="gender" required>
          <option value="">-- Select Gender --</option>
          <option value="Male" {{ old('gender', $demographics->gender) == 'Male' ? 'selected' : '' }}>Male</option>
          <option value="Female" {{ old('gender', $demographics->gender) == 'Female' ? 'selected' : '' }}>Female</option>
        </select>
      </div>

      {{-- Race --}}
      <div>
        <label>Race</label>
        <select name="race" required>
          <option value="">-- Select Race --</option>
          <option value="Malay" {{ old('race', $demographics->race)=='Malay'?'selected':'' }}>Malay</option>
          <option value="Chinese" {{ old('race', $demographics->race)=='Chinese'?'selected':'' }}>Chinese</option>
          <option value="Indian" {{ old('race', $demographics->race)=='Indian'?'selected':'' }}>Indian</option>
          <option value="Others" {{ old('race', $demographics->race)=='Others'?'selected':'' }}>Others</option>
        </select>
      </div>

      {{-- Height --}}
      <div>
        <label>Height (cm)</label>
        <input type="number" name="height_cm" step="0.1"
               value="{{ old('height', $demographics->height_cm) }}" required>
      </div>

      {{-- Weight --}}
      <div>
        <label>Weight (kg)</label>
        <input type="number" name="weight_kg" step="0.1"
               value="{{ old('weight', $demographics->weight_kg) }}" required>
      </div>

      {{-- Education --}}
      <div>
        <label>Education Level</label>
        <select name="education" required>
          <option value="">-- Select Education Level --</option>
          <option value="Primary" {{ old('education', $demographics->education)=='Primary'?'selected':'' }}>Primary</option>
          <option value="Secondary" {{ old('education', $demographics->education)=='Secondary'?'selected':'' }}>Secondary</option>
          <option value="Diploma" {{ old('education', $demographics->education)=='Diploma'?'selected':'' }}>Diploma</option>
          <option value="Bachelor" {{ old('education', $demographics->education)=='Bachelor'?'selected':'' }}>Bachelor</option>
          <option value="Master" {{ old('education', $demographics->education)=='Master'?'selected':'' }}>Master</option>
          <option value="PhD" {{ old('education', $demographics->education)=='PhD'?'selected':'' }}>PhD</option>
        </select>
      </div>

      {{-- Occupation --}}
      <div>
        <label>Occupation</label>
        <input type="text" name="occupation"
               value="{{ old('occupation', $demographics->occupation) }}" required>
      </div>

      {{-- Postcode --}}
      <div>
        <label>Postcode</label>
        <input type="text" name="postcode"
               value="{{ old('postcode', $demographics->postcode) }}" required>
      </div>

      {{-- Income --}}
      <div>
        <label>Monthly Income (RM)</label>
        <select name="income" required>
          <option value="">-- Select Range --</option>
          <option value="Below 1000" {{ old('income', $demographics->income)=='Below 1000'?'selected':'' }}>Below RM1000</option>
          <option value="1000-2999" {{ old('income', $demographics->income)=='1000-2999'?'selected':'' }}>RM1000 - RM2999</option>
          <option value="3000-4999" {{ old('income', $demographics->income)=='3000-4999'?'selected':'' }}>RM3000 - RM4999</option>
          <option value="5000-9999" {{ old('income', $demographics->income)=='5000-9999'?'selected':'' }}>RM5000 - RM9999</option>
          <option value="10000+" {{ old('income', $demographics->income)=='10000+'?'selected':'' }}>RM10000 and above</option>
        </select>
      </div>

      {{-- Submit --}}
      <button type="submit" class="btn-submit">
        Update Profile
      </button>
    </form>
  </div>
</section>
@endsection
