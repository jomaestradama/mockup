<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mock extends Model
{
    //
    protected $fillable = ['cuenta','url'];
    protected $primaryKey = 'mock_id';

}
