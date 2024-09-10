<?php
session_start(); // Khởi tạo session

// Kiểm tra nếu $_SESSION['username'] chưa được thiết lập
if (!isset($_SESSION['username'])) {
    // Có thể chuyển hướng đến trang đăng nhập hoặc thông báo lỗi
    header("Location: /login.php");
    exit();
}

// Lấy danh sách phòng từ cơ sở dữ liệu
require_once 'model/DBConfig.php';
$db = new Database();
$rooms = $db->getRooms();

// Hiển thị danh sách phòng
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách phòng học</title>

    <!-- Custom CSS link -->
    <link rel="stylesheet" href="public/stylesheets/stylehome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
        integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    <section id="filter">
    <div class="container">
        <form id="filterForm" method="GET">
            <div class="filter-wrapper">
                <label for="block">Lọc theo dãy:</label>
                <select name="block" id="block">
                    <option value="">Tất cả</option>
                    <option value="A">Dãy A</option>
                    <option value="B">Dãy B</option>
                    <option value="C">Dãy C</option>
                    <option value="D">Dãy D</option>
                    <option value="E">Dãy E</option>
                    <option value="F">Dãy F</option>
                    <option value="G">Dãy G</option>
                    <option value="H">Dãy H</option>
                </select>

                <label for="capacity">Lọc theo sức chứa:</label>
                <select name="capacity" id="capacity">
                    <option value="">Tất cả</option>
                    <option value="0-50">0-50</option>
                    <option value="50-100">50-100</option>
                    <option value=">100">Trên 100</option>
                </select>

                <button type="submit" class="btn btn-primary">Lọc</button>
            </div>
        </form>
    </div>
</section>

        <section id="room-list">
            <div class="container">
                <div class="title">
                    <h1>Danh sách phòng học</h1>
                </div>
                <table class="fl-table">
                    <thead>
                        <tr>
                            <th>Tên phòng</th>
                            <th>Dãy</th>
                            <th>Sức chứa</th>
                            <th>Trạng thái</th>
                            <?php if ($_SESSION['username'] == 'admin') { ?>
                                <th>Thao tác</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rooms as $room): ?>
                            <tr>
                                <td><?= htmlspecialchars($room['room_name']) ?></td>
                                <td><?= htmlspecialchars($room['block']) ?></td>
                                <td><?= htmlspecialchars($room['capacity']) ?></td>
                                <td><?= $room['room_condition'] == 'good' ? 'Trống' : 'Được mượn' ?></td>
                                <?php if ($_SESSION['username'] == 'admin'): ?>
                                    <td><a href="/index.php?Controllers=thanh-vien&Action=editroomlist&id=<?= urlencode($room['room_id']) ?>" class="button">Cập nhật</a></td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="pagination-container">
                    <button id="previous" class="btn btn-primary">Previous</button>
                    <span>Page <span id="currentPage">1</span></span>
                    <button id="next" class="btn btn-primary">Next</button>
                </div>
            </div>
        </section>
    </main>

    <script>
            document.getElementById('filterForm').addEventListener('submit', function(e) {
        e.preventDefault(); // Ngăn chặn hành động gửi form mặc định

        // Lấy giá trị của các select
        var block = document.getElementById('block').value;
        var capacity = document.getElementById('capacity').value;
        
        // Cập nhật action của form
        var baseUrl = '/index.php';
        var params = new URLSearchParams({
            Controllers: 'thanh-vien',
            Action: 'locroomlist',
            block: block,
            capacity: capacity
        });
        
        // Chuyển hướng đến URL mới
        window.location.href = baseUrl + '?' + params.toString();
    });


        $(document).ready(function () {
            $('#previous').click(function () {
                // Handle Previous button click
            });

            $('#next').click(function () {
                // Handle Next button click
            });
        });
    </script>
</body>
</html>
