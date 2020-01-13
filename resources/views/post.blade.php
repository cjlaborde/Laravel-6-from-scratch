<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>My Blog Posts</h1>
    <!-- $post is an object, so if you just use $post it will fail -->
    <p>{{ $post->body }}</p>
</body>
</html>