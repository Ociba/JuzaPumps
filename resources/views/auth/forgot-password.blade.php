<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" type="image/png" sizes="16x16" href="{{asset('admin/dist/images/logo/images.jpeg')}}">
	<title>Juza Pumps</title>
	<link rel="stylesheet" href="{{ asset('assets/styles/style.min.css')}}">
   <link rel="stylesheet" href="{{ asset('assets/styles/custom.css')}}">

	<!-- Waves Effect -->
	<link rel="stylesheet" href="{{ asset('assets/plugin/waves/waves.min.css')}}">

</head>

<body>

<div id="single-wrapper">
        @if (session('status'))  
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif
	<form method="POST" action="{{ route('password.email') }}" class="frm-single">
        @csrf
		<div class="inside">
        <span style="color:red;"><x-jet-validation-errors class="text-center" /></span>
			<div class="title"><strong>Juza </strong>Pumps</div>
			<!-- /.title -->
			<div class="frm-title">Reset Password</div>
			<!-- /.frm-title -->
			<p class="text-center">Enter your email address and we'll send you an email with instructions to reset your password.</p>
			<div class="frm-input">
                <label for="exampleInputEmail1">Password</label>
                <input id="email" placeholder="Enter Email" class="frm-inp" type="email" name="email" :value="old('email')" required autofocus >
            </div>
			<!-- /.frm-input -->
			<button type="submit" class="frm-submit">Email Password Reset Link<i class="fa fa-arrow-circle-right"></i></button>
			<span class="text-center"><a href="/" ><i class="fa fa-sign-in"></i>Already have account? Login.</a></span>
			<!-- /.footer -->
		</div>
		<!-- .inside -->
	</form>
	<!-- /.frm-single -->
</div><!--/#single-wrapper -->
	<!-- 
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="{{ asset('assets/scripts/jquery.min.js')}}" type="c581f0aaed47674534ee06c3-text/javascript"></script>
	<script src="{{ asset('assets/scripts/modernizr.min.js')}}" type="c581f0aaed47674534ee06c3-text/javascript"></script>
	<script src="{{ asset('assets/plugin/bootstrap/js/bootstrap.min.js')}}" type="c581f0aaed47674534ee06c3-text/javascript"></script>
	<script src="{{ asset('assets/plugin/nprogress/nprogress.js')}}" type="c581f0aaed47674534ee06c3-text/javascript"></script>
	<script src="{{ asset('assets/plugin/waves/waves.min.js')}}" type="c581f0aaed47674534ee06c3-text/javascript"></script>

	<script src="{{ asset('assets/scripts/main.min.js')}}" type="c581f0aaed47674534ee06c3-text/javascript"></script>
<script src="{{ asset('assets/scripts/mycommon.js')}}" type="c581f0aaed47674534ee06c3-text/javascript"></script>
<script src="https://demo.ninjateam.org/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="c581f0aaed47674534ee06c3-|49" defer=""></script></body>

</html>
