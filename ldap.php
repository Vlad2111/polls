<?php //
//define(LDAP_OPT_DIAGNOSTIC_MESSAGE, 0x0032);

$ldaphost="192.168.12.1";
$ldapport="389";
$login="TECOM\\ldapquery";
$password="Tecom1";
$ldap=ldap_connect($ldaphost, $ldapport) or die("Cant connect to ldap Server");
 ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);
 ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
echo "Произошло подключение к серверу $ldap";
/*$bind= ldap_bind($ldap);
echo "<br>анонимная привязка ";
var_dump($bind);*/
echo "<br>Привязка под пользователем $login  ";
$bind1=ldap_bind($ldap, $login, $password);
var_dump($bind1);

echo "<BR>";
if (!$bind1) {
    if (ldap_get_option($ldap, LDAP_OPT_DIAGNOSTIC_MESSAGE, $extended_error)) {
        echo "Error Binding to LDAP: $extended_error";
    } else {
        echo "Error Binding to LDAP: No additional information is available.";
    }
}
echo "<hr>";
echo "Подтверждение принадлежности пользователя к определённойй группе: ";
$memberof = "CN=VPNusers,OU=MainOffice,DC=tecom,DC=nnov,DC=ru";
$base = "DC=tecom,DC=nnov,DC=ru";
$samaccountname = "ldapquery";
//    $arr=array('cn', 'mail', 'samaccountname', 'objectclass');
    $arr=array('objectclass');
    $arr2=array();
    $result = ldap_search($ldap, $base, "(sAMAccountName={$samaccountname})", $arr);
    $result_ent = ldap_get_entries($ldap,$result);
    echo "<pre>";
// var_dump($result_ent[0]['objectclass']['count']);
var_dump(checkGroupLDAP($ldap, $base,$samaccountname, array('CN=VPNusers,OU=MainOffice,DC=tecom,DC=nnov,DC=ru')));
 echo "</pre>";
 function checkGroupLDAP($ldap, $base, $samaccountname, $array_group){
     $arr=array('memberof');
     $result = ldap_search($ldap, $base, "(sAMAccountName={$samaccountname})", $arr);
     $result_ent = ldap_get_entries($ldap,$result);
     $count=$result_ent[0]['memberof']['count'];
     for ($b=0; $b<count($array_group); $b++){
        for($i=0; $i<$count; $i++){
            if ($result_ent[0]['memberof'][$i]==$array_group[$b]){
                return true;
            }
        }
     }
     return false;
 }
  function checkGroupLDAP($ldap, $base_dn, $samaccountname, $array_group){
        $arr=array('memberof');
        $result = ldap_search($ldap, $base_dn, "(sAMAccountName={$samaccountname})", $arr);
        $result_ent = ldap_get_entries($ldap, $result);
        $count=$result_ent[0]['memberof']['count'];
        for ($b=0; $b<count($array_group); $b++){
            for($i=0; $i<$count; $i++){
                if ($result_ent[0]['memberof'][$i]==$array_group[$b]){
                    return true;
                }
            }
        }
        return false;
    }
?>
