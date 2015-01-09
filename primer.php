<html>
	<head><title>Таблица</title><meta charset="utf-8"></head>
		<body>
<?php
   
    include_once 'class_bd.php';
    include_once 'class_auth.php';
    
    class AddLog
    {
        private $log;
        public function __construct() {
            $this->log = Logger::getLogger('myLogger');
        }
        public function Fatal($name){
            $this->log->fatal($name);
        }
        public function Error($name){
            $this->log->error($name);
        }
        public function Warn($name){
            $this->log->warn($name);
        }
        public function Info($name){
            $this->log->info($name);
        }
        public function Debug($name){
            $this->log->debug($name);
        }
       
    }
        $foo= new AddLog();
        $foo->info('add new logger');
                              
                      try{ 
                            echo "<br>";
                          
                            $re= new BD();
                            echo $re->connect_db();
                            echo"<br>";
                            echo BD::query_db($re->connect_db(), "select * from auth");
                                
                            echo "<br>";
                            $qw=new auth('Иван', 1);
                            echo $qw->auth_user(); 
                            }
                            catch (Exception $e){
                                echo 'Поймано исключение:'.$e->getMessage();
                            }
?>

                    	</body>
</html>