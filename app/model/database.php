<?php

/**
 * Class for handling database connections.
 */
class model_database extends PDO {

    // Connection object
    public $connection = NULL;

    // Singleton instance for database connection
    static $instance = NULL;

    /**
     * Connects to database.
     *
     * @param $server string server
     * @param $user string user
     * @param $password string password
     * @param $name string database
     */
    public function __construct($server, $user, $password, $name) {

        $dsn = "mysql:host=$server;dbname=$name";
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => FALSE,
        ];

        parent::__construct($dsn, $user, $password, $opt);
    }

    /**
     * Returns singleton database connection. If connection doesn't exist it is created.
     */
    public static function instance() {

        // First it checks if connection was already created
        if (isset(self::$instance)) {
            return self::$instance;
        }

        // Creates the singleton instance for database connection
        global $config;
        self::$instance = new model_database($config['database']['server'], $config['database']['user'],
            $config['database']['password'], $config['database']['name']);

        return self::$instance;
    }

    /**
     * Does a query on database and returns all rows.
     * @param $sql string query
     * @return array
     */
    public function getRows($sql) {
        $result = $this->instance()->prepare($sql);
        $result->execute();
        $rows = array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $rows[] = $row;
        }
        return $rows;
    }

    /**
     * Executes a query on database and returns the number of affected columns.
     * @param $sql string query
     * @return int
     */
    public function getNrOfRows($sql) {
        $result = $this->instance()->prepare($sql);
        $result->execute();
        $row = $result->fetch();
        return $row;
    }
}
