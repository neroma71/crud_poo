<?php
require_once('utils/loadClass.php');
require_once('utils/db_connect.php');

$articleRepository = new ArticleRepository($bdd);
$uploadRepository = new UploadRepository($bdd, new ImageUploader("upload/")); 

$newArticleData = array(
    'title' => $_POST['title'],
    'intro' => $_POST['intro'],
    'content' => $_POST['content']
);
$newArticle = new Article($newArticleData);
try {
    // Insérez l'article dans la base de données en utilisant la méthode createArticle
    $articleId = $articleRepository->createArticle($newArticle, null); // Passer null car il n'y a pas d'image pour le moment
    
    if (isset($_FILES['image']) && !empty($_FILES['image']['name'][0])) {
        // Nombre total de fichiers téléchargés
        $totalFiles = count($_FILES['image']['name']);

        // Parcourir chaque fichier téléchargé
        for ($i = 0; $i < $totalFiles; $i++) {
            // Récupérer les données du fichier actuel
            $imageFile = array(
                'name' => $_FILES['image']['name'][$i],
                'type' => $_FILES['image']['type'][$i],
                'tmp_name' => $_FILES['image']['tmp_name'][$i],
                'error' => $_FILES['image']['error'][$i],
                'size' => $_FILES['image']['size'][$i]
            );

            // Insérer l'image avec l'ID de l'article comme clé étrangère
            $uploadRepository->insertImageForArticle($articleId, $imageFile);
        }
    } else {
        // Cas où aucune image n'a été téléchargée
    }

    // Rediriger vers la page de l'article créé
    header("Location: article.php?id=" . $articleId);
    exit();
} catch (Exception $e) {
    // Gérer les exceptions ici, par exemple, afficher un message d'erreur approprié
    echo "Une erreur s'est produite : " . $e->getMessage();
}
