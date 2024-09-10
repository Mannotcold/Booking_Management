<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>

    <!-- Custom CSS link -->
    <link rel="stylesheet" href="public/stylesheets/styleadminhome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
        integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Google Font link -->
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
        <div>
            <div class="table-wrapper">
                <div class="title">
                    <h1>Booking Requests</h1>
                </div>
                <table class="fl-table">
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>User ID</th>
                            <th>Created Date</th>
                            <th>Status</th>
                            <th>Action</th>
                            <th>Details</th> <!-- New column for details -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($bookings) && is_array($bookings)): ?>
                            <?php foreach ($bookings as $booking): ?>
                                <tr data-id="<?= htmlspecialchars($booking['booking_id']) ?>">
                                    <td><?= htmlspecialchars($booking['booking_id']) ?></td>
                                    <td><?= htmlspecialchars($booking['user_id']) ?></td>
                                    <td><?= htmlspecialchars($booking['created_date']) ?></td>
                                    <td class="status"><?= htmlspecialchars($booking['status']) ?></td>
                                    <td>
                                        <?php if ($booking['status'] == 'pending'): ?>
                                            <form class="approve-form" action="/index.php?Controllers=thanh-vien&Action=updateBooking&booking_id=<?= htmlspecialchars($booking['booking_id']) ?>&action=confirmed" method="post">
                                                <button type="submit">confirmed</button>
                                            </form>
                                            <form class="disapprove-form" action="/index.php?Controllers=thanh-vien&Action=updateBooking&booking_id=<?= htmlspecialchars($booking['booking_id']) ?>&action=cancelled" method="post">
                                                <button type="submit">cancelled</button>
                                            </form>
                                            <form class="disapprove-form" action="/index.php?Controllers=thanh-vien&Action=updateBooking&booking_id=<?= htmlspecialchars($booking['booking_id']) ?>&action=finished" method="post">
                                                <button type="submit">finished</button>
                                            </form>
                                        <?php else: ?>
                                            <span>Action not available</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="/index.php?Controllers=thanh-vien&Action=viewBookingDetails&id=<?= htmlspecialchars($booking['booking_id']) ?>" class="button-details">View Details</a>
                                    </td> <!-- New column for details -->
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6">No bookings found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

</body>
</html>
