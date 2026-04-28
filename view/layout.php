<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>
    <header>
        <nav>
            <a href="/">Home</a>
        </nav>
    </header>
    <?= $content ?>
    <footer class="text-center">Slim template, &copy; 2026, Nathan Pache</footer>
</body>

</html>