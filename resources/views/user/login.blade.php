@extends('user.guest-layouts')
@section('content')
<div class="container d-flex justify-content-center align-items-center" style="height:100vh">
    <form action="{{route('user.authenticate')}}" method="post">
        @csrf
        <div class="card">
            <div class="card-header fw-bold text-info py-4 px-4">Welcome, please submit your credentials below</div>
            <div class="card-body">
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
                    <span class="text-info">Or, </span><a href="{{route('user.register')}}" class="text-info">register</a>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </div>
    </form>
</div>
@endsection
