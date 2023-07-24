<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loker extends Model
{
    use HasFactory;
    protected $table = 'tb_loker';
    protected $fillable = [
        'id_loker',
        'id_dept',
        'id_user',
        'status',
        'created_at',
        'updated_at',
    ];
}
