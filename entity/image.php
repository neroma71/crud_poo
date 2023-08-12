<?php
    class image
    {
        private int $id;
        private int $articleId;
        private string $image;

        public function __construct(array $datas)
        {
                 $this->hydrate($datas);    
        }

        /**
         * Get the value of image
         */ 
        public function getImage()
        {
                return $this->image;
        }

        /**
         * Set the value of image
         *
         * @return  self
         */ 
        public function setImage($image)
        {
                $this->image = $image;

                return $this;
        }

        /**
         * Get the value of articleId
         */ 
        public function getArticleId()
        {
                return $this->articleId;
        }

        /**
         * Set the value of articleId
         *
         * @return  self
         */ 
        public function setArticleId($articleId)
        {
                $this->articleId = $articleId;

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

        public function hydrate(array $datas)
        {
                if(isset($datas["id"])){
                   $this->setId($datas["id"]);
                }
                if (isset($datas["articleId"])) { 
                   $this->setArticleId($datas["articleId"]); 
                }
                if(isset($datas["image"])){
                   $this->setImage($datas["image"]);
                }
        }
        
    }