<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Editorial extends BaseModel
{
    public $table = 'editorial';

    protected $fillable = ['text'];
}
