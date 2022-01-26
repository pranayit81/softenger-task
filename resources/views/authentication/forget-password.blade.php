@extends('layouts.master_layout')
@section('content')

    <div class="container">
        <div class="col-md-12">
            <h1>Forget password</h1>
            <div class=" mt-5">
                <form method="post" action="{{URL::to('send-forget-password-link')}}" data-parsley-validate
                      class="form-horizontal form-label-left" id="adminLogin">
                    @csrf
                    <div>
                        <div class="form-group">
                            <input type="email" name="email" required placeholder="Email" class="form-control"
                                   placeholder="enter email"/>
                        </div>

                    </div>
                    <div>
                        <button type="submit" class="loginbtn btn btn-primary  mt-3 submit btn-block">Send mail</button>
                    </div>
                    <div class="clearfix"></div>
                    <div class="separator">
                        <div class="clearfix"></div>
                        <br/>
                        <div class="text-center">

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection



