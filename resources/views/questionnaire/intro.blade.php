@extends('layouts.app')

@section('content')
<section class="questionnaire-hero" style="background: url('{{ asset('assets/img/questionnaire/bg.png') }}') no-repeat center/cover;">
    <div class="questionnaire-box text-center">
        <h1 class="fw-bold mb-3">Welcome to MySCAT Questionnaire</h1>

        <p>"Craving" is defined as an intense desire to consume a particular food that is difficult to resist.</p>
        <p>This questionnaire is aimed to assess the intensity of sugar craving among Malaysians. The results obtained from this questionnaire will not be manipulated or jeopardize the respondent. Please kindly complete this questionnaire with the sincerest answer.</p>
        <p><strong>Instruction:</strong> For each of the foods below, choose the appropriate letter using the scale given.<br>
           <strong>Question:</strong> Over the past month, how often have you experienced a craving for the food?</p>

        <form action="{{ route('questionnaire.start') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Start Questionnaire</button>
        </form>
    </div>
</section>
@endsection

