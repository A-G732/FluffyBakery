<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'product_code';
    public $timestamps = false;       // usamos date_add/date_upd
    public $incrementing = true;      // PK autoincrement
    protected $keyType = 'int';

    protected $fillable = [
        'id_category',
        'product_name',
        'description',
        'ingredients',
        'price',
        'discount',
        'available_unity',
        'minimum_stock',
        'maximum_stock',
        'status',
        'date_add',
        'date_upd',
        'display_order',
        'image',
    ];
}
