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
            <h1>Bewerken</h1>
        </div>

        <form action=" {{ route('tasks.update', [$taskBeingEdited->id]) }} " method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PUT">

            <div class="form-row">
                <div class="col">
                    <input type="text" class="form-control" value="{{ $taskBeingEdited->name }}" name="taskNameUpdate">
                </div>
            </div>

            <div class="form-row"> 
                <div class="col">
                    <textarea class="form-control" name="taskDescriptionUpdate">{{ $taskBeingEdited->description }}</textarea>
                </div>
                <div class="col">
                    <input type="date" class="form-control" value="{{ $taskBeingEdited->date }}" name="taskDateUpdate">
                </div>
            </div>

            <div class="form-row">
                <div class="col">
                    <input type="submit" class="btn btn-primary btn-block" value="Aanpassingen opslagen">
                </div>
            </div>

            <div class="form-row">
                <a href="" class="btn btn-secondary">Terug naar mijn taken</a>
            </div>
        </form>

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
    
</body>
</html>