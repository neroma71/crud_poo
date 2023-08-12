<?php
    class deleteRepository
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function deleteArticle(int $id)
    {
        // Supprimer toutes les images associées à l'article
        $this->deleteImagesForArticle($id);

        // Supprimer l'article
        $query = 'DELETE FROM articles WHERE id = :id';
        $result = $this->db->prepare($query);
        $result->execute([':id' => $id]);
    }

    public function deleteImagesForArticle(int $articleId)
    {
        $query = 'DELETE FROM images WHERE article_id = :articleId';
        $result = $this->db->prepare($query);
        $result->execute([':articleId' => $articleId]);
    }
}