<table class="table table-condensed table-hover table-responsive">
    <thead>
    <tr>
        <th>#</th>
        <th>Alumno1</th>
        <th>Cal.Unidad1</th>
        <th>Cal.Unidad2</th>
        <th>Cal.Unidad3</th>
        <th>Promedio</th>
        <th>Calificación final</th>
        <th>Extraordinario1</th>
        <th>Extraordinario2</th>
        <th>ExamenEspecial</th>
    </tr>
    </thead>
    <tbody>
    @foreach($matriculaActiva AS $expediente)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $expediente->nombre_completo }}</td>
            <td>
                @if($capturar_unidad1 == 'S')
                    {!! Form::number('AsignaturaGrupoExpediente['.$expediente->id.'][1]',(isset($expediente->unidad1))?$expediente->unidad1:NULL,['class'=>'form-control form-control-lg','min'=>0,'max'=>10,'step'=>1]) !!}
                @else
                    {{ $expediente->unidad1 }}

                    {!! Form::hidden('AsignaturaGrupoExpediente['.$expediente->id.'][1]',$expediente->unidad1) !!}
                @endif
            </td>
            <td>
                @if($capturar_unidad2 == 'S')
                    {!! Form::number('AsignaturaGrupoExpediente['.$expediente->id.'][2]',(isset($expediente->unidad2))?$expediente->unidad2:NULL,['class'=>'form-control form-control-lg','min'=>0,'max'=>10,'step'=>1]) !!}
                @else
                    {{ $expediente->unidad2 }}

                    {!! Form::hidden('AsignaturaGrupoExpediente['.$expediente->id.'][2]',$expediente->unidad2) !!}
                @endif
            </td>
            <td>
                @if($capturar_unidad3 == 'S')
                    {!! Form::number('AsignaturaGrupoExpediente['.$expediente->id.'][3]',(isset($expediente->unidad3))?$expediente->unidad3:NULL,['class'=>'form-control form-control-lg','min'=>0,'max'=>10,'step'=>1]) !!}
                @else
                    {{ $expediente->unidad3 }}

                    {!! Form::hidden('AsignaturaGrupoExpediente['.$expediente->id.'][3]',$expediente->unidad3) !!}
                @endif
            </td>
            <td>
                {{ $expediente->promedio }}
            </td>
            <td>
                {{ $expediente->calificacion_final }}
            </td>
            <td>
                @if($capturar_e1 == 'S')
                    {!! Form::number('AsignaturaGrupoExpediente['.$expediente->id.'][e1]',(isset($expediente->extraordinario1))?$expediente->extraordinario1:NULL,['class'=>'form-control form-control-lg','min'=>0,'max'=>10,'step'=>1]) !!}
                @else
                    {{ $expediente->extraordinario1 }}

                    {!! Form::hidden('AsignaturaGrupoExpediente['.$expediente->id.'][e1]',$expediente->extraordinario1) !!}
                @endif
            </td>
            <td>
                @if($capturar_e2 == 'S')
                    {!! Form::number('AsignaturaGrupoExpediente['.$expediente->id.'][e2]',(isset($expediente->extraordinario2))?$expediente->extraordinario2:NULL,['class'=>'form-control form-control-lg','min'=>0,'max'=>10,'step'=>1]) !!}
                @else
                    {{ $expediente->extraordinario2 }}

                    {!! Form::hidden('AsignaturaGrupoExpediente['.$expediente->id.'][e2]',$expediente->extraordinario2) !!}
                @endif
            </td>
            <td>
                @if($capturar_ee == 'S')
                    {!! Form::number('AsignaturaGrupoExpediente['.$expediente->id.'][ee]',(isset($expediente->examen_especial))?$expediente->examen_especial:NULL,['class'=>'form-control form-control-lg','min'=>0,'max'=>10,'step'=>1]) !!}
                @else
                    {{ $expediente->examen_especial }}

                    {!! Form::hidden('AsignaturaGrupoExpediente['.$expediente->id.'][ee]',$expediente->examen_especial) !!}
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
