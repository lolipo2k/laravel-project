<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
<body>
    <p>Area: {{ $office->m2 }} &#13217;</p>
    <p>Window: {{ $office->window == 1 ? 'Yes':'No' }}</p>
    <p>Dry cleaning: {{ $office->chemical_cleaning == 1 ? 'Yes':'No' }}</p>
    <p>Cleaning after renovation: {{ $office->repairs == 1 ? 'Yes':'No' }}</p>
    @if ($office->information)
        <p>Information: {{ $office->information }}</p>
    @endif
    <p>Created: {{ $office->created_at }}</p>
    <hr>
    <p>Customer information:</p>
    <p>Name: {{ $office->name }}</p>
    <p>Phone: {{ $office->phone }}</p>
    <p>E-Mail: {{ $office->email }}</p>
</body>
</html>
