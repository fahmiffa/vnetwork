<!DOCTYPE html>
<html>
<head>
    <title>Mail</title>
</head>
<body>
    <p>{{ $details['body'] }}</p>

    @if($link != null)
    <a href="{{$link}}">{{$link}}</a>
    @endif
    <p>Thank you</p>
</body>
</html>