<?php
$name = '';
$email = '';
$errors = [];
$successMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = trim($_POST['name'] ?? '');
  $email = trim($_POST['email'] ?? '');
  $password = $_POST['password'] ?? '';
  $termsAccepted = isset($_POST['terms']);

  if (!preg_match('/^[a-zA-Z ]{2,60}$/', $name)) {
    $errors['name'] = 'Name must contain 2 to 60 letters and spaces only.';
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Please enter a valid email address.';
  }

  if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d).{8,}$/', $password)) {
    $errors['password'] = 'Password must be at least 8 characters and include a letter and number.';
  }

  if (!$termsAccepted) {
    $errors['terms'] = 'Please agree to the terms and privacy policy.';
  }

  if ($errors === []) {
    $successMessage = 'Registration form validated successfully.';
  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Iron Core Fitness</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="act3des.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.21.0/dist/jquery.validate.min.js"></script>
  </head>

  <body class="account-page">
    <main class="account-layout">
      <section class="account-intro" aria-labelledby="register-welcome">
        <a class="brand" href="index.php">IRON<span>CORE</span></a>
        <div><p class="eyebrow">Start today</p><h1 id="register-welcome">Make your strongest move yet.</h1><p>Create an account and take the first step toward a stronger you.</p></div>
        <a class="back-link" href="index.php">Back to home</a>

      </section>
      <section class="form-panel" aria-labelledby="register-title">
        <form id="myForm" class="account-form" action="Register.php" method="post" novalidate>
          <header><h2 id="register-title">Create account</h2><p>It only takes a minute to get started.</p></header>
          <?php if ($successMessage !== ''): ?><p class="form-success"><?= htmlspecialchars($successMessage) ?></p><?php endif; ?>
          <div class="field"><label for="name">Full name</label><input id="name" name="name" type="text" autocomplete="name" placeholder="Your full name" value="<?= htmlspecialchars($name) ?>" required><?php if (isset($errors['name'])): ?><label class="error"><?= htmlspecialchars($errors['name']) ?></label><?php endif; ?></div>
          <div class="field"><label for="register-email">Email address</label><input id="register-email" name="email" type="email" autocomplete="email" placeholder="you@example.com" value="<?= htmlspecialchars($email) ?>" required><?php if (isset($errors['email'])): ?><label class="error"><?= htmlspecialchars($errors['email']) ?></label><?php endif; ?></div>
          <div class="field"><label for="register-password">Create password</label><input id="register-password" name="password" type="password" autocomplete="new-password" minlength="8" placeholder="At least 8 characters" required><?php if (isset($errors['password'])): ?><label class="error"><?= htmlspecialchars($errors['password']) ?></label><?php endif; ?></div>
          <label class="checkbox"><input type="checkbox" name="terms" required> I agree to the terms and privacy policy.</label><?php if (isset($errors['terms'])): ?><label class="error"><?= htmlspecialchars($errors['terms']) ?></label><?php endif; ?>
          <button class="button btn" type="submit">Create account</button>
          <p class="form-switch">Already a member? <a href="Login.php">Log in</a></p>
        </form>
      </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <script>
      $(document).ready(function () {
        $("#myForm").validate({
          rules: { name: { required: true, minlength: 2, maxlength: 60 }, email: { required: true, email: true }, password: { required: true, minlength: 8 }, terms: { required: true } },
          messages: { name: { required: "Please enter your full name.", minlength: "Your name must be at least 2 characters.", maxlength: "Your name cannot exceed 60 characters." }, email: { required: "Please enter your email address.", email: "Please enter a valid email address." }, password: { required: "Please create a password.", minlength: "Your password must be at least 8 characters." }, terms: { required: "Please agree to the terms and privacy policy." } },
          errorPlacement: function (error, element) { if (element.is(":checkbox")) { error.insertAfter(element.closest(".checkbox")); } else { error.insertAfter(element); } }
        });
      });
    </script>
  </body>
</html>
