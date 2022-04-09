<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>
<body class="antialiased">
<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <a href="/"> users </a>

        @if($errors->any())
            <div style="background-color: red">
                {{ implode('', $errors->all('<div>:message</div>')) }}
            </div>
        @endif

        <form method="post" action="/user/{{ $user->id }}/update">
            {{ csrf_field() }}
            <label for="fname">Name:</label><br>
            <input type="text" id="fname" name="name" value="{{ $user->name }}"><br>
            <label for="lname">Email:</label><br>
            <input type="text" id="lname" name="email" value="{{ $user->email }}"><br><br>

            <button type="submit">Update</button>
        </form>
    </div>
</div>
</body>
</html>
