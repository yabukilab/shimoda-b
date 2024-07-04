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
    
    require 'db.php'; // データベース接続を読み込み
    
    header('Content-Type: application/json');

    if (isset($data['position']) && isset($data['status'])) {
        $position = (int) $data['position'];
        $status = (int) $data['status'];
    
        $stmt = $pdo->prepare('UPDATE seat SET status = ? WHERE position = ?');
        if ($stmt->execute([$status, $position])) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'データベース更新に失敗しました。']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => '無効なデータが送信されました。']);
    }
    
    $stmt = $pdo->query('SELECT position, status FROM seat');
    $seats = $stmt->fetchAll();
    
    echo json_encode($seats);

    ?>

</body>
</html>
