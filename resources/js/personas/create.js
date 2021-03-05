(function () {

    let token = document.head.querySelector('meta[name="csrf-token"]');

    let pais_id = $('#pais_id');

    $('.s2').select2({
        placeholder: "Seleccionar",
        allowClear: true,
        theme: "bootstrap4",
        width: "100%"
    });

    pais_id.on('select2:select', function (e) {
        let parametros = e.params.data;

        if (parametros.id !== '146') {
            $('#entidad_id').val(null).trigger('change');
            $('#entidad_id').prop('disabled', true);
        } else {

            $('#entidad_id').prop('disabled', false);
        }
    });
})();
