@extends('admin.layouts.adminLayout')
@section('content')
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.menu-categories.index')}}">Menu Categories</a></li>
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
                            <label class="form-check-label" for="input_active">Status</label>
                        </div>
                        <div class="col-md-8">
                            <div class="form-check">
                                <label class="form-check-label" for="input_active">Active</label>
                                <input type="checkbox" class="form-check-input @error('active') is-invalid @enderror" id="input_active" name="active" value="1" {{(old('active') == 1 || $data->active) ? 'checked' : ''}}>
                            </div>
                            @error('active')<small class="text-danger">{{$message}}</small>@enderror
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
