<h1 class="page-header">Members Login</h1>

<?php if (isset($this->message)) : ?>
  <?php if  ($this->message == 1) : ?>
    <p class="message bg-success">An email has been sent. Please follow the instructions stated.</p>
  <?php endif; ?>
  <?php if  ($this->message == 2) : ?>
    <p class="message bg-warning">Your email and password combination has not been recognised. Please try again or click the link below.</p>
  <?php endif; ?>
	<?php if  ($this->message == 3) : ?>
    <p class="message bg-warning">Your account has been disabled. Please contact a site administrator to make your account active.</p>
  <?php endif; ?>
<?php endif; ?>
<div class="row">
    <div class="col-md-8">
        <form method="POST" action="<?php echo URL ?>login/run">
            <div class="control-group form-group">
                <div class="controls">
                    <label>Email:</label>
                    <input type="email" class="form-control" name="login" id="login" required>
                </div>
            </div>
            <div class="control-group form-group">
                <div class="controls">
                    <label>Password:</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>
            </div>

            <!-- For success/fail messages -->
            <button type="submit" class="btn btn-primary">Login</button>	
        </form>
    </div>
</div>
<!-- /.row -->