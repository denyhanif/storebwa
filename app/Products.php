<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Products extends Model
{
    use SoftDeletes;
    protected $fillable= ['name','user_id','categories_id','price','description','slug'];
    protected $hidden =[];

    //relasi
    public function galleries(){
        return $this->hasMany(ProductsGalleries::class,'products_id','id');
    }

    public function users(){
        return $this->hasOne(User::class,'id','user_id');
    }
    public function category(){
        return $this->belongsTo(Category::class,'categories_id','id');
    }
    
}
