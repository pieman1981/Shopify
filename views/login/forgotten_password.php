<h1 class="page-header">Forgotten Password</h1>

<?php if (isset($this->message)) : ?>
  <?php if  ($this->message == 1) : ?>
    <p class="message bg-success">An email has been sent. Please follow the instructions stated.</p>
  <?php endif; ?>
  <?php if  ($this->message == 2) : ?>
    <p class="message bg-warning">Your login email has not been recognised. Please try again.</p>
  <?php endif; ?>
	<?php if  ($this->message == 3) : ?>
    <p class="message bg-warning">There was a problem saving your new password. Please try again</p>
  <?php endif; ?>
  <?php if  ($this->message == 4) : ?>
    <p class="message bg-warning">Your account is not active so you can't reset your password.</p>
  <?php endif; ?>
<?php endif; ?>

<div class="row">
    <div class="col-md-8">
        <form method="POST" action="<?php echo URL ?>login/reset">
            <div class="control-group form-group">
                <div class="controls">
                    <label>Login Email:</label>
                    <input type="email" class="form-control" name="login" id="login" required>
                </div>
            </div>
            
						<button type="submit" class="btn btn-primary">Reset</button>
			
        </form>
    </div>

</div>
<!-- /.row -->