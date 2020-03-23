<?php

/**
 * Class Stuff
 */
class Stuff
{
    /** @var mysqli */
    protected $database;

    /** @var array */
    protected $request;

    /**
     * Stuff constructor.
     * @param $request
     * @throws Exception
     */
    public function __construct($request = [])
    {
        $this->database = new mysqli('database', 'lamp', 'lamp', 'lamp');
        $this->init();
        $this->request = $request;
    }

    /**
     * @throws Exception
     */
    protected function init(): void {
        /** @var string $query */
        $query = <<<SQL
CREATE TABLE IF NOT EXISTS stuff (
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(60) NOT NULL,
description VARCHAR(225) NOT NULL
)
SQL;
        // Throw an exception when query fails.
        if(!$this->database->query($query)) {
            throw new \Exception($this->database->error);
        }
    }

    /**
     * @return string
     */
    public function create(): string {
        $query = 'INSERT INTO stuff (name, description) VALUES (?, ?)';
        $stmt = $this->database->prepare($query);
        $stmt->bind_param('ss', $this->request['name'], $this->request['description']);

        $stmt->execute();
        $stmt->close();

        return $this->database->insert_id;
    }

    /**
     * @return array
     */
    public function findAll(): array {
        $query = 'SELECT id, name, description FROM stuff';
        $result = $this->database->query($query);

        $records = [];
        while ($item = $result->fetch_object()) {
            $records[] = $item;
        }

        return $records;
    }

    /**
     * @return object
     */
    public function findById(): object {
        $query = "SELECT id, name, description FROM stuff WHERE id = " . $this->request['id'];
        $result = $this->database->query($query);

        return $result->fetch_object();
    }

    /**
     * @param string $id
     * @return bool
     */
    public function deleteById($id): bool {
        return $this->database->query("DELETE FROM stuff WHERE id={$id}");
    }

    /**
     * @return bool|int
     */
    public function updateItem() {
        if(!empty($this->request['name']) && !empty($this->request['description'])) {
          $query = "UPDATE stuff SET name = '{$this->request['name']}', description = '{$this->request['description']}' WHERE id = {$this->request['id']}";
          $this->database->query($query);

          return $this->database->affected_rows;
        }
        return FALSE;
    }

    /**
     *
     */
    public function __destruct()
    {
        $this->database->close();
    }
}