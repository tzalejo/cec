<?php

namespace App;

use App\Role;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable;

    /**
     *  Si queremos crear un nombre de una tabla distinta en la bd
     *  protected $table = 'nombre_tabla'
     *
     */

    /**
     *
     * si queremos desactivar los campos de creacion y actualizacion
     * que se crean automaticamente al crear una tabla
     *
     * public $timestamps = false;
     */


    /**
     * Para cambiar el modelo de clave primaria
     */
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'userNombre', 'email', 'password','userImagen','roleId',
    ];

    /**
     * Mutadores: se lo utiliza para modificar antes de ser insertado en la bd
     * para que siempre los nombre(userNombre.users) esten en minusculas al momento de establecer..
     */

    public function setUserNombreAttribute($valor)
    {
        $this->attributes['userNombre'] = strtolower($valor);
    }
    public function setEmailAttribute($valor)
    {
        $this->attributes['email'] = strtolower($valor);
    }
    # estamos devolviendo el valor con cada caracter inical con mayuscual,
    # pero esta transformacion no se encuentra en la bd.
    public function getUserNombreAttribute($valor)
    {
        return ucwords($valor);
    }

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

    /**
     * Estoy indicando que un Usuario pertenece a una Role
     * @var array
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'roleId');
    }

    /**
     * Estoy indicando si es director
     *
     * @var boolean
     */
    public function esDirector()
    {
        return $this->roleId === Role::where('roleDescripcion', 'Director')->first()->value('roleId');
    }

    /**
     * Buscar por email y retorna el usuario
     * @var user
     */
    public static function buscarPorEmail($email)
    {
        // es static es similar a user o this
        return static::where(compact('email'))->first();
    }
}
