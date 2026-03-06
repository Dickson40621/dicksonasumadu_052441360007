<?php
session_start();

// If already logged in, redirect to dashboard
if (isset($_SESSION['noir_user'])) {
    header('Location: dashboard.php');
    exit;
}

$error = '';
$success = '';

// Handle form submission via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs
    $email    = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['password'] ?? '');
    $role     = trim($_POST['demo_role'] ?? '');

    // Demo login via role buttons
    if (!empty($role)) {
        if ($role === 'admin') {
            $_SESSION['noir_user'] = [
                'name'     => 'Isabelle Laurent',
                'email'    => 'admin@noirmaison.com',
                'city'     => 'Paris, FR',
                'phone'    => '+33 1 42 68 00',
                'role'     => 'admin',
                'joinDate' => '2022-03-15',
            ];
        } else {
            $_SESSION['noir_user'] = [
                'name'     => 'Elara Voss',
                'email'    => 'elara@email.com',
                'city'     => 'Milan, IT',
                'phone'    => '+39 02 123 456',
                'role'     => 'user',
                'joinDate' => '2024-01-10',
            ];
        }
        header('Location: dashboard.php');
        exit;
    }

    // Regular login validation
    if (empty($email) || empty($password)) {
        $error = 'Please fill in all fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } elseif (strlen($password) < 6) {
        $error = 'Invalid password.';
    } else {
        // Mock credential check using switch
        switch ($email) {
            case 'admin@noirmaison.com':
                if ($password === 'admin123') {
                    $_SESSION['noir_user'] = [
                        'name'     => 'Isabelle Laurent',
                        'email'    => $email,
                        'city'     => 'Paris, FR',
                        'phone'    => '+33 1 42 68 00',
                        'role'     => 'admin',
                        'joinDate' => '2022-03-15',
                    ];
                    header('Location: dashboard.php');
                    exit;
                } else {
                    $error = 'Invalid email or password.';
                }
                break;

            case 'elara@email.com':
                if ($password === 'user123') {
                    $_SESSION['noir_user'] = [
                        'name'     => 'Elara Voss',
                        'email'    => $email,
                        'city'     => 'Milan, IT',
                        'phone'    => '+39 02 123 456',
                        'role'     => 'user',
                        'joinDate' => '2024-01-10',
                    ];
                    header('Location: dashboard.php');
                    exit;
                } else {
                    $error = 'Invalid email or password.';
                }
                break;

            default:
                $error = 'No account found with that email.';
                break;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#0a0a0a">
  <title>Sign In | NOIR MAISON</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>

  <div class="login-page">
    <div class="login-card">
      <p class="form-logo" style="text-align:center;">NOIR <span>MAISON</span></p>
      <p class="form-subtitle" style="text-align:center;">Welcome back to the Maison</p>

      <?php if (!empty($error)): ?>
        <div style="background:#2a0a0a;border:1px solid #8b1a1a;color:#f87171;padding:12px 16px;margin-bottom:20px;font-size:0.85rem;letter-spacing:0.03em;">
          <?= htmlspecialchars($error) ?>
        </div>
      <?php endif; ?>

      <?php if (!empty($success)): ?>
        <div style="background:#0a1a0a;border:1px solid #1a5c1a;color:#4ade80;padding:12px 16px;margin-bottom:20px;font-size:0.85rem;letter-spacing:0.03em;">
          <?= htmlspecialchars($success) ?>
        </div>
      <?php endif; ?>

      <form method="POST" action="login.php">
        <div class="form-group">
          <label for="email">Email Address</label>
          <input type="email" id="email" name="email"
                 placeholder="your@email.com"
                 value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                 required>
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password"
                 placeholder="Enter your password" required>
        </div>

        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;">
          <label style="display:flex;align-items:center;gap:8px;font-size:0.8rem;color:var(--text-muted);cursor:pointer;">
            <input type="checkbox" name="remember" style="accent-color:var(--gold);">
            Remember me
          </label>
          <a href="#" style="font-size:0.8rem;color:var(--gold);">Forgot password?</a>
        </div>

        <button type="submit" class="form-submit">Sign In</button>

        <p class="form-links">
          New to Noir Maison? <a href="register.php">Create Account</a>
        </p>
      </form>

      <!-- Demo Access via POST buttons -->
      <div style="margin-top:28px;padding-top:20px;border-top:1px solid var(--border);text-align:center;">
        <p style="font-size:0.7rem;letter-spacing:0.15em;text-transform:uppercase;color:var(--text-muted);margin-bottom:12px;">Quick Demo Access</p>
        <div style="display:flex;gap:12px;">
          <form method="POST" action="login.php" style="flex:1;">
            <input type="hidden" name="demo_role" value="user">
            <button type="submit" class="btn-dark" style="width:100%;justify-content:center;">User Demo</button>
          </form>
          <form method="POST" action="login.php" style="flex:1;">
            <input type="hidden" name="demo_role" value="admin">
            <button type="submit" class="btn-dark" style="width:100%;justify-content:center;">Admin Demo</button>
          </form>
        </div>
        <p style="font-size:0.7rem;color:var(--text-muted);margin-top:10px;">
          User: elara@email.com / user123 &nbsp;|&nbsp; Admin: admin@noirmaison.com / admin123
        </p>
      </div>
    </div>
  </div>

</body>
</html>
