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
            <td><a href="/?page=edit&id=<?php echo $articles['id'];?>"><button>Edit</button></a> <a href="/?page=delete&id=<?php echo $articles['id'];?>"><button>Delete</button></a></td>
        </tr>
        <?php endforeach; ?>
    </table>
</section>