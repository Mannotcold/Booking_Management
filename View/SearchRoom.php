<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Rooms</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
        integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="public/stylesheets/stylelogin.css">
    <!-- google font link -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&display=swap" rel="stylesheet">
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
    </style>
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
        <!-- Form for searching rooms -->
        <section id="search">
            <div class="container">
                <form id="searchForm">
                    <div class="form-wrapper">
                        <div class="form-container">
                            <h2>Search Rooms</h2>
                            
                            <div class="form-group">
                                <label for="capacity">Capacity Greater Than:</label>
                                <input type="number" id="capacity" name="capacity" placeholder="Enter minimum capacity" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="start_time">Start Time:</label>
                                <input type="datetime-local" id="start_time" name="start_time" placeholder="Enter start time" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="end_time">End Time:</label>
                                <input type="datetime-local" id="end_time" name="end_time" placeholder="Enter end time" required>
                            </div>
                            
                            <button type="submit" class="submit-btn">Search Rooms</button>
                        </div>
                    </div>
                </form>
                
                <!-- Display search results -->
                <div class="results-wrapper">
                    <h2>Available Rooms</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Room ID</th>
                                <th>Room Name</th>
                                <th>Capacity</th>
                                <th>Block</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="resultsBody">
                            <?php if (isset($rooms) && !empty($rooms)): ?>
                                <?php foreach ($rooms as $room): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($room['room_id']); ?></td>
                                        <td><?php echo htmlspecialchars($room['room_name']); ?></td>
                                        <td><?php echo htmlspecialchars($room['capacity']); ?></td>
                                        <td><?php echo htmlspecialchars($room['block']); ?></td>
                                        <td><a href="/index.php?Controllers=thanh-vien&Action=addbooking&room_id=<?php echo urlencode($room['room_id']); ?>&start_time=<?php echo urlencode($start_time); ?>&end_time=<?php echo urlencode($end_time); ?>">Add to Booking</a>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5">No rooms found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>

    <script>
        document.getElementById('searchForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            // Get form values
            var capacity = document.getElementById('capacity').value;
            var start_time = document.getElementById('start_time').value;
            var end_time = document.getElementById('end_time').value;

            // Create query parameters
            var params = new URLSearchParams({
                Controllers: 'thanh-vien',
                Action: 'searchroomlist',
                capacity: capacity,
                start_time: start_time,
                end_time: end_time
            });

            // Redirect to search results page
            window.location.href = 'http://localhost:3000/index.php?' + params.toString();
        });
    </script>
</body>

</html>
