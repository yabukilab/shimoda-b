document.addEventListener('DOMContentLoaded', function() {
    const seatsContainer = document.getElementById('seats');
    const totalSeats = 516;

    for (let i = 1; i <= totalSeats; i++) {
        let seat = document.createElement('div');
        seat.classList.add('seat');
        seat.dataset.position = i;
        seat.textContent = i;
        seat.addEventListener('click', toggleSeatStatus);
        seatsContainer.appendChild(seat);
    }

    function toggleSeatStatus(event) {
        const seat = event.target;
        const position = seat.dataset.position;
        const isOccupied = seat.classList.toggle('occupied');

        fetch('update_seat.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ position: position, status: isOccupied ? 1 : 0 })
        })
        .then(response => response.json())
        .then(data => {
            if (!data.success) {
                seat.classList.toggle('occupied'); // 失敗した場合、元に戻す
                alert('座席の状態を更新できませんでした。');
            }
        })
        .catch(error => {
            seat.classList.toggle('occupied'); // エラーの場合、元に戻す
            alert('エラーが発生しました。');
        });
    }

    // 初期状態を取得
    fetch('get_seats.php')
        .then(response => response.json())
        .then(data => {
            data.forEach(seat => {
                if (seat.status == 1) {
                    document.querySelector(`.seat[data-position='${seat.position}']`).classList.add('occupied');
                }
            });
        })
        .catch(error => {
            alert('座席の初期状態を取得できませんでした。');
        });
});
