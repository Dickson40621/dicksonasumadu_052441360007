<?php
session_start();

$newsletterMsg = '';

// Handle newsletter form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['newsletter_email'])) {
    $email = filter_var(trim($_POST['newsletter_email'] ?? ''), FILTER_SANITIZE_EMAIL);

    if (empty($email)) {
        $newsletterMsg = 'error:Please enter your email address.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $newsletterMsg = 'error:Please enter a valid email address.';
    } else {
        // In production: save to database / mailing list API
        $newsletterMsg = 'success:You have been subscribed. Welcome to the Maison.';
    }
}

// Determine logged-in state for navigation
$isLoggedIn = isset($_SESSION['noir_user']);
$userRole   = $isLoggedIn ? $_SESSION['noir_user']['role'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Dark luxury editorial fashion house. Avant-garde collections that redefine modern elegance.">
  <meta name="theme-color" content="#0a0a0a">
  <title>NOIR MAISON | Luxury Fashion</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>

  <!-- Header -->
  <header class="site-header">
    <a href="index.php" class="logo">NOIR <span>MAISON</span></a>
    <nav>
      <a href="index.php">Home</a>
      <a href="#collection">Collection</a>
      <a href="#story">Story</a>
      <a href="#contact">Contact</a>
      <?php if ($isLoggedIn): ?>
        <a href="dashboard.php" class="btn-outline" style="padding:10px 24px;">Dashboard</a>
      <?php else: ?>
        <a href="login.php" class="btn-outline" style="padding:10px 24px;">Sign In</a>
      <?php endif; ?>
    </nav>
  </header>

  <!-- Hero -->
  <section class="hero">
    <div class="hero-bg">
      <img src="../images/hero-main.jpg" alt="Fashion editorial campaign">
    </div>
    <div class="hero-content">
      <p class="hero-label">Spring / Summer 2025</p>
      <h1 class="hero-title">WEAR<br>THE <em>FUTURE</em></h1>
      <p class="hero-sub">Where avant-garde vision meets masterful craftsmanship. A collection that transcends seasons and silhouettes.</p>
      <a href="#collection" class="btn-gold">
        Explore Collection
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
      </a>
    </div>
  </section>

  <!-- Featured Products -->
  <section class="products-strip" id="collection">
    <h2 class="fade-up">Featured Pieces</h2>
    <div class="products-scroll">
      <?php
      $featuredProducts = [
        ['img'=>'../images/product-1.jpg','name'=>'The Obsidian Bag','cat'=>'Accessories',  'price'=>'$2,450'],
        ['img'=>'../images/product-2.jpg','name'=>'Noir Overcoat',   'cat'=>'Outerwear',    'price'=>'$3,800'],
        ['img'=>'../images/product-3.jpg','name'=>'Eclipse Shades',  'cat'=>'Eyewear',      'price'=>'$890'],
        ['img'=>'../images/product-4.jpg','name'=>'Shadow Boots',    'cat'=>'Footwear',     'price'=>'$1,650'],
        ['img'=>'../images/product-5.jpg','name'=>'Silk Meridian',   'cat'=>'Accessories',  'price'=>'$680'],
        ['img'=>'../images/product-6.jpg','name'=>'Phantom Dress',   'cat'=>'Ready-to-Wear','price'=>'$4,200'],
      ];
      foreach ($featuredProducts as $i => $p):
        $stagger = $i > 0 ? ' stagger-' . $i : '';
      ?>
      <div class="product-card fade-up<?= $stagger ?>">
        <div class="product-card-img"><img src="<?= htmlspecialchars($p['img']) ?>" alt="<?= htmlspecialchars($p['name']) ?>"></div>
        <div class="product-card-body">
          <p class="product-card-name"><?= htmlspecialchars($p['name']) ?></p>
          <p class="product-card-cat"><?= htmlspecialchars($p['cat']) ?></p>
          <p class="product-card-price"><?= htmlspecialchars($p['price']) ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- Our Story -->
  <section class="story-section" id="story">
    <div class="story-text fade-up">
      <p class="story-label">Our Story</p>
      <h2>Crafted in Darkness,<br>Worn in Light</h2>
      <p>Born from the conviction that true luxury whispers rather than shouts, Noir Maison exists at the intersection of shadow and sophistication. Every piece is a testament to the art of restraint — where absence defines presence and darkness reveals beauty.</p>
      <a href="register.php" class="btn-outline">
        Join the Maison
        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
      </a>
    </div>
    <div class="story-image fade-up stagger-2">
      <img src="../images/story-image.jpg" alt="Fashion editorial">
    </div>
  </section>

  <!-- Marquee -->
  <div class="marquee">
    <div class="marquee-track">
      <span class="marquee-text">NEW COLLECTION <span class="dot"></span> SS2025 <span class="dot"></span> LIMITED DROPS <span class="dot"></span> FREE SHIPPING WORLDWIDE <span class="dot"></span> AVANT-GARDE <span class="dot"></span> MAISON NOIR <span class="dot"></span></span>
      <span class="marquee-text">NEW COLLECTION <span class="dot"></span> SS2025 <span class="dot"></span> LIMITED DROPS <span class="dot"></span> FREE SHIPPING WORLDWIDE <span class="dot"></span> AVANT-GARDE <span class="dot"></span> MAISON NOIR <span class="dot"></span></span>
    </div>
  </div>

  <!-- Contact -->
  <section class="contact-section" id="contact">
    <p class="section-label fade-up">Get in Touch</p>
    <h2 class="fade-up">Visit Our <em style="font-family:var(--font-display);color:var(--gold);">Maison</em></h2>
    <div class="contact-grid">
      <div class="contact-card fade-up stagger-1">
        <div class="contact-card-icon">
          <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/><circle cx="12" cy="9" r="2.5"/></svg>
        </div>
        <h3>Flagship</h3>
        <p>Amakom opposite Kstu Main Campus</p>
      </div>
      <div class="contact-card fade-up stagger-2">
        <div class="contact-card-icon">
          <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><path d="M22 6l-10 7L2 6"/></svg>
        </div>
        <h3>Email</h3>
        <p>asumadudickson10@gmail.com</p>
      </div>
      <div class="contact-card fade-up stagger-3">
        <div class="contact-card-icon">
          <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72c.12.96.36 1.9.7 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.91.34 1.85.58 2.81.7A2 2 0 0122 16.92z"/></svg>
        </div>
        <h3>Phone</h3>
        <p>+223 552892518</p>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="site-footer">
    <div class="footer-top">
      <div class="footer-brand">
        <p class="logo">NOIR <span>MAISON</span></p>
        <p>Dark luxury editorial fashion. Avant-garde collections that redefine modern elegance.</p>
      </div>
      <div class="footer-col">
        <h4>Explore</h4>
        <a href="#collection">Collection</a>
        <a href="#story">Our Story</a>
        <a href="#contact">Contact</a>
        <a href="#">Lookbook</a>
      </div>
      <div class="footer-col">
        <h4>Client</h4>
        <a href="login.php">Sign In</a>
        <a href="register.php">Create Account</a>
        <a href="#">Shipping</a>
        <a href="#">Returns</a>
      </div>
      <div class="footer-newsletter">
        <h4>Newsletter</h4>
        <p>Receive exclusive drops and editorial previews.</p>

        <?php if (!empty($newsletterMsg)): ?>
          <?php [$msgType, $msgText] = explode(':', $newsletterMsg, 2); ?>
          <div style="padding:10px 14px;margin-bottom:12px;font-size:0.8rem;
            background:<?= $msgType === 'success' ? '#0a1a0a' : '#2a0a0a' ?>;
            border:1px solid <?= $msgType === 'success' ? '#1a5c1a' : '#8b1a1a' ?>;
            color:<?= $msgType === 'success' ? '#4ade80' : '#f87171' ?>;">
            <?= htmlspecialchars($msgText) ?>
          </div>
        <?php endif; ?>

        <form class="newsletter-form" method="POST" action="index.php#contact">
          <input type="email" name="newsletter_email" placeholder="your@email.com" aria-label="Email for newsletter"
                 value="<?= ($newsletterMsg && str_starts_with($newsletterMsg, 'error')) ? htmlspecialchars($_POST['newsletter_email'] ?? '') : '' ?>">
          <button type="submit">Subscribe</button>
        </form>
      </div>
    </div>
    <div class="footer-bottom">
      <p>&copy; <?= date('Y') ?> Noir Maison. All rights reserved.</p>
      <div class="footer-social">
        <a href="#" aria-label="Instagram">
          <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="5"/><circle cx="17.5" cy="6.5" r="1.5" fill="currentColor"/></svg>
        </a>
        <a href="#" aria-label="Twitter">
          <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M23 3a10.9 10.9 0 01-3.14 1.53A4.48 4.48 0 0012 7.5v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"/></svg>
        </a>
        <a href="#" aria-label="Pinterest">
          <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.08 3.15 9.43 7.6 11.21-.1-.95-.19-2.41.04-3.45.21-.94 1.37-5.81 1.37-5.81s-.35-.7-.35-1.74c0-1.63.95-2.85 2.12-2.85 1 0 1.49.75 1.49 1.66 0 1.01-.64 2.52-.98 3.92-.28 1.17.59 2.12 1.74 2.12 2.09 0 3.69-2.2 3.69-5.38 0-2.81-2.02-4.78-4.9-4.78-3.34 0-5.3 2.5-5.3 5.09 0 1.01.39 2.09.87 2.67.1.12.11.22.08.34-.09.37-.29 1.17-.33 1.34-.05.22-.18.26-.41.16-1.52-.71-2.47-2.93-2.47-4.72 0-3.84 2.79-7.37 8.05-7.37 4.23 0 7.51 3.01 7.51 7.03 0 4.2-2.64 7.58-6.32 7.58-1.23 0-2.39-.64-2.79-1.4l-.76 2.89c-.27 1.07-1.01 2.41-1.51 3.23C9.57 23.81 10.76 24 12 24c6.63 0 12-5.37 12-12S18.63 0 12 0z"/></svg>
        </a>
      </div>
    </div>
  </footer>

</body>
</html>
