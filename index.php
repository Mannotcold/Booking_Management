<?php
// Thay vì dùng include, sử dụng require_once
require_once 'model/DBConfig.php'; // Đảm bảo rằng đường dẫn này đúng
$db = new Database;
$db->connect();

// In ra đường link đầy đủ
$base_url = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['SCRIPT_NAME']}";
$full_url = "{$base_url}?Controllers=thanh-vien&Action=home";
echo "Vào trang Web: <a href=\"$full_url\">$full_url</a><br>";

// Kiểm tra nếu đang ở URL không phải mong muốn, thực hiện chuyển hướng
if (!isset($_GET['Controllers']) || $_GET['Controllers'] !== 'thanh-vien') {
    exit();
}

// Kiểm tra giá trị của Controllers từ query string
$controller = isset($_GET['Controllers']) ? $_GET['Controllers'] : '';

// Dựa vào giá trị của Controllers, thực hiện yêu cầu
switch ($controller) {
    case 'thanh-vien':
        require_once('Controllers/thanhvien/HomeController.php');  // Bao gồm tệp chứa hàm HomeRequest và AddRequest
        $action = isset($_GET['Action']) ? $_GET['Action'] : '';

        // Gọi hàm dựa vào giá trị của Action
        if ($action === 'login' && function_exists('LoginRequest')) {
            
            LoginRequest();
        } 
        elseif ($action === 'logout' && function_exists('LoginRequest')) {
            unset($_SESSION['username']);
            LoginRequest();
        }
        elseif ($action === 'postlogin' && function_exists('handleLoginPostRequest')) {
            handleLoginPostRequest();
        }
        elseif ($action === 'roomlist' && function_exists('ViewRoomsRequest')) {
            ViewRoomsRequest();
        }
        elseif ($action === 'editroomlist' && function_exists('EditRoomsRequest')) {
            EditRoomsRequest();
        }
        elseif ($action === 'updateroomlist' && function_exists('UpdateRoomsRequest')) {
            UpdateRoomsRequest();
        }
        elseif ($action === 'locroomlist' && function_exists('ViewRoomsRequest2')) {
            ViewRoomsRequest2();
        }
        elseif ($action === 'searchroom' && function_exists('SearchRoomsRequest')) {
            SearchRoomsRequest();
        }
        elseif ($action === 'searchroomlist' && function_exists('SearchRoomsRequest2')) {
            SearchRoomsRequest2();
        }
        elseif ($action === 'addbooking' && function_exists('AddBookingRequest')) {
            AddBookingRequest();
        }
        elseif ($action === 'deletebooking' && function_exists('DeleteBookingRequest')) {
            DeleteBookingRequest();
        }
        elseif ($action === 'allbooking' && function_exists('ALLBookingRequest')) {
            ALLBookingRequest();
        }
        elseif ($action === 'updateBooking' && function_exists('UpdateBookingRequest')) {
            UpdateBookingRequest();
        }
        elseif ($action === 'viewBookingDetails' && function_exists('viewBookingDetails')) {
            viewBookingDetails();
        }
        elseif ($action === 'allbooking' && function_exists('LoginRequest')) {
            LoginRequest();
        }elseif ($action === 'home' && function_exists('HomeRequest')) {
            HomeRequest();
        } else {
            // Nếu Action không hợp lệ hoặc hàm không tồn tại
            echo "Action không hợp lệ hoặc hàm không tồn tại.";
        }
        break;
    default:
        // Xử lý trường hợp mặc định nếu cần
        echo "Controller không hợp lệ.";
        break;
}
?>
