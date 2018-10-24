<h3>Elenco articoli</h3>

<div>
    <table id="table-articles">    
        <thead>
            <tr>
                <th>ID</th>
                <th>Autore</th>
                <th>Data</th>
                <th>Titolo</th>
                <th>Sommario</th>  
                <th>Azioni</th>     
            </tr>        
        </thead>
        <tbody>
            <?php foreach ($this->articles as $article): ?>
            <tr>
                <td><?=$article->getId() ?></td>
                <td><?=$article->getAuthor() ?></td>
                <td><?=$article->getPublicationDate() ?></td>
                <td><?=$article->getTitle() ?></td>
                <td><?=$article->getSummary() ?></td>
                <td>
                    <span><a href="?action=editArticle&id=<?=$article->getId() ?>">Modifica</a></span> |
                    <span><a href="?action=deleteArticle&id=<?=$article->getId() ?>">Elimina</a></span>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
