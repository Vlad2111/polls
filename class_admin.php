<?php
 class admin{
    public $id_admin;
    public $BD;
    
    public function __construct($id_admin){//Получаем на вход ид админа
        $this->id_admin= $id_admin;
        $this->BD= new BD();
    }
    
    public function all_users(){ //Выводим всех пользователей кроме админа в виде массива                                   
        $query_admin= $this->BD;
        $array_users = $query_admin->result_array("alluser");
        $key=0;
        for($i=0;$i<count($array_users);$i++){
            if($array_users[$i][0]!=$this->id_admin){
                for($p=0;$p<count($array_users[0]);$p++){                                              
                    $users[$key][$p]=$array_users[$i][$p];
                    $key++;
                }                                                
            }else if(!$key==0) $key--; continue;
        }
        return $users;
    }
    
     public function delete_user($id_user){
        $qu="delete from alluser where id_user=".$id_user;
        $delete_user=$this->BD;                                       
        return $delete_user->query_db($qu);                                       
    }
                                    
    public function edit_user($id_user, $cell, $value){
        $qu="update alluser set ".$cell."='" .$value."' where id_user=".$id_user;
        $edit_user= $this->BD;
        $edit_user->query_db($qu);
    }
    public function add_user($last_name, $first_name, $patronymic, $type=null, $email=null){
        if(isset($last_name) && isset($first_name) && isset($patronymic)){
            $qu="insert into alluser values ('".$last_name."', '".$first_name."', '".$patronymic."', '".$type."', '".$email."');";
            $add_user=new BD();
            $add_user->query_db($qu);
            
        }
        else return false;
    }
                                    
                                    
}       
?>