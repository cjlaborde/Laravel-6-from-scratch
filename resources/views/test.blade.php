<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    {{-- <h1>< ?= htmlspecialchars($name, ENT_QUOTES) ?></h1> --}}
    {{-- using {{}}  will automatically add the htmlspecialchars protection against executable code --}}


    <!-- Escape the data -->
    <h1>{{ $name }}</h1>


    <!-- Will Not Escape the data -->
    <h1>{{ $name }}</h1>
    
</body>
</html>