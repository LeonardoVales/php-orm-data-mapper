<?php

namespace Vales\DataMapperOrm\Drivers;

use Vales\DataMapperOrm\QueryBuilder\QueryBuilderInterface;

class Mysql implements DriverInterface
{
    private $pdo;
    private $query;

    public function connect(array $config) 
    {        
        $dsn_pattern = 'mysql:host=%s;dbname=%s';

        if (empty($config['server'])) {
            throw new \InvalidArgumentException('Server is required');
        }

        if (empty($config['database'])) {
            throw new \InvalidArgumentException('Database is required');
        }
        
        if (empty($config['user'])) {
            throw new \InvalidArgumentException('User is required');
        }

        $dsn     = sprintf($dsn_pattern, $config['server'], $config['database']);
        $user    = $config['user'];
        $pass    = $config['pass'] ?? null;
        $options = $config['options'] ?? [];

        $this->pdo = new \PDO($dsn, $user, $pass, $options);
        //habilita o retorno de erros
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function close() 
    {
        $this->pdo = null;
    }

    public function setQueryBuilder(QueryBuilderInterface $query) 
    {        
        $this->query = $query;
    }

    public function execute() 
    {        
        $this->sth = $this->pdo->prepare((string)$this->query);
        $results = $this->sth->execute($this->query->getValues());

        return $results;
    }

    public function lastInsertId() 
    {
        return $this->pdo->lastInsertId();
    }

    public function first() 
    {
        return $this->sth->fetch(\PDO::FETCH_ASSOC);
    }

    public function all() 
    {
        return $this->sth->fetchAll(\PDO::FETCH_ASSOC);
    }
}