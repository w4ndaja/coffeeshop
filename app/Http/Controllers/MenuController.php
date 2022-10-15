<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuCategory;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categoryId = $request->category_id;
        $menus = Menu::select('menus.*', 'menu_categories.name as category_name')
            ->joinCategory()
            ->where(function($q)use($categoryId){
                if(!empty($categoryId)){
                    $q->whereMenuCategoryId($categoryId);
                }
            })
            ->search($request->search, 'menus.name', 'menu_categories.name')
            ->paginate($request->perpage ?? 10);

        return view('admin.pages.menu.index', [
            'title' => 'Menu',
            'menus' => $menus,
            'categories' => MenuCategory::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.menu.form', [
            'title' => 'New Menu',
            'categories' => MenuCategory::all(),
            'data' => Menu::latest()->firstOrNew(),
            'action' => route('admin.menus.store'),
            'submit' => 'Save',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form = $request->validate([
            'name' => 'required|string',
            'menu_category_id' => 'required|integer',
            'stock' => 'required|integer',
            'price' => 'required|integer',
        ]);

        Menu::create($form);

        return redirect()->route('admin.menus.index')->with('success', [
            'title' => 'Menu',
            'message' => 'Menu successfully created!'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        return view('admin.pages.menu.form', [
            'title' => "{$menu->name} / Edit",
            'categories' => MenuCategory::all(),
            'data' => $menu,
            'action' => route('admin.menus.update', $menu),
            'method' => 'PUT',
            'submit' => 'Update',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $form = $request->validate([
            'name' => 'required|string',
            'menu_category_id' => 'required|integer',
            'stock' => 'required|integer',
            'price' => 'required|integer',
        ]);

        $menu->update($form);
        return redirect()->route('admin.menus.index')->with('success', [
            'title' => 'Menu',
            'message' => 'Menu successfully updated!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('admin.menus.index')->with('success', [
            'title' => 'Menu',
            'message' => 'Menu successfully deleted!'
        ]);
    }
}
