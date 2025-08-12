<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class register extends Model
{
    use HasFactory;

    protected $table = 'registers'; // Specify the table name

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];
    protected $hidden = [
        'password',
    ];
}
