<?php 
$error = (!empty($this->session->flashdata('error'))) ? true : false;  
$animation = ($error) ? 'bounce' : 'zoomIn'; 
$form_attributes = array('class' => 'animated ' . $animation, 'id' => 'form');
?>

<div class="container-fluid h-100 background-special">
	<div class="row h-100 justify-content-center align-items-center">
		<div class="col-12">
			<div class="card card-custom mx-auto" style="max-width:600px; width:auto;">
				<?php echo form_open('/register/submit', $form_attributes); ?>
					<h2>Welcome To Iluminous</h2>
					<p>Let's get started...</p>
					<?php if ($error) { ?>
					<div class="alert alert-danger" role="alert">
						<small>
							<?php echo form_error('first_name'); ?>
							<?php echo form_error('last_name'); ?>
							<?php echo form_error('email'); ?>
							<?php echo form_error('username'); ?>
 							<?php echo form_error('password'); ?>
						</small>
					</div>
					<?php } ?>
					<div class="form-row">
						<div class="form-group col-md-6">
							<small class="form-text text-muted" for="first_name">First Name</small>
  							<input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="<?php echo set_value('first_name'); ?>" required>
						</div>
						<div class="form-group col-md-6">
							<small class="form-text text-muted" for="last_name">Last Name</small>
  							<input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="<?php echo set_value('last_name'); ?>" required>
						</div>
					</div>
					<div class="form-group">
						<small class="form-text text-muted" for="email">Email</small>
					<input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo set_value('email'); ?>" required>
					</div>
					<div class="form-row">
						<div class="form-group col-md-4">
							<small class="form-text text-muted" for="username">Username</small>
								<div class="input-group mb-2">
								<div class="input-group-prepend">
	  								<div class="input-group-text">@</div>
								</div>
								<input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?php echo set_value('username'); ?>" required>
								</div>
						</div>
						<div class="form-group col-md-4">
							<small class="form-text text-muted" for="Password">Password</small>
								<input type="password" class="form-control" pattern=".{8,}" title="Password must contain at least 8 characters." name="password" placeholder="Password" required>
						</div>
						<div class="form-group col-md-4">
							<small class="form-text text-muted" for="Password">Confirm Password</small>
								<input type="password" class="form-control" pattern=".{8,}" title="Password must contain at least 8 characters." name="confirm_password" placeholder="Confirm Password" required>
						</div>
					</div>
						<button class="btn btn-dark btn-register mt-4" type="submit">SIGN UP</button>
				  		<small class="form-text text-muted mt-4">Already have an account? <a href="/login">Login</a></small>
				</form>
			</div>
    	</div>   
  	</div>
</div>
