<?php

namespace App\Database;

use App\Database\Transaction;
use PDO;

abstract class ActiveRecordActions
{
    protected array $data = [];

    /**
     * Update generico.
     *
     * @param string $tableName
     * @return void
     */
    private function update(string $tableName)
    {
        $sql = "update {$tableName} set ";
        foreach (array_keys($this->data) as $field) {
            if ($field != 'id') {
                $sql .= "{$field} = :{$field},";
            }
        }
        $sql = rtrim($sql, ',');

        $sql .= ' where id = :id';

        return $this->execute($sql, $this->data);
    }

    /**
     * Insert generico.
     *
     * @param string $tableName
     * @return void
     */
    private function insert(string $tableName)
    {
        $sql = "insert into {$tableName}(" . implode(',', array_keys($this->data)) . ') values(:' . implode(',:', array_keys($this->data)) . ')';

        return $this->execute($sql, $this->data);
    }

    /**
     * Chama metodo update ou insert de acordo com parametro id.
     *
     * @return void
     */
    public function save()
    {
        $class = get_class($this);
        $tableName = constant("{$class}::TABLENAME");

        $saved = array_key_exists('id', $this->data) ? $this->update($tableName) : $this->insert($tableName);

        return $saved;
    }

    /**
     * Busca por id.
     *
     * @param string $fields
     * @param integer|null $id
     * @return mixed
     */
    public function getById(string $fields = '*', ?int $id = null)
    {
        $class = get_class($this);
        $tableName = constant("{$class}::TABLENAME");

        if (array_key_exists('id', $this->data)) {
            $id = $this->data['id'];
        }

        $sql = "select {$fields} from {$tableName} where id = :id";

        $prepare = $this->execute($sql, ['id' => $id], true);

        return $prepare->fetchObject($class);
    }

    /**
     * Busca todos.
     *
     * @param string $fields
     * @return void
     */
    public function all(string $fields = '*')
    {
        $class = get_class($this);
        $tableName = constant("{$class}::TABLENAME");

        $sql = "select {$fields} from {$tableName}";
        $conn = Transaction::get();

        $query = $conn->query($sql);
        return $query->fetchAll(PDO::FETCH_CLASS, static::class);
    }

    /**
     * Delete
     *
     * @param integer|null $id
     * @return void
     */
    public function delete(?int $id = null)
    {
        $class = get_class($this);
        $tableName = constant("{$class}::TABLENAME");

        if (array_key_exists('id', $this->data)) {
            $id = $this->data['id'];
        }

        return $this->execute("delete from {$tableName} where id = :id", ['id' => $id]);
    }

    /**
     * Executa query
     *
     * @param string $sql
     * @param array $execute
     * @param boolean $returnPrepare
     * @return void
     */
    private function execute(string $sql, array $execute, bool $returnPrepare = false)
    {
        $this->data = [];

        $conn = Transaction::get();

        $prepare = $conn->prepare($sql);

        $executed = $prepare->execute($execute);

        if ($returnPrepare) {
            return $prepare;
        }

        return $executed;
    }
}
