<?php
    class Article
    {
        private int $id;
        private string $title;
        private string $intro;
        private string $content;
        private array $images = array();
        

        public function __construct(array $datas)
        {
                 $this->hydrate($datas);    
        }

         /**
         * Get the value of title
         */ 
        public function getTitle()
        {
                return $this->title;
        }

        /**
         * Set the value of title
         *
         * @return  self
         */ 
        public function setTitle($title)
        {
                $this->title = $title;

                return $this;
        }
        /**
         * Get the value of intro
         */ 
        public function getIntro()
        {
                return $this->intro;
        }

        /**
         * Set the value of intro
         *
         * @return  self
         */ 
        public function setIntro($intro)
        {
                $this->intro = $intro;

                return $this;
        }

        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }
        /**
         * Get the value of content
         */ 
        public function getContent()
        {
                return $this->content;
        }

        /**
         * Set the value of content
         *
         * @return  self
         */ 
        public function setContent($content)
        {
                $this->content = $content;

                return $this;
        }

         /**
         * Get the value of image
         */ 
        public function getImages(): array
        {
            return $this->images;
        }
    
        public function addImage(string $imageFileName): void
        {
            $this->images[] = $imageFileName;
        }
        /**
         * Set the value of image
         *
         * @return  self
         */ 
/**
         * Set the value of images
         *
         * @return  self
         */ 
        public function setImages($images)
        {
                $this->images = $images;

                return $this;
        }
        public function hydrate(array $datas)
        {
    if (isset($datas["id"])) {
        $this->setId($datas["id"]);
    }
    if (isset($datas["title"])) {
        $this->setTitle($datas["title"]);
    }
    if (isset($datas["intro"])) {
        $this->setIntro($datas["intro"]);
    }
    if (isset($datas["content"])) {
        $this->setContent($datas["content"]);
    }

    // Effacer les images précédentes pour éviter les doublons
    $this->setImages([]);

    // Ajouter les nouvelles images à l'objet Article
    if (isset($datas["image"])) {
        if (is_array($datas["image"])) {
            foreach ($datas["image"] as $imageFileName) {
                $this->addImage($imageFileName);
            }
        } else {
            $this->addImage($datas["image"]);
        }
             }
        }
}