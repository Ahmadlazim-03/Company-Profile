<!-- resources/views/mahasiswa.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mahasiswa List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
        }
        h1 {
            color: #333;
        }
        .mahasiswa {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .nama {
            font-weight: bold;
            color: #007bff;
        }
        .nim, .angkatan, .divisi, .email {
            margin-top: 5px;
            color: #555;
        }
    </style>
</head>
<body>
    <h1>Mahasiswa List</h1>
    @if($mahasiswa->isEmpty())
        <p>No mahasiswa available.</p>
    @else
        @foreach($mahasiswa as $mhs)
            <div class="mahasiswa">
                <div class="nama">Nama: {{ $mhs->nama }}</div>
                <div class="nim">NIM: {{ $mhs->nim }}</div>
                <div class="angkatan">Angkatan: {{ $mhs->angkatan }}</div>
                <div class="divisi">Divisi: {{ $mhs->divisi }}</div>
                <div class="email">Email: {{ $mhs->email }}</div>
            </div>
        @endforeach
    @endif
</body>
</html>