<form method="POST" action="?action=confirmArticle">
    <div id="entity_fields">
        <div class="entity_row">
            <span>Autore</span>
            <input type="text" id="author" name="author" value="<?=App::getInstance()->getUserProfile('username') ?>" disabled>                    
        </div>        
        <div class="entity_row">
            <span>Titolo</span>
            <input type="text" id="title" name="title" size="60" autofocus>                    
        </div>
        <div class="entity_row">
            <span>Sommario</span>
            <input type="text" id="summary" size="60" name="summary">                    
        </div>
        <div class="entity_row">
            <span>Contenuto</span>
            <textarea cols="80" rows="10" id="content" name="content"></textarea>             
        </div>
        <div class="hidden_fields">
            <input type="hidden" id="mode" name="mode" value="<?=$this->mode ?>">
            <input type="hidden" id="author" name="author" value="<?=App::getInstance()->getUserProfile('username') ?>">
        </div>
    </div>
    <div id="entity_buttons">
        <button type="submit">Conferma</button>
        <button type="reset">Annulla</button>                    
    </div>     

    <?php if (strlen($this->validationMessage) > 0): ?>
    <div class="error-messages">
        <?=$this->validationMessage?>                
    </div>
    <?php endif; ?>              
</form>