<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Undian Nama</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .undian-container {
            text-align: center;
        }

        .nama-acak {
            font-size: 2rem;
            font-weight: bold;
            padding: 20px;
            color: #ffecb3;
            background: rgba(93, 64, 55, 0.6);
            border-radius: 15px;
            margin-bottom: 30px;
            min-height: 60px;
            transition: all 0.3s ease;
            /* animation: pulse 1.5s infinite; */
        }

        .undian-button {
            font-size: 1rem;
            font-weight: 500;
            padding: 12px 25px;
            background-color: #c68642;
            border: none;
            border-radius: 8px;
            color: #fff;
            cursor: pointer;
            margin: 10px;
            box-shadow: 1px 1px 5px #3e2723;
        }

        .undian-button:hover {
            background-color: #d2a679;
        }
    </style>
</head>
<body>
    <div class="container fade-in undian-container">
        <h1>🎁 Undian Doorprize 🎁</h1>
        <div class="nama-acak" id="namaTampil"></div>
        <button class="undian-button" onclick="mulaiUndian()">Mulai</button>
        <button class="undian-button" onclick="stopUndian()">Stop</button>
    </div>

    <script>
        let namaList = [];
        let interval;
        let currentIndex = 0;

        // Ambil data dari server
        fetch("{{ url('/api/undian-nama') }}")
            .then(res => res.json())
            .then(data => namaList = data);

        function mulaiUndian() {
            if (!namaList.length) return;
            clearInterval(interval);
            interval = setInterval(() => {
                currentIndex = Math.floor(Math.random() * namaList.length);
                document.getElementById('namaTampil').textContent = namaList[currentIndex];
            }, 100);
        }

        function stopUndian() {
            clearInterval(interval);
        }
    </script>
</body>
</html>
