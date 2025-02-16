<section>
    <h2>Pages list</h2>
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
        foreach ($params['pages'] ?? [] as $page):
        ?>
        <tr>
            <td><?php echo htmlentities($page['id']) ?></td>
            <td><?php echo htmlentities($page['name']) ?></td>
            <td><a href="/?page=edit-page&id=<?php echo $page['id'];?>"><button>Edit</button></a></td>
        </tr>
        <?php endforeach; ?>
    </table>
</section>