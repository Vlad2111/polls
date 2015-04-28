<?php
    include_once 'CheckOS.php';
    include_once 'Log4php/Logger.php';
        Logger::configure(CheckOS::getConfigLogger());
class PhpLDAP {
    private $ldap;
    private $base_dn;
    private $log;
    public $user_ldap=false;
    private $auth;
    const LDAP_OPT_DIAGNOSTIC_MESSAGE='0x0032';
    
    public function __construct(MAuthorization $auth) {
        $this->ldap= $this->setConnectLDAP();
        $this->log= Logger::getLogger(__CLASS__);
        $this->auth=$auth;
        $this->checkUser($this->auth);
    }
    //Установление соединения с LDAP сервером
    private function setConnectLDAP(){
        $array_ini= $this->getConfigLDAP();
        $ldaphost=$array_ini['ldaphost'];
        $ldapport=$array_ini['ldapport'];
        $this->base_dn=$array_ini['basedn'];
        $ldap_temp=ldap_connect($ldaphost, $ldapport);
        ldap_set_option($this->ldap, LDAP_OPT_REFERRALS, 0);
        ldap_set_option($this->ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
        if($ldap_temp){
                return $ldap_temp;
            } 
            else{   
                $this->log->ERROR('Ошибка соединения с LDAP сервером');
//                throw new Exception('Ошибка соединения с LDAP сервером');
            }
    }
    //проверка пользователя
    public function checkUser(){
        $bind=ldap_bind($this->ldap, "TECOM\\".$this->auth->getLogin(), $this->auth->getPasswordLDAP());
        if ($bind) {
            $this->user_ldap=true;
        }
        else{
            
//            if (ldap_get_option($this->ldap, self::LDAP_OPT_DIAGNOSTIC_MESSAGE, $extended_error)) {
//                $this->log->ERROR('Ошибка соединения с LDAP сервером( $extended_error)');
////                throw new Exception('Ошибка соединения с LDAP сервером( $extended_error)');
//            } else {
//                $this->log->ERROR('Ошибка соединения с LDAP сервером( неизвестная ошибка)');
////                throw new Exception('Ошибка соединения с LDAP сервером( неизвестная ошибка)');
//            }
        }
    }
    //Проверка person    
    private function checkObjectclass(){
        $arr=array('objectclass');
        $result = ldap_search($this->ldap, $this->base_dn, "(sAMAccountName={$this->auth->getLogin()})", $arr);
        $result_ent = ldap_get_entries($this->ldap, $result);
        $count=$result_ent[0]['objectclass']['count'];
        for($i=0; $i<$count; $i++){
            if($result_ent[0]['objectclass'][$i]=="person"){
                return true;
            }
        }
        return $result_ent;
    }
    //Возращает данные пользователя
    public function getDataUserLDAP(){
        if($this->checkObjectclass($this->auth)){$arr=array('displayname', 'samaccountname', 'mail');
            $temp_arr=array();
            $result = ldap_search($this->ldap, $this->base_dn, "(sAMAccountName={$this->auth->getLogin()})", $arr);
            $result_ent = ldap_get_entries($this->ldap, $result);
            foreach($arr as $value){
                $temp_arr[$value]=$result_ent[0][$value][0];
            }
            $fi=  explode(' ', $temp_arr["displayname"]);
            $return=array();
            $return['first_name']=$fi[0];
            $return['last_name']=$fi[1];
            $return['login']=$temp_arr["samaccountname"];
            $return['mail']=$temp_arr["mail"];
        return $return;}
    }
    //Проверка принадлежности пользователя к группе(массив групп)
    public function checkGroupLDAP($array_group){
        $return=array();
        if($this->checkObjectclass($this->auth)){
            $array_group_user=$this->getGroupLDAPUser();
            for ($b=0; $b<count($array_group); $b++){
                for($i=0; $i<count($array_group_user); $i++){
                    if ($array_group_user[$i]==$array_group[$b]){
                        $return[$i]=$array_group[$b];
                    }
                }
                return true;
            }
            return false;
        }
    }
    //возвращает список групп пользователя
    public function getGroupLDAPUser(){
        if($this->checkObjectclass($this->auth)){$arr=array('memberof');
            $arr_temp=array();
            $result = ldap_search($this->ldap, $this->base_dn, "(sAMAccountName={$this->auth->getLogin()})", $arr);
            $result_ent = ldap_get_entries($this->ldap, $result);
            $count=$result_ent[0]['memberof']['count'];
                for($i=0; $i<$count; $i++){
                    $arr_temp[$i]=$result_ent[0]['memberof'][$i];
            }
            
            return $arr_temp;}
    }
    //Получаем настройки LDAP из конфиг. файла
    private function getConfigLDAP ($section='LDAP'){
        $array= parse_ini_file(CheckOS::getConfigConnectDb(), true);
        return $array[$section];
    }
}
