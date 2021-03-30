<?php

namespace Vales\DataMapperOrm\Entities;

class Entity implements EntityInterface
{
    protected $data;
    protected $table;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function setAll(array $data)
    {
        $this->data = $data;
        return $this; //retorna a própria classe
    }

    public function getAll(): array
    {
        return $this->data;
    }

    public function getTable(): string
    {
        if (!empty($this->table)) {
            return $this->table;
        }

        $table = get_class($this); 
        $table = explode('\\', $table);
        $table = array_pop($table);

        return strtolower($table);
    }
}