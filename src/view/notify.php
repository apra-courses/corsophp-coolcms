<html>
    <head>
        <meta charset="UTF-8">
        <title>Notifica</title>
        <link rel="icon" href="/img/favicon.png" type="image/png" />
        <link rel="stylesheet" href="/css/style.css" type="text/css" />
    </head>
    <body>
        <div id="notify-container">
            <div id="notify-title"><?= $this->title ?></div>
            <div id="notify-message"><?= $this->message ?></div>
            <div id="notify-actions">
                <?php foreach ($this->actions as $action) : ?>
                    <div class="notify-action">
                        <span><a href="<?= $action['link'] ?>"</a><?= $action['title'] ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </body>
</html>