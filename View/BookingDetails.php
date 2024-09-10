<?php
// Tùy chỉnh các biến theo nhu cầu
$baseURL = "http://localhost:3000"; // Đặt URL cơ sở cho các liên kết
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Booking Details</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
    integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="public/stylesheets/stylehome.css">

  <!-- Google font link -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Inter', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
    }

    header {
      background-color: #333;
      color: #fff;
      padding: 1rem 0;
    }

    
    
    .container {
      width: 80%;
      margin: 0 auto;
      padding: 1rem;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background-color: #fff;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    th, td {
      padding: 0.75rem;
      border-bottom: 1px solid #ddd;
      text-align: left;
    }

    th {
      background-color: #f4f4f4;
    }

    h1 {
      margin-top: 0;
    }

    p {
      color: #333;
    }
  </style>
</head>

<body>
<header>
        <div class="container">
            <nav class="navbar">
                <div class="flex-wrapper">
                    <ul class="desktop-nav">
                    <a href="/index.php?Controllers=thanh-vien&Action=home" class="nav-link">Home</a></li>
            <li><a href="/index.php?Controllers=thanh-vien&Action=roomlist" class="nav-link">Room list</a></li>
            <li><a href="/index.php?Controllers=thanh-vien&Action=searchroom" class="nav-link">Search Room</a></li>
            <li><a href="/index.php?Controllers=thanh-vien&Action=allbooking" class="nav-link">All Booking</a></li>
                    </ul>
                    <a href="/index.php?Controllers=thanh-vien&Action=logout" class="button1"><h1>Logout</h1></a>
                </div>
            </nav>
        </div>
    </header>

  <main>
    <div class="container">
      <h1>Booking Details</h1>
      <?php if ($bookingDetails): ?>
        <table>
          <tr>
            <th>Booking ID</th>
            <td><?= htmlspecialchars($bookingDetails['booking_id']) ?></td>
          </tr>
          <tr>
            <th>Room ID</th>
            <td><?= htmlspecialchars($bookingDetails['room_id']) ?></td>
          </tr>
          <tr>
            <th>Start Time</th>
            <td><?= htmlspecialchars($bookingDetails['start_time']) ?></td>
          </tr>
          <tr>
            <th>End Time</th>
            <td><?= htmlspecialchars($bookingDetails['end_time']) ?></td>
          </tr>
        </table>
      <?php else: ?>
        <p>No details found for this booking.</p>
      <?php endif; ?>
    </div>
  </main>
</body>

</html>
