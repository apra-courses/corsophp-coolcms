<div id="notify-container">
    <div id="notify-title"><?=$this->title ?></div>
    <div id="notify-message"><?=$this->message ?></div>
    <div id="notify-actions">
        <?php foreach ($this->actions as $action) : ?>
        <div class="notify-action">
            <span><a href="<?=$action['link']?>"</a><?=$action['title']?></span>
        </div>
        <?php endforeach; ?>
    </div>
</div>