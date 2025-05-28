@extends('layout.main') {{-- atau layout utamamu --}}
@section('customcss')
    <style>
        .container-keluarga {
            background: rgba(69, 35, 10, 0.85);
            border-radius: 15px;
            padding: 30px 40px;
            box-shadow: 0 0 30px #6d4c41;
            text-align: center;
            position: relative;
            transform: translateY(20px);
            transition: opacity 1.2s ease, transform 1.2s ease;
            width: 100%;
            max-width: 90%;
            margin-bottom: 50px;
            /* supaya center horizontal */
        }

        .card-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: center;
            margin-top: 20px;
            margin-bottom: 25px;
        }

        .card {
            background: #6d4c41;
            border-radius: 12px;
            padding: 20px;
            color: #fff8dc;
            box-shadow: 2px 2px 10px #3e2723;
            width: 100%;
            max-width: 220px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 2px 4px 20px #5d4037;
        }

        .card h3 {
            margin-top: 0;
            color: #ffecb3;
            font-family: "Gloock", serif;
            font-size: 1.2rem;
            text-shadow: 1px 1px 2px #3e2723;
        }

        /* @media (max-width: 600px) {
                .card {
                    width: 100%;
                    max-width: 100%;
                }


                .container-keluarga {
                    padding: 20px 30px;
                    max-width: 100%;

                }
            } */
    </style>
@endsection
@section('content')
    <div class="container-keluarga">
        <h1>Data Keluarga</h1>
        <p class="subtitle">Terdata berdasarkan Bani & Keturunan</p>
        @foreach ($kelompokBani as $bani => $anggota)
            <div class="section">
                <h2>
                    @if ($bani === 'Lainnya')
                        {{ $bani }}
                    @else
                        Bani {{ $bani }}
                    @endif
                </h2>
                <div class="card-grid">
                    @foreach ($anggota as $person)
                        <div class="card">
                            <h3>{{ strtoupper($person->nama) }}</h3>
                            @if($person->is_menantu)
                                <p><strong>(Menantu)</strong></p>
                            @endif
                            <p><strong>{{$person->is_menantu ? 'Nama Mertua' : 'Nama Orang Tua'}}:</strong> {{ ucwords($person->nama_orang_tua) }}</p>
                            <p><strong>Alamat:</strong> {{ $person->alamat }}</p>
                            <p><strong>HP:</strong> {{ $person->hp }}</p>
                            <p><strong>Pekerjaan:</strong> {{ $person->pekerjaan }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
@endsection
@section('customjs')
@endsection
