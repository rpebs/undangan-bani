@section('customcss')
    <style>
        .container-delete {
            background: rgba(69, 35, 10, 0.85);
            border-radius: 15px;
            padding: 30px 40px;
            box-shadow: 0 0 30px #6d4c41;
            color: #fff8dc;
            max-width: 1000px;
            margin: 40px auto;
            overflow-x: auto;
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
            min-width: 600px; /* Supaya tabel tetap proper di layar kecil */
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
            white-space: nowrap;
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

        /* Responsive table wrapper */
        @media (max-width: 768px) {
            .container-delete {
                padding: 20px 15px;
            }

            table {
                min-width: unset;
            }

            .container-delete table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
                -webkit-overflow-scrolling: touch;
            }
        }

        @media (max-width: 500px) {
            th, td {
                font-size: 14px;
                padding: 10px 12px;
            }

            .btn-delete {
                padding: 6px 10px;
                font-size: 13px;
            }
        }
    </style>
@endsection
