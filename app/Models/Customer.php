<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'customers'; 

    protected $fillable = [
        'id',
        'shop_id',
        'first_name',
        'last_name',
        'avatar',
        'city',
        'birthdate'
    ];

    public function getFullNameAttribute()
    {
        return ucwords("{$this->first_name} {$this->last_name}");
    }

    public function Shop()
    {
        return $this->hasOne(Shop::class,'id','shop_id');
    }

}
