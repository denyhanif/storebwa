<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chart extends Model
{
protected $fillable = ['products_id','user_id'];
protected $hidden= [];

public function product(){
    return $this->hasOne(Products::class,'id','products_id');
}
public function user(){
    return $this->belongsTo(User::class,'users_id','id');
}
}
