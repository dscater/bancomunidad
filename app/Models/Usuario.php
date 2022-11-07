<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $connection = 'mysql_dos';
    protected $fillable = ["nombre", "contrasenia", "tipo", "acceso"];
    public $timestamps = false;
}
