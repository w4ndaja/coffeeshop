<?php

namespace App\Models;

use App\Traits\Model\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory, Search;
    protected $guarded = ['id'];
}
