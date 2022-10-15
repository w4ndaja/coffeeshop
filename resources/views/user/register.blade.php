@extends('user.guest-layouts')
@section('content')
<div class="container d-flex justify-content-center align-items-center" style="height:100vh">
    <ul>
        @foreach ($errors->all() as $item)
        <li><span class="text-danger">{{$item}}</span></li>
        @endforeach
    </ul>
    <form action="{{route('user.register.store')}}" method="post">
        @csrf
        <div class="card">
            <div class="card-header fw-bold text-info py-4 px-4">Welcome, please register to continue</div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="name_input">Name</label>
                    <input type="name" class="form-control @error('name')is-invalid @enderror" id="name_input" name="name" value="{{old('name')}}" @if(empty(old('name')))autofocus @endif>
                    @error('name')<span class="text-danger">{{$message}}</span>@enderror
                </div>
                <div class="mb-3">
                    <label for="phone_input">Phone</label>
                    <input type="phone" class="form-control @error('phone')is-invalid @enderror" id="phone_input" name="phone" value="{{old('phone')}}" @if(empty(old('phone')))autofocus @endif>
                    @error('phone')<span class="text-danger">{{$message}}</span>@enderror
                </div>
                <div class="mb-3">
                    <label for="email_input">Email</label>
                    <input type="email" class="form-control @error('email')is-invalid @enderror" id="email_input" name="email" value="{{old('email')}}" @if(empty(old('email')))autofocus @endif>
                    @error('email')<span class="text-danger">{{$message}}</span>@enderror
                </div>
                <div>
                    <label for="password_input">Password</label>
                    <input type="password" class="form-control @error('password')is-invalid @enderror" id="password_input" name="password" @if(old('email')) autofocus @endif>
                    @error('password')<span class="text-danger">{{$message}}</span>@enderror
                </div>
                <div>
                    <label for="password_confirmation_input">Confirm Password</label>
                    <input type="password" class="form-control @error('password_confirmation')is-invalid @enderror" id="password_confirmation_input" name="password_confirmation" @if(old('email')) autofocus @endif>
                    @error('password_confirmation')<span class="text-danger">{{$message}}</span>@enderror
                </div>
                <div>
                    <span class="text-info">Or, </span><a href="{{route('user.register')}}" class="text-info">register</a>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Register</button>
            </div>
        </div>
    </form>
</div>
@endsection
