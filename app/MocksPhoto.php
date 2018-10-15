<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MocksPhoto extends Model
{
    //
    protected $fillable = ['mock_id', 'filename'];
    protected $primaryKey = 'photo_id';
}
