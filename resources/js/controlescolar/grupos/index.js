(function () {

    $(document).on('click','.cargarOcultar',function(event){

        var asignatura_grupo_id = $(this).data("asignatura-grupo-id");

        $('#fila_'+asignatura_grupo_id).toggle();

    });

    $(document).on('click','.detalle',function(event){

        var asignatura_grupo_id = $(this).data("asignatura-grupo-id");

        $.ajax({
            type: "GET",
            data: {
                asignatura_grupo_id : asignatura_grupo_id
            },
            url: "../../api/grupos-x-asignatura",

            success: function (response)
            {
                $('#btnCargar'+asignatura_grupo_id).hide();

                $('#btnMostrarOcultar'+asignatura_grupo_id).show();



                $('#fila_'+asignatura_grupo_id).show();

                // Trabajamos con los alumnos del grupo

                row_data = '';
                if (jQuery.isEmptyObject(response.arregloExpedientes.regular))
                {
                    row_data += '<tr>';
                    row_data += '<td colspan="7">No hay alumnos registrados</td>';
                    row_data += '</tr>';
                }
                else
                {
                    var unidad1            ='';
                    var unidad2            ='';
                    var unidad3            ='';
                    var promedio           ='';
                    var calificacion_final = '';
                    var extraordinario1    = '';
                    var extraordinario2    = '';
                    var examen_especial    = '';
                    $.each(response.arregloExpedientes.regular, function (key,value)
                    {
                        unidad1            ='';
                        unidad2            ='';
                        unidad3            ='';
                        promedio           ='';
                        calificacion_final ='';
                        extraordinario1    = '';
                        extraordinario2    = '';
                        examen_especial    = '';
                        if (value.unidad1 != null)
                            unidad1=value.unidad1;

                        if (value.unidad2 != null)
                            unidad2=value.unidad2;

                        if (value.unidad3 != null)
                            unidad3=value.unidad3;

                        if (value.promedio != null)
                            promedio=value.promedio;

                        if (value.calificacion_final != null)
                            calificacion_final=value.calificacion_final;

                        if (value.extraordinario1 != null)
                            extraordinario1 = value.extraordinario1;

                        if (value.extraordinario2 != null)
                            extraordinario2 = value.extraordinario2;

                        if (value.examen_especial != null)
                            examen_especial = value.examen_especial;

                        row_data += '<tr>';
                        row_data += '<td align="center"><a href="'+value.url+'">Boleta</a></td>';
                        row_data += '<td align="center">'+key+'</td>';
                        row_data += '<td>'+value.nombre_completo+'</td>';
                        row_data += '<td align="center">'+unidad1+'</td>';
                        row_data += '<td align="center">'+unidad2+'</td>';
                        row_data += '<td align="center">'+unidad3+'</td>';
                        row_data += '<td align="center">'+promedio+'</td>';
                        row_data += '<td align="center">'+calificacion_final+'</td>';
                        row_data += '<td align="center">'+extraordinario1+'</td>';
                        row_data += '<td align="center">'+extraordinario2+'</td>';
                        row_data += '<td align="center">'+examen_especial+'</td>';
                        row_data += '</tr>';
                    });
                }

                $('#columna_'+asignatura_grupo_id+' .alumnos tbody').empty();
                $('#columna_'+asignatura_grupo_id+' .alumnos tbody').append(row_data);

                row_data = '';
                if (jQuery.isEmptyObject(response.arregloExpedientes.especial))
                {
                    row_data += '<tr>';
                    row_data += '<td colspan="7">No hay alumnos registrados</td>';
                    row_data += '</tr>';
                }
                else {
                    var unidad1='';
                    var unidad2='';
                    var unidad3='';
                    var promedio='';
                    var calificacion_final = '';
                    $.each(response.arregloExpedientes.especial, function (key,value)
                    {
                        unidad1            ='';
                        unidad2            ='';
                        unidad3            ='';
                        promedio           ='';
                        calificacion_final ='';
                        extraordinario1    = '';
                        extraordinario2    = '';
                        examen_especial    = '';

                        if (value.unidad1 != null)
                            unidad1=value.unidad1;

                        if (value.unidad2 != null)
                            unidad2=value.unidad2;

                        if (value.unidad3 != null)
                            unidad3=value.unidad3;

                        if (value.promedio != null)
                            promedio=value.promedio;

                        if (value.calificacion_final != null)
                            calificacion_final=value.calificacion_final;

                        if (value.extraordinario1 != null)
                            extraordinario1=value.extraordinario1;

                        if (value.extraordinario2 != null)
                            extraordinario2=value.extraordinario2;

                        if (value.examen_especial != null)
                            examen_especial=value.examen_especial;

                        row_data += '<tr>';
                        //row_data += '<td align="center"><a href="'+value.url+'">Boleta</a></td>';
                        row_data += '<td align="center"></td>';
                        row_data += '<td align="center">'+key+'</td>';
                        row_data += '<td>'+value.nombre_completo+'</td>';
                        row_data += '<td align="center">'+unidad1+'</td>';
                        row_data += '<td align="center">'+unidad2+'</td>';
                        row_data += '<td align="center">'+unidad3+'</td>';
                        row_data += '<td align="center">'+promedio+'</td>';
                        row_data += '<td align="center">'+calificacion_final+'</td>';
                        row_data += '<td align="center">'+extraordinario1+'</td>';
                        row_data += '<td align="center">'+extraordinario2+'</td>';
                        row_data += '<td align="center">'+examen_especial+'</td>';
                        row_data += '</tr>';
                    });
                }

                $('#columna_'+asignatura_grupo_id+' .alumnosEspeciales tbody').empty();
                $('#columna_'+asignatura_grupo_id+' .alumnosEspeciales tbody').append(row_data);
            },
            error: function (error)
            {
                console.log(error);
            }
        })

    });

})();
