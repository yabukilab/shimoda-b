document.addEventListener('DOMContentLoaded', () => {
    const seatContainer = document.querySelector('.seat-container');
    const seatLayout = [
        // 1-32
        ...Array.from({ length: 32 }, (_, i) => i + 1),
        // 33-48 (1行空白)
        ...Array.from({ length: 16 }, (_, i) => i + 33),
        // 49-64 (1行空白)
        ...Array.from({ length: 16 }, (_, i) => i + 49),
        // 65-80
        ...Array.from({ length: 16 }, (_, i) => i + 65),
        // 81-96 (1行空白)
        ...Array.from({ length: 16 }, (_, i) => i + 81),
        // 97-112 (1行空白)
        ...Array.from({ length: 16 }, (_, i) => i + 97),
        // 113-128 (1行空白)
        ...Array.from({ length: 16 }, (_, i) => i + 113),
        // 129-144
        ...Array.from({ length: 16 }, (_, i) => i + 129),
        // 145-160 (1行空白)
        ...Array.from({ length: 16 }, (_, i) => i + 145),
        // 161-176 (1行空白)
        ...Array.from({ length: 16 }, (_, i) => i + 161),
        // 177-192 (1行空白)
        ...Array.from({ length: 16 }, (_, i) => i + 177),
        // 193-208
        ...Array.from({ length: 16 }, (_, i) => i + 193),
        // 209-224 (1行空白)
        ...Array.from({ length: 16 }, (_, i) => i + 209),
        // 225-240 (1行空白)
        ...Array.from({ length: 16 }, (_, i) => i + 225),
        // 241-256
        ...Array.from({ length: 16 }, (_, i) => i + 241),
        // 257-272 (1行空白)
        ...Array.from({ length: 16 }, (_, i) => i + 257),
        // 273-288
        ...Array.from({ length: 16 }, (_, i) => i + 273),
        // 289-304
        ...Array.from({ length: 16 }, (_, i) => i + 289),
        // 305-320
        ...Array.from({ length: 16 }, (_, i) => i + 305),
        // 321-336 (1行空白)
        ...Array.from({ length: 16 }, (_, i) => i + 321),
        // 337-352
        ...Array.from({ length: 16 }, (_, i) => i + 337),
        // 353-368 (1行空白)
        ...Array.from({ length: 16 }, (_, i) => i + 353),
        // 369-384
        ...Array.from({ length: 16 }, (_, i) => i + 369),
        // 385-400 (1行空白)
        ...Array.from({ length: 16 }, (_, i) => i + 385),
        // 401-416
        ...Array.from({ length: 16 }, (_, i) => i + 401),
        // 417-432 (1行空白)
        ...Array.from({ length: 16 }, (_, i) => i + 417),
        // 433-448 (1行空白)
        ...Array.from({ length: 16 }, (_, i) => i + 433),
        // 449-464
        ...Array.from({ length: 16 }, (_, i) => i + 449),
        // 465-480 (1行空白)
        ...Array.from({ length: 16 }, (_, i) => i + 465),
        // 481-496
        ...Array.from({ length: 16 }, (_, i) => i + 481),
        // 497-512 (1行空白)
        ...Array.from({ length: 16 }, (_, i) => i + 497),
        // 513-516 (空白16席)
        513, 514, 515, 516,
        ...Array.from({ length: 12 }, () => '')
    ];

    seatLayout.forEach(seatNumber => {
        const seat = document.createElement('div');
        seat.classList.add('seat');
        seat.textContent = seatNumber || '';
        seat.dataset.position = seatNumber;
        seat.addEventListener('click', toggleSeatStatus);
        seatContainer.appendChild(seat);
    });
});

function toggleSeatStatus(event) {
    const seat = event.target;
    const position = seat.dataset.position;
    const status = seat.classList.toggle('occupied') ? 1 : 0;

    // Ajaxを使用してサーバーに更新を送信
    fetch('update_seat.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ position, status })
    })
    .then(response => response.json())
    .then(data => {
        if (!data.success) {
            // 更新に失敗した場合、状態を元に戻す
            seat.classList.toggle('occupied');
            alert('更新に失敗しました。');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        // エラーが発生した場合、状態を元に戻す
        seat.classList.toggle('occupied');
        alert('更新に失敗しました。');
    });
}
