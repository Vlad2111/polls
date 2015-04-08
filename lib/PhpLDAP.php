<?php
    include_once 'CheckOS.php';
    include_once 'Log4php/Logger.php';
        Logger::configure(CheckOS::getConfigLogger());
class PhpLDAP {
    private $log;
    private $ldap;
    const LDAP_OPT_DIAGNOSTIC_MESSAGE='0x0032';
    
    public function __construct() {
        $this->ldap= $this->setConnectLDAP();
        $this->log= Logger::getLogger(__CLASS__);
    }
    //Установление соединения с LDAP сервером
    private function setConnectLDAP(){
        $array_ini= $this->getConfigLDAP();
        $ldaphost=$array_ini['ldaphost'];
        $ldapport=$array_ini['ldapport'];
        $ldap_temp=ldap_connect($ldaphost, $ldapport);
        if($ldap_temp){
                return $ldap_temp;
            } 
            else{   
                $this->log->ERROR('Ошибка соединения с LDAP сервером');
                throw new Exception('Ошибка соединения с LDAP сервером');
            }
    }
    //проверка пользователя
    public function checkUser(MAuthorization $auth){
        $bind=ldap_bind($this->ldap, "TECOM\\".$auth->getLogin(), $auth->getPasswordLDAP());
        if (!$bind) {
            if (ldap_get_option($this->ldap, self::LDAP_OPT_DIAGNOSTIC_MESSAGE, $extended_error)) {
                $this->log->ERROR('Ошибка соединения с LDAP сервером( $extended_error)');
                throw new Exception('Ошибка соединения с LDAP сервером( $extended_error)');
            } else {
                $this->log->ERROR('Ошибка соединения с LDAP сервером( неизвестная ошибка)');
                throw new Exception('Ошибка соединения с LDAP сервером( неизвестная ошибка)');
            }
        }
        return $bind;
        
    }
    //Проверка принадлежности пользователя к определенной группе
    public function checkGroupUser($group_ldap, $last_name, $first_name){
        $list_user_group=$this->getListGroupUsers($group_ldap);
        for($i=0; $i<count($list_user_group); $i++){
            if (count($list_user_group[$i])==2){
                if ($list_user_group[$i][0]==$last_name || $list_user_group[$i][1]==$first_name){
                    return $i; 
                }
            }
            else{
                if ($list_user_group[$i][0]==$last_name){//???
                    return $i; 
                }
            } 
                
        }        
    }
    //Получение списка членов группы
    public function getListGroupUsers($group_ldap){
        $search=ldap_search($this->ldap, $group_ldap, "cn=*"); //результаты поиска в группе
        $data_users = ldap_get_entries($this->ldap, $search); //Получаем все резульаты поиска
        $result=array();
        for ($i=0; $i < $data_users["count"]; $i++) { //Выбираем только Имя и Фамиию пользователей в группе
            $temp= $data_users[$i]["cn"][0];
            $result[$i]=  explode(" ", $temp);
        }
        return $result;
    }
    //Получаем настройки LDAP из конфиг. файла
    private function getConfigLDAP ($section='LDAP'){
        $array= parse_ini_file(CheckOS::getConfigConnectDb(), true);
        return $array[$section];
        }
    public function get($group_ldap){
        $search=ldap_search($this->ldap, 'DC=tecom,DC=nnov,DC=ru', "(memberOf=$group_ldap)");
         $data_users = ldap_get_entries($this->ldap, $search);
         return $data_users;
    }    
}
