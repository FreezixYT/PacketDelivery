<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="fixed navbar bg-base-100 shadow-sm">
        <div class="navbar-start">
            <a class="text-xl">
                <?php  
                    if (empty($_SESSION['user']['nom']))
                    {
                        echo "<p> Bonjour</p>";
                    }
                    else
                    {
                        echo "<p> Bonjour " . $_SESSION['user']['nom'];
                    }
                    ?>
            </a>
        </div>
        <div class="navbar-center">
            <img src="./assets/img/array.png" width="50px" height="50px" alt="">
        </div>
        <div class="navbar-end">
            <a href="/login" class="btn btn-ghost btn-circle">
                <img src="./assets/img/on-off-button.png" width="100px" height="100px" alt="">
            </a>
        </div>
    </div>
    <main>
        <?= $content ?>
    </main>
    <footer class="fixed bottom-0 left-0 right-0 navbar bg-base-100 shadow-[0_-1px_3px_rgba(0,0,0,0.1)] p-4 justify-center">
        <aside>
            <p class="t-center">Packet delivery &copy; 2026</p>
        </aside>
    </footer>
</body>

</html>