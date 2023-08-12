<?php
class ImageUploader
{
    private string $uploadDir;

    public function __construct(string $uploadDir)
    {
        $this->uploadDir = $uploadDir;
    }

    public function uploadImage(array $imageFile):string
    {
            // ... Vérifications de la validité de l'image ici ...
            $maxFileSize = 2 * 1024 * 1024; // 2 Mo (en octets)
            $uploadDir = "upload/";
            if ($imageFile['error'] === UPLOAD_ERR_OK) {
                // Vérifier la taille du fichier
                if ($imageFile['size'] > $maxFileSize) {
                    throw new Exception("Le fichier est trop lourd. La taille maximale autorisée est de 2 Mo.");
                }

                $imageFileType = exif_imagetype($imageFile['tmp_name']);
                $allowedTypes = array(IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF);
                if (!in_array($imageFileType, $allowedTypes)) {
                    throw new Exception("Mauvais format d'image. Veuillez télécharger une image JPEG, PNG ou GIF.");
                }
        // Renommer le fichier pour le rendre unique
        $imageFileName = uniqid() . '_' . basename($imageFile['name']);
        $targetPath = $this->uploadDir . $imageFileName;

        // Déplacer le fichier téléchargé vers le dossier de destination
        if (move_uploaded_file($imageFile['tmp_name'], $targetPath)) {
            return $imageFileName;
        } else {
            throw new Exception("Erreur lors de l'upload de l'image.");
        }
    }
}
}