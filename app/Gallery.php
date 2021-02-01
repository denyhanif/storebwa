<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable =['phptos','products_id'];
    protected $hidden = [];

    public function product(){
        return $this->belongsTo(Product::class,'products_id','id');
    }
}
