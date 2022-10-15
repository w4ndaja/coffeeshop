<?php

namespace App\Models;

use App\Traits\Model\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory, Search;
    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(MenuCategory::class, 'menu_category_id');
    }

    public function scopeJoinCategory($q)
    {
        $q->join('menu_categories', 'menu_categories.id', 'menus.menu_category_id');
    }
}
