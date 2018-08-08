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
            <h1>Uw lijst met Todo's</h1>
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

        <!--ADD NEW TASK-->
        <form action=" {{ route('tasks.store')}} " method="POST">
        {{ csrf_field() }}
            <div class="form-row">
                <div class="col">
                    <input type="text" class="form-control" name="newTaskName">
                </div>
            </div>

            <div class="form-row">
                <div class="col">
                    <textarea class="form-control" name="taskDescription"></textarea>
                </div>
                <div class="col">
                    <input type="date" class="form-control" name="taskDate">
                </div>
            </div>

            <div class="form-row">
                <div class="col">
                    <input type="submit" class="btn btn-primary btn-block" value="Nieuwe taak toevoegen">
                </div>
            </div>
        </form>

        <!--DISPLAY TASKS-->
        @if (count($savedTasks)>0)
            <table class="table">
                <thead>
                    <th>Nummer Taak</th>
                    <th>Naam</th>
                    <th>Omschrijving</th>
                    <th>Datum</th>
                    <th>Bewerken</th>
                    <th>Verwijderen</th>
                    <th>Voltooid?</th>
                </thead>

                <tbody>
                    @foreach ($savedTasks as $savedTask)
                        <tr>
                        @if(auth()->user()->id == $savedTask->user_id)
                            @if(auth()->user()->done == 0)
                                <th>{{ $savedTask->id }}</th>
                                <td>{{ $savedTask->name }}</td>
                                <td>{{ $savedTask->description }}</td>
                                <td>{{ $savedTask->date }}</td>
                                <td><a href="{{ route('tasks.edit', ['tasks' => $savedTask->id]) }}" class="btn btn-info">Bewerk</a></td>
                                <td>
                                    <form action="{{ route('tasks.destroy', ['tasks' => $savedTask->id]) }}" method="POST">
                                    {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="submit" class="btn btn-danger btn-block" value="Verwijder">
                                    </form>
                                </td>
                                <td>
                                    <form action="">
                                    {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="COMPLETE">
                                        <input type="submit" class="btn btn-block btn-success" value="Done">
                                    </form>
                                </td>
                            @endif
                        @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

    </div>

    @endsection
    
</body>
</html>