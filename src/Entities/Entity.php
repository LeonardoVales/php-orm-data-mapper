<?php

namespace Vales\DataMapperOrm\Entities;

class Entity implements EntityInterface
{
    protected $data;
    protected $table;

    public function __construct()
    {
        
    }

    public function setAll(array $data)
    {
        $this->data = $data;
    }

    public function getAll(): array
    {
        return $this->data;
    }

    public function getTable(): string
    {
        return 'users';
    }
}