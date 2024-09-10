<?php
include_once 'model/DBConfig.php';

function HomeRequest() {
    $Action = isset($_GET['Action']) ? $_GET['Action'] : '';

    // Nếu Action không được cung cấp, điều hướng đến URL mặc định
    if (empty($Action)) {
        header("Location: /index.php?Controllers=thanh-vien&Action=home");
        exit();
    }

    // Dựa vào giá trị của Action, thực hiện yêu cầu
    switch ($Action) {
        case 'home':
            require_once('View/Home.php');
            echo "Giá trị của Action: " . htmlspecialchars($Action);
            break;
        // Bạn có thể thêm các trường hợp khác ở đây nếu cần
        default:
            // Xử lý trường hợp mặc định nếu cần
            echo "Action không hợp lệ.HomeRequest";
            echo "Giá trị của Action: " . htmlspecialchars($Action);
            break;
    }
}

function LoginRequest() {
    // Khởi tạo kết nối đến cơ sở dữ liệu
    $db = new Database();
    $db->connect();
    // Kiểm tra và lấy giá trị của Action từ query string
    $Action = isset($_GET['Action']) ? $_GET['Action'] : '';

    // Dựa vào giá trị của Action, thực hiện yêu cầu
    switch($Action) {
        case 'login':
            require_once('View/login.php');
            break;
        case 'logout':
            session_start();
            unset($_SESSION['username']);
            require_once('View/Home.php');
            break;
        case 'list_users':
            // Lấy danh sách người dùng
            $users = $db->getUsers();
            
            // Hiển thị danh sách người dùng
            echo "<h2>Danh sách người dùng:</h2>";
            echo "<table border='1'>
                    <tr>
                        <th>User ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>User Type</th>
                    </tr>";
            foreach ($users as $user) {
                echo "<tr>
                        <td>{$user['user_id']}</td>
                        <td>{$user['username']}</td>
                        <td>{$user['email']}</td>
                        <td>{$user['status']}</td>
                        <td>{$user['user_type']}</td>
                    </tr>";
            }
            echo "</table>";
            break;
        default:
            // Xử lý trường hợp mặc định nếu cần
            echo "Action không hợp lệ.";
            break;
    }
}



function handleLoginPostRequest() {
    // Khởi tạo kết nối đến cơ sở dữ liệu
    require_once 'model/DBConfig.php';
    $db = new Database();
    $conn = $db->connect(); // Lấy đối tượng kết nối

    // Kiểm tra xem yêu cầu có phải là POST không
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Lấy dữ liệu từ biểu mẫu
        $username = isset($_POST['username']) ? trim($_POST['username']) : '';
        $password = isset($_POST['password']) ? trim($_POST['password']) : '';

        // Kiểm tra tài khoản và mật khẩu
        $user = $db->checkUserCredentials($username, $password);
        
        
        if ($user) {
            // Đăng nhập thành công, lưu thông tin người dùng vào session
            session_start();
            $_SESSION['username'] = $username;
            // Chuyển hướng đến trang chính
            header("Location: /index.php?Controllers=thanh-vien&Action=home");
        } else {
            // Đăng nhập thất bại, thông báo lỗi
            $loginError = "Tên đăng nhập hoặc mật khẩu không đúng.";
            // Hiển thị lại biểu mẫu đăng nhập với thông báo lỗi
            require_once('View/login.php');
        }
    } else {
        // Nếu không phải là yêu cầu POST
        // Chuyển hướng đến trang đăng nhập
        header("Location: /index.php?Controllers=thanh-vien&Action=login");
        exit();
    }
}




function AddRequest() {
    // Kiểm tra và lấy giá trị của Action từ query string
    $Action = isset($_GET['Action']) ? $_GET['Action'] : '';

    // Dựa vào giá trị của Action, thực hiện yêu cầu
    switch($Action) {
        case 'add':
            require_once('View/ThanhVien/add_user.php');
            break;
        // Bạn có thể thêm các trường hợp khác ở đây nếu cần
        default:
            // Xử lý trường hợp mặc định nếu cần
            echo "Action không hợp lệ.handleRequest";
            break;
    }
}




function ViewRoomsRequest() {
    // Kiểm tra và lấy giá trị của Action từ query string
    $Action = isset($_GET['Action']) ? $_GET['Action'] : '';

    // Dựa vào giá trị của Action, thực hiện yêu cầu
    switch($Action) {
        case 'roomlist':
            require_once 'model/DBConfig.php';
            $db = new Database();
            $rooms = $db->getRooms();
        //     echo "<pre>";
        // print_r($room);  // In kết quả dưới dạng mảng
        // echo "</pre>";
    // Hiển thị danh sách các phòng
            require_once('View/RoomList.php');
            break;
        // Bạn có thể thêm các trường hợp khác ở đây nếu cần
        default:
            // Xử lý trường hợp mặc định nếu cần
            echo "Action không hợp lệ.handleRequest";
            break;
    }
}


