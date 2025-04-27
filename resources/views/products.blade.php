<!-- resources/views/products.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
        }
        h1 {
            color: #333;
        }
        .product {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .name {
            font-weight: bold;
            color: #007bff;
        }
        .price, .stock, .sku, .status, .description {
            margin-top: 5px;
            color: #555;
        }
        .image img {
            max-width: 100px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>Products</h1>
    @if($products->isEmpty())
        <p>No products available.</p>
    @else
        @foreach($products as $product)
            <div class="product">
                <div class="name">Name: {{ $product->name }}</div>
                <div class="description">Description: {{ $product->description }}</div>
                <div class="price">Price: ${{ number_format($product->price, 2) }}</div>
                <div class="stock">Stock: {{ $product->stock }}</div>
                <div class="sku">SKU: {{ $product->sku }}</div>
                <div class="status">Status: {{ $product->status ? 'Active' : 'Inactive' }}</div>
                @if($product->image)
                    <div class="image">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                    </div>
                @endif
            </div>
        @endforeach
    @endif
</body>
</html>