document.getElementById('delete-button').addEventListener('click', function (event) {
    event.preventDefault();

    Swal.fire({
        title: "Вы уверены?",
        text: "Это действие приведет к удалению записи!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Да, удалить"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = this.getAttribute('href');
        }
    });
});