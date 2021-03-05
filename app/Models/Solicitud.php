<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Solicitud extends Model
{
    protected $table = 'solicitudes';

    protected $fillable = [
        'user_id','tipo_sangre_id','periodo_escolar_id','carrera_id','carrera_descripcion','grado_id',
        'turno_id','turno_descripcion','primer_apellido','segundo_apellido','nombre',
        'curp','fecha_nacimiento','sexo','email','telefono',
        'nacionalidad_tipo','nacionalidad_id','nacionalidad_descripcion', 'enfermedad',
        'domicilio_calle','domicilio_numero','domicilio_cruzamientos','domicilio_codigo_postal',
        'domicilio_colonia','referencia_bancaria',
        'estatus_solicitud_id', 'tipo_solicitud'
    ];

    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Uuid::uuid4()->toString();
        });
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'grupo_id');
    }

    public function estatusSolicitud()
    {
        return $this->belongsTo(EstatusSolicitud::class, 'estatus_solicitud_id');
    }

    public function periodoEscolar()
    {
        return $this->belongsTo(PeriodoEscolar::class, 'periodo_escolar_id');
    }

    public function turno()
    {
        return $this->belongsTo(Turno::class, 'turno_id');
    }

    public function tipoSangre()
    {
        return $this->belongsTo(TipoSangre::class, 'tipo_sangre_id');
    }

    public function solicitudTutor()
    {
        return $this->hasOne(SolicitudTutor::class, 'solicitud_id');
    }

    public function solicitudCt()
    {
        return $this->hasOne(SolicitudCt::class, 'solicitud_id');
    }

    public function fichaPago()
    {
        return $this->hasOne(FichaPago::class, 'solicitud_id');
    }
}
