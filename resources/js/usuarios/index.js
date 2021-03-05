$( document ).ready(function() {

    var user_id;

    $(document).on('click','.delete',function (){
        user_id = $(this).attr('id');

        $('#confirmModal').modal('show');
    });

    $('#ok_button').click(function (){

        var action_url = '/users/destroy/'+user_id;

        $.ajax({
            url: action_url,
            method: "GET",
            beforeSend:function (){
                $('#ok_button').text('Eliminando...');
            },
            success:function (data)
            {
                setTimeout(function (){
                    $('#confirmModal').modal('hide');
                    $('#laravel_datatable').DataTable().ajax.reload();
                    alert('Registro eliminado');
                }, 1500);
            }
        });


    });

    $('#create_record').click(function (event){

        //$('#name').val('');
        $('#username').val('');
        $('#email').val('');
        $('#password').val('');
        $('#password-confirm').val('');
        $('#hidden_id').val('');

        $('.modal-title').text('Agregar nuevo registro');
        $('#action_button').val('Add');
        $('#action').val('Add');
        $('#form_result').html('');

        $('#formModal').modal('show');
    });

    $(document).on('click','.edit', function (){
        var id = $(this).attr('id');

        $('#form_result').html('');

        $.ajax({
            url: 'users/'+id+'/edit',
            dataType:'json',
            success: function (data)
            {
                //$('#name').val(data.result.name);
                $('#username').val(data.result.username);
                $('#email').val(data.result.email);
                $('#hidden_id').val(data.result.id);

                $('.modal-title').text('Editar registro');
                $('#action_button').val('Edit');
                $('#action').val('Edit');
                $('#formModal').modal('show');
            }
        });
    });

    //
    // Código para agregar un nuevo registro
    //
    $('#sample_form').on('submit', function (event) {

        event.preventDefault();

        var action_url = '';

        if ($('#action').val() == 'Add')
            action_url = $('#action_save').val();
        else if ($('#action').val() == 'Edit')
            action_url = $('#action_update').val();

        $.ajax({
            url: action_url,
            method: "POST",
            data:$(this).serialize(),
            dataType:"json",
            success:function (data)
            {
                var html='';
                if (data.errors)
                {
                    html = '<div class="alert alert-danger">';

                    for (var count = 0; count < data.errors.length; count++)
                    {
                        html += '<p>' + data.errors[count] + '</p>';
                    }

                    html += '</div>';
                }

                if (data.success)
                {
                    html = '<div class="alert alert-success">'+data.success + '</div>';

                    $('#sample_form')[0].reset();

                    $('#laravel_datatable').DataTable().ajax.reload();

                    $('#formModal').modal('hide');
                }

                $('#form_result').html(html);
            }
        });
    });

    var myDataTable = $('#laravel_datatable').DataTable({
        "responsive": true,
        "bAutoWidth": false,
        "bSortClasses": false,
        'fixedHeader': true,
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: "/users-list"
        },
        "columns": [

            {
                "defaultContent": '',
                'className': 'responsiveColumn'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false
            },
            {
                data: 'username',
                name: 'username'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'last_login_at',
                name: 'last_login_at'
            }
        ]
    });

    //new $.fn.dataTable.FixedHeader( myDataTable );

});
