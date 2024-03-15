<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quanity extends Model
{
    use HasFactory;
    protected $table='quanity';
    protected $fillable = [
        'quanity',
        'product_id',
        'id_color',
        'id_size'
    ];
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function color(){
        return $this->belongsTo(Color::class);
    }
    public function size(){
        return $this->belongsTo(Size::class);
    }
}
