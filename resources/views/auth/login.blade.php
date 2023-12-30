@extends('layouts.login_master')

@section('content')
<div class="page-content login-cover">

    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Content area -->
        <div class="content d-flex justify-content-center align-items-center">

            <!-- Login card -->
            <form class="login-form " method="post" action="{{ route('login') }}">
                @csrf
                <div class="card mb-0">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <i class="icon-lock icon-2x text-warning-400 border-warning-400  mb-3 mt-1"></i>
                            <h5 class="mb-0">Login to your account</h5>
                            </br>
                            or
                            <h5 class="mb-0"> <a href="{{route('register')}}">Register</a>
                            </h5>

                        </div>

                        @if ($errors->any())
                        <div class="alert alert-danger alert-styled-left alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                            <span class="font-weight-semibold">Oops!</span> {{ implode('<br>', $errors->all()) }}
                        </div>
                        @endif


                        <div class="form-group ">
                            <input type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                        </div>

                        <div class="form-group ">
                            <input required name="password" type="password" class="form-control" placeholder="{{ __('Password') }}">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-block">Sign in <i class="icon-circle-right2 ml-2"></i></button>
                        </div>

        

                    </div>
                </div>
            </form>

        </div>


    </div>

</div>
@endsection