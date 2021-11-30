<!DOCTYPE html>
<html lang="en">
<link rel="icon" type="image/png" sizes="16x16" href="{{asset('admin/dist/images/logo/images.jpeg')}}">
<title>Welcome To Juza Pumps</title>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="{{ asset('assets/images/images.jpeg')}}" type="image/x-icon">
	<link rel="stylesheet" href="{{ asset('assets/styles/style.min.css')}}">
   <link rel="stylesheet" href="{{ asset('assets/styles/custom.css')}}">

	<!-- Waves Effect -->
	<link rel="stylesheet" href="{{ asset('assets/plugin/waves/waves.min.css')}}">

</head>

<body>

<div id="single-wrapper" style="background: linear-gradient(to bottom, rgba(107, 107, 71, 0.42), rgba(153, 153, 102, 0.80)),
    url('assets/images/mot07.jpeg'); top center no-repeat;background-size:cover;overflow:hidden;width:100%;padding:0 15px 0 15px">
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif
	<form method="POST" action="{{ route('login') }}" class="frm-single">
        @csrf
		<div class="inside">
        <span style="color:red;"><x-jet-validation-errors class="text-center" /></span>
			<div class="title"><strong>Juza</strong>Pumps</div>
			<!-- /.title -->
			<!-- /.frm-title -->
			<div class="frm-input">
                <label for="exampleInputEmail1">Enter Your Username</label>
                <input id="name" type="name" placeholder="Username" class="frm-inp" name="name" :value="old('name')" required autofocus><i class="fa fa-use frm-ico"></i>
            </div>
			<!-- /.frm-input -->
			<div class="frm-input">
                <label for="exampleInputEmail1">Password</label>
                <input type="password" id="password" placeholder="Password" class="frm-inp" name="password" required autocomplete="current-password"><i class="fa fa-loc frm-ico"></i>
            </div>
			<!-- /.frm-input -->
			<div class="clearfix margin-bottom-20">
				<div class="float-left">
					<div class="checkbox primary"><input type="checkbox"  id="remember_me" name="remember"><label for="remember_me">Remember me</label></div>
					<!-- /.checkbox -->
				</div>
				<!-- /.float-left -->
				<div class="float-right">
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="a-link"><i class="fa fa-unlock-alt"></i>Forgot password?</a>
                    @endif
                </div>
				<!-- /.float-right -->
			</div>
			<!-- /.clearfix -->
			<button type="submit" class="frm-submit">Login<i class="fa fa-arrow-circle-right"></i></button>
			<!-- /.footer -->
		</div>
		<!-- .inside -->
	</form>
	<!-- /.frm-single -->
</div><!--/#single-wrapper -->
	<!-- 
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="{{ asset('assets/scripts/jquery.min.js')}}" type="5b2bca26d52a7e42ff9f44ae-text/javascript"></script>
	<script src="{{ asset('assets/scripts/modernizr.min.js')}}" type="5b2bca26d52a7e42ff9f44ae-text/javascript"></script>
	<script src="{{ asset('assets/plugin/bootstrap/js/bootstrap.min.js')}}" type="5b2bca26d52a7e42ff9f44ae-text/javascript"></script>
	<script src="{{ asset('assets/plugin/nprogress/nprogress.js')}}" type="5b2bca26d52a7e42ff9f44ae-text/javascript"></script>
	<script src="{{ asset('assets/plugin/waves/waves.min.js')}}" type="5b2bca26d52a7e42ff9f44ae-text/javascript"></script>

	<script src="{{ asset('assets/scripts/main.min.js')}}" type="5b2bca26d52a7e42ff9f44ae-text/javascript"></script>
<script src="{{ asset('assets/scripts/mycommon.js')}}" type="5b2bca26d52a7e42ff9f44ae-text/javascript"></script>
<script src="https://demo.ninjateam.org/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js'" data-cf-settings="5b2bca26d52a7e42ff9f44ae-|49" defer=""></script></body>

</html>
