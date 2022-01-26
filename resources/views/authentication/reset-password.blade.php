@extends('layouts.master_layout')
@section('content')

  <div class="container">
      <div class="col-md-12">
        <h1>Reset Password</h1>
          <div class=" mt-5">


            <form method="POST" action="{{  URL::to('/update-forget-password') }}"  autocomplete="off" data-parsley-validate>
                @csrf



                <input type="hidden" name="token" value="{{ $token }}">


                <div class="form-group mb-2">
                    <input type="password" name="password" class="form-control" placeholder="Enter password" required data-parsley-error-message="Please enter new password.">
                </div>

                <div class="form-group">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Enter confirm password" required data-parsley-error-message="Please enter confirm password.">
                </div>


                <div class="form-group mt-2">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">
                            {{ __('Reset Password') }}
                        </button>
                    </div>
                </div>


            </form>
          </div>

      </div>
  </div>

@endsection



