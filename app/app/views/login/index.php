<div class="login">
</div>

<div class="uk-card uk-card-default uk-card-body uk-card-large uk-width-1-3@s uk-position-center uk-card-login">
	<?php echo form_open('login/authenticate', 'class="uk-text-center uk-animation-scale-up" id="login"'); ?>
		<h2>SIGN IN</h2>
		<p>Please login to continue...</p>
		<div class="uk-alert-danger" id="alert" uk-alert>
    		<p></p>
		</div>
		<div class="uk-margin">
			<div class="uk-inline uk-width-1-1">
				<span class="uk-form-icon" uk-icon="icon: user"></span>
				<input class="uk-input" type="text" name="email" id="email" placeholder="Email">
			</div>
		</div>
		<div class="uk-margin">
			<div class="uk-inline uk-width-1-1">
				<span class="uk-form-icon" uk-icon="icon: lock"></span>
				<input class="uk-input" type="password" name="password" id="password" placeholder="Password">
			</div>
		</div>
		<div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
            <label><input class="uk-checkbox" type="checkbox" name="remember" id="remember"> Keep me logged in</label>
        </div>

		<button class="uk-button uk-button-secondary" onclick="login();">Login</button>
		<button class="uk-button uk-button-default">Register</button>
	</form>
</div>