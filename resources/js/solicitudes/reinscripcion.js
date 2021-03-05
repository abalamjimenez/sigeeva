(function () {

    let token = document.head.querySelector('meta[name="csrf-token"]');

    let nacionalidad_tipo = $('#nacionalidad_tipo');

    $('.s2').select2({
        placeholder: "Seleccionar",
        allowClear: true,
        theme: "bootstrap4",
        width: "100%"
    });



    nacionalidad_tipo.on('select2:select', function (e) {

        let parametros = e.params.data;

        if (parametros.id == 'MEXICANA')
        {
            $('#nacionalidad_id').val(null).trigger('change');
            $('#nacionalidad_id').prop('disabled', true);
        }
        else
        {
            $('#nacionalidad_id').prop('disabled', false);
        }
    });

})();
