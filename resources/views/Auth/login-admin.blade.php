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

	</head>
	<body class="login-page">
		<div class="login-header box-shadow" style="background:black;">
			<div
				class="container-fluid d-flex justify-content-between align-items-center"
			>
				<div class="brand-logo">
					<a href="/" style="	color:black !important;font-weight:bolder  !important; font-size:x-large;">
						<h5 style="color:white; padding-left:30px;">SMART ATTENDANCE SYSTEM</h5>
					</a>
				</div>
				<div class="login-menu" style="color:white;">
					<ul>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="color: white">Role</a>
							<ul class="dropdown-menu" style="border: 1px solid #333; border-radius: 5px; background-color: white; top: 30px;">
								<li><a href="#" style="color: rgb(0, 0, 0); display: block; padding: 10px; text-decoration: none;">Admin</a></li>
								<li><a href="/" style="color: rgb(0, 0, 0); display: block; padding: 10px; text-decoration: none;">Teacher</a></li>
							</ul>
						</li>
					</ul>
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
					<div class="col-md-6 col-lg-7">
						<img src="Image/Attendancebg.png"  alt="" />
					</div>
					<div class="col-md-6 col-lg-5">
						<div class="login-box bg-white box-shadow border-radius-10">
							<div class="login-title">
								<center>
								<h2 class="text-center text-primary">Welcome Back !<br><br><h2 style="color:black;">Sign in to your Account</h2></h2>
								</center>
							</div>
							<form action="loginadmin" method="POST" autocomplete="off" aria-autocomplete="off">
                                            @csrf
                                      
							
								<div class="input-group custom">

									<input
										type="text"
										class="form-control form-control-lg"
										placeholder="Username"
										name="username"
										required
									/>

									<div class="input-group-append custom">
										<span class="input-group-text"
											><i class="icon-copy dw dw-user1"></i
										></span>
									</div>
								</div>

								<div class="input-group custom">

									<input
										type="password"
										class="form-control form-control-lg"
										placeholder="**********"
										name="password"
										required
									/>

									<div class="input-group-append custom">
										<span class="input-group-text"
											><i class="dw dw-padlock1"></i
										></span>
									</div>
								</div>

								<div class="row">
									<div class="col-sm-12">
										<div class="input-group mb-0">
											<input class="btn btn-primary btn-lg btn-block" type="submit" value="Sign In">
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
