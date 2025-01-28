<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link
            href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@100;200;300;400;500;600;700;800;900&display=swap"
            rel="stylesheet">
        @routes
        @inertiaHead
    </head>

    <body>
        @inertia
    </body>

</html>
