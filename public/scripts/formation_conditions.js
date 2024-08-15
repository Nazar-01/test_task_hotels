$(document).ready(function () {

    function addConditionGroup(newConditionHTML) {
        $('.conditions').append(`
            <div class="condition-group">
                ${newConditionHTML}
                <button type="button" class="mt-2 btn btn-danger remove-condition">Удалить условие</button>
            </div>
        `);
    }

    $(document).on('change', '.condition-select', function () {
        var selectedValue = $(this).val();
        var $conditionGroup = $(this).closest('.condition-group');
        var newConditionHTML = '';

        switch (selectedValue) {
            case '1':
                newConditionHTML = `
                    <div class="condition">
                        <span data-property="country">Страна отеля</span>
                        <select name="operator">
                            <option value="=">=</option>
                            <option value="!=">!=</option>
                        </select>
                        <select name="value">
                            ${countries.map(country => `
                                <option value="${country.id}">
                                    ${country.name}
                                </option>
                            `).join('')}
                        </select>
                    </div>
                `;
                break;
            case '2':
                newConditionHTML = `
                    <div class="condition">
                        <span data-property="city_id">Город отеля</span>
                        <select name="operator">
                            <option value="=">=</option>
                            <option value="!=">!=</option>
                        </select>
                        <select name="value">
                            ${cities.map(city => `
                                <option value="${city.id}">
                                    ${city.name}
                                </option>
                            `).join('')}
                        </select>
                    </div>
                `;
                break;
            case '3':
                newConditionHTML = `
                    <div class="condition">
                        <span data-property="stars">Звездность отеля</span>
                        <select name="operator">
                            <option value="=">=</option>
                            <option value="!=">!=</option>
                        </select>
                        <select name="value">
                            <option value="1">
                                1
                            </option>
                            <option value="2">
                                2
                            </option>
                            <option value="3">
                                3
                            </option>
                            <option value="4">
                                4
                            </option>
                            <option value="5">
                                5
                            </option>
                        </select>
                    </div>
                `;
                break;
            case '4':
                newConditionHTML = `
                    <div class="condition">
                        <span data-property="discount">Скидка</span>
                        <select name="operator">
                            <option value="=">=</option>
                            <option value="!=">!=</option>
                            <option value=">">></option>
                            <option value="<"><</option>
                        </select>
                        <input type="number">
                    </div>
                `;
                break;
            case '5':
                newConditionHTML = `
                    <div class="condition">
                        <span data-property="contract">Договор по умолчанию</span>
                        <select name="operator">
                            <option value="=">=</option>
                        </select>
                        <select name="value">
                            <option value="0">
                                0
                            </option>
                            <option value="1">
                                1
                            </option>
                        </select>
                    </div>
                `;
                break;
            case '6':
                newConditionHTML = `
                    <div class="condition">
                        <span data-property="company-contract">Договор с компанией</span>
                        <select name="operator">
                            <option value="=">=</option>
                            <option value="!=">!=</option>
                        </select>
                        <select name="value">
                            ${companies.map(company => `
                                <option value="${company.id}">
                                    ${company.name}
                                </option>
                            `).join('')}
                        </select>
                    </div>
                `;
                break;
            case '7':
                newConditionHTML = `
                    <div class="condition">
                        <span data-property="blacklist">Черный список</span>
                        <select name="operator">
                            <option value="=">=</option>
                        </select>
                        <select name="value">
                            <option value="0">
                                0
                            </option>
                            <option value="1">
                                1
                            </option>
                        </select>
                    </div>
                `;
                break;
            case '8':
                newConditionHTML = `
                    <div class="condition">
                        <span data-property="recommended-hotel">Рекомендованный отель</span>
                        <select name="operator">
                            <option value="=">=</option>
                        </select>
                        <select name="value">
                            <option value="0">
                                0
                            </option>
                            <option value="1">
                                1
                            </option>
                        </select>
                    </div>
                `;
                break;
            case '9':
                newConditionHTML = `
                    <div class="condition">
                        <span data-property="whitelist">Белый список</span>
                        <select name="operator">
                            <option value="=">=</option>
                        </select>
                        <select name="value">
                            <option value="0">
                                0
                            </option>
                            <option value="1">
                                1
                            </option>
                        </select>
                    </div>
                `;
                break;
            
            default:
                newConditionHTML = '';
        }

        if (newConditionHTML) {
            addConditionGroup(newConditionHTML);
            $(this).closest('.form-group').remove();
            $(this).closest('.btn-danger').remove();
        }
    });

    $('.add-condition').on('click', function () {
        
        $('.conditions').append(`
            <div class="condition-group mt-3">
                <div class="form-group">
                    <label for="conditionSelect">Выберите условие:</label>
                    <select class="form-select condition-select" aria-label="Default select example">
                        <option selected>Выберите условие</option>
                        <option value="1">Страна отеля</option>
                        <option value="2">Город отеля</option>
                        <option value="3">Звездность отеля</option>
                        <option value="4">Скидка</option>
                        <option value="5">Договор по умолчанию</option>
                        <option value="6">Договор с отелем</option>
                        <option value="7">Черный список</option>
                        <option value="8">Рекомендованный отель</option>
                        <option value="9">Белый список</option>
                    </select>
                </div>
            </div>
        `);
    });

    $('.conditions').on('click', '.remove-condition', function () {
        $(this).closest('.condition-group').remove();
    });
});
