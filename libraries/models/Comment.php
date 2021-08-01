<?php 

require_once('libraries/models/Model.php');

class Comment extends Model {

    protected $table = 'comments';

    /**
     * Retourne la liste des commentaires associés à l'article en question
     * 
     * @param integer $id
     * @return array
     */
    public function findAllWithArticle(int $id):array 
    {
        $query = $this->pdo->prepare("SELECT * FROM comments WHERE article_id = :article_id");
        $query->execute(['article_id' => $id]);
        $commentaires = $query->fetchAll();
        return $commentaires;
    }

    /**
     * Insère un commentaire dans la base de données
     * 
     * @param string $author
     * @param string $content
     * @param string $article_id
     * @return void
     */
    public function insert(string $author, string $content, int $article_id): void 
    {
        $query = $this->pdo->prepare('INSERT INTO comments SET author = :author, content = :content, article_id = :article_id, created_at = NOW()');
        $query->execute(compact('author', 'content', 'article_id'));
    }
}