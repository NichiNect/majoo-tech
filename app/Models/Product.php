<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_name', 'picture', 'price', 'description', 'status'
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function getImageProduct()
    {
        return asset('storage/images/products/'.$this->picture);
    }
}