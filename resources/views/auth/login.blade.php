@extends('layouts.app')

@section('content-login')

    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="#"><b>Tele</b>práctica</a>
            </div>
            <!-- /.login-logo -->
            <div id="userLogin">
                <userlogin-component></userlogin-component>
            </div>
            <!--
                <div class="login-box">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header"></div>

                                    <div class="card-body">
                                        <form method="POST" action="">
                                        

                                            <div class="form-group row mb-0">
                                                <div class="col-md-8 offset-md-4">
                                                    <button type="submit" class="btn btn-primary">
                                                        
                                                    </button>

                                                    
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                -->
        </div>
        <!-- /.login-box -->
    </body>

@endsection
