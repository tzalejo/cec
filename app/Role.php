<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected $primaryKey = 'roleId';
    /**
     * Estoy indicando que un role tiene muchos user
     * 
     * Lo declaro en plurar porque un role tiene muchos usuarios..por ello devuelve una
     * coleccion de usuarios..
     * 
     * @var colection
     */
    public function users(){
       return $this->hasMany(User::class,'id');
    }

    
}
