@extends('layouts.privado')

@section('content')

    <div class="container" style="padding-top: 1em">

        <h1>Usuarios</h1>

        <div align="right" style="margin-bottom: 1em">
            <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm">
                Agregar registro
            </button>
        </div>

        <table class="table table-bordered nowrap" id="laravel_datatable">
        <thead>
        <tr>
            <th></th>
            <th>action</th>
            <th>username</th>
            <th>email</th>
            <th>last_login_at</th>
        </tr>
        </thead>
        </table>

    </div>
@endsection

@section('modals')

    <div id="formModal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <form method="post" id="sample_form" class="form-horizontal" action="">

                    @csrf

                    <div class="modal-header">
                        <h4 class="modal-title">Titulo modal</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <span id="form_result"></span>

                        <div class="form-group">
                            <label for="" class="control-label col-md-4">{{ __('Username') }}</label>
                            <div class="col-md-8">
                                <input type="text" name="username" id="username" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label col-md-4">{{ __('E-Mail Address') }}</label>
                            <div class="col-md-8">
                                <input type="text" name="email" id="email" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label col-md-4">{{ __('Password') }}</label>
                            <div class="col-md-8">
                                <input type="text" name="password" id="password" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label col-md-5">{{ __('Confirm Password') }}</label>
                            <div class="col-md-7">
                                <input type="text" name="password_confirmation" id="password_confirmation" class="form-control">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <div class="form-group">

                            <input type="hidden" name="action_save" id="action_save" value="{{ route('usuarios.store') }}" />
                            <input type="hidden" name="action_update" id="action_update" value="{{ route('usuarios.update') }}" />
                            <input type="hidden" name="action" id="action" value="" />

                            <input type="hidden" name="hidden_id" id="hidden_id" />

                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" name="action_button" id="action_button" class="btn btn-primary" value="Guardar datos" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="confirmModal" class="modal fade" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title">
                        Confirmation
                    </h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4 align="center" style="margin:0;">
                        Esta seguro de eliminar el registro?
                    </h4>
                </div>
                <div class="modal-footer">

                    <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">
                        OK
                    </button>

                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('jscripts')
    <script src="{{ mix('js/usuarios/index.js') }}"></script>
@endsection
