<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  
    protected $guarded = ['created_at', 'deleted_at', 'updated_at'];
}
