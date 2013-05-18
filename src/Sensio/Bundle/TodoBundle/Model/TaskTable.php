<?php

namespace Sensio\Bundle\TodoBundle\Model;

class TaskTable
{
    const RECORD_CLASS = 'Sensio\\Bundle\\TodoBundle\\Model\\Task';

    private $db;

    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    public function countAll()
    {
        $stmt = $this->db->query('SELECT COUNT(*) from todo');

        return (int) $stmt->fetchColumn();
    }
    
    public function findAll()
    {
        $stmt = $this->db->query('SELECT * from todo');

        return $stmt->fetchAll(\PDO::FETCH_CLASS, self::RECORD_CLASS);
    }

    public function find($id)
    {
        $stmt = $this->db->prepare('SELECT * from todo where id = :id');
        $stmt->bindParam('id', $id, \PDO::PARAM_INT);
        $stmt->execute();

        return current($stmt->fetchAll(\PDO::FETCH_CLASS, self::RECORD_CLASS));
    }


}
