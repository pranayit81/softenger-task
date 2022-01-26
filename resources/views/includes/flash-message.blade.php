{{--Test all Flash messages--}}

{{--<div class="alert alert-success custom-alert-success animated  flash  alert-block text-center">--}}
{{--<button type="button" class="close custom-alert-close" data-dismiss="alert">×</button>--}}
{{--<span>This is some testing message</span>--}}
{{--</div>--}}

{{--<div class="alert alert-danger  custom-alert-danger  animated  flash alert-block  text-center">--}}
{{--<button type="button" class="close custom-alert-close" data-dismiss="alert">×</button>--}}
{{--<span>This is some testing message</span>--}}
{{--</div>--}}

{{--<div class="alert alert-warning alert-block custom-alert-warning  animated  flash  text-center">--}}
{{--<button type="button" class="close custom-alert-close" data-dismiss="alert">×</button>--}}
{{--<span>This is some testing message</span>--}}
{{--</div>--}}

{{--<div class="alert alert-info alert-block custom-alert-info animated  flash  text-center">--}}
{{--<button type="button" class="close custom-alert-close" data-dismiss="alert">×</button>--}}
{{--<span>This is some testing message</span>--}}
{{--</div>--}}

{{--<div class="alert alert-primary custom-alert-primary animated  flash alert-block  text-center">--}}
{{--<button type="button" class="close custom-alert-close" data-dismiss="alert">×</button>--}}
{{--<span>This is some testing message</span>--}}
{{--</div>--}}

{{--<div class="alert alert-secondary custom-alert-secondary animated  flash alert-block  text-center">--}}
{{--<button type="button" class="close custom-alert-close" data-dismiss="alert">×</button>--}}
{{--<span>This is some testing message</span>--}}
{{--</div>--}}

{{--Alert code for Success--}}

<div id="overlay">
    <div class="loaderContent">This can take up to 90 seconds</div>
    <img src="{{asset('public/assets/front-user/images/loader1.gif') }}" id="loading-image" alt="">
</div>

{{--Overlay Css--}}
<style>
    #overlay {
        display: none;
        position: fixed; /* Sit on top of the page content */

        width: 100%; /* Full width (cover the whole page) */
        height: 100%; /* Full height (cover the whole page) */
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(251, 251, 251, 0.86); /* Black background with opacity */
        z-index: 2; /* Specify a stack order in case you're using a different order for other elements */
        cursor: pointer; /* Add a pointer on hover */

    }

    .modal-open #overlay {
        background: transparent;
    }


    #loading-image {
        position: absolute;
        z-index: 999;
        left: 0;
        right: 0;
        bottom: 0;
        top: 0;
        margin: auto;

    }

    /*.alert {
        position: fixed;
        width: 100%;
        z-index: 999;
        margin-top: 100px;
    }*/
</style>


@if ($message = Session::get('success'))


    <div class="row">
        <div class="col-12">
            <div class="alert alert-success custom-alert-success   alert-block text-center">


                <span>{!! $message !!}</span>

            </div>
        </div>
    </div>


@endif

{{--Alert code for status--}}
@if ($message = Session::get('status'))


    <div class="row">
        <div class="col-12">
            <div class="alert alert-success custom-alert-success   alert-block text-center">

                <span>{!! $message !!}</span>
            </div>
        </div>
    </div>


@endif

{{--Alert code for error--}}
@if ($message = Session::get('error'))


    <div class="row">
        <div class="col-12">
            <div class="alert alert-danger  custom-alert-danger   alert-block  text-center">

                <span>{!! $message !!}</span>
            </div>
        </div>
    </div>

@endif

{{--Alert code for danger--}}
@if ($message = Session::get('danger'))


    <div class="row">
        <div class="col-12">
            <div class="alert alert-danger  custom-alert-danger   alert-block  text-center">


                <span>{!! $message !!}</span>

            </div>
        </div>
    </div>


@endif

{{--Alert code for warning--}}
@if ($message = Session::get('warning'))


    <div class="row">
        <div class="col-12">
            <div class="alert alert-warning alert-block custom-alert-warning  text-center">


                <span>{!! $message !!}</span>

            </div>
        </div>
    </div>

@endif

{{--Alert code for info--}}
@if ($message = Session::get('info'))


    <div class="row">
        <div class="col-12">
            <div class="alert alert-info custom-alert-info  alert-block  text-center">


                <span>{!! $message !!}</span>

            </div>
        </div>

    </div>
@endif

{{--Alert code for primary--}}
@if ($message = Session::get('primary'))

    <div class="row">
        <div class="col-12">
            <div class="alert alert-info custom-alert-primary  alert-block  text-center">


                <span>{!! $message !!}</span>

            </div>
        </div>
    </div>

@endif

{{--Alert code for Secondary--}}
@if ($message = Session::get('secondary'))


    <div class="row">
        <div class="col-12">
            <div class="alert alert-info custom-alert-secondary  alert-block  text-center">


                <span>{!! $message !!}</span>

            </div>
        </div>
    </div>

@endif

{{--Alert code for any--}}



@if (isset($errors) && $errors->any())
    <div class="alert alert-danger custom-alert-danger   text-center">

        {{$errors->first()}}
    </div>
@endif


<script>

    // $(".alert").each(function () {
    //
    //     $(".alert").delay(3000).fadeOut(2000);
    //
    // });


</script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
