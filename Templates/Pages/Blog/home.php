<main>
        <?php 
        echo $params['page']['description'];
        ?>
        <div class="articles-list">
        <h2>Lista artykułów:</h2>
        <?php 
        foreach ($params['articles'] ?? [] as $articles):
                echo '<h2>' . $articles['title'] . '</h2>';
                echo showShortText($articles['description']) . '<br>';
                echo "<a href=/?page=show&article=" . $articles['URL'] . "><button class='btn'>Czytaj dalej...</button></a>";
        endforeach;
        ?>
        </div>
</main>