<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/iqra/auth.css')?>">
<section class="content f-ubuntu login-content" style="">
    <div class="container-fluid register-bg login-container" style="">
        <div class="col-sm-4 col-sm-offset-4 col-xs-12 col-xs-offset-0">
            <div class="form-style" style="">
                <div style="">
                    <h3 style="" class="t-c-white m-b 20 f-ubuntu">Create Account</h3>
                    <?php echo form_open() ?>
                    <?php echo $success ?>
                    <div class="form-group">
                        <label>Username</label>
                        <?php echo form_error('username')?>
                        <input type="text" name="username" value="<?php echo set_value('username')?>" class="container" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <?php echo form_error('email') ?>
                        <input type="email" name="email" value="<?php echo set_value('email')?>" class="container" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <?php echo form_error('password')?>
                        <input type="password" name="password" class="container" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <?php echo form_error('cpassword')?>
                        <input type="password" name="cpassword" class="container" placeholder="Confirm Password">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" class="checkbox">
                            Receive email updates from your followers
                        </label>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Create Account" class="btn btn-danger btn-lg no-border-radius login-btn" name="submit" style="">
                    </div>
                    <div class="text-center t-c-white" style="">
                        <span class="text-center">Already have an account? <a href="<?php echo base_url('login')?>" class="text-red f-w-700" >Login</a></span>
                    </div>
                    <?php echo form_close() ?>
                </div>
            </div>
            <p class="text-center t-c-white" style="">By creating your account you agree with our <a href="<?php echo base_url('pages/terms')?>" class="text-red"><b>terms</b></a> of service. </p>
        </div>
    </div>
</section>