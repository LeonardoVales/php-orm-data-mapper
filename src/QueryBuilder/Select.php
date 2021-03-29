<?php 

namespace Vales\DataMapperOrm\QueryBuilder;

class Select implements QueryBuilderInterface
{
    private $query;
    private $values = [];

    public function __construct(string $table, array $conditions = [])
    {
        $this->query = $this->makeSql($table);
    }

    private function makeSql($table)
    {
        $sql = sprintf('SELECT * FROM %s', $table);

        return $sql;
    }

    public function getValues() : array
    {

    }

    public function __toString()
    {
        return $this->query;
    }
}