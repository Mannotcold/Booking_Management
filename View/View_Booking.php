<?php
session_start();

// Lấy dữ liệu đăng ký mượn từ session
$booking = isset($_SESSION['booking']) ? $_SESSION['booking'] : array();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Request</title>
    <link rel="stylesheet" href="public/stylesheets/stylelogin.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .delete-btn {
            color: red;
            text-decoration: none;
        }
        .borrow-btn {
            color: green;
            text-decoration: none;
        }
    </style>
</head>

<body class="light-theme">
    <header>
        <div class="container">
            <nav class="navbar">
                <div class="flex-wrapper">
                    <ul class="desktop-nav">
                    li><a href="/index.php?Controllers=thanh-vien&Action=home" class="nav-link">Home</a></li>
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
        <section id="booking">
            <div class="container">
                <h2>Your Booking Request</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Room ID</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($booking)): ?>
                            <?php foreach ($booking as $index => $item): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($item['room_id']); ?></td>
                                    <td><?php echo htmlspecialchars($item['start_time']); ?></td>
                                    <td><?php echo htmlspecialchars($item['end_time']); ?></td>
                                    <td>
                                        <!-- Nút xóa -->
                                        <a href="/index.php?Controllers=thanh-vien&Action=deletebooking&delete=<?php echo $index; ?>" class="delete-btn">Delete</a>
                                        
                                        <!-- Nút mượn phòng -->
                                        <a href="/index.php?Controllers=thanh-vien&Action=borrow&room_id=<?php echo $item['room_id']; ?>" class="borrow-btn">Borrow</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4">No rooms selected.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <?php if (!empty($booking)): ?>
                    <a href="confirm_booking.php" class="submit-btn">Confirm Booking</a>
                <?php endif; ?>
            </div>
        </section>
    </main>
</body>

</html>
