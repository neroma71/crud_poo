<?php
    class ArticleRepository
    {
        private PDO $db;

        public function __construct(PDO $db)
        {
            $this->setDb($db);
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

        public function findAllArticle()
        {
            $query = 'SELECT * FROM articles ORDER BY id DESC';
            $result = $this->db->prepare($query);
            $result->execute(); 

            $articlesDatas = $result->fetchAll();
            $articles = [];
            foreach ($articlesDatas as $article) {
                $articles[] = new Article($article);
            }
            return $articles;
        }

        public function findArticleById(int $id)
{
    $query = 'SELECT a.*, i.image FROM articles a LEFT JOIN images i ON a.id = i.article_id WHERE a.id = :id';
    $result = $this->db->prepare($query);
    $result->bindValue(':id', $id, PDO::PARAM_INT);
    $result->execute();

    $articleData = $result->fetch(PDO::FETCH_ASSOC);
    if ($articleData) {
        $article = new Article($articleData);

        // Récupérer toutes les images associées à l'article
        $images = [];
        do {
            if ($articleData['image']) {
                $images[] = $articleData['image'];
            }
        } while ($articleData = $result->fetch(PDO::FETCH_ASSOC));

        // Ajouter les images à l'objet Article
        $article->setImages($images);

        return $article;
    }

    return null; // Si l'article n'est pas trouvé, on renvoie null.
}

public function createArticle(Article $article)
{
    $req = $this->db->prepare('INSERT INTO articles (title, intro, content) VALUES (:title, :intro, :content)');
    $req->execute([
        ':title' => $article->getTitle(),
        ':intro' => $article->getIntro(),
        ':content' => $article->getContent()
    ]);
    $articleId = $this->db->lastInsertId();
    return $articleId;
}
}