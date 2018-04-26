<?php 
$error = (!empty($this->session->flashdata('error'))) ? true : false;  
$error_message = ($error) ? $this->session->flashdata('error_message') : 'Something went wrong...';
?>
<div class="container-fluid background-special">
	<div class="row h-100 justify-content-center align-items-center">
		<div class="col-12">
			<div class="card mx-auto" style="max-width:600px; width:auto;">
				<form method="POST" action="register/submit" class="animated <?php echo ($error) ? 'bounce' : 'zoomIn'; ?>">
					<div class="text-center">
						<h2>Welcome To Iluminous</h2>
						<p>Let's get started...</p>
					</div>
					<?php if ($error) { ?>
					<div class="alert alert-danger" role="alert">
						<?php echo $error_message; ?>
					</div>
					<?php } ?>
					<div class="form-row">
						<div class="form-group col-md-6">
							<small class="form-text text-muted" for="first_name">First Name</small>
  							<input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" required>
						</div>
						<div class="form-group col-md-6">
							<small class="form-text text-muted" for="last_name">Last Name</small>
  							<input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" required>
						</div>
					</div>
					<div class="form-group">
						<small class="form-text text-muted" for="email">Email</small>
					<input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<small class="form-text text-muted" for="username">Username</small>
								<div class="input-group mb-2">
								<div class="input-group-prepend">
	  								<div class="input-group-text">@</div>
								</div>
								<input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
								</div>
						</div>
						<div class="form-group col-md-6">
							<small class="form-text text-muted" for="Password">Password</small>
								<input type="password" class="form-control" pattern=".{8,}" title="Password must contain at least 8 characters." name="password" placeholder="Password" required>
						</div>
					</div>
					<div class="text-center">
						<button class="btn btn-dark btn-register mt-4" type="submit">SIGN UP</button>
				  		<small class="form-text text-muted mt-4">Already have an account? <a href="/login">Login</a></small>
			  		</div>
				</form>
			</div>
    	</div>   
  	</div>
</div>
