@extends('layouts.app')

@section('content')
<section class="fooddiary-summary" 
style="background: url('{{ asset('assets/img/fooddiary/bg.jpg') }}') center/cover no-repeat;
       min-height: 100vh; padding: 60px 0;">

<div class="container bg-white p-4 rounded shadow">
    <h2 class="text-center mb-4">My Food Diary Summary</h2>

    @if(!$diaries)
        <div class="alert alert-warning text-center">
            No diary entries found.
        </div>
    @else
        @foreach($diaries->entries as $day => $meals)
            <div class="card mb-4">
                <div class="card-header bg-info text-white fw-bold">
                    {{ strtoupper($day) }}
                </div>

                <div class="card-body">
                    @if(count($meals) === 0)
                        <p class="text-muted">No meals logged.</p>
                    @else
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Meal</th>
                                    <th>Time</th>
                                    <th>Food</th>
                                    <th>Portion</th>
                                    <th>Drink</th>
                                    <th>Image</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($meals as $meal)
                                    <tr>
                                        <td>{{ $meal['meal'] }}</td>
                                        <td>{{ $meal['time'] }}</td>
                                        <td>{{ $meal['food'] }}</td>
                                        <td>{{ $meal['portion'] }}</td>
                                        <td>{{ $meal['drink'] }}</td>
                                        <td>
                                            @if(!empty($meal['image']))
                                                <img src="{{ asset($meal['image']) }}" style="width:70px; height:70px; border-radius:8px;">
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        @endforeach
    @endif

</div>

</section>
@endsection
