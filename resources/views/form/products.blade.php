<!-- resources/views/products.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification Form</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
            color: #333;
        }

        h1 {
            color: #444;
            text-align: center;
            margin-bottom: 20px;
        }

        p {
            text-align: center;
            font-size: 1.1em;
            color: #666;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }

        label {
            font-size: 1em;
            color: #444;
            margin-bottom: 5px;
        }

        input,
        textarea {
            width: 80%;
            max-width: 400px;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        input:focus,
        textarea:focus {
            border-color: #007bff;
            box-shadow: 0 0 6px rgba(0, 123, 255, 0.5);
            outline: none;
        }

        button {
            padding: 10px 20px;
            font-size: 1em;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.2s, transform 0.2s;
        }

        button:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <h1>Create Products</h1>
    <form id="productsForm" method="post" action="/products">
        @csrf <!-- Include CSRF token -->
        <label for='nama'>Nama:</label>
        <input type="text" id='nama' name='nama' required>
        <br><br>
        <label for='deskripsi'>Deskripsi:</label>
        <textarea id='deskripsi' name='deskripsi' required></textarea>
        <br><br>
        <label for='harga'>Harga:</label>
        <input type="text" id='harga' name='harga' required>
        <br><br>
        <label for='stok'>Stok:</label>
        <input type="number" id='stok' name='stok' required>
        <br><br>
        <label for='sku'>SKU:</label>
        <input type="text" id='sku' name='sku' required>
        <br><br>
        <label for='gambar'>Gambar:</label>
        <input type="url" id='gambar' name='gambar' required>
        <br><br>
        <label for='status'>Status:</label>
        <input type="text" id='status' name='status' required>
        <button type="submit">Create Products</button>
    </form>

    <div id="responseMessage"></div>

    <script>
        $(document).ready(function() {
            $('#productsForm').on('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission

                $.ajax({
                    url: '/api/products',
                    type: 'POST',
                    data: $(this).serialize(), // Serialize the form data
                    success: function(response) {
                        $('#responseMessage').text('Success, data: ' + JSON.stringify(response)); // Display success message
                    },
                    error: function(xhr) {
                        $('#responseMessage').text('Error: ' + xhr.responseText); // Display error message
                    }
                });
            });
        });
    </script>
</body>
</html>