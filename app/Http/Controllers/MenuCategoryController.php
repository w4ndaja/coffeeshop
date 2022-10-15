<?php

namespace App\Http\Controllers;

use App\Models\MenuCategory;
use Illuminate\Http\Request;

class MenuCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $menuCategories = MenuCategory::withCount('menus')
            ->active($request->active)
            ->search($request->search, 'name')
            ->paginate($request->perpage ?? 10);

        return view('admin.pages.category.index', [
            'title' => 'Menu Categories',
            'menuCategories' => $menuCategories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.category.form', [
            'title' => 'New Menu Categories',
            'data' => new MenuCategory,
            'action' => route('admin.menu-categories.store'),
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
            'name' => 'required|string|unique:menu_categories,name',
            'active' => 'nullable|boolean'
        ]);

        $menuCategory = MenuCategory::create($form);
        $menuCategory->loadCount('menus');
        return redirect()->route('admin.menu-categories.index')->with('success', [
            'title' => 'Menu Categories',
            'message' => 'Menu category successfully created!'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MenuCategory  $menuCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(MenuCategory $menuCategory)
    {
        return view('admin.pages.category.form', [
            'title' => "{$menuCategory->name} / Edit",
            'data' => $menuCategory,
            'action' => route('admin.menu-categories.update', $menuCategory),
            'method' => 'PUT',
            'submit' => 'Update',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MenuCategory  $menuCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MenuCategory $menuCategory)
    {
        $form = $request->validate([
            'name' => 'required|string|unique:menu_categories,name,' . $menuCategory->id,
            'active' => 'nullable|boolean'
        ]);

        if (!$request->exists('active')) {
            $form['active'] = false;
        }

        $menuCategory->update($form);
        $menuCategory->loadCount('menus');
        return redirect()->route('admin.menu-categories.index')->with('success', [
            'title' => 'Menu Categories',
            'message' => 'Menu category successfully updated!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MenuCategory  $menuCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(MenuCategory $menuCategory)
    {
        $menuCategory->delete();
        return redirect()->route('admin.menu-categories.index')->with('success', [
            'title' => 'Menu Categories',
            'message' => 'Menu category successfully deleted!'
        ]);
    }
}
