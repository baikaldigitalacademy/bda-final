<!DOCTYPE html>

<html lang = "ru">
<head>
    <title>{{ $summary->name }}</title>
    <meta charset = "utf8">

    <style>
        body{
            font-family: Arial;
            font-size: 12pt;
        }

        .head{
            font-size: 20pt;
            font-weight: bold;
        }

        .subsection{
            text-decoration: underline;
        }
    </style>
</head>

<body>
<span class = "head">{{ $summary->name }}</span> <br>
<a href = "{{ $summary->email }}">{{ $summary->email }}</a> <br> <br>
<span class = "subsection">Ключевые навыки:</span> <br>
{{ $summary->skills }} <br> <br>
<span class = "subsection">Резюме:</span> <br>
{{ $summary->description }} <br> <br>
<span class = "subsection">Опыт:</span> <br>
{{ $summary->experience }}
</body>
</html>
