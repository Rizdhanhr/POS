<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
  protected $table = 'brand';
  protected $fillable = ['nama','created_at','updated_at','created_by','updated_by'];
}
