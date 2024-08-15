@extends('layout')

@section('content')

<br>

<div class="container mt-4">
        @if(isset($matchedRules) && count($matchedRules) > 0)
            <div class="alert alert-success" role="alert">
                Отель успешно прошел проверку! Найдено следующие правила:
                <ul>
                    @foreach($matchedRules as $rule)
                        <li class="mt-4">
                            Правило: <strong>{{ $rule['name'] }}</strong>
                            <br>
                            Текст для менеджера: <strong>{{ $rule['text'] }}</strong>
                            <br>
                            Агентство: <strong>{{ $rule['agency_name'] }}</strong>
                        </li>
                    @endforeach
                </ul>
            </div>
        @else
            <div class="alert alert-danger" role="alert">
                Отель не прошел проверку. Не найдено ни одного подходящего правила.
            </div>
        @endif
    </div>

@endsection