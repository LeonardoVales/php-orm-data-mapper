<?php

namespace Vales\DataMapperOrm\Repositories;

use Vales\DataMapperOrm\Drivers\DriverInterface;
// use Vales\DataMapperOrm\Entities\Entity;
use Vales\DataMapperOrm\Entities\EntityInterface;
use Vales\DataMapperOrm\QueryBuilder\Select;
use App\Entities\Users as Entity;

class Repository
{
    protected $driver;

    public function __construct(DriverInterface $driver)
    {
        $this->driver = $driver;
    }

    public function setEntity(string $entity)
    {
        $reflection = new \ReflectionClass($entity);

        if (!$reflection->implementsInterface(EntityInterface::class)) {
            throw new \InvalidArgumentException('{$entity} not implements interface' . EntityInterface::class);
        }

        $this->entity = $entity;
    }

    public function getEntity(): EntityInterface
    {
        if (is_null($this->entity)) {
            throw new \Exception('entity is required');
        }

        if (is_string($this->entity)) {
            return new $this->entity;
        }
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
        $entity = $this->getEntity();
        $table = $entity->getTable();

        $conditions = [];

        if (!is_null($id)) {
            $conditions[] = ['id', $id];
        }

        $this->driver->setQueryBuilder(new Select($table, $conditions));
        $this->driver->execute();
        $data = $this->driver->first();

        if (!$data) {
            return null;
        }

        return $entity->setAll($data);
    }

    public function all(array $conditions = []): array
    {
        $entity = $this->getEntity();
        $table = $entity->getTable();

        $this->driver->setQueryBuilder(new Select($table, $conditions));
        $this->driver->execute();
        $data = $this->driver->all();

        $entities = [];
        foreach ($data as $row) {
            $entities[] = $entity->setAll($row);
        }

        return $entities;
    }
}