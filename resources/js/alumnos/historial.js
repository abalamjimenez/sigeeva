(function () {

    $(document).on('click','.cargarOcultar',function(event){

        var expediente_id = $(this).data("expediente-id");

        $('#fila_'+expediente_id).toggle();

    });

    $(document).on('click','.detalle',function(event){

        var expediente_id = $(this).data("expediente-id");


        $.ajax({
            type: "GET",
            data: {
                expediente_id : expediente_id
            },
            url: "/API/historial-detalle-expediente",

            success: function (response)
            {
                $('#btnCargar'+expediente_id).hide();

                $('#btnMostrarOcultar'+expediente_id).show();

                $('#fila_'+expediente_id).show();

                // M O S T R A M O S  E L   D A T O
                // D E L   T U T O R   Y   E L   R E S P O N S A B L E   D E   C O N T R O L   E S C O L A R

                row_data = '';

                row_data += '<tr>';
                row_data += '<th align="center">Responsable de Control Escolar</th>';
                row_data += '<td align="left">'+response.arregloExpedientes.generales.nombreResponsableControlEscolar+'</td>';
                row_data += '</tr>';
                row_data += '<tr>';
                row_data += '<th align="center">Tutor</th>';
                row_data += '<td align="left">'+response.arregloExpedientes.generales.nombreTutor+'</td>';
                row_data += '</tr>';

                $('#columna_'+expediente_id+' .generales').empty();
                $('#columna_'+expediente_id+' .generales').append(row_data);


                // P R O C E S A M O S  A   L O S   A L U M N O S   R E G U L A R E S

                row_data = '';
                if (jQuery.isEmptyObject(response.arregloExpedientes.regular))
                {
                    row_data += '<tr>';
                    row_data += '<td colspan="10" align="center">No tiene materias registradas</td>';
                    row_data += '</tr>';
                }
                else
                {
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
                        row_data += '<td align="center">'+key+'</td>';
                        row_data += '<td>'+value.abreviacion+'</td>';
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

                $('#columna_'+expediente_id+' .materias tbody').empty();
                $('#columna_'+expediente_id+' .materias tbody').append(row_data);

                // P R O C E S A M O S  A   L O S   A L U M N O S   E N   R E P E T I C I Ó N

                row_data = '';
                if (jQuery.isEmptyObject(response.arregloExpedientes.especial))
                {
                    row_data += '<tr>';
                    row_data += '<td colspan="10" align="center">No tiene materias en repetición</td>';
                    row_data += '</tr>';
                }
                else
                {
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
                            extraordinario1 = value.extraordinario1;

                        if (value.extraordinario2 != null)
                            extraordinario2 = value.extraordinario2;

                        if (value.examen_especial != null)
                            examen_especial = value.examen_especial;


                        row_data += '<tr>';
                        row_data += '<td align="center">'+key+'</td>';
                        row_data += '<td>'+value.abreviacion+'</td>';
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

                $('#columna_'+expediente_id+' .materiasEnRepeticion tbody').empty();
                $('#columna_'+expediente_id+' .materiasEnRepeticion tbody').append(row_data);


                $('#columna_'+expediente_id+' .datosMaterias tbody').empty();

                // M O S T R A M O S  E L   N O M B R E   D E   L A   M A TE R I A  R E G U L A R E S
                // Y   E L   D O C E N T E   Q U E   L A   I M P A R T E

                row_data = '';
                $.each(response.arregloExpedientes.regular, function (key,value)
                {
                    row_data += '<tr>';
                    row_data += '<td align="center">'+key+'</td>';
                    row_data += '<td align="left">'+value.primer_apellido+' '+value.segundo_apellido+' '+value.nombre+'</td>';
                    row_data += '<td align="left">'+value.abreviacion+'</td>';
                    row_data += '<td align="left">'+value.descripcion+'</td>';
                    row_data += '<td align="left">'+value.claveGrupo+'</td>';
                    row_data += '</tr>';
                });

                $('#columna_'+expediente_id+' .datosMaterias tbody').append(row_data);

                // M O S T R A M O S  E L   N O M B R E   D E   L A   M A TE R I A   D E   R E P E T I C I O N
                // Y   E L   D O C E N T E   Q U E   L A   I M P A R T E

                row_data = '';
                $.each(response.arregloExpedientes.especial, function (key,value)
                {
                    row_data += '<tr>';
                    row_data += '<td align="center">'+key+'</td>';
                    row_data += '<td align="left">'+value.primer_apellido+' '+value.segundo_apellido+' '+value.nombre+'</td>';
                    row_data += '<td align="left">'+value.abreviacion+'</td>';
                    row_data += '<td align="left">'+value.descripcion+'</td>';
                    row_data += '<td align="left">'+value.claveGrupo+'</td>';
                    row_data += '</tr>';
                });

                $('#columna_'+expediente_id+' .datosMaterias tbody').append(row_data);
            },
            error: function (error)
            {
                console.log(error);
            }
        })
    });
})();
