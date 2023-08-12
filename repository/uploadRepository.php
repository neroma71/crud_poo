<?php
    require_once('entity/ImageUploader.php');

   class UploadRepository
   {
       private PDO $db;
       private ImageUploader $imageUploader;
   
       public function __construct(PDO $db, ImageUploader $imageUploader)
       {
           $this->setDb($db);
           $this->imageUploader = $imageUploader;
       }
   
        /**
        * Get the value of db
        */ 
        public function getDb()
        {
               return $this->db;
        }
 
        /**
         * Set the value of db
         *
         * @return  self
         */ 
        public function setDb($db)
        {
               $this->db = $db;
 
               return $this;
        }
   
       public function insertImageForArticle($articleId, $imageFile)
       {
           // Utiliser l'ImageUploader pour uploader l'image
           $imageFileName = $this->imageUploader->uploadImage($imageFile);
   
           // Insérer l'image avec l'ID de l'article comme clé étrangère
           $req = $this->db->prepare('INSERT INTO images (article_id, image) VALUES (:articleId, :image)');
           $req->execute([
               ':articleId' => $articleId,
               ':image' => $imageFileName
           ]);
       }
   }
