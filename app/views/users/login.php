<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="col-md-6 mx-auto">
  <div class="card bg-light">
    <div class="card-body">
      <h2 class="card-title text-center">Login</h2>
      <p>Please fill out this form to login with us</p>
      <form action="<?php echo URLROOT; ?>/users/login" method="post">
        <div class="form-group">
          <label for="email">Email: <sup>*</sup></label>
          <input type="email" name="email" id="email" value="<?php echo $data['email']; ?>" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>">
          <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
        </div>
        <div class="form-group">
          <label for="password">Password: <sup>*</sup></label>
          <input type="password" name="password" id="password" value="<?php echo $data['password']; ?>" class="form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>">
          <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
        </div>
        <div class="row">
          <div class="col">
            <input type="submit" class="btn btn-success btn-block" value="Login">
          </div>
          <div class="col">
            <a href="<?php echo URLROOT; ?>/users/register" class="btn btn-secondary btn-block">No account??? Register</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>