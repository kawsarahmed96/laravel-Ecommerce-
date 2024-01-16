<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponUseDetails extends Model
{
    use HasFactory;
    
       /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */

    protected $guarded = ['id'];

}
