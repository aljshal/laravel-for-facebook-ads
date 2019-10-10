<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catalogs extends Model
{
    public $timestamps = false;
    protected $fillable = ['email','business_id','catalog_id'];
}
