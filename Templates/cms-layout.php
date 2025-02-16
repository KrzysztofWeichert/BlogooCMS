<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../assets/css/style-cms.css">
    <script src="https://cdn.tiny.cloud/1/r3yiwmmm6caht3ugx351hbq7w854lo00o89eo889nljw2hnt/tinymce/7.6.1-131/tinymce.min.js"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: '#mytextarea',
            skin: "oxide-dark",
            content_css: "dark"
        });
    </script>
</head>

<body>
    <div class="message">
        <?php
        if (!empty($params['info'])) {
            $infoMessage = match ($params['info']){
                'edited' => 'An article has been edited!',
                'created' => 'An article has been created!',
                'deleted' => 'An article has been deleted!',
                'HomeEdited' => 'An home page has been edited',
                default => 'Something went wrong'
            };
            echo $infoMessage;
        }
        ?>
    </div>
    <header>
        <h1>
            BlogCMS
        </h1>

    </header>

    <main>
        <aside>
            <ul>
                <li>
                    <a href="/">Back to blog</a>
                </li>
                <li>
                    <a href="/?page=cms">List</a>
                </li>
                <li>
                    <a href="/?page=new-article">Create article</a>
                </li>
                <li>
                    <a href="?page=edit-home&id=1">Edit home</a>
                </li>
                <li>
                    <a href="/?page=log-out">Log out</a>
                </li>
            </ul>
        </aside>
    </main>
    <?php require_once("pages/CMS/$page.php") ?>
    <footer>
        <p>Krzysztof Weichert</p>
    </footer>
</body>

</html>