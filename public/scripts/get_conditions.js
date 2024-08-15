$(document).ready(function () {
    function collectFormData() {
        var formData = {};

        formData['rule_name'] = $('#rule_name').val();

        formData['agency'] = $('select[name="agency"]').val();

        var conditions = [];
        $('.condition-group').each(function () {
            var condition = {};
            var $condition = $(this).find('.condition');
            var $inputField = $condition.find('input[type="number"]');

            if ($condition.length) {
                condition['data-property'] = $condition.find('span').data('property');
                condition['data-select'] = $condition.find('select[name="operator"]').val();
                
                if ($inputField.length) {
                    condition['data-value'] = $inputField.val();
                } else {
                    condition['data-value'] = $condition.find('select[name="value"]').val();
                }

                conditions.push(condition);
            }
        });
        formData['conditions'] = conditions;

        formData['manager_text'] = $('#exampleFormControlTextarea1').val();

        formData['is_active'] = $('#flexSwitchCheckChecked').is(':checked') ? 1 : 0;

        return formData;
    }

    window.collectFormData = collectFormData;
});
