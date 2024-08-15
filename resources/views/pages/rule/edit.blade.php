@extends('layout')

@section('content')

<br>
<div class="container">
    <br>

    <div class="row g-3">

        <div class="col-12">
            <h4>Название правила</h4>
            <input id="rule_name" name="rule_name" class="form-control" value="{{ $rule->name }}">
        </div>

        <div class="col-12">
            <h4>Агентство</h4>
            <select name="agency" class="form-select" aria-label="Default select example">
                @foreach($agencies as $agency)
                <option value="{{ $agency->id }}" {{ $agency->id == $rule->agency_id ? 'selected' : '' }}>
                    {{ $agency->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="col-12">
    <h4>Условия</h4>
    <div class="conditions">
        @foreach($rule->conditions as $condition)
        <div class="condition-group">
            <div class="condition">
                <span data-property="{{ $condition['data-property'] }}">
                    @switch($condition['data-property'])
                        @case('country')
                            Страна отеля
                            @break
                        @case('city_id')
                            Город отеля
                            @break
                        @case('stars')
                            Звездность отеля
                            @break
                        @case('discount')
                            Скидка
                            @break
                        @case('contract')
                            Договор по умолчанию
                            @break
                        @case('company-contract')
                            Договор с компанией
                            @break
                        @case('blacklist')
                            Черный список
                            @break
                        @case('recommended-hotel')
                            Рекомендованный отель
                            @break
                        @case('whitelist')
                            Белый список
                            @break
                        @default
                            Неизвестное свойство
                    @endswitch
                </span>
                <select name="operator">
                    <option value="=" {{ $condition['data-select'] == '=' ? 'selected' : '' }}>=</option>
                    <option value="!=" {{ $condition['data-select'] == '!=' ? 'selected' : '' }}>!=</option>
                    @if(in_array($condition['data-property'], ['discount']))
                        <option value=">" {{ $condition['data-select'] == '>' ? 'selected' : '' }}>></option>
                        <option value="<" {{ $condition['data-select'] == '<' ? 'selected' : '' }}><</option>
                    @endif
                </select>
                @switch($condition['data-property'])
                    @case('country')
                        <select name="value">
                            @foreach($countries as $country)
                            <option value="{{ $country->id }}" {{ $country->id == $condition['data-value'] ? 'selected' : '' }}>
                                {{ $country->name }}
                            </option>
                            @endforeach
                        </select>
                        @break
                    @case('city_id')
                        <select name="value">
                            @foreach($cities as $city)
                            <option value="{{ $city->id }}" {{ $city->id == $condition['data-value'] ? 'selected' : '' }}>
                                {{ $city->name }}
                            </option>
                            @endforeach
                        </select>
                        @break
                    @case('stars')
                        <select name="value">
                            @for($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" {{ $i == $condition['data-value'] ? 'selected' : '' }}>
                                {{ $i }}
                            </option>
                            @endfor
                        </select>
                        @break
                    @case('discount')
                        <input type="number" name="value" value="{{ $condition['data-value'] }}" />
                        @break
                    @case('contract')
                    @case('company-contract')
                    @case('blacklist')
                    @case('recommended-hotel')
                    @case('whitelist')
                        <select name="value">
                            <option value="0" {{ $condition['data-value'] == '0' ? 'selected' : '' }}>0</option>
                            <option value="1" {{ $condition['data-value'] == '1' ? 'selected' : '' }}>1</option>
                        </select>
                        @break
                    @default
                        Неизвестное значение
                @endswitch
            </div>
            <button type="button" class="mt-2 btn btn-danger remove-condition">Удалить условие</button>
        </div>
        <br>
        @endforeach
    </div>
</div>

        <div class="col-12">
            <h4>Текст для менеджера</h4>
            <textarea name="manager_text" class="form-control" id="exampleFormControlTextarea1" rows="4">{{ $rule->manager_text }}</textarea>
        </div>

        <div class="col-12">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" {{ $rule->is_active ? 'checked' : '' }}>
                <label class="form-check-label" for="flexSwitchCheckChecked">
                    Активное правило
                </label>
            </div>
        </div>

        <div class="col-12">
            <button type="button" class="w-100 add-condition btn btn-primary">Добавить условие</button>
        </div>
        <div class="col-12">
            <button type="button" class="w-100 btn btn-success">Сохранить</button>
        </div>
        <br><br><br><br>
        <div class="col-12">
            <a id="delete-button" href="{{ route('rule.delete', $rule->id) }}">
                <button style="background-color:transparent; color: red;" type="button" class="w-100 btn btn-danger">Удалить</button>
            </a>
        </div>
    </div>

</div>
<br><br><br>

@endsection

@push('scripts')
<script>
    var countries = @json($countries);
    var cities = @json($cities);
    var hotels = @json($hotels);
    var companies = @json($companies);
    var rule_id = @json($rule->id);
    var baseUrl = "{{ url('/') }}";
</script>
<script src="{{ asset('scripts/formation_conditions.js') }}"></script>
<script src="{{ asset('scripts/get_conditions.js') }}"></script>
<script src="{{ asset('scripts/update_rule_ajax.js') }}"></script>
<script src="{{ asset('scripts/sure.js') }}"></script>
@endpush