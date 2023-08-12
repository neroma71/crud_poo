<?php
    require_once('utils/loadClass.php');
    require_once('utils/db_connect.php');

    $newArticle = new  ArticleRepository($bdd);

    $articles = $newArticle->findAllArticle();
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body class="bg-light">
        <header class="bg-white">
           <h1>MY CRUD</h1>
           <a href="createArticle.php">créer un article</a>
        </header>
        <div class="container">
            <div class="row justify-content-center">
            <?php foreach ($articles as $article): ?> 
                <div class="col-10 col-md-7 col-lg-7 bg-dark text-white link">
                    <a href="article.php?id=<?= $article->getId(); ?>" class="text-white">
                        <h4><?= htmlspecialchars($article->getIntro()); ?></h4>
                    </a>
                </div>
            <?php endforeach;  ?>
     </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    </body>
    </html>