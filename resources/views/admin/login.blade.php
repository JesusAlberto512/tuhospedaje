<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ siteName() }} | Log in</title>
    <link rel="shortcut icon" href={!! getFavicon() !!}>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="{{ asset('public/backend/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awsome 4.7 -->
    <link rel="stylesheet" href="{{ asset('public/backend/font-awesome/css/font-awesome.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('public/backend/dist/css/AdminLTE.min.css') }}">
</head>
<body class="hold-transition login-page">
    <div class="">
        @if (Session::has('message'))
            <div class="alert {{ Session::get('alert-class') }} text-center mb-0" role="alert">
            {{ Session::get('message') }}
            <a href="javaScript:void(0);" class="pull-right" data-dismiss="alert" aria-label="Close">&times;</a>
            </div>
        @endif
    </div>
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ url('/') }}" class="text-decoration-none fw-bolder"><strong>{{ siteName() }}</strong></a>
        </div>
        <div class="login-box-body">
            <p class="login-box-msg">LOGIN TO <span class="loginto"><strong>{{ siteName() }}</strong></span></p>

            <form action="{{ url('admin/authenticate') }}" method="post" id="admin_login">
            {{ csrf_field() }}

                <div class="form-group has-feedback mb-3">
                    <label class="fw-bold" for="username">Email</label>

                    <div class="input-group">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>
                </div>
                
                
                <div class="form-group has-feedback">
                    <label class="fw-bold" for="password">Password</label>
                    <div class="input-group">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label></label>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat float-end ">Sign In</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<script src="{{ asset('public/js/jquery-2.2.4.min.js') }}"></script>
<script src="{{ asset('public/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>

