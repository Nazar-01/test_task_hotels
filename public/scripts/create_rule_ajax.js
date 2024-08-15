$('.btn-success').on('click', function () {
    var formData = window.collectFormData();
    var formDataJson = JSON.stringify(formData, null, 4);

    $.ajax({
        url: baseUrl + '/rule/store',
        type: 'POST',
        dataType: 'json',
        contentType: 'application/json',
        data: formDataJson,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            window.location.href = response.redirect;
        },
        error: function (xhr, status, error) {
            Swal.fire({
                icon: 'error',
                title: 'Ошибка',
                text: xhr.responseJSON.message || 'Неизвестная ошибка'
            });
        }
    });

});