<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
<body>
    <p>Created: {{ $vacancy['created_at'] }}</p>
    <hr>
    <p>Customer information:</p>
    <p>Name: {{ $vacancy['name'] }}</p>
    <p>Phone: {{ $vacancy['phone'] }}</p>
    <p>E-Mail: {{ $vacancy['email'] }}</p>
    @if ($vacancy['information'])
        <p>Information: {{ $vacancy['information'] }}</p>
    @endif
</body>
</html>
