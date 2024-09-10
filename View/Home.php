<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UDPT</title>

  <!-- favicon -->
  <link rel="shortcut icon" href="/images/blog-1" type="image/x-icon">

  <!-- custom css link -->
  <link rel="stylesheet" href="public/stylesheets/stylehome.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
    integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- google font link -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&display=swap" rel="stylesheet">
</head>

<body class="light-theme">

  <!-- #HEADER -->
  <header>
    <div class="container">
      <nav class="navbar">
        <div class="flex-wrapper">
        <ul class="desktop-nav">
        <?php if (isset($_SESSION['username'])): ?>
            <li><a href="/index.php?Controllers=thanh-vien&Action=home" class="nav-link">Home</a></li>
            <li><a href="/index.php?Controllers=thanh-vien&Action=roomlist" class="nav-link">Room list</a></li>
            <li><a href="/index.php?Controllers=thanh-vien&Action=searchroom" class="nav-link">Search Room</a></li>
            <li><a href="/index.php?Controllers=thanh-vien&Action=allbooking" class="nav-link">All Booking</a></li>
          <?php else: ?>
            <li><a href="#home" class="nav-link">Home</a></li>
            <li><a href="#search" class="nav-link">Search Rooms & Equipment</a></li>
            <li><a href="#my-bookings" class="nav-link">My Bookings</a></li>
            <li><a href="#manage" class="nav-link">Manage Equipment</a></li>
            <li><a href="#contact" class="nav-link">Contact</a></li>
          <?php endif; ?>
            
          </ul>
          <?php if (isset($_SESSION['username'])): ?>
            <h3>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h3>
            <a href="/index.php?Controllers=thanh-vien&Action=logout" class="button1"><h1>Logout</h1></a>
          <?php else: ?>
            <a href="/index.php?Controllers=thanh-vien&Action=login" class="button1"><h1>Login</h1></a>
          <?php endif; ?>
          

        </div>
      </nav>
    </div>
  </header>

  <main>
    <!-- #HERO SECTION -->
    <div id="home" class="hero">
      <div class="container">
        <div class="left">
          <h1 class="h1"><b>Manage Your Room and Equipment Reservations</b></h1>
          <h3 class="h3">Streamline Your Scheduling and Equipment Management</h3>
          <div class="btn-group">
            <a href="#search" class="btn btn-primary">Search Rooms & Equipment</a>
            <a href="#my-bookings" class="btn btn-secondary">View My Bookings</a>
          </div>
        </div>
        <div class="right">
          <div class="pattern-bg"></div>
          <div class="img-box">
            <img src="public/images/Author.jpg" class="hero-img" alt="Hero Image">
          </div>
        </div>
      </div>
    </div>

    <div class="main">
      <div class="container">
        <div id="search" class="column">
          <div class="introduce">
            <h1>Search Rooms & Equipment</h1>
          </div>
          <div class="introduce">
            <h3>Welcome to the Classroom and Equipment Management Portal. This application is designed to streamline the management of classroom and equipment bookings within the university. Here, users can easily log in, search for and book classrooms and equipment, view details of their bookings, and manage the available resources. Our goal is to provide a user-friendly, efficient platform to enhance the organization and accessibility of university facilities.</h3>
          </div>
        </div>
        <div class="column2">
          <div class="column3">
            <img src="public/images/Author.jpg" alt="Connect Icon" class="icon">
            <h3>Search Rooms & Equipment</h3>
            <p>Find and reserve available classrooms and equipment easily.</p>
          </div>
          <div class="column3">
            <img src="public/images/author.jpg" alt="Merge Icon" class="icon">
            <h3>My Bookings</h3>
            <p>iew details of your current and past reservations.</p>
          </div>
          <div class="column3">
            <img src="public/images/author.jpg" alt="Work Icon" class="icon">
            <h3>Manage Equipment</h3>
            <p>Administrate and update information about equipment available for reservation.</p>
          </div>
        </div>
      </div>
    </div>
  </main>

  <div class="map-section">
    <img src="/images/map.png" alt="Map">
  </div>

  <!-- #FOOTER -->
  <footer>
    <div class="container">
      <div class="wrapper">
        <p class="footer-text">
          <span>Jim Rohn: </span>
          "If you are not willing to risk the unusual, you will have to settle for the ordinary."
        </p>
      </div>
      <div class="wrapper">
        <p class="footer-title">Quick Links</p>
        <ul>
          <li><a href="#" class="footer-link">About Us</a></li>
          <li><a href="#" class="footer-link">Contact Us</a></li>
        </ul>
      </div>
      <div id="contact" class="wrapper">
        <p class="footer-title">Contact</p>
        <ul class="social-link">
          <li><a href="https://www.facebook.com/hoaiman208" class="icon-box facebook" target="_blank">
            <span class="icon"><i class="fa fa-facebook" aria-hidden="true"></i></span></a></li>
          <li><a href="https://www.linkedin.com/in/nguyenhoaiman/" class="icon-box linkedin" target="_blank">
            <span class="icon"><i class="fa fa-linkedin" aria-hidden="true"></i></span></a></li>
          <li><a href="https://github.com/Mannotcold" class="icon-box youtube" target="_blank">
            <span class="icon"><i class="fa fa-youtube" aria-hidden="true"></i></span></a></li>
        </ul>
      </div>
    </div>
    <p class="copyright">&copy; Copyright 2024 <a href="#">NHM</a></p>
  </footer>

</body>

</html>
