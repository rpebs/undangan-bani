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
            color: #fff8dc;
            padding: 20px 30px;
            background-color: #5d4037cc;
            border-radius: 12px;
            box-shadow: inset 0 0 10px #3e2723;
            text-align: center;
            min-width: 300px;
            transition: all 0.3s ease-in-out;
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
        <h1>🎁 Undian Doorprize</h1>
        <div class="nama-acak" id="namaTampil"></div>
        <button class="undian-button" onclick="mulaiUndian()">Mulai</button>
        <button class="undian-button" onclick="stopUndian()">Stop</button>
    </div>
    <script>
        let namaList = [];
        let interval;

        fetch("{{ url('/api/undian-nama') }}")
            .then(res => res.json())
            .then(data => namaList = data);

        function mulaiUndian() {
            if (!namaList.length) return;
            clearInterval(interval);
            interval = setInterval(() => {
                const current = namaList[Math.floor(Math.random() * namaList.length)];
                const tampilNama = current.nama;
                const tampilOrtu = current.nama_orang_tua ?
                    `<br><span style="font-size: 1rem; font-style: italic;">(${current.is_menantu ? 'Menantu dari' : 'Anak dari'} ${current.nama_orang_tua})</span>` :
                    '';
                document.getElementById('namaTampil').innerHTML = tampilNama + tampilOrtu;
            }, 100);
        }

        function stopUndian() {
            clearInterval(interval);
        }
    </script>
</body>

</html>
