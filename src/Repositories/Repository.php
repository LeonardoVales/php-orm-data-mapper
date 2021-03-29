<?php

namespace Vales\DataMapperOrm\Repositories;

use Vales\DataMapperOrm\Drivers\DriverInterface;
use Vales\DataMapperOrm\Entities\Entity;
use Vales\DataMapperOrm\Entities\EntityInterface;
use Vales\DataMapperOrm\QueryBuilder\Select;

class Repository
{
    protected $driver;

    public function __construct(DriverInterface $driver)
    {
        $this->driver = $driver;
    }

    public function setEntity(string $entity)
    {

    }

    public function getEntity(): EntityInterface
    {

    }

    public function insert(EntityInterface $entity): EntityInterface
    {

    }

    public function update(EntityInterface $entity): EntityInterface
    {

    }

    public function delete(EntityInterface $entity): EntityInterface
    {

    }

    public function first($id = null): ?EntityInterface
    {
        $this->driver->setQueryBuilder(new Select('users'));
        $this->driver->execute();
        $data = $this->driver->first();

        return new Entity($data);
    }

    public function all(array $condition = []): EntityInterface
    {
        $this->driver->setQueryBuilder(new Select('users'));
        $this->driver->execute();
        $data = $this->driver->all();

        $entities = [];
        foreach ($data as $row) {
            $entities[] = new Entity($row);
        }

        return $entities;
    }
}