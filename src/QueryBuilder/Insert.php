<?php 

namespace Vales\DataMapperOrm\QueryBuilder;

class Insert implements QueryBuilderInterface
{

    private $query;
    protected $values = [];

    public function __construct(string $table, array $data = [])
    {
        $this->query = $this->makeSql($table, $data);
        $this->values = array_values($data);
    }

    private function makeSql($table, $data)
    {
        $sql = sprintf('INSERT INTO %s', $table);

        $columns = array_keys($data);
        $values = array_fill(0, count($data), '?');

        $columns = implode(', ', $columns);
        $values = implode(', ', $values);

        $sql .= sprintf(' (%s) VALUES (%s)', $columns, $values);

        return $sql;
    }

    public function getValues() : array
    {
        return $this->values;
    }

    public function __toString()
    {
        return $this->query;
    }
}