(function () {

    let token = document.head.querySelector('meta[name="csrf-token"]');

    $('.s2').select2({
        placeholder: "Seleccionar",
        allowClear: true,
        theme: "bootstrap4",
        width: "100%"
    });

})();
