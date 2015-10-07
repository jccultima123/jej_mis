<?php

class SetupModel
{
    /**
     * @var null
     */
    public $dbs = null;

    /**
    public function __construct()
    {

    }
     **/

    public function createDB($db, $user, $pass = NULL)
    {
        try {
            $this->dbs->exec("CREATE DATABASE `$db`;
                CREATE USER '$user'@'localhost' IDENTIFIED BY '$pass';
                GRANT ALL ON `$db`.* TO '$user'@'localhost';
                FLUSH PRIVILEGES;")
            or die(print_r($this->dbs->errorInfo(), true));

        } catch (PDOException $e) {
            die("DB ERROR: ". $e->getMessage());
        }
    }


    public function sys_install($admin_name, $admin_password, $database_host, $database_username, $database_password, $database_name)
    {
        //Checking database server
        $this->db_check();

        if (empty($admin_name) || empty($admin_password) || empty($database_host) || empty($database_username) || empty($database_name)) {
            $_SESSION["feedback_negative"][] = "All fields are required! Please re-enter.";
        } else {
            //INSTALLATION
            $connection = sql_connect($database_host, $database_username, $database_password);
            mysql_select_db($database_name, $connection);

            $file ='DB.sql';
            $f=fopen("config.user.php","w");

$output="<?php

    /*
     * Database Configurations
     */

        $type = 'mysql';
        $database = '".$database_name."';
        $host = '".$database_host."';
        $user = '".$database_username."';
        $password = '".$database_password."';
        $charset = 'utf8';

    /*
     * View Configurations
     * init (i.e.) = app > view > $header
     */
        $header = '_header';
        $footer = '_footer';
        $templates = '_templates';

?>";

            if (fwrite($f,$output)>0){
                fclose($f);
            }
            header("Location: 4");
            $_SESSION["feedback_positive"][] = "Configuration Done!";
        }
    }

    /**
     * Open the database connection
     */
    function sql_connect($database = false, $user, $password = false, $type = 'mysql', $host = 'localhost', $charset = 'utf8')
    {
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
        $this->dbs = new PDO($type.':host='.$host.';dbname='.$database.';charset=' . $charset, $user, $password, $options);
        if (defined(EMULATED_SQL)) {$this->dbs->setAttribute(PDO::ATTR_EMULATE_PREPARES, EMULATED_SQL);}
        $this->dbs->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    private $keywords = array(
        'ALTER', 'CREATE', 'DELETE', 'DROP', 'INSERT',
        'REPLACE', 'SELECT', 'SET', 'TRUNCATE', 'UPDATE', 'USE',
        'DELIMITER', 'END'
    );

    /**
     * Loads an SQL stream into the database one command at a time.
     *
     * @param $sqlfile The file containing the mysql-dump data.
     * @param $connection Instance of a PDO Connection Object.
     * @return boolean Returns true, if SQL was imported successfully.
     * @throws Exception
     */
    public function importSQL($sqlfile, $connection)
    {
        # read file into array
        $file = file($sqlfile);
        # import file line by line
        # and filter (remove) those lines, beginning with an sql comment token
        $file = array_filter($file,
            create_function('$line',
                'return strpos(ltrim($line), "--") !== 0;'));
        # and filter (remove) those lines, beginning with an sql notes token
        $file = array_filter($file,
            create_function('$line',
                'return strpos(ltrim($line), "/*") !== 0;'));
        $sql = "";
        $del_num = false;
        foreach($file as $line){
            $query = trim($line);
            try
            {
                $delimiter = is_int(strpos($query, "DELIMITER"));
                if($delimiter || $del_num){
                    if($delimiter && !$del_num ){
                        $sql = "";
                        $sql = $query."; ";
                        echo "OK";
                        echo "<br/>";
                        echo "---";
                        echo "<br/>";
                        $del_num = true;
                    }else if($delimiter && $del_num){
                        $sql .= $query." ";
                        $del_num = false;
                        echo $sql;
                        echo "<br/>";
                        echo "do---do";
                        echo "<br/>";
                        $connection->exec($sql);
                        $sql = "";
                    }else{
                        $sql .= $query."; ";
                    }
                }else{
                    $delimiter = is_int(strpos($query, ";"));
                    if($delimiter){
                        $connection->exec("$sql $query");
                        echo "$sql $query";
                        echo "<br/>";
                        echo "---";
                        echo "<br/>";
                        $sql = "";
                    }else{
                        $sql .= " $query";
                    }
                }
            }
            catch (\Exception $e)
            {
                echo $e->getMessage() . "<br /> <p>The sql is: $query</p>";
            }

        }
    }
}