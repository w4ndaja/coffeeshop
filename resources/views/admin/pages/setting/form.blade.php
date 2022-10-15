@extends('admin.layouts.adminLayout')
@section('content')
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.menu-categories.index')}}">Settings</a></li>
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
                            <label for="input_key">Name</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control @error('key') is-invalid @enderror" id="input_key" name="key" value="{{old('key') ?? $data->key}}" {{$data->exists ? 'disabled' : ''}}>
                            @error('key')<small class="text-danger">{{$message}}</small>@enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="input_value">Value</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control @error('value') is-invalid @enderror" id="input_value" name="value" value="{{old('value') ?? $data->value}}">
                            @error('value')<small class="text-danger">{{$message}}</small>@enderror
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
