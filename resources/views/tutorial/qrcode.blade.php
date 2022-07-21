<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
<body>
    <div class="card text-center my-5">
        <div class="card-header">
            <h2>Suzume No Tojimari</h2>
        </div>
        <div class="card-body">
            {!! QrCode::size(300)->generate('Suzume No Tojimari') !!}
        </div>
        <img src="data:image/png;base64, {!! base64_encode(QrCode::size(200)->generate('Suzume No Tojimari')) !!} ">
      </div>
</body>
</html>