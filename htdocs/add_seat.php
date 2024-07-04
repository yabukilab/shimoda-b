<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>座席利用システム</title>
    <style>
        .seat {
            width: 30px;
            height: 30px;
            margin: 5px;
            background-color: red;
            display: inline-block;
            text-align: center;
            line-height: 30px;
            cursor: pointer;
        }
        .seat.in-use {
            background-color: green;
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            fetchSeats();

            function fetchSeats() {
                fetch('path/to/your/php/script.php')
                    .then(response => response.json())
                    .then(data => {
                        const container = document.getElementById('seat-container');
                        container.innerHTML = ''; // コンテナをクリア
                        data.forEach(seat => {
                            const seatDiv = document.createElement('div');
                            seatDiv.classList.add('seat');
                            if (seat.in_use) {
                                seatDiv.classList.add('in-use');
                            }
                            seatDiv.dataset.id = seat.id;
                            seatDiv.dataset.inUse = seat.in_use;
                            seatDiv.innerText = seat.id;
                            seatDiv.addEventListener('click', toggleSeat);
                            container.appendChild(seatDiv);
                        });
                    });
            }

            function toggleSeat(event) {
                const seat = event.target;
                const seatId = seat.dataset.id;
                const currentStatus = seat.dataset.inUse;

                fetch('path/to/your/php/script.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `seat_id=${seatId}&in_use=${currentStatus}`
                })
                .then(response => response.text())
                .then(response => {
                    if (response === "Seat updated successfully") {
                        seat.classList.toggle('in-use');
                        seat.dataset.inUse = seat.dataset.inUse == 1 ? 0 : 1;
                    } else {
                        console.error("Error updating seat:", response);
                    }
                });
            }
        });
    </script>
</head>
<body>
    <h1>座席利用システム</h1>
    <div id="seat-container"></div>
    
    <?php
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "cafeteria";

// MySQLデータベースに接続
$conn = new mysqli($servername, $username, $password, $dbname);

// 接続確認
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 座席状態の取得
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT id, in_use FROM status";
    $result = $conn->query($sql);

    $seats = array();
    while ($row = $result->fetch_assoc()) {
        $seats[] = $row;
    }
    echo json_encode($seats);
}

// 座席状態の更新
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $seat_id = intval($_POST['seat_id']);
    $current_status = intval($_POST['in_use']);

    // 座席状態の反転
    $new_status = $current_status ? 0 : 1;

    $sql = "UPDATE status SET in_use=$new_status WHERE id=$seat_id";
    if ($conn->query($sql) === TRUE) {
        echo "Seat updated successfully";
    } else {
        echo "Error updating seat: " . $conn->error;
    }
}

$conn->close();
?>

</body>
</html>
