<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family:Arial, Helvetica, sans-serif;
            background-color: #fff;
            margin: 0;
            padding: 0;
        }

        table {
            border-spacing: 0px;
        }

        th {
            text-align: center;
        }

        th, td {
            padding: 5px;
        }

        table, th, td {
            width: 100%;
            border: 1px solid rgb(229, 229, 229);
        }

        .header {
            background: #00a0e3;
            color: white;
            padding: 25px 13px;
            margin-bottom: 25px;
        }

        .container {
            margin: 0 auto;
            padding: 0px 15px;
        }

        .order-text {
            color: #00a0e3;
            font-size: 24px;
            font-weight: bold;
        }

        .address-text {
            margin: 20px 0px;
            color: #00a0e3;
        }

        .address {
            border: 2px solid rgb(229, 229, 229);
            padding: 10px;
        }

        .site {
            margin: 15px 0px;
        }
    </style>
</head>
<body>
    <div class="header">
        Dziękujemy za Twoje zamówienie
    </div>

    <div class="container">
        <p>Hej {{ $office['name'] }},</p>
        <p>Właśnie otrzymaliśmy Twoje zamówienie #{{ $office['id'] }} i rozpoczęliśmy jego realizację:</p>
        <p class="order-text">[Zamówienie {{ $office['id'] }}] ({{ \Carbon\Carbon::parse($office['created_at'])->isoFormat('D.m.Y') }})</p>
        <table>
            <tr>
                <th>Nazwa</th>
                <th>Ilość</th>
            </tr>
            <tr>
                <td>Area</td>
                <td>{{ $office->m2 }}&#13217;</td>
            </tr>
            <tr>
                <td>Window</td>
                <td>{{ $office->window == 1 ? 'Yes':'No' }}</td>
            </tr>
            <tr>
                <td>Dry cleaning</td>
                <td>{{ $office->chemical_cleaning == 1 ? 'Yes':'No' }}</td>
            </tr>
            <tr>
                <td>Cleaning after renovation:</td>
                <td>{{ $office->repairs == 1 ? 'Yes':'No' }}</td>
            </tr>
            <tr>
                <td>Dry cleaning</td>
                <td>Yes</td>
            </tr>
        </table>
        <!-- <div class="address-text">Informacja o zamówieniu</div> -->
        <!-- <div class="address">
            <p>Service: Biuro</p>
            <p>Address: ul. Мира, dom. 44A, kw. 44</p>
            <p>Info: TExt</p>
        </div> -->
        <p class="site">Dziękujemy za korzystanie z <a href="http://extracleaning.pl" target="_blank">extracleaning.pl</a>!</p>
    </div>
</body>
</html>