function ViewRoomsRequest1() {
    // Lấy danh sách các phòng
    require_once 'model/DBConfig.php';
    $rooms = new Database();
    $rooms->getRooms();
    // Hiển thị danh sách các phòng
    require_once('View/RoomsList.php');
}


function EditRoomsRequest() {
    // Kiểm tra và lấy giá trị của Action và ID từ query string
    $Action = isset($_GET['Action']) ? $_GET['Action'] : '';
    $room_id = isset($_GET['id']) ? $_GET['id'] : '';

    // Khởi tạo đối tượng Database
    $db = new Database();
    $db->connect(); // Kết nối đến cơ sở dữ liệu

    // Dựa vào giá trị của Action, thực hiện yêu cầu
    switch($Action) {
        case 'editroomlist':
            // Lấy thông tin phòng dựa trên room_id
            $room = $db->getRoomById($room_id);
            // Kiểm tra xem phòng có tồn tại không
            if ($room) {
                // Truyền dữ liệu phòng tới view
                include('View/EditRoomList.php');
            } else {
                echo "Phòng không tồn tại.";
            }
            break;
        // Bạn có thể thêm các trường hợp khác ở đây nếu cần
        default:
            // Xử lý trường hợp mặc định nếu cần
            echo "Action không hợp lệ.";
            break;
    }
}


function UpdateRoomsRequest() {
    // Khởi tạo đối tượng Database và kết nối đến cơ sở dữ liệu
$db = new Database();
$db->connect();

// Lấy dữ liệu từ form
$room_id = isset($_POST['room_id']) ? $_POST['room_id'] : '';
$room_name = isset($_POST['room_name']) ? $_POST['room_name'] : '';
$capacity = isset($_POST['capacity']) ? $_POST['capacity'] : '';
$block = isset($_POST['block']) ? $_POST['block'] : '';
$room_condition = isset($_POST['room_condition']) ? $_POST['room_condition'] : '';
$type = isset($_POST['type']) ? $_POST['type'] : '';

// Gọi phương thức updateRoom để cập nhật thông tin phòng
$update_result = $db->updateRoom($room_id, $room_name, $capacity, $block, $room_condition, $type);

// Kiểm tra kết quả cập nhật và hiển thị thông báo tương ứng
if ($update_result) {
    include('View/RoomList.php');

} else {
    echo "Cập nhật thông tin phòng thất bại.";
}
}

function ViewRoomsRequest2() {
    // Lấy các tham số từ query string
    $block = isset($_GET['block']) ? $_GET['block'] : '';
    $capacity = isset($_GET['capacity']) ? $_GET['capacity'] : '';

    // Khởi tạo đối tượng Database
    require_once 'model/DBConfig.php';
    $db = new Database();
    $db->connect();

    // Xóa dữ liệu cũ nếu có
    // Nếu bạn sử dụng phiên, hãy chắc chắn không lưu dữ liệu lọc cũ
    // session_start();
    // unset($_SESSION['previous_filter_data']);

    // Lấy danh sách các phòng với các tham số lọc
    $rooms = $db->getFilteredRooms($block, $capacity);
    // Truyền dữ liệu phòng tới view
    require_once('View/RoomList.php');
}

// function SearchRoomsRequest() {
//     // Lấy các tham số từ query string
//     // Kiểm tra và lấy giá trị của Action từ query string
//     $Action = isset($_GET['Action']) ? $_GET['Action'] : '';

//     // Dựa vào giá trị của Action, thực hiện yêu cầu
//     switch($Action) {
//         case 'searchroom':
//             require_once 'model/DBConfig.php';
//             $db = new Database();
//             $rooms = $db->getRooms();
//         //     echo "<pre>";
//         // print_r($room);  // In kết quả dưới dạng mảng
//         // echo "</pre>";
//     // Hiển thị danh sách các phòng
//             require_once('View/SearchRoom.php');
//             break;
//         // Bạn có thể thêm các trường hợp khác ở đây nếu cần
//         default:
//             // Xử lý trường hợp mặc định nếu cần
//             echo "Action không hợp lệ.handleRequest";
//             break;
//     }
// }

