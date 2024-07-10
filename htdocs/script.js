document.addEventListener('DOMContentLoaded', () => {
    const seatContainer = document.querySelector('.seat-container');
    const seatLayout = [
        // 1-16
        ...Array.from({ length: 16 }, (_, i) => i + 1),
        // 17-32
        ...Array.from({ length: 16 }, (_, i) => i + 17),
        // 空白
        ...Array(32).fill(''),
        // 33-48
        ...Array.from({ length: 16 }, (_, i) => i + 33),
        // 49-64
        ...Array.from({ length: 16 }, (_, i) => i + 49),
        // 空白
        ...Array(32).fill(''),
        // 65-80
        ...Array.from({ length: 16 }, (_, i) => i + 65),
        // 81-96
        ...Array.from({ length: 16 }, (_, i) => i + 81),
        // 空白
        ...Array(32).fill(''),
        // 97-112
        ...Array.from({ length: 16 }, (_, i) => i + 97),
        // 113-128
        ...Array.from({ length: 16 }, (_, i) => i + 113),
        // 空白
        ...Array(32).fill(''),
        // 129-144
        ...Array.from({ length: 16 }, (_, i) => i + 129),
        // 145-160
        ...Array.from({ length: 16 }, (_, i) => i + 145),
        // 空白
        ...Array(32).fill(''),
        // 161-176
        ...Array.from({ length: 16 }, (_, i) => i + 161),
        // 177-192
        ...Array.from({ length: 16 }, (_, i) => i + 177),
        // 空白
        ...Array(32).fill(''),
        // 193-208
        ...Array.from({ length: 16 }, (_, i) => i + 193),
        // 209-224
        ...Array.from({ length: 16 }, (_, i) => i + 209),
        // 空白
        ...Array(32).fill(''),
        // 225-240
        ...Array.from({ length: 16 }, (_, i) => i + 225),
        // 241-256
        ...Array.from({ length: 16 }, (_, i) => i + 241),
        // 257-272
        ...Array.from({ length: 16 }, (_, i) => i + 257),
        // 空白
        ...Array(16).fill(''),
        // 273-288
        ...Array.from({ length: 16 }, (_, i) => i + 273),
        // 289-304
        ...Array.from({ length: 16 }, (_, i) => i + 289),
        // 305-320
        ...Array.from({ length: 16 }, (_, i) => i + 305),
        // 321-336
        ...Array.from({ length: 16 }, (_, i) => i + 321),
        // 337-352
        ...Array.from({ length: 16 }, (_, i) => i + 337),
        // 353-368
        ...Array.from({ length: 16 }, (_, i) => i + 353),
        // 空白
        ...Array(16).fill(''),
        // 369-384
        ...Array.from({ length: 16 }, (_, i) => i + 369),
        // 385-400
        ...Array.from({ length: 16 }, (_, i) => i + 385),
        // 401-416
        ...Array.from({ length: 16 }, (_, i) => i + 401),
        // 空白
        ...Array(16).fill(''),
        // 417-432
        ...Array.from({ length: 16 }, (_, i) => i + 417),
        // 433-448
        ...Array.from({ length: 16 }, (_, i) => i + 433),
        // 空白
        ...Array(16).fill(''),
        // 449-464
        ...Array.from({ length: 16 }, (_, i) => i + 449),
        // 465-480
        ...Array.from({ length: 16 }, (_, i) => i + 465),
        // 空白
        ...Array(16).fill(''),
        // 481-496
        ...Array.from({ length: 16 }, (_, i) => i + 481),
        // 497-512
        ...Array.from({ length: 16 }, (_, i) => i + 497),
        // 513-516
        ...Array.from({ length: 4 }, (_, i) => i + 513),
        // 空白
        ...Array(28).fill('')
    ];

    seatLayout.forEach(seatNumber => {
        const seat = document.createElement('div');
        seat.classList.add('seat');
        seat.textContent = seatNumber || '';
        if (seatNumber) seat.dataset.position = seatNumber;
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
