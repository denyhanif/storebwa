<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductsGalleries extends Model
{
    protected $fillable =['photos','products_id'];
    protected $hidden = [];

    public function product(){
        return $this->belongsTo(Products::class,'products_id','id');
    }
}
