@extends('layout')

@section('content')

<br>
<div class="container">
    <br>
    <div class="row g-3">
        <h3>Выберите агенство</h3>

        @foreach($agencies as $agency)
        <div class="col-6">
            <a href="{{ route('agency', ['id' => $agency->id]) }}">
                <div class="shadow p-3 mb-5 bg-body rounded">
                    <div>{{ $agency->name }}</div>
                </div>
            </a>
        </div>
        @endforeach


    </div>
</div>

@endsection