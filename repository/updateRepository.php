<?php
    class updateRepository
    {
        private PDO $db;
    
        public function __construct(PDO $db)
        {
            $this->db = $db;
        }
    
        public function updateArticle(Article $article, int $id)
        {
            // Mise à jour des autres propriétés de l'article
            $query = 'UPDATE articles SET title = :title, intro = :intro, content = :content WHERE id = :id';
            $result = $this->db->prepare($query);
            $result->execute([
                ':title' => $article->getTitle(),
                ':intro' => $article->getIntro(),
                ':content' => $article->getContent(),
                ':id' => $id
            ]);
    
            // Mise à jour des images associées à l'article
            $this->updateImagesForArticle($article, $id);
        }
    
        public function updateImagesForArticle(Article $article, int $id)
        {
            // Supprimer toutes les images existantes pour cet article
            $queryDelete = 'DELETE FROM images WHERE article_id = :id';
            $resultDelete = $this->db->prepare($queryDelete);
            $resultDelete->execute([':id' => $id]);
    
            // Insérer les nouvelles images pour cet article
            $queryInsert = 'INSERT INTO images (article_id, image) VALUES (:articleId, :image)';
            $resultInsert = $this->db->prepare($queryInsert);
            foreach ($article->getImages() as $image) {
                $resultInsert->execute([
                    ':articleId' => $id,
                    ':image' => $image
                ]);
            }
        }
    }