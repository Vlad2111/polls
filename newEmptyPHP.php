<html>
	<head><title>Таблица</title><meta charset="utf-8"></head>
		<body>
			<?php   
                            include_once 'class_bd.php';
                            include_once 'class_auth.php';
                            include_once 'class_create_conf.php';
                            include_once 'class_work_with_conf.php';
                                
                                class admin{                                    
                                    public function users (){
                                        
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