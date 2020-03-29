<?php

/**
 * Class Users
 */
class Users extends Entity
{
    /** @var  */
    protected $account;

    /**
     * Users constructor.
     * @param array $request
     */
    public function __construct($request = []) {
        parent::__construct($request);
        $this->isAnonymous();
    }

    /**
     * @throws Exception
     */
    protected function init(): void {
        /** @var string $query */
        $query = <<<SQL
CREATE TABLE IF NOT EXISTS users (
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(225) NOT NULL,
password VARCHAR(225) NOT NULL
)
SQL;
        // Throw an exception when query fails.
        if(!$this->database->query($query)) {
            throw new \Exception($this->database->error);
        }
    }

    /**
     * @return bool
     */
    public function login(): bool {
        $password = md5($this->request['password']);
        $query = sprintf("SELECT id FROM users WHERE username = '%s' AND password = '%s'",
            $this->request['username'],
            $password
        );

        $result = $this->database->query($query);
        if(1 == $result->num_rows) {
            $account = $result->fetch_object();
            $account->username = $this->request['username'];
            $_SESSION['account'] = $account;

            return TRUE;
        }
        return FALSE;
    }

    /**
     * @return bool
     */
    public function isAnonymous(): bool {
        //
        if(!is_null($this->account)) {
            return FALSE;
        }

        //
        if(!empty($_SESSION['account'])) {
            $this->account = $_SESSION['account'];
            return FALSE;
        }
        return TRUE;
    }

    /**
     *
     */
    public function logout(): void {
        unset($_SESSION['account']);
    }

    /**
     * @return string
     */
    public function getUsername(): string {
        return $this->account->username;
    }
}