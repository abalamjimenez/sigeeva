<table class="table table-condensed table-hover table-responsive">
    <thead>
    <tr>
        <th>#</th>
        <th>Alumno3</th>
        <th>Cal.Unidad1</th>
        <th>Cal.Unidad2</th>
        <th>Cal.Unidad3</th>
        <th>Promedio</th>
        <th>Calificación final</th>
        <th>Extraordinario 1</th>
        <th>Extraordinario 2</th>
        <th>Examen_especial</th>
    </tr>
    </thead>
    <tbody>
    @foreach($alumnosCr AS $expediente)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $expediente->nombre_completo }}</td>
            <td>
                {!! Form::number('AsignaturaGrupoExpediente['.$expediente->id.'][1]',(isset($expediente->unidad1))?$expediente->unidad1:NULL,['class'=>'form-control form-control-lg','min'=>0,'max'=>10,'step'=>1]) !!}
            </td>
            <td>
                {!! Form::number('AsignaturaGrupoExpediente['.$expediente->id.'][2]',(isset($expediente->unidad2))?$expediente->unidad2:NULL,['class'=>'form-control form-control-lg','min'=>0,'max'=>10,'step'=>1]) !!}
            </td>
            <td>
                {!! Form::number('AsignaturaGrupoExpediente['.$expediente->id.'][3]',(isset($expediente->unidad3))?$expediente->unidad3:NULL,['class'=>'form-control form-control-lg','min'=>0,'max'=>10,'step'=>1]) !!}
            </td>
            <td>
                {{ $expediente->promedio }}
            </td>
            <td>
                {{ $expediente->calificacion_final }}
            </td>
            <td>
                {!! Form::number('AsignaturaGrupoExpediente['.$expediente->id."][e1]",(isset($expediente->extraordinario1))?$expediente->extraordinario1:NULL,['class'=>'form-control form-control-lg','min'=>0,'max'=>10,'step'=>1]) !!}
            </td>
            <td>
                {!! Form::number('AsignaturaGrupoExpediente['.$expediente->id."][e2]",(isset($expediente->extraordinario2))?$expediente->extraordinario2:NULL,['class'=>'form-control form-control-lg','min'=>0,'max'=>10,'step'=>1]) !!}
            </td>
            <td>
                {!! Form::number('AsignaturaGrupoExpediente['.$expediente->id."][ee]",(isset($expediente->examen_especial))?$expediente->examen_especial:NULL,['class'=>'form-control form-control-lg','min'=>0,'max'=>10,'step'=>1]) !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
