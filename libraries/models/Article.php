<?php

require_once('libraries/models/Model.php');

class Article extends Model {
    
    protected $table = 'articles';
    /**
     * Retourne la liste des articles
     * 
     * @return array
     */
    public function findAll(): array 
    {
        $resultats = $this->pdo->query('SELECT * FROM articles ORDER BY created_at DESC');
        $articles = $resultats->fetchAll();
        return $articles;
    }

    /**
     * Retourne un article grâce à son identifiant
     * 
     * @param integer $id
     */
    public function find(int $id)
   {
       $query = $this->pdo->prepare("SELECT * FROM articles WHERE id = :article_id"); 
       $query->execute(['article_id' => $id]);
       $article = $query->fetch();
       return $article;
   }

//    /**
//     * Supprime un article grâce à son identifiant
//     * 
//     * @param integer $id
//     * @return void
//     */
//     public function delete(int $id): void 
//     {
//         $query = $this->pdo->prepare('DELETE FROM articles WHERE id = :id');
//         $query->execute(['id' => $id]);
//     }
}