<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Room</title>
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
        <!-- Form để cập nhật thông tin phòng -->
        <!-- Form để cập nhật thông tin phòng -->
<form id="updateRoomForm" action="/index.php?Controllers=thanh-vien&Action=updateroomlist" method="post">
    <div class="form-wrapper">
        <div class="form-container">
            <h2>Update Room</h2>
            <div class="form-group -none">
                <label for="room_id">Room ID:</label>
                <input type="text" id="room_id" value="<?php echo htmlspecialchars($room['room_id']); ?>" name="room_id" placeholder="Enter Room ID" readonly>
            </div>
            <div class="form-group">
                <label for="room_name">Room Name:</label>
                <input type="text" id="room_name" value="<?php echo htmlspecialchars($room['room_name']); ?>" name="room_name" placeholder="Enter Room Name" required>
            </div>
            <div class="form-group">
                <label for="capacity">Capacity:</label>
                <input type="number" id="capacity" value="<?php echo htmlspecialchars($room['capacity']); ?>" name="capacity" placeholder="Enter Capacity" required>
            </div>
            <div class="form-group">
                <label for="block">Block:</label>
                <input type="text" id="block" value="<?php echo htmlspecialchars($room['block']); ?>" name="block" placeholder="Enter Block" required>
            </div>
            <div class="form-group">
                <label for="room_condition">Room Condition:</label>
                <input type="text" id="room_condition" value="<?php echo htmlspecialchars($room['room_condition']); ?>" name="room_condition" placeholder="Enter Room Condition" required>
            </div>
            <div class="form-group">
                <label for="type">Type:</label>
                <input type="text" id="type" value="<?php echo htmlspecialchars($room['type']); ?>" name="type" placeholder="Enter Type" required>
            </div>

            <button type="submit" class="submit-btn">Update Room</button>
        </div>
    </div>
</form>

    </main>
</body>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('updateRoomForm');
    
    form.addEventListener('submit', function(event) {
        let isValid = true;
        let errorMessage = '';

        // Lấy giá trị của các trường
        const roomName = document.getElementById('room_name').value.trim();
        const capacity = document.getElementById('capacity').value.trim();
        const block = document.getElementById('block').value.trim();
        const roomCondition = document.getElementById('room_condition').value.trim();
        const type = document.getElementById('type').value.trim();

        // Kiểm tra Room Name
        if (roomName === '') {
            errorMessage += 'Room Name is required.\n';
            isValid = false;
        }

        // Kiểm tra Capacity
        if (capacity === '' || isNaN(capacity) || parseInt(capacity) <= 0) {
            errorMessage += 'Capacity must be a positive number.\n';
            isValid = false;
        }

        // Kiểm tra Block
        if (block === '') {
            errorMessage += 'Block is required.\n';
            isValid = false;
        }

        // Kiểm tra Room Condition
        if (roomCondition === '') {
            errorMessage += 'Room Condition is required.\n';
            isValid = false;
        }

        // Kiểm tra Type
        if (type === '') {
            errorMessage += 'Type is required.\n';
            isValid = false;
        }

        // Nếu có lỗi, ngăn gửi biểu mẫu và hiển thị thông báo lỗi
        if (!isValid) {
            alert(errorMessage);
            event.preventDefault(); // Ngăn chặn gửi biểu mẫu
        }
    });
});
</script>
</html>
