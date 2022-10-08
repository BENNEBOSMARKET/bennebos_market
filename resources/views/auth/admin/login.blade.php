@extends('auth.auth-layout')

@section('title') Admin Login @endsection

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Black+Ops+One&family=ZCOOL+QingKe+HuangYou&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Black+Ops+One&family=Saira+Condensed:wght@300&family=ZCOOL+QingKe+HuangYou&display=swap');
        body {
            font-family: 'Roboto', sans-serif;
            background: #046a70;
            font-size: 15px;
        }
        button {
            background: #046a70;
            border: none;
            width: 50%;
            padding: 7px 10px;
            border-radius: 15px;
            color: white;
        }
        button:hover {
            background: #055f64;
            transition-duration: .3s;
        }
        button:disabled {
            background: #032325;
        }
        .content {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .card {
            min-height: 50vh;
            background: transparent;
            border: none;
        }
        .card-body {
            background: white;
            border-radius: 20px;
        }
        .logo {
            height: 100px;
            width: 100px;
            margin-top: -50px;
        }
        .form-control {}
        .form-control:focus {
            box-shadow: none;
        }
        .title {
            /* font-family: 'Black Ops One', cursive; */
            font-family: 'ZCOOL QingKe HuangYou', cursive;
            font-size: 30px;
        }
    </style>
    <section id="SignupForm">
        <div class="container">
            <div class="row justify-content-center content">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <img src="{{ asset('assets/img/AdminLTELogo.png') }}"
                                        class="rounded-circle logo" alt="">
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-12 text-center">
                                    <h5 class="font-weight-bold title">Admin Login</h5>

                                    <div class="dropdown-divider mt-4"></div>
                                </div>
                            </div>

                            <div class="row justify-content-center mt-3">
                                <div class="col-md-10">
                                    @if (session()->has('errorMessage'))
                                        <div class="alert alert-danger text-center">{{ session('errorMessage') }}
                                        </div>
                                    @endif
                                    <form action="{{ route('admin.login') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="email" class="text-muted"><i class="fa fa-envelope"></i> Email</label>
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" />

                                            @error('email')
                                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="password" class="text-muted"><i class="fa fa-lock"></i> Password</label>
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" />

                                            @error('password')
                                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group text-center mt-5">
                                            <button type="submit">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection