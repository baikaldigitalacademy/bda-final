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

        .from-editor > p{
            margin: 0px;
        }
    </style>
</head>

<body>
<span class = "head">{{ $summary->name }}</span> <br>
<a href = "{{ $summary->email }}">{{ $summary->email }}</a> <br> <br> <br>
<span class = "subsection">Ключевые навыки:</span>
<div class = "from-editor">{!! $summary->skills !!}</div> <br> <br>
<span class = "subsection">Резюме:</span>
<div class = "from-editor">{!! $summary->description !!}</div> <br> <br>
<span class = "subsection">Опыт:</span>
<div class = "from-editor">{!! $summary->experience !!}</div>
</body>
</html>
