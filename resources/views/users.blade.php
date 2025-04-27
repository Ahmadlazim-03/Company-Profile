<!-- resources/views/users.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
        }
        h1 {
            color: #333;
        }
        .user {
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
        .email, .password {
            margin-top: 5px;
            color: #555;
        }
    </style>
</head>
<body>
    <h1>Users</h1>
    @if($users->isEmpty())
        <p>No users available.</p>
    @else
        @foreach($users as $user)
            <div class="user">
                <div class="nama">Name: {{ $user->nama }}</div>
                <div class="email">Email: {{ $user->email }}</div>
                <div class="password">Password: {{ $user->password }}</div>
            </div>
        @endforeach
    @endif
</body>
</html>