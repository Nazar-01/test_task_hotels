@extends('layout')

@section('content')

<br>
<div class="container">
    <br>
    <div class="row g-3">
        <h3>Выберите отель, который будем проверять</h3>

        @foreach($hotels as $hotel)
        <div class="col-6">
            <a href="{{ route('check_hotel', ['id' => $hotel->id]) }}">
                <div class="shadow p-3 mb-5 bg-body rounded">
                    <div>{{ $hotel->name }}</div>
                </div>
            </a>
        </div>
        @endforeach


    </div>
</div>

@endsection