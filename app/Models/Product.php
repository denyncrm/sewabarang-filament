<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['name','slug','thumbnail','about','price','category_id','brand_id'];

    public function setNameAttribute($value){
        $this->attributes['name']= $value;
        $this->attributes['slug']= Str::slug($value);
    }
    
    protected $casts = [
        'price'=>MoneyCast::class,
    ];

    public function category():BelongsTo{
        return $this->belongsTo(Category::class,'category_id');
    }

    public function brand():BelongsTo{
        return $this->belongsTo(Brand::class,'brand_id');
    }

    public function productPhotos():HasMany{
        return $this->hasMany(productPhoto::class,'product_id');
    }
}
