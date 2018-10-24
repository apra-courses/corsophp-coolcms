<h3><?= $this->mode === 'insert' ? 'Nuovo ' : 'Modifica ' ?>articolo</h3>

<form method="POST" action="?action=confirmArticle">
    <div id="entity_fields">
        <div class="entity_row">
            <span>Autore</span>
            <input type="text" id="author" name="author" value="<?=App::getInstance()->getUserProfile('username') ?>" disabled>                    
        </div>      
        <?php if ($this->mode === 'update') : ?>
        <div class="entity_row">
            <span>Data</span>
            <input type="text" id="publicationDate" name="publicationDate" autofocus value="<?=$this->article ? $this->article->getPublicationDate() : '' ?>" disabled>                    
        </div>
        <?php endif; ?>
        <div class="entity_row">
            <span>Titolo</span>
            <input type="text" id="title" name="title" size="60" autofocus value="<?=$this->article ? $this->article->getTitle() : '' ?>">                    
        </div>
        <div class="entity_row">
            <span>Sommario</span>
            <input type="text" id="summary" size="60" name="summary" value="<?=$this->article ? $this->article->getSummary() : '' ?>">                    
        </div>
        <div class="entity_row">
            <span>Contenuto</span>
            <textarea cols="80" rows="10" id="content" name="content"><?=$this->article ? $this->article->getContent() : '' ?></textarea>             
        </div>
        <div class="hidden_fields">
            <?php if ($this->article) : ?>
            <input type="hidden" id="id" name="id" value="<?=$this->article->getId() ?>">
            <?php endif; ?>
            <input type="hidden" id="mode" name="mode" value="<?=$this->mode ?>">
            <input type="hidden" id="author" name="author" value="<?=App::getInstance()->getUserProfile('username') ?>">
        </div>
    </div>
    <div id="entity_buttons">
        <input type="submit" value="Conferma">
        <input type="reset" value="Annulla">
    </div>     

    <?php if (strlen($this->validationMessage) > 0): ?>
    <div class="error-messages">
        <?=$this->validationMessage?>                
    </div>
    <?php endif; ?>              
</form>