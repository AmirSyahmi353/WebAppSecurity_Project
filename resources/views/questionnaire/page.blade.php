@extends('layouts.app')

@section('content')
<div class="questionnaire-wrapper">

    <div class="questionnaire-card">
        <!-- Progress bar -->
        <div class="mb-4">
            <p class="text-center fw-bold">Page {{ $page }} of {{ $totalPages }}</p>
            <div class="progress">
                <div class="progress-bar" role="progressbar"
                    style="width: {{ (($page - 1) / $totalPages) * 100 }}%"
                    aria-valuenow="{{ (($page - 1) / $totalPages) * 100 }}">
                    {{ round((($page - 1) / $totalPages) * 100) }}%
                </div>
            </div>
        </div>

        <form action="{{ route('questionnaire.savePage', ['page' => $page]) }}" method="POST">
            @csrf

            @foreach($questions as $id => $q)
            <div class="mb-5 text-center">
                <h2 class="question-text">
                    {{ ($page - 1) * 5 + $loop->iteration }}. {{ $q['text'] }}
                </h2>

                <img src="{{ asset($q['image']) }}" alt="Question Image" class="question-image">

                <!-- Rating scale A–E UI but values 1–5 -->
                <div class="rating-scale">
                    <span>Never</span>

                    @php
                        $letters = ['A', 'B', 'C', 'D', 'E'];
                    @endphp

                    @foreach($letters as $index => $letter)
                        <label>
                            <input type="radio" name="answers[{{ $id }}]" value="{{ $index + 1 }}" required>
                            <span>{{ $letter }}</span>
                        </label>
                    @endforeach

                    <span>Always</span>
                </div>
            </div>
            @endforeach

            <!-- Navigation Buttons -->
            <div class="d-flex 
                @if($page == 1)
                    justify-content-end
                @else
                    justify-content-between
                @endif">

                @if($page > 1)
                    <a href="{{ route('questionnaire.page', ['page' => $page - 1]) }}" class="btn btn-back">Back</a>
                @endif

                @if($page < $totalPages)
                    <button type="submit" class="btn btn-next">Next</button>
                @else
                    <button type="submit" class="btn btn-submit">Submit</button>
                @endif
            </div>

        </form>
    </div>
</div>
@endsection
