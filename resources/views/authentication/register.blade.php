@extends('layouts.master_layout')
@section('content')
    <div class="container">
        <div class="col-md-12">
            <h1>Register</h1>
            <div class=" mt-5">
                <form action="{{url('/register')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="formGroupExampleInput" class="form-label">name</label>
                        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Enter name"
                               name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="formGroupExampleInput2" class="form-label">email</label>
                        <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Enter email"
                               name="email" required>
                    </div>

                    <div class="mb-3">
                        <label for="formGroupExampleInput2" class="form-label">password</label>
                        <input type="password" class="form-control" id="formGroupExampleInput2"
                               placeholder="Enter password" name="password" required>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection



