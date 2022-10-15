<?php

namespace App\Models;

use App\Traits\Model\Search;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MenuCategory extends Model
{
    use HasFactory, Search;
    protected $guarded = ['id'];

    public function menus()
    {
        return $this->hasMany(Menu::class, 'menu_category_id');
    }

    public function scopeActive($q, $active = 0)
    {
        $q->where('active', !!$active);
    }
}
