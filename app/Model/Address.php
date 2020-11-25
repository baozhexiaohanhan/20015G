<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'address';
    protected $guarded = [];
    protected $primaryKey = "address_id";
    public $timestamps = false;
}
