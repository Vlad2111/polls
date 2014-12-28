<html>
	<head><title>Таблица</title><meta charset="utf-8"></head>
		<body>
			<?php   
                            include_once 'class_bd.php';
                            include_once 'class_auth.php';
                            include_once 'class_create_conf.php';
                            include_once 'class_work_with_conf.php';
                            include_once 'class_admin.php';
                            $qw=new auth('Иван', 1);
                            echo $qw->auth_user();   
                            
                            echo "<br>";
                            $re= new BD();
                            echo $re->port;
                            
                            echo "<hr>";
                            $admin= new admin(1);                            
                            var_dump($admin->all_users());
                            echo "<br>";
                            $admin->edit_user(4, 'first_name', 'new');
                           $admin->add_user('ВА', 'ВА', 'ВА', 'ВА', 'ВА');
                         
                            
                         
                            
                           
                            
                            
                        ?>
		</body>
</html>