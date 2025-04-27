<!-- resources/views/contents.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Content List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
        }
        h1 {
            color: #333;
        }
        .content {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .judul {
            font-weight: bold;
            color: #007bff;
        }
        .tipe, .isi {
            margin-top: 5px;
            color: #555;
        }
        .gambar img {
            max-width: 200px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>Content List</h1>
    @if($contents->isEmpty())
        <p>No content available.</p>
    @else
        @foreach($contents as $content)
            <div class="content">
                <div class="judul">Judul: {{ $content->judul }}</div>
                <div class="tipe">Tipe: {{ $content->tipe }}</div>
                <div class="isi">Isi: {{ $content->isi }}</div>
                @if($content->gambar)
                    <div class="gambar">
                        <img src="{{ asset('storage/' . $content->gambar) }}" alt="{{ $content->judul }}">
                    </div>
                @endif
            </div>
        @endforeach
    @endif
</body>
</html>