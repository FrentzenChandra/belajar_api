<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notification</title>
</head>
<body>
    <form action="/api/notification/send" method="POST">
    {{ csrf_field() }}
    <select name="firebase_token" id="">
        @forEach($users as $user)
            <option value="{{$user->firebase_token}}">{{$user->name}}</option>
        @endforEach
    </select>
    <input type="text" name="title" placeholder="Input Notification Title">
    <input type="text" name="body" placeholder="Input Notification Body">
    <button>GASS</button>
    </form>
</body>
</html>