<!DOCTYPE html>
<html>
	<head>
		<!-- Basic Page Info -->
		<meta charset="utf-8" />
		<title>Smart Attendance System</title>

		<!-- Site favicon -->
		<link
			rel="apple-touch-icon"
			sizes="180x180"
			href="Image/calendar.png"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="32x32"
			href="Image/calendar.png"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="16x16"
			href="Image/calendar.png"
		/>

		<!-- Mobile Specific Metas -->
		<meta
			name="viewport"
			content="width=device-width, initial-scale=1, maximum-scale=1"
		/>

		<!-- Google Font -->
		<link
			href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
			rel="stylesheet"
		/>
		<!-- CSS -->
		<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
		<link rel="stylesheet" type="text/css" href="vendors/styles/core.css" />
		<link
			rel="stylesheet"
			type="text/css"
			href="vendors/styles/icon-font.min.css"
		/>
		<link rel="stylesheet" type="text/css" href="vendors/styles/style.css" />
        <style>
		.login-box{
			max-width: 100% !important;
		}
	</style>
	</head>
	<body class="login-page">
		<div class="login-header box-shadow" style="background:black;">
			<div
				class="container-fluid d-flex justify-content-between align-items-center"
			>
				<div class="brand-logo">
					<a href="/" style="	color:black !important;
	font-weight:bolder  !important; font-size:x-large;">
						<h5 style="color:white; padding-left:30px;">SMART ATTENDANCE SYSTEM</h5>
					</a>
				</div>
			</div>
		</div>
		<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center"
		>
			<div class="container">

            @if($message = Session::get('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
<strong>Whoops !</strong> {{ session()->get('error') }}
    
</div>
@endif

@if($message = Session::get('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
<strong>Success !</strong> {{ session()->get('success') }}
    
</div>
@endif
				<div class="row align-items-center">
					<div class="col-md-6 col-lg-6">
						<img src="Image/Attendancebg.png"  alt="" />
					</div>
					<div class="col-md-6 col-lg-6">
						<div class="login-box bg-white box-shadow border-radius-10">
							<div class="login-title">
								<center>
								<h2 class="text-center text-primary">Create an Account!</h2>
								</center>
							</div>
                            <form action="/regusr" method="POST" autocomplete="off" aria-autocomplete="off">
                                            @csrf


                            <div class="row">
		<div class="col-md-6 col-sm-12">
			<div class="form-group">
				<label>Full Name</label>
				<input type="text" class="form-control" name="fullname" required>
			</div>
		</div>
		<div class="col-md-6 col-sm-12">
			<div class="form-group">
				<label>Username</label>
				<input type="text" class="form-control" name="username" required>
			</div>
		</div>
	</div>

    <div class="row">
		<div class="col-md-6 col-sm-12">
			<div class="form-group">
				<label>Password</label>
				<input type="text" class="form-control" name="password" required>
			</div>
		</div>
		<div class="col-md-6 col-sm-12">
			<div class="form-group">
				<label>Confirm Password</label>
				<input type="text" class="form-control" name="cpassword" required>
			</div>
		</div>
	</div>

    <div class="row">
		<div class="col-md-6 col-sm-12">
			<div class="form-group">
				<label>Email</label>
				<input type="email" class="form-control" name="email" required>
			</div>
		</div>
		<div class="col-md-6 col-sm-12">
			<div class="form-group">
				<label>Mobile Number</label>
				<input type="number" class="form-control" name="mobile" required>
			</div>
		</div>
	</div>



    <div class="row">
		<div class="col-md-8 col-sm-12">
			<div class="form-group">
				<label>Department</label>
				<input type="text" class="form-control" name="department" required>
			</div>
		</div>
	</div>



                                  
                            
								<div class="row">
									<div class="col-sm-12">
										<div class="input-group mb-0">
										
											<input class="btn btn-primary btn-lg btn-block" type="submit" value="Sign Up">
										
										</div>
										<div
											class="font-16 weight-600 pt-10 pb-10 text-center register"
											data-color="#707373"
										>
											OR
										</div>
										<div class="input-group mb-0 register">
											<a
												class="btn btn-outline-primary btn-lg btn-block"
												href="/"
												>Sign In</a
											>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- js -->

     
		
		<script src="vendors/scripts/core.js"></script>
		<script src="vendors/scripts/script.min.js"></script>
		<script src="vendors/scripts/process.js"></script>
		<script src="vendors/scripts/layout-settings.js"></script>
	</body>
</html>
