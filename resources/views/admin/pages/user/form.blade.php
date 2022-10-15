@extends('admin.layouts.adminLayout')
@section('content')
<ol class="breadcrumb mb-4">
  <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
  <li class="breadcrumb-item"><a href="{{route('admin.menu-categories.index')}}">Users</a></li>
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
              <label for="input_email">Email</label>
            </div>
            <div class="col-md-8">
              <input type="email" class="form-control @error('email') is-invalid @enderror" id="input_email" name="email" value="{{old('email') ?? $data->email}}">
              @error('email')<small class="text-danger">{{$message}}</small>@enderror
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-4">
              <label for="input_password">Password</label>
            </div>
            <div class="col-md-8">
              <input type="password" class="form-control @error('password') is-invalid @enderror" id="input_password" name="password">
              @error('password')<small class="text-danger">{{$message}}</small>@enderror
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-4">
              <label for="input_password_confirmation">Password Confirmation</label>
            </div>
            <div class="col-md-8">
              <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="input_password_confirmation" name="password_confirmation">
              @error('password_confirmation')<small class="text-danger">{{$message}}</small>@enderror
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-4">
              <label for="input_role">Role</label>
            </div>
            <div class="col-md-8">
              <select class="form-control @error('role') is-invalid @enderror" id="input_role" name="role">
                <option value="">Choose Role</option>
                @foreach(['Admin', 'Kasir', 'User'] as $item)
                <option value="{{$item}}" @if($item==(old('role') ?? $data->role)) selected @endif>{{$item}}</option>
                @endforeach
              </select>
              @error('role')<small class="text-danger">{{$message}}</small>@enderror
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
