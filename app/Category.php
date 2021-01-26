<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //mass asigment
    protected $fillable= ['nama','photo','slug'];

    protected $hidden=[];// menyembunyikan kolom saat di panggil di kontroller

}
