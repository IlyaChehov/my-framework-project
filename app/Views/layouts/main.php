<!DOCTYPE html>
<html lang="ru" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'My-Framework' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/public/assets/styles/styles.css">
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
            <a class="navbar-brand fw-bold" href="<?= baseHref() ?>">MyFramework</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 gap-3">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= baseHref('') ?>">Главная</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= baseHref('/dashboard') ?>">Личный кабинет</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= baseHref('/users') ?>">Пользователи</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= baseHref('/about') ?>">О фреймворке</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= baseHref('/register') ?>">Регистрация</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= baseHref('/login') ?>">Вход</a>
                    </li>
                </ul>

                <?php $requestUri = uriWithoutLang() ?>

                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                           <?= app()->get('lang')['title'] ?>
                        </a>
                        <ul class="dropdown-menu">
                            <?php foreach (LANGUAGE as $key => $value):?>
                                <?php if ($key === app()->get('lang')['code']) continue; ?>
                            <?php if ($value['base'] === true): ?>
                                    <li><a class="dropdown-item" href="<?= baseUrl("/{$requestUri}") ?>"><?= $value['title'] ?></a></li>
                            <?php else: ?>
                                    <li><a class="dropdown-item" href="<?= baseUrl("/{$key}/{$requestUri}") ?>"><?= $value['title'] ?></a></li>
                            <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
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
                <a href="<?= baseHref('') ?>" class="me-3 text-decoration-none text-reset">Главная</a>
                <a href="<?= baseHref('/about') ?>" class="me-3 text-decoration-none text-reset">О фреймворке</a>
                <a href="<?= baseHref('/register') ?>" class="me-3 text-decoration-none text-reset">Регистрация</a>
                <a href="<?= baseHref('/login') ?>" class="text-decoration-none text-reset">Вход</a>
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
