@extends('admin.layouts.adminLayout')
@section('content')
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.menus.index')}}">Menu</a></li>
    <li class="breadcrumb-item active">{{$title}}</li>
</ol>
<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{$action}}" method="post">
                    @csrf
                    @method($method ?? 'POST')
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="input_name">Name</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="input_name" name="name" value="{{old('name') ?? $data->name}}">
                            @error('name')<small class="text-danger">{{$message}}</small>@enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="input_category_id">Category</label>
                        </div>
                        <div class="col-md-8">
                            <select class="form-control @error('menu_category_id') is-invalid @enderror" id="input_menu_category_id" name="menu_category_id">
                                <option value="">Choose Category</option>
                                @foreach ($categories as $item)
                                <option value="{{$item->id}}" @if($item->id == (old('menu_category_id') ?? $data->menu_category_id)) selected="selected" @endif >{{$item->name}}</option>
                                @endforeach
                            </select>
                            @error('menu_category_id')<small class="text-danger">{{$message}}</small>@enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="input_price">Price</label>
                        </div>
                        <div class="col-md-8 d-flex gap-2 align-items-center">
                            Rp. <input type="number" class="form-control @error('price') is-invalid @enderror" id="input_price" name="price" value="{{old('price') ?? $data->price}}">
                            @error('price')<small class="text-danger">{{$message}}</small>@enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="input_stock">Stock</label>
                        </div>
                        <div class="col-md-8">
                            <input type="number" class="form-control @error('stock') is-invalid @enderror" id="input_stock" name="stock" value="{{old('stock') ?? $data->stock}}">
                            @error('stock')<small class="text-danger">{{$message}}</small>@enderror
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">{{$submit}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
