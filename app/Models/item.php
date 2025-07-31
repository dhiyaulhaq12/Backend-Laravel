<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = 'items';

    protected $fillable = ['name','description','quantity','price','image'];

    // Supaya response JSON selalu menyertakan image_url
    protected $appends = ['image_url'];

    // Casting supaya jumlah & harga tidak jadi string di JSON
    protected $casts = [
        'quantity' => 'integer',
        'price'    => 'decimal:2',
    ];

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/'.$this->image) : null;
    }
}