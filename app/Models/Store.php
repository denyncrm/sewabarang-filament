<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Store extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['name','slug','thumbnail','address','is_open'];

    public function setNameAttribute($value){
        $this->attributes['name']= $value;
        $this->attributes['slug']= Str::slug($value);
    }
    
    public function transactions():HasMany{
        return $this->hasMany(Transaction::class,'store_id');
    }
}
