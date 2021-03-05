(function () {

    $(document).on('click','.cargarOcultar',function(event){

        var registro_id = $(this).data("registro-id");

        $('#fila_'+registro_id).toggle();
    });

    $(document).on('click','.detalle',function(event){

        var registro_id = $(this).data("registro-id");

        $.ajax({
            type: "GET",
            data: {
                registro_id : registro_id
            },
            url: "api/registros-x-perfil",

            success: function (response)
            {
                $('#btnCargar'+registro_id).hide();

                $('#btnMostrarOcultar'+registro_id).show();

                $('#fila_'+registro_id).show();

                row_data = '';
                if (jQuery.isEmptyObject(response.asignaciones))
                {
                    row_data += '<tr>';
                    row_data += '<td colspan="3">No hay personas asignadas</td>';
                    row_data += '</tr>';
                }
                else
                {
                    $.each(response.asignaciones, function (key,value)
                    {

                        row_data += '<tr>';
                        row_data += '<td align="center">'+key+'</td>';
                        row_data += '<td>'+value.username+'</td>';
                        row_data += '<td align="center">'+value.nombre_completo+'</td>';
                        row_data += '<td align="center">'+value.correo_institucional+'</td>';
                        row_data += '<td align="center">'+value.correo_personal+'</td>';
                        row_data += '</tr>';
                    });
                }

                $('#columna_'+registro_id+' .personasAsignadas tbody').empty();
                $('#columna_'+registro_id+' .personasAsignadas tbody').append(row_data);
            },
            error: function (error)
            {
                console.log(error);
            }
        })
    });

})();
