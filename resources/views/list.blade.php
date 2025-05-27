@extends('layout.main')

@section('customcss')
    <style>
        .container-delete {
            background: rgba(69, 35, 10, 0.85);
            border-radius: 15px;
            padding: 30px 40px;
            box-shadow: 0 0 30px #6d4c41;
            color: #fff8dc;
            max-width: 900px;
            margin: 40px auto;
        }

        h1 {
            font-family: "Gloock", serif;
            font-size: 2rem;
            color: #ffecb3;
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #5d4037cc;
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #3e2723;
        }

        th {
            background-color: #6d4c41;
            color: #f0e68c;
            font-weight: bold;
        }

        td {
            color: #fff8dc;
        }

        .btn-delete {
            padding: 8px 12px;
            background-color: #b71c1c;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .btn-delete:hover {
            background-color: #c62828;
        }

        @media (max-width: 600px) {
            .container-delete {
                padding: 20px 15px;
            }

            table, thead, tbody, th, td, tr {
                display: block;
                width: 100%;
            }

            tr {
                margin-bottom: 15px;
            }

            td {
                text-align: right;
                position: relative;
                padding-left: 50%;
            }

            td::before {
                content: attr(data-label);
                position: absolute;
                left: 15px;
                width: 45%;
                white-space: nowrap;
                font-weight: bold;
            }

            th {
                display: none;
            }
        }
    </style>
@endsection

@section('content')
    <div class="container-delete">
        <h1>Hapus Data Keluarga</h1>
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Keturunan</th>
                    <th>Alamat</th>
                    <th>HP</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataKeluarga as $item)
                    <tr>
                        <td data-label="Nama">{{ $item->nama }}</td>
                        <td data-label="Keturunan">{{ $item->keturunan_ke }}</td>
                        <td data-label="Alamat">{{ $item->alamat }}</td>
                        <td data-label="HP">{{ $item->hp }}</td>
                        <td data-label="Aksi">
                            <form action="{{ route('keluarga.destroy', $item->id) }}" method="POST"
                                  onsubmit="return confirm('Yakin mau dihapus ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
