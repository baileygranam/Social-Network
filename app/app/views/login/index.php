<?php 
$error = (!empty($this->session->flashdata('error'))) ? true : false;  
$animation = ($error) ? 'bounce' : 'zoomIn'; 
$form_attributes = array('class' => 'animated ' . $animation, 'id' => 'form');
?>

<div class="container-fluid h-100 background-special">
	<div class="row h-100 justify-content-center align-items-center">
		<div class="col-12">
			<div class="card card-custom mx-auto" style="max-width:400px; width:auto;">
				<?php echo form_open('/login/submit', $form_attributes); ?>
					<h2>SIGN IN</h2>
					<p>Please login to continue...</p>
					<?php if ($error) { ?>
					<div class="alert alert-danger" role="alert">
							Email or password incorrect!
					</div>
					<?php } ?>
					<div class="form-group">
					    <input type="text" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Email">
					</div>
					<div class="form-group">
					    <input type="password" class="form-control" name="password" aria-describedby="passwordHelp" placeholder="Password">
					</div>
					<button class="btn btn-dark btn-login" type="submit">LOGIN</button>
			  		<small class="form-text text-muted mt-4">Don't have an account? <a href="/register">Sign Up</a></small>
				</form>
			</div>
    	</div>   
  	</div>
</div>
