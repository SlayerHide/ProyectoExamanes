<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Historial de Exámenes</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 1em; }
        th, td { border: 1px solid #999; padding: 6px; text-align: left; }
        th { background-color: #eee; }
    </style>
</head>
<body>
    <h2>Historial de Exámenes</h2>
    <table>
        <thead>
            <tr>
                <th>Examen</th>
                <th>Inicio</th>
                <th>Fin</th>
                <th>Calificación</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($intentos as $i)
                <tr>
                    <td>{{ $i->examen->titulo }}</td>
                    <td>{{ $i->fecha_inicio }}</td>
                    <td>{{ $i->fecha_fin }}</td>
                    <td>{{ number_format($i->calificacion, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
