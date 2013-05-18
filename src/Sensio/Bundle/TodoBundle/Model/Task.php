<?php

namespace Sensio\Bundle\TodoBundle\Model;

class Task
{
    public $id;
    
    public $title;

    public $id_done;

    public function save(\PDO $db)
    {
        if(!$this->title) {
            throw new \LogicException('title must be set.');
        }
    
        if(!$this->id) {
            $stmt = $db->prepare('insert into todo (title) values(?)');
            $stmt->bindParam(1, $this->title);
            $stmt->execute();

            $this->id = $db->lastInsertId();
        }

    }
}
