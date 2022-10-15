<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SettingController extends Controller
{
  public function index(Request $request)
  {
    $qrCode = Setting::where('key', 'qrcode')->first();
    if (!$qrCode) {
      $qrCode->fill([
        'key' => 'qrcode',
        'value' => route('menus.index')
      ]);
      $qrCode->save();
    }
    $settings = Setting::search($request->search)->paginate($request->perpage);
    return view('admin.pages.setting.index', [
      'title' => 'Settings',
      'settings' => $settings,
      'qrCode' => QrCode::size(200)->generate($qrCode->value),
    ]);
  }

  public function create(Request $request)
  {
    return view('admin.pages.setting.form', [
      'title' => 'Create New Setting',
      'action' => route('admin.settings.store'),
      'data' => new Setting,
      'method' => 'POST',
      'submit' => 'Save',
    ]);
  }

  public function edit(Request $request, Setting $setting)
  {
    return view('admin.pages.setting.form', [
      'title' => "Edit Setting {$setting->key}",
      'data' => $setting,
      'action' => route('admin.settings.update', $setting),
      'method' => 'PUT',
      'submit' => 'Update',
    ]);
  }

  public function store(Request $request)
  {
    $form = $request->validate([
      'key' => 'required|string|unique:settings,key',
      'value' => 'required|string',
    ]);
    Setting::create($form);
    return redirect()->route('admin.settings.index')->with('success', [
      'title' => 'Setting',
      'message' => 'Setting successfully created!'
    ]);
  }

  public function update(Request $request, Setting $setting)
  {
    $form = $request->validate([
      'value' => 'required|string'
    ]);
    $setting->update($form);
    return redirect()->route('admin.settings.index')->with('success', [
      'title' => 'Setting',
      'message' => 'Setting successfully updated!'
    ]);
  }

  public function destroy(Setting $setting)
  {
    $setting->delete();
    return redirect()->route('admin.settings.index')->with('success', [
      'title' => 'Setting',
      'message' => 'Setting successfully deleted!'
    ]);
  }
}
