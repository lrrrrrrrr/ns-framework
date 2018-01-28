<?php

namespace framework\Component;

use PDO;

class Command
{
    private $db;
    private $sql;
    private $properties;

    public function __construct(PDO $db, $sql, array $properties = [])
    {
        $this->db = $db;
        $this->sql = $sql;
        $this->properties = $properties;
    }

    /**
     * @return array
     */
    public function get()
    {
        $sth = $this->db->prepare($this->sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $sth->execute($this->properties);
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * @return array
     */
    public function getAll()
    {
        $sth = $this->db->prepare($this->sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $sth->execute($this->properties);
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function execute(): int
    {
        return $this->db->exec($this->sql);
    }

    /**
     * @return int
     */
    public function executePrepared()
    {
        $sth = $this->db->prepare($this->sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);

        return $sth->execute($this->properties);
    }

}