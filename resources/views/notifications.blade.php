<!-- resources/views/notifications.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
        }
        h1 {
            color: #333;
        }
        .notification {
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
        .isi {
            margin-top: 5px;
            color: #555;
        }
    </style>
</head>
<body>
    <h1>Notifications</h1>

    @if($notifications->isEmpty())
        <p>No notifications available.</p>
    @else
        @foreach($notifications as $notification)
            <div class="notification">
                <div class="judul">{{ $notification->judul }}</div>
                <div class="isi">{{ $notification->isi }}</div>
            </div>
        @endforeach
    @endif
</body>
</html>