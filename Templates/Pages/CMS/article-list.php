<section>
    <h2>Articles list</h2>
    <table>
        <tr>
            <th>
                ID
            </th>
            <th style="width: 60%;">
                Title
            </th>
            <th>
                Action
            </th>
        </tr>
        <?php
        foreach ($params['articles'] ?? [] as $articles):
        ?>
            <tr>
                <td><?php echo htmlentities($articles['id']) ?></td>
                <td><?php echo htmlentities($articles['title']) ?></td>
                <td><a href="/?page=edit&id=<?php echo $articles['id']; ?>"><button>Edit</button></a> <a href="/?page=delete&id=<?php echo $articles['id']; ?>"><button>Delete</button></a></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <div class="pagination">
        <?php
        if ($params['articlesNumber'] > 10):
            $pageNumber = $params['pagenumber'];
            if ($params['pagenumber'] > 1) {
                $pageNumber--;
                echo "<a href='/?page=cms&pagenumber=$pageNumber'><<</a>";
            }
            for ($i = 1; $i <= ceil((int)$params['articlesNumber'] / 10); $i++):
        ?>
                <a href="/?page=cms&pagenumber=<?php echo $i ?>"><?php echo $i ?></a>
        <?php endfor;

            if ($params['pagenumber'] < ceil((int)$params['articlesNumber'] / 10)) {
                $pageNumber++;
                echo "<a href='/?page=cms&pagenumber=$pageNumber'>>></a>";
            }
        endif;
        ?>
    </div>
</section>