<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Ramsey\Uuid\Uuid;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password','last_login_at', 'cuenta_validada', 'correo_institucional_validada'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [ 'groupsTags' ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Uuid::uuid4()->toString();
        });
    }

    public function userable()
    {
        return $this->morphTo();
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_user', 'user_id', 'group_id');
    }

    // = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
    //                    METODOS DE ROLES Y GRUPOS
    // = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =

    public function scopeByGroup($query, $group)
    {
        if (empty ($group)) {
            return;
        }
        $query->whereHas('groups', function ($q) use ($group){
            $q->where('groups.id', $group);
        });
    }

    public function hasRole($role)
    {
        if ( ! is_array($role)) {
            return $this->groups()->where('descripcion', $role)->count();
        }
        $rolesDelUsuario = $this->groups->pluck('descripcion')->toArray();

        if (count(array_intersect($rolesDelUsuario, $role))) {
            return true;
        }

        return false;
    }

    public function getGroupsTagsAttribute()
    {
        $groups = $this->groups()->get();

        return $groups->implode('descripcion', ', ');
    }
}
