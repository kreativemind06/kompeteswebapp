<?php if(isset($_GET['redirect'])){$action_link = 'login?redirect='.$_GET['redirect'];}else{ $action_link ='login';}?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/iqra/auth.css')?>">
<section class="content login-bg login f-ubuntu login-content">
	<div class="container-fluid login-container">
		<div class="col-sm-4 col-sm-offset-4 col-xs-12 col-xs-offset-0">
			<?php //echo $_GET['redirect']?>
			<div class="form-style">
				<div>
					<h3 class="t-c-white m-b-20 f-ubuntu">Login</h3>
					<?php echo form_open(base_url($action_link)) ?>
					<?php echo $success ?>
					<div class="form-group">
						<label>Username</label>
						<?php echo form_error('username')?>
						<input type="text" name="username" value="<?php echo set_value('username')?>" class="container" placeholder="Username">
					</div>
					<div class="form-group">
						<label>Password</label>
						<?php echo form_error('password')?>
						<input type="password" name="password" class="container" placeholder="Password">
					</div>
					<div class="checkbox">
						<label class="pull-left">
							<input type="checkbox" class="checkbox">
							Remember Me
						</label>
						<label class="pull-right"><a href="<?php echo base_url('authentication/forgot')?>" class="t-c-white">Forgot Password?</a></label>
						<br>
					</div>
					<div class="f-ubuntu form-group">
						<!--<input type="submit" class="f-ubuntu btn btn-success btn-lg" name="submit" style="border-radius: 0; width: 100%; background: #449D44" value="Login">-->
						<button class="f-ubuntu btn btn-danger btn-lg no-border-radius login-btn" type="submit">Login</button>
					</div>
					<div class="f-ubuntu text-center t-c-white">
						<span class="f-ubuntu text-center">New user? <a href="<?php echo base_url('register')?>" class="text-red f-w-700" >Sign Up</a></span>
					</div>
					<?php echo form_close() ?>
				</div>
			</div>
			<p class="f-ubuntu text-center t-c-white" >By creating your account you agree with our <a href="<?php echo base_url('pages/terms')?>" class="f-ubuntu text-red"><b>terms</b></a> of service. </p>
		</div>
	</div>
</section>