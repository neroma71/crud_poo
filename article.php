<?php
require_once('utils/loadClass.php');
require_once('utils/db_connect.php');

$articleRepository = new ArticleRepository($bdd);

if (isset($_GET['id'])) {
    $articleId = (int)$_GET['id'];
    $article = $articleRepository->findArticleById($articleId);

    if ($article) {
        $images = $article->getImages();
    } else {
        echo "Article not found!";
        exit();
    }
} else {
    echo "Invalid article ID!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $article->getTitle() ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="css/article.css">
</head>

<body>
    <header>
        <h1><?= $article->getTitle() ?></h1>
    </header>
    <div class="container">
        <div class="row d-flex justify-content-around flex-wrap mt-5">
            <div class="col-6 text">
                <h3 class="mb-5"><?= $article->getIntro() ?></h3>
                <p class="content"><?= $article->getContent() ?></p>
            </div>
            <div class="col-6">
                <div class="lightbox">
                    <div class="navigate">
                        <div class="next">next</div>
                        <div class="prev">prev</div>
                    </div>
                    <?php foreach ($images as $image) : ?>
                        <img src="upload/<?= $image ?>" alt="Image">
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="js/lightbox.js"></script>
</body>

</html>
