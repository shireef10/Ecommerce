<!DOCTYPE html>
<html lang="en">

@include('user.css');
<head>
    <style>
        /* Add this CSS to your 'user.css' file or a new CSS file */

/* Style the table */
.cart-table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
}

/* Style the table header */
.cart-table th {
    background-color: #f2f2f2;
    text-align: left;
    padding: 10px;
    border: 1px solid #ddd;
}

/* Style the table rows */
.cart-table tr {
    border: 1px solid #ddd;
}

/* Style alternate table rows with different background colors */
.cart-table tr:nth-child(even) {
    background-color: #f2f2f2;
}

.cart-table td {
    padding: 10px;
    border: 1px solid #ddd;
    text-align: center;
}

/* Center the table header text */
.cart-table th {
    text-align: center;
}

/* Center the table data in the "Price" column */
.cart-table td:last-child {
    text-align: center;
}

    </style>
</head>
<body class="ecommerce">
    @include('user.header')
    <div class="main">
        <div class="container">
            <h1 style="text-align: center">Your Cart</h1>
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Product Title</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <form method="POST" action="{{ url('orders') }}">
                        @csrf
                        @if (count($cart) > 0)
                        @foreach ($cart as $cartItem)
                        <tr>
                            <input name="productname[]" value="{{ $cartItem->product_title }}" type="text" hidden="">
                            <td>{{ $cartItem->product_title }}</td>
                            <input name="price[]" value="{{ $cartItem->price }}" type="text" hidden="">
                            <td>{{ $cartItem->price }} EGP</td>
                            <td>
                                <a href="{{ url('delete', $cartItem->id) }}" class="btn btn-denger" style="color:red; font-size:20px; font-wight:bold">X</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div style="text-align: center;">
                    <p>Total: {{ $total }} EGP</p>
                    <button type="submit" class="btn btn-success">Confirm Order</button>
                </div>
            </form>
            @else
            </tbody>
            </table>
            <p>No products in the cart!</p>
            @endif
        </div>
    </div>
    @include('user.footer');
    @include('user.js');
</body>
</html>