function SearchRoomsRequest() {
    
    // Truyền dữ liệu phòng tới view
    require_once('View/SearchRoom.php');
}

function SearchRoomsRequest2() {
    // Lấy các tham số từ query string
    $capacity = isset($_GET['capacity']) ? $_GET['capacity'] : '';
    $start_time = '2024-09-10'; 
$end_time = '2024-09-12';   
    
    // Khởi tạo đối tượng Database
    require_once 'model/DBConfig.php';
    $db = new Database();
    $db->connect();

    // Lấy danh sách các phòng với các tham số lọc
    $rooms = $db->searchRooms($capacity, $start_time, $end_time);
    // Truyền dữ liệu phòng tới view
    require_once('View/SearchRoom.php');
}

function AddBookingRequest() {
    session_start();

// Lấy các tham số từ query string
$room_id = isset($_GET['room_id']) ? $_GET['room_id'] : '';
$start_time = isset($_GET['start_time']) ? $_GET['start_time'] : '';
$end_time = isset($_GET['end_time']) ? $_GET['end_time'] : '';

// Kiểm tra nếu thông tin phòng có được truyền vào
if ($room_id && $start_time && $end_time) {
    // Nếu session booking không tồn tại, khởi tạo nó
    if (!isset($_SESSION['booking'])) {
        $_SESSION['booking'] = array();
    }

    // Thêm phòng vào session booking
    $_SESSION['booking'][] = array(
        'room_id' => $room_id,
        'start_time' => $start_time,
        'end_time' => $end_time
    );
}

// Chuyển hướng đến trang đăng ký mượn
require_once('View/View_Booking.php');
exit;
    
}

session_start();

function DeleteBookingRequest() {
    // Kiểm tra xem tham số 'delete' có tồn tại trong URL và session 'booking' đã tồn tại
    if (isset($_GET['delete']) && isset($_SESSION['booking'])) {
        $deleteIndex = intval($_GET['delete']); // Lấy chỉ số của phòng muốn xóa và chuyển thành số nguyên

        // Kiểm tra nếu chỉ số tồn tại trong session booking
        if (isset($_SESSION['booking'][$deleteIndex])) {
            unset($_SESSION['booking'][$deleteIndex]);  // Xóa phòng khỏi session
            $_SESSION['booking'] = array_values($_SESSION['booking']); // Sắp xếp lại chỉ số sau khi xóa
        }
    }

    // Chuyển hướng lại trang đăng ký mượn
    require_once('View/View_Booking.php');
    exit;
}


function ALLBookingRequest() {
    // Khởi tạo đối tượng Database
    $db = new Database();
    $db->connect(); // Kết nối đến cơ sở dữ liệu

    // Lấy tất cả các booking
    $bookings = $db->getAllBookings();

    // Nếu $bookings không phải là mảng, khởi tạo nó như một mảng rỗng
    if (!is_array($bookings)) {
        $bookings = [];
    }

    // Truyền dữ liệu booking tới view
    include('View/AllBooking.php');
}


function UpdateBookingRequest() {
    // Khởi tạo đối tượng Database
    $db = new Database();
    $db->connect(); // Kết nối đến cơ sở dữ liệu

    // Lấy các tham số từ query string
    $booking_id = isset($_GET['booking_id']) ? $_GET['booking_id'] : '';
    $action = isset($_GET['action']) ? $_GET['action'] : '';

    // Kiểm tra nếu thông tin booking_id và action có được truyền vào
    if ($booking_id && in_array($action, ['confirmed', 'cancelled', 'finished'])) {
        // Cập nhật trạng thái booking
        $result = $db->updateBookingStatus($booking_id, $action);
        echo "<pre>";
        print_r($result);  // In kết quả dưới dạng mảng
        echo "</pre>";
        if ($result) {
            echo "Booking status updated successfully.";
            
        } else {
            echo "Failed to update booking status.";
        }
    } else {
        echo "Invalid booking ID or action.";
    }

    // Chuyển hướng lại trang yêu cầu
    
    exit;
}



function viewBookingDetails() {
    // Khởi tạo đối tượng Database
    $db = new Database();
    $db->connect(); // Kết nối đến cơ sở dữ liệu

    // Lấy booking_id từ query string
    $booking_id = isset($_GET['id']) ? $_GET['id'] : '';

    if ($booking_id) {
        // Lấy thông tin chi tiết booking
        $bookingDetails = $db->getBookingDetails($booking_id);
        
        // Hiển thị trang chi tiết booking
        require_once('View/BookingDetails.php');
    } else {
        echo "Invalid booking ID.";
    }
}


?>
