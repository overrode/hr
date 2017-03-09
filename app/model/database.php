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
//        if (isset(self::$instance)) {
//            return self::$instance;
//        }

        // Creates the singleton instance for database connection
        global $config;
        try {
            self::$instance = new model_database($config['database']['server'], $config['database']['user'],
                $config['database']['password'], $config['database']['name']);
            echo "Conection is success!";
        }
        catch(PDOException $e) {
            $error_db = $e->getMessage();
            if($e->getMessage()) {
                echo $error_db;
            }
        }
        return self::$instance;
    }

    /**
     * Does a query on database and returns all rows.
     * @param $sql string query
     * @return array
     */
    public function get_rows($sql) {
        $result = $this->instance()->prepare($sql);
        $result->execute();
        $rows = array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $rows[] = $row;
        }
        return $rows;
    }

    /**
     * Does a query on database and returns first row.
     * @param $sql string query
     * @return array
     */
    public function get_row($sql) {

        $result = $this->instance()->prepare($sql);
        $tmp = $result->execute();
        //print_r($row1);
        $row = $result->fetchAll();
        print_r($row);
        return $row[0];
    }
}
