@extends('layout')

@section('content')

<br>
<div class="container">
    <br>
    <div class="row g-3">


        <div class="col-12">
            <h4>Название правила</h4>
            <input id="rule_name" name="rule_name" class="form-control">
        </div>

        <div class="col-12">
            <h4>Агенство</h4>
            <select name="agency" class="form-select" aria-label="Default select example">
                @foreach($agencies as $agency)
                <option value="{{ $agency->id }}">{{ $agency->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-12">
            <h4>Условия</h4>
            <div class="conditions">

            </div>
        </div>

        <div class="col-12">
            <h4>Текст для менеджера</h4>
            <textarea name="manager_text" class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea>
        </div>

        <div class="col-12">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
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
    </div>
</div>

@endsection

@push('scripts')
<script>
    var countries = @json($countries);
    var cities = @json($cities);
    var hotels = @json($hotels);
    var companies = @json($companies);
    var baseUrl = "{{ url('/') }}";
</script>
<script src="{{ asset('scripts/formation_conditions.js') }}"></script>
<script src="{{ asset('scripts/get_conditions.js') }}"></script>
<script src="{{ asset('scripts/create_rule_ajax.js') }}"></script>
@endpush