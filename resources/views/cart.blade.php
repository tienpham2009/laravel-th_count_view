<!doctype html>
<html lang="en">
<head>
    <title>cart</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="card">
        <div class="card-header">
            Gio hang
        </div>
        <div>
            <a class="btn btn-secondary" href="{{ route('index') }}">tro lai</a>
        </div>
        <form action="{{ route('destroyCart') }}" method="get">
            @csrf
            <div>
                <button class="btn btn-secondary" type="submit">Xoa</button>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th></th>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">price</th>
                    <th>amount</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach(session()->get('cart') as $key => $cart)
                    <tr>
                        <td><input type="checkbox" value="{{ $key }}" name="key[]"></td>
                        <td>{{ $key }}</td>
                        <td>{{ $cart['name']}}</td>
                        <td>{{ $cart['description'] }}</td>
                        <td>{{ $cart['price'] }}</td>
                        <td>
                            <a href="{{ route('update-cart' , ['quantity' => ($cart['quantity'] - 1) , 'id' => $key]) }}">-</a>
                            {{ $cart['quantity'] }}
                            <a href="{{ route('update-cart' , ['quantity' => ($cart['quantity'] + 1) , 'id' => $key]) }}">+</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </form>
    </div>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>
</html>

