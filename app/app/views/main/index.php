<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>

<div class="login animated fadeIn">
</div>

<div class="uk-card uk-card-default uk-card-body uk-card-large uk-width-1-3@s uk-position-center uk-card-login">
	<form action="/login/authenticate" method="POST" class="uk-text-center">
		<h2>SIGN IN</h2>
		<p>Please login to continue...</p>
		<div class="uk-margin">
			<div class="uk-inline uk-width-1-1">
				<span class="uk-form-icon" uk-icon="icon: user"></span>
				<input class="uk-input" type="text" name="email" placeholder="Username">
			</div>
		</div>
		<div class="uk-margin">
			<div class="uk-inline uk-width-1-1">
				<span class="uk-form-icon" uk-icon="icon: lock"></span>
				<input class="uk-input" type="password" name="password" placeholder="Password">
			</div>
		</div>
		<div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
            <label><input class="uk-checkbox" type="checkbox"> Keep me logged in</label>
        </div>

		<button class="uk-button uk-button-secondary">Login</button>
		<button class="uk-button uk-button-default">Register</button>
	</form>
</div>
