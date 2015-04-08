<?php
define(LDAP_OPT_DIAGNOSTIC_MESSAGE, 0x0032);

$ldaphost="192.168.12.1";
$ldapport="389";
$login="TECOM\\porandaykin.a";
$password="Tecom1";
$ldap=ldap_connect($ldaphost, $ldapport) or die("Cant connect to ldap Server");
echo "Произошло подключение к серверу $ldap";
$bind= ldap_bind($ldap);
echo "<br>анонимная привязка ";
var_dump($bind);
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
//Полный путь к группе 
$memberof = "CN=VPNusers,OU=MainOffice,DC=tecom,DC=nnov,DC=ru";
//Откуда начинаем искать 
$base = "DC=tecom,DC=nnov,DC=ru";
// фильтр по которому будем аутентифицировать пользователя
$filter = "sAMAccountName=porandaykin.a";
// Проверим, является ли пользователь членом указанной группы."
                  $result = ldap_search($ldap, $base, "(&(memberOf= ".$memberof.")(".$filter."))");
                  // Получаем количество результатов предыдущей проверки
                  $result_ent = ldap_get_entries($ldap,$result);
 var_dump($result_ent);
?>
