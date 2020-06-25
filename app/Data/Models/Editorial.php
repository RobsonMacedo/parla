<?php

namespace App\Data\Models;

use Illuminate\Database\Eloquent\Model;

class Editorial extends BaseModel
{
    public $table = 'editorial';

    protected $fillable = ['text'];
}
