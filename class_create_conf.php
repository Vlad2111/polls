<?php
class add_config{                                    
    public function creat_txt($text){
        $fp=fopen('project_duke.conf', 'w+');
        fwrite($fp, $text);
        fclose($fp);
    }
    public function create_text(){
        $text="##Project Dike \n"
        . "##Configuration for database postgresql \n"
        . "##Type\t Host\t Port\t DBname\t User\t Password\n"
        . "PostgreSQL\t localhost\t 5432\t dike\t postgres\t 1";      
        $this->creat_txt($text);
    }                                 
}
?>