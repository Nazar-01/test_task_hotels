<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRuleRequest extends FormRequest
{
    public function rules()
    {
        return [
            'rule_name' => 'required|string|max:255',
            'agency' => 'required|exists:agencies,id',
            'conditions' => 'required|array',
            'conditions.*.data-property' => 'required|string',
            'conditions.*.data-select' => 'required|string',
            'conditions.*.data-value' => 'required|string',
            'manager_text' => 'required|string',
            'is_active' => 'required|boolean',
        ];
    }

    public function messages()
    {
        return [
            'rule_name.required' => 'Название правила обязательно для заполнения.',
            'rule_name.string' => 'Название правила должно быть строкой.',
            'rule_name.max' => 'Название правила не должно превышать 255 символов.',
            'agency.required' => 'Агенство обязательно для выбора.',
            'agency.exists' => 'Выбранное агенство не существует.',
            'conditions.required' => 'Условия обязательны для заполнения.',
            'conditions.array' => 'Условия должны быть массивом.',
            'conditions.*.data-property.required' => 'Свойство данных обязательно для заполнения.',
            'conditions.*.data-select.required' => 'Выбор данных обязателен.',
            'conditions.*.data-value.required' => 'Значение данных обязательно для заполнения.',
            'manager_text.required' => 'Текст для менеджера обязателен.',
            'manager_text.string' => 'Текст для менеджера должен быть строкой.',
            'is_active.required' => 'Активное правило обязательно для указания.',
            'is_active.boolean' => 'Активное правило должно быть булевым значением.',
        ];
    }
}
