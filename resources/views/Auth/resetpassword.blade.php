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
			href="../Image/calendar.png"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="32x32"
			href="../Image/calendar.png"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="16x16"
			href="../Image/calendar.png"
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
		<link rel="stylesheet" type="text/css" href="../vendors/styles/core.css" />
		<link
			rel="stylesheet"
			type="text/css"
			href="vendors/styles/icon-font.min.css"
		/>
		<link rel="stylesheet" type="text/css" href="../vendors/styles/style.css" />

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
			<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
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
					<div class="col-md-6">
						<img src="../vendors/images/forgot-password.png" alt="" />
					</div>
					<div class="col-md-6">
						<div class="login-box bg-white box-shadow border-radius-10">
							<div class="login-title">
								<h2 class="text-center text-primary">Reset Password</h2>
							</div>
							<h6 class="mb-20">
								Enter your new password to reset your password
							</h6>
                            <form action="/updatepassword" method="POST" autocomplete="off" aria-autocomplete="off">
                                            @csrf

                                <input type="hidden" name="id" value="{{ $user->id }}">

								<div class="input-group custom">
									<input
										type="text"
										class="form-control form-control-lg"
										placeholder="Email"
                                        name="email"
                                        value="{{ $user->email }}"
                                        readonly
                                        required
									/>

                                   
									<div class="input-group-append custom">
										<span class="input-group-text"
											><i class="fa fa-envelope-o" aria-hidden="true"></i
										></span>
									</div>
								</div>


                                <div class="input-group custom">
									<input
										type="password"
										class="form-control form-control-lg"
										placeholder="Enter New Password"
                                        name="password"
                                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@$!%*#?&]).{8,32}" title="Your password must be between 8 - 32 characters long and include uppercase letter (A-Z), lowercase letter (a-z), number (0-9) and special characters such as @$!%*#?&"
                                        required
									/>

                                   
									<div class="input-group-append custom">
										<span class="input-group-text"
											><i class="fa fa-key" aria-hidden="true"></i
										></span>
									</div>
								</div>

                                <div class="input-group custom">
									<input
										type="password"
										class="form-control form-control-lg"
										placeholder="Re-Enter New Password"
                                        name="repassword"
                                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@$!%*#?&]).{8,32}" title="Your password must be between 8 - 32 characters long and include uppercase letter (A-Z), lowercase letter (a-z), number (0-9) and special characters such as @$!%*#?&"
                                        required
									/>

                                   
									<div class="input-group-append custom">
										<span class="input-group-text"
											><i class="fa fa-key" aria-hidden="true"></i
										></span>
									</div>
								</div>
								<div class="row align-items-center">
									<div class="col-12">
										<div class="input-group mb-0">
									
											<input class="btn btn-primary btn-lg btn-block" type="submit" value="Submit">
								
											
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
		<script src="../vendors/scripts/core.js"></script>
		<script src="../vendors/scripts/script.min.js"></script>
		<script src="../vendors/scripts/process.js"></script>
		<script src="../vendors/scripts/layout-settings.js"></script>

	</body>
</html>
