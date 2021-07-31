<?php 

require_once('libraries/models/Model.php');

class Comment extends Model {
    
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
     * Retourne un commentaire de la base de données grâce à son identifiant
     * 
     * @param integer $id
     * @return array|bool Le commentaire si on le trouve, false si on ne le trouve pas
     */
    public function find(int $id)
    {
        $query = $this->pdo->prepare('SELECT * FROM comments WHERE id = :id');
        $query->execute(['id' => $id]);
        $comment = $query->fetch();
        return $comment;
    }

    /**
     * Supprime un commentaire de la base de données grâce à son identifiant
     * 
     * @param integer $id
     * @return void
     */
    public function delete(int $id): void 
    {
        $query = $this->pdo->prepare('DELETE FROM comments WHERE id = :id');
        $query->execute(['id' => $id]);
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