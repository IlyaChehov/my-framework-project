<!DOCTYPE html>
<html lang="ru" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'My-Framework' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./public/assets/styles/styles.css">
    <style>
        body {
            font-family: system-ui, sans-serif;
        }

        footer {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
</head>
<body>

<div class="wrapper">
    <nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?= baseUrl() ?>">MyFramework</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 gap-3">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= baseUrl('') ?>">Главная</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= baseUrl('/about') ?>">О фреймворке</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= baseUrl('/register') ?>">Регистрация</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= baseUrl('/login') ?>">Вход</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?= showAlerts() ?>
    <?= $this->getContent() ?>

    <footer class="py-4 bg-body-tertiary mt-auto">
        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center text-secondary small">
            <div>
                <a href="<?= baseUrl('') ?>" class="me-3 text-decoration-none text-reset">Главная</a>
                <a href="<?= baseUrl('/about') ?>" class="me-3 text-decoration-none text-reset">О фреймворке</a>
                <a href="<?= baseUrl('/register') ?>" class="me-3 text-decoration-none text-reset">Регистрация</a>
                <a href="<?= baseUrl('/login') ?>" class="text-decoration-none text-reset">Вход</a>
            </div>
            <div class="mt-3 mt-md-0">
                <span>Связаться: </span>
                <a href="https://github.com/yourusername" target="_blank" class="text-reset me-2">GitHub</a>
                <a href="https://t.me/yourtelegram" target="_blank" class="text-reset me-2">Telegram</a>
            </div>
        </div>
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
