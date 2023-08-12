<?php
require_once('utils/loadClass.php');
require_once('utils/db_connect.php');

// Instancier l'ArticleRepository pour récupérer les données de l'article à modifier
$articleRepository = new ArticleRepository($bdd);
// Instancier l'image uploader
$imageUploader = new ImageUploader('upload/');
// Vérifier si l'ID de l'article à modifier est passé en paramètre de la requête
if (isset($_GET['id'])) {
    $articleId = (int)$_GET['id'];
    // Récupérer l'article à modifier depuis la base de données
    $articleToUpdate = $articleRepository->findArticleById($articleId);
    if ($articleToUpdate) {
        // Vérifier si le formulaire a été soumis pour mettre à jour l'article
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données du formulaire
            $newTitle = $_POST['title'];
            $newIntro = $_POST['intro'];
            $newContent = $_POST['content'];
        
            // Mettre à jour les propriétés de l'article
            $articleToUpdate->setTitle($newTitle);
            $articleToUpdate->setIntro($newIntro);
            $articleToUpdate->setContent($newContent);
        
            // Gérer les nouvelles images téléchargées
            if (isset($_FILES['image']) && is_array($_FILES['image']['name'])) {
                $newImages = array();
                foreach ($_FILES['image']['name'] as $index => $imageName) {
                    // Vérifier si le fichier a été téléchargé avec succès
                    if ($_FILES['image']['error'][$index] === UPLOAD_ERR_OK) {
                        $imageFile = array(
                            'name' => $imageName,
                            'type' => $_FILES['image']['type'][$index],
                            'tmp_name' => $_FILES['image']['tmp_name'][$index],
                            'error' => $_FILES['image']['error'][$index],
                            'size' => $_FILES['image']['size'][$index],
                        );
                        try {
                            $newImages[] = $imageUploader->uploadImage($imageFile);
                        } catch (Exception $e) {
                            echo 'Erreur lors de l\'upload de l\'image : ' . $e->getMessage();
                        }
                    }
                }
                // Si de nouvelles images ont été ajoutées, les ajouter à l'article
                if (!empty($newImages)) {
                    $articleToUpdate->setImages($newImages);
                }
            }
        
            // Instancier l'ArticleUpdater et mettre à jour l'article dans la base de données
            $articleUpdater = new updateRepository($bdd);
            $articleUpdater->updateArticle($articleToUpdate, $articleId);
        
            // Rediriger vers la page de l'article modifié
            header("Location: article.php?id=" . $articleId);
            exit();
        }
    } else {
        echo "L'article avec l'ID $articleId n'existe pas.";
        exit();
    }
} else {
    echo "ID d'article manquant.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'article</title>
    <link rel="stylesheet" href="css/modif.css" />
</head>
<body>
    
    <form method="post" action="modifier_article.php?id=<?= $articleId ?>" enctype="multipart/form-data">
        <p>
            <input type="text" name="title" value="<?= htmlspecialchars($articleToUpdate->getTitle()) ?>">
        </p>
        <p>
            <input type="text" name="intro" value="<?= htmlspecialchars($articleToUpdate->getIntro()) ?>">
        </p>
        <p>
            <textarea name="content"><?= htmlspecialchars($articleToUpdate->getContent()) ?></textarea>
        </p>
        <p>
            <!-- Afficher les images associées à l'article -->
            <?php foreach ($articleToUpdate->getImages() as $image) : ?>
                <img src="upload/<?= $image ?>" alt="Image">
            <?php endforeach; ?>
        </p>
        <p>
            <input type="file" name="image[]" multiple>
        </p>
        <p>
            <input type="submit" value="Enregistrer les modifications">
        </p>
    </form>
</body>
</html>
