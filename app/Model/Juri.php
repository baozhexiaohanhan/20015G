<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Juri extends Model
{
    protected $table = 'juri';
    protected $guarded = [];
    protected $primaryKey = "juri_id";
    public $timestamps = false;
}
