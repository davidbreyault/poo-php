<?php

require_once('libraries/database.php');

abstract class Model {

    protected $pdo;
    protected $table;

    public function __construct() 
    {
        $this->pdo = getPdo();
    }

    /**
     * Retourne la liste des items en question
     * 
     * @return array
     */
    public function findAll(?string $order = ""): array 
    {
        $sql = "SELECT * FROM {$this->table}";
        if ($order) {
            $sql .= " ORDER BY " . $order;
        }
        $resultats = $this->pdo->query($sql);
        $items = $resultats->fetchAll();
        return $items;
    }

    /**
     * Retourne un item grâce à son identifiant
     * 
     * @param integer $id
     */
    public function find(int $id)
    {
        $query = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id"); 
        $query->execute(['id' => $id]);
        $item = $query->fetch();
        return $item;
    }

    /**
     * Supprime un item grâce à son identifiant
     * 
     * @param integer $id
     * @return void
     */
    public function delete(int $id): void 
    {
        $query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $query->execute(['id' => $id]);
    }
}