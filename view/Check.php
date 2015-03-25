<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Check
 *
 * @author User
 */
class Check {
   public static function checkRoleUser($role_user, $name_pages){
        if ($name_pages="administration"){
            if($role_user!=3){
            header('HTTP/1.1 200 OK');
            header('Location: quiz.php');
            exit();}
    }
   }
}
