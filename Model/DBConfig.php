<?php
// Đảm bảo rằng lớp Database chỉ được khai báo một lần
require_once 'config.inc.php';
class Database {
   

    private $conn = NULL;
    private $result = NULL;

    // Hàm khởi tạo không có tham số
    public function __construct() {
        // Không cần cấu hình gì ở đây
    }

    public function connect() {
        $this->conn = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASS, DB_NAME);
        if ($this->conn->connect_error) {
            die("Kết nối thất bại: " . $this->conn->connect_error);
        }
        mysqli_set_charset($this->conn, 'utf8');
        return $this->conn;
    }

    public function execute($sql) {
        $this->result = $this->conn->query($sql);
        return $this->result;
    }

    public function getData($sql) {
        if ($this->result) {
            $data = mysqli_fetch_array($this->result);
        } else {
            $data = 0;
        }
        return $data;
    }

    public function getAllData($sql) {
        $this->result = $this->conn->query($sql);
        $data = array();

        if ($this->result) {
            while ($row = $this->result->fetch_array(MYSQLI_ASSOC)) {
                $data[] = $row;
            }
        }

        return $data;
    }

    // Phương thức để lấy danh sách người dùng
    public function getUsers() {
        $sql = "SELECT * FROM USERS";
        return $this->getAllData($sql);
    }

    public function checkUserCredentials($username, $password) {
        $sql = "SELECT * FROM USERS WHERE username = '$username' AND password = '$password'";
        $result = $this->getAllData($sql);
        if ($result) {
            // In dữ liệu để kiểm tra
            return true; // Đăng nhập thành công
        } else {
            return false; // Đăng nhập thất bại
        }
    }

    // Phương thức lấy danh sách các rooms
    // public function getRooms() {
    //     $sql = "SELECT * FROM ROOMS";
    //     return $this->getAllData($sql);
    // }

    public function getRooms() {
        // Khởi tạo kết nối đến cơ sở dữ liệu
        $db = new Database();
        $conn = $db->connect(); // Lấy đối tượng kết nối
    
        // Xây dựng câu lệnh SQL để lấy danh sách phòng
        $query = "SELECT * FROM ROOMS";
        
        // Thực thi câu lệnh SQL
        $rooms = $db->getAllData($query);
        
        // Trả về danh sách các phòng
        return $rooms;
    }

    public function getFilteredRoomsc($block = '', $capacity = '') {
        $sql = "SELECT * FROM rooms WHERE 1=1";
        $params = [];

        // Thêm điều kiện lọc theo dãy
        if ($block) {
            $sql .= " AND block = ?";
            $params[] = $block;
        }

        // Thêm điều kiện lọc theo sức chứa
        if ($capacity) {
            $capacityRange = explode('-', $capacity);
            if (count($capacityRange) == 2) {
                $sql .= " AND capacity BETWEEN ? AND ?";
                $params[] = $capacityRange[0];
                $params[] = $capacityRange[1];
            } elseif ($capacity === '>100') {
                $sql .= " AND capacity > ?";
                $params[] = 100;
            }
        }

        return $this->execute($sql, $params);
    }


    public function getRoomById($room_id) {
        $sql = "SELECT * FROM ROOMS WHERE room_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $room_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $stmt->close();
        return $data;
    }


    public function updateRoom($room_id, $room_name, $capacity, $block, $room_condition, $type) {
        // Xây dựng câu lệnh SQL để cập nhật thông tin phòng
        $sql = "UPDATE ROOMS 
                SET room_name = ?, capacity = ?, block = ?, room_condition = ?, type = ? 
                WHERE room_id = ?";
        
        // Chuẩn bị câu lệnh SQL
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            die("Prepare failed: " . $this->conn->error);
        }
        
        // Liên kết các tham số với câu lệnh
        $stmt->bind_param('sissss', $room_name, $capacity, $block, $room_condition, $type, $room_id);
        
        // Thực thi câu lệnh SQL
        $result = $stmt->execute();
        
        // Đóng câu lệnh
        $stmt->close();
        
        return $result;
    }
    


    public function getFilteredRooms($block = '', $capacity = '') {
        $sql = "SELECT * FROM ROOMS WHERE 1=1";
        $params = [];
    
        // Thêm điều kiện lọc theo dãy
        if ($block) {
            $sql .= " AND block = ?";
            $params[] = $block;
        }
    
        // Thêm điều kiện lọc theo sức chứa
        if ($capacity) {
            $capacityRange = explode('-', $capacity);
            if (count($capacityRange) == 2) {
                $sql .= " AND capacity BETWEEN ? AND ?";
                $params[] = $capacityRange[0];
                $params[] = $capacityRange[1];
            } elseif ($capacity === '>100') {
                $sql .= " AND capacity > ?";
                $params[] = 100;
            }
        }
    
        // Thực thi câu lệnh SQL với các tham số
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            die("Prepare failed: " . $this->conn->error);
        }
    
        // Liên kết các tham số với câu lệnh
        if (!empty($params)) {
            $types = str_repeat('s', count($params)); // Tạo chuỗi kiểu dữ liệu cho các tham số
            $stmt->bind_param($types, ...$params);
        }
    
        // Thực thi câu lệnh SQL
        $stmt->execute();
        $result = $stmt->get_result();
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        $stmt->close();
        
        return $data;
    }




    public function searchRooms($capacity, $start_time, $end_time) {
        // Xây dựng câu lệnh SQL với tham số được gắn trực tiếp vào
        $sql = "SELECT r.room_id, r.room_name, r.capacity, r.block
                FROM ROOMS r
                WHERE r.capacity > $capacity
                  AND r.room_condition = 'good'
                  AND r.type = 'public'
                  AND r.room_id NOT IN (
                    SELECT bd.room_id
                    FROM BOOKING_DETAILS bd
                    JOIN BOOKINGS b ON bd.booking_id = b.booking_id
                    WHERE b.status IN ('confirmed', 'pending')
                      AND (
                        (bd.start_time <= '$start_time' AND bd.end_time >= '$end_time')
                      )
                )";
    
        // Debugging: hiển thị câu lệnh SQL để kiểm tra
        
    
        // Thực thi câu lệnh SQL
        $result = $this->conn->query($sql);
        if ($result === false) {
            echo "Query failed: " . $this->conn->error;
            return [];
        }
        
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        
        // Lấy dữ liệu và trả về
        return $data;
    }
    
    
    
    public function getAllBookings() {
        $sql = "SELECT * FROM bookings";
        return $this->getAllData($sql);
    }
    
    
    public function updateBookingStatus($booking_id, $status) {
        $sql = "UPDATE bookings SET status = ? WHERE booking_id = ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            die("Prepare failed: " . $this->conn->error);
        }
        $stmt->bind_param('si', $status, $booking_id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    
    public function getBookingDetails($booking_id) {
        $sql = "SELECT * FROM BOOKING_DETAILS WHERE booking_id = ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            die("Prepare failed: " . $this->conn->error);
        }
        $stmt->bind_param('i', $booking_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $details = $result->fetch_assoc();
        $stmt->close();
        return $details;
    }
    
    
    
}
?>
