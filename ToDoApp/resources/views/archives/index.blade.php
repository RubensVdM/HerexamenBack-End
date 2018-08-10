@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">

    <!--BOOTSTRAP CSS-->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!--BOOTSTRAP JS-->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ToDo App</title>
</head>
<body>
    <div class="container">
        <div class="form-row">
            <h1>Mijn archief</h1>
        </div>

        <!--SUCCES MESSAGES-->
        @if (Session::has('success'))
            <div class="alert alert-success">
                <strong>Success:</strong> {{ Session::get('success')}}
            </div>
        @endif

        <!--ERROR MESSAGES-->
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Error:</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    </div>

    @endsection
    
</body>
</html>