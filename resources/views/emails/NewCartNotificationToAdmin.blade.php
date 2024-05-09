<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <p>Hello Admin,</p>

    <p>{{ $user->name }} Telah Menyelesaikan Pembelian dari product:</p>
    <br>
    <p>{{ $payment->product['nama'] }} - {{$payment->product->seriesproduct['seri']}}</p>
    <br>
    <p>Tolong di cek segera</p>
</body>
</html>
