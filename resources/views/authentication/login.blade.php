@extends('layouts.master_layout')
@section('content')

    <div class="container">
        <div class="col-md-12">
            <h1>Login</h1>
            <div class=" mt-5">
                <form action="{{url('/login')}}" method="post" data-parsley-validate>
                    @csrf
                    <div class="mb-3">
                        <label for="formGroupExampleInput" class="form-label">Email</label>
                        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Enter email"
                               required name="email">
                    </div>
                    <div class="mb-3" required>
                        <label for="formGroupExampleInput2" class="form-label">Password</label>
                        <input type="password" class="form-control" id="formGroupExampleInput2"
                               placeholder="Enter password" name="password">
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                    <div class="mb-3">
                        <a href="{{url('/forget-password')}}">forget password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection



