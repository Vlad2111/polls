<html>
	<head><title>Таблица</title><meta charset="utf-8"></head>
		<body>
			<?php   
                            include_once 'class_bd.php';
                            include_once 'class_auth.php';
                            include_once 'class_create_conf.php';
                            include_once 'class_work_with_conf.php';
                                
                                class admin{
                                    public $id_admin;
                                    public function __construct($id_admin){
                                        $this->id_admin= $id_admin;
                                    }
                                    public function all_users(){
                                      $qu="select id_";  
                                    }
                                    
                                }                                
                                
                                
                            $qw=new auth('Иван', 1);
                            echo $qw->auth_user();   
                            
                            echo "<br>";
                            $re= new BD();
                            echo $re->user;
                            
                         
                            
                           
                            
                            
                        ?>
		</body>
</html>