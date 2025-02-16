<html>

<head>
    <title><?php echo $params['meta_title'] ?? 'Blog' ?></title>
    <meta name="description" content="<?php echo $params['meta_desc'] ?? 'Welcome to my Blog CMS' ?>">
    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>
    <div class="message">
        <?php
            if(!empty($params['info'])){
                $infoMessage = match ($params['info']){
                    'invalidlogin' => 'Invalid login or password',
                    'logout' => "You've been logged out",
                };
                echo $infoMessage;
            }
        ?>
    </div>
    <header>
        <div class="header-center">
            <a href="/">
                <h1>
                    Blog
                </h1>
            </a>
            <nav>
                <a href="/">Home</a>
                <a href="/?page=log-in">Log in</a>
            </nav>
        </div>
    </header>

    <?php require_once("Pages/blog/$page.php") ?>

    <footer>
        <p>Krzysztof Weichert</p>
    </footer>
</body>

</html>