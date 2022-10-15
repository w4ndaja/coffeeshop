<?php

namespace App\Http\Controllers;

use App\Models\MenuCategory;
use Illuminate\Http\Request;

class ShowcaseController extends Controller
{
    public function index(Request $request)
    {
        $menuCategories = MenuCategory::with('menus')->active(1)->get();
        return view('user.showcase.index', [
            'title' => 'Showcase',
            'menuCategories' => $menuCategories
        ]);
    }
}
