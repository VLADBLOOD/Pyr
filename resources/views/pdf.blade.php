<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
    </style>
</head>
<body>
<h1>Документ</h1>
<table class="table table-bordered">
    <thead>
    <tr>
        <td><b>Фамилия</b></td>
        <td><b>Имя</b></td>
        <td><b>Отчество</b></td>
        <td><b>Долг</b></td>
        <td><b>Госпошлина</b></td>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>
            {{ $debt->lastname }}
        </td>
        <td>
            {{ $debt->firstname }}
        </td>
        <td>
            {{ $debt->secondname }}
        </td>
        <td>
            {{ $debt->debt }}
        </td>
        <td>
            {{ $debt->statefee }}
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>
