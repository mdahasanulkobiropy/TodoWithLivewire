<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
   .error_page {
        width: 400px;
        margin: auto;
        height: 100vh;
        display: flex;
        align-items: center;
    }
    .error_page img{
        width: 100%
    }
    </style>

</head>

<body>

    <div class="error_page">
        <img src="{{ asset('assets/not_found.jpg') }}"  alt="">
    </div>

</body>

</html>
