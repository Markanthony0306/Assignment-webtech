<?php
$email = '';
$errors = [];
$successMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = trim($_POST['email'] ?? '');
  $password = $_POST['password'] ?? '';

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Please enter a valid email address.';
  }

  if (!preg_match('/^.{8,}$/', $password)) {
    $errors['password'] = 'Your password must be at least 8 characters.';
  }

  if ($errors === []) {
    $successMessage = 'Login form validated successfully.';
  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in | Iron Core Fitness</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="act3des.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.21.0/dist/jquery.validate.min.js"></script>
  </head>

  <body class="account-page">
    <main class="account-layout">
      <section class="account-intro" aria-labelledby="login-welcome">
        <a class="brand" href="index.php">IRON<span>CORE</span></a>
        <div><p class="eyebrow">Welcome back</p><h1 id="login-welcome">Your next session is waiting.</h1><p>Log in to check your workouts, track your progress, and stay on schedule.</p></div>
        <a class="back-link" href="index.php">Back to home</a>
      </section>

      <section class="form-panel" aria-labelledby="login-title">
        <form id="myForm" class="account-form" action="Login.php" method="post" novalidate>
          <header><h2 id="login-title">Log in</h2><p>Enter your details to continue.</p></header>
          <?php if ($successMessage !== ''): ?><p class="form-success"><?= htmlspecialchars($successMessage) ?></p><?php endif; ?>
          <div class="field"><label for="login-email">Email address</label><input id="login-email" name="email" type="email" autocomplete="email" placeholder="you@example.com" value="<?= htmlspecialchars($email) ?>" required><?php if (isset($errors['email'])): ?><label class="error"><?= htmlspecialchars($errors['email']) ?></label><?php endif; ?></div>
          <div class="field"><label for="login-password">Password</label><input id="login-password" name="password" type="password" autocomplete="current-password" placeholder="Enter your password" required><?php if (isset($errors['password'])): ?><label class="error"><?= htmlspecialchars($errors['password']) ?></label><?php endif; ?></div>
          <div class="form-options"><label class="checkbox"><input type="checkbox" name="remember"> Remember me</label><a href="#">Forgot password?</a></div>
          <button class="button btn" type="submit">Log in</button>
          <p class="form-switch">New to Iron Core? <a href="Register.php">Create an account</a></p>
        </form>
      </section>
    </main>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
      $(document).ready(function () {
        $("#myForm").validate({
          rules: { email: { required: true, email: true }, password: { required: true, minlength: 8 } },
          messages: { email: { required: "Please enter your email address.", email: "Please enter a valid email address." }, password: { required: "Please enter your password.", minlength: "Your password must be at least 8 characters." } }
        });
      });
    </script>
  </body>
</html>
