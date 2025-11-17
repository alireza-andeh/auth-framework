<?php

namespace andeh\Framework\Infrastructure\Contract\Database;

use PDO;
use PDOException;
interface DbContextInterface{

    public function getConnection():?PDO ;

}