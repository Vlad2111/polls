<?php
class work_with_conf {
    public $type_db;
    public $params;
    public $host;
    public $port;
    public $dbname;
    public $user;
    public $password_bd;
    
    public function __get($name) {
        return $this->$name;
    }
    public function __construct($value) {
        $this->type_db=$value;
    }
    public function open_conf(){
        $array_text= file('project_duke.conf');
        $col_array=count($array_text);
        for($i=0; $i<$col_array; $i++){
            $text=$array_text[$i];
            if (strstr($text, $this->type_db)) {
                $params=explode("\t",$text);                
            }
                else continue;                
        }
        $this->host = trim($params[1]);
        $this->port = trim($params[2]);
        $this->dbname = trim ($params[3]);
        $this->user = trim ($params[4]);
        $this->password_bd = trim ($params[5]);
    }                                
}
?>
