<?php
// Tùy chỉnh các biến theo nhu cầu
$baseURL = "http://localhost:3000"; // Đặt URL cơ sở cho các liên kết

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
    integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="public/stylesheets/stylelogin.css">


  <!-- google font link -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&display=swap" rel="stylesheet">


</head>

<body class="light-theme">
  <header>

    <div class="container">

      <nav class="navbar">


        <div class="flex-wrapper">

          <ul class="desktop-nav">

            <li>
              <a href="/index.php?Controllers=thanh-vien&Action=home" class="nav-link">Home</a>
            </li>

          </ul>
        </div>

      </nav>

    </div>

  </header>

  <main>
    <div class="form-wrapper">
      <img src="public/images/Author.jpg" alt="Descriptive image text" class="form-image">
      <div class="form-container">

        <h2>Login</h2>
        <form action="/index.php?Controllers=thanh-vien&Action=postlogin" method="post">

          <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="username" placeholder="Enter your name" required autocomplete="off">
          </div>
          <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Password" required>
          </div>
          <button type="submit" class="submit-btn">Login</button>
        </form>
      </div>
      <a href="/index.php?Controllers=thanh-vien&Action=home" class="icon-box">
        <span class="icon_close"><i class="fa fa-times close-btn" aria-hidden="true"></i></span>
      </a>
    </div>
  </main>


</body>

</html>
