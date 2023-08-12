<?php
require_once('utils/db_connect.php');
require_once('repository/articleRepository.php');
require_once('repository/deleteRepository.php');
require_once('entity/article.php');

// Instancier l'ArticleRepository pour récupérer les données de l'article à supprimer
$articleRepository = new ArticleRepository($bdd);
if (isset($_GET['delete_id'])) {
    $articleId = $_GET['delete_id'];
    // Récupérer l'article à supprimer depuis la base de données
    $articleToDelete = $articleRepository->findArticleById($articleId);
    if ($articleToDelete) {
        // Instancier le deleteRepository en lui passant la connexion PDO
        $deleteRepository = new deleteRepository($bdd);
        // Appeler la méthode deleteArticle pour supprimer l'article correspondant
        $deleteRepository->deleteArticle($articleId);

        // Rediriger vers la page de gestion des articles après la suppression
        header("Location: manage.php");
        exit();
    } else {
        echo "L'article avec l'ID $articleId n'existe pas.";
        exit();
    }
} else {
    echo "ID d'article manquant.";
    exit();
}
exit();

?>
