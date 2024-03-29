<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;
     /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */

    protected $guarded = ['id'];

    public function categories(){
        
        return $this->belongsToMany(Category::class);
    }


     public function galleries(){
        
        return $this->hasMany(ProductGallery::class);
    }
    
     public function inventories(){
        
        return $this->hasMany(Inventory::class);
    }
}
