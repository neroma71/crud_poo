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
        <link rel="stylesheet" href="css/manage.css">
    </head>
    <body>
        <header>
           <h1>MY CRUD</h1>
        </header>
        <section class="container">
            <div class="row">
        <ul class="list-group">
                <?php foreach ($articles as $article): ?> 
            <li class="list-group-item d-flex justif-content-evenly align-items-center">
            <p class="flex-grow-1"> <?= htmlspecialchars($article->getTitle()); ?></p>
            <button type="button" class="btn btn-primary ms-auto mx-1"><a href="modifier_article.php?id=<?= $article->getId(); ?>">Modifier</a></button>
            <button type="button" class="btn btn-danger ms-auto"><a href="delete.php?delete_id=<?= $article->getId() ?>">Supprimer</a></button>
            </li>
                <?php endforeach;  ?>
            </ul>
                </div>
        </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    </body>
    </html>