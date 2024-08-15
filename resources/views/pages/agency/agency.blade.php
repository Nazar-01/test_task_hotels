@extends('layout')

@section('content')

<br>
<div class="container">
    <br>
    <div class="row g-3">

        <h4>Агенство</h4>

        <p>{{ $agencyName }}</p>

        <div class="col-12">
            <h4>Правила</h4>
            @foreach($rules as $rule)
            <div class="col-12">
                <a href="{{ route('rule.edit', $rule->id) }}">
                    <div class="shadow p-3 mb-5 bg-body rounded" role="alert">
                        {{ $rule->name }}
                    </div>
                </a>
            </div>
            @endforeach
        </div>

    </div>
</div>

@endsection