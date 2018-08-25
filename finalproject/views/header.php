<!DOCTYPE html>

<html>

    <head>

        <!-- http://getbootstrap.com/ -->
        <link href="/css/bootstrap.min.css" rel="stylesheet"/>

        <link href="/css/styles.css" rel="stylesheet"/>

        <?php if (isset($title)): ?>
            <title>MyMentor: <?= htmlspecialchars($title) ?></title>
        <?php else: ?>
            <title>MyMentor</title>
        <?php endif ?>

        <!-- https://jquery.com/ -->
        <script src="/js/jquery-1.11.3.min.js"></script>

        <!-- http://getbootstrap.com/ -->
        <script src="/js/bootstrap.min.js"></script>

        <script src="/js/scripts.js"></script>

    </head>

    <body>
        
        <div class="container">

            <div id="top">
                <div>
                    <a href="/"><img alt="MyMentor" src="/img/mymentorlogo.gif"/></a>
                </div>
                <?php if (empty($_SESSION["id"])): ?>
                    <ul class="nav nav-pills nav-justified">
                        <li><a href="main_page.php">Home</a></li>
                        <li><a href="logout.php"><strong>LOG OUT</strong></a></li>
                    </ul>
                <?php endif ?>
                <?php if (!empty($_SESSION["id"])): ?> 
                <ul class="nav nav-pills nav-justified">
                        <li><a href="main_page.php">Home</a></li>
                        <li><a href="logout.php"><strong>LOG OUT</strong></a></li>
                    </ul>
                <?php endif ?>
            </div>
            <div id="middle">
                