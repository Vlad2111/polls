<?php
/*
* Copyright (c) 2015 Tecom LLC
* All rights reserved
*
* Исключительное право (c) 2015 пренадлежит ООО Теком
* Все права защищены
*/

/**
Класс, инкапсулирующий операции с сервером LDAP

@author smirnov.a
*/
class LdapOperations
{
	private $ldaphost="192.168.12.1";
	private $ldapport="389";
	private $login="TECOM\\ldapquery";
	private $password="Tecom1";
	private $base = "DC=tecom,DC=nnov,DC=ru";

	private $ldap = null;

	/** Подключение к серверу LDAP. Метод обязательно должен быть вызван перед вызовом любых других методов */
	const LDAP_OPT_DIAGNOSTIC_MESSAGE = 0x0032;
	public function connect()
	{
		$this->ldap=ldap_connect($this->ldaphost, $this->ldapport);
		if (!$this->ldap) {
			throw new Exception("Cant connect to ldap Server");
		}
		ldap_set_option($this->ldap, LDAP_OPT_REFERRALS, 0);
		ldap_set_option($this->ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
		$bind = ldap_bind($this->ldap, $this->login, $this->password);

		if (!$bind) {
			if (ldap_get_option($this->$ldap, self::LDAP_OPT_DIAGNOSTIC_MESSAGE, $extended_error)) {
				$this->ldap = null;
				throw new Exception("Error Binding to LDAP: $extended_error");
			} else {
				$this->ldap = null;
				throw new Exception("Error Binding to LDAP: No additional information is available");
			}
		}
	}
	
	/** Проверка данных пользователя входящего в систему
	@return Boolean
	*/
	public function checkUser(MAuthorization $auth)
	{
	    $ldap = ldap_connect($this->ldaphost, $this->ldapport);
		if (!$ldap) {
			throw new Exception("Cant connect to ldap Server");
		}
		
        @$bind = ldap_bind($ldap, "TECOM\\".$auth->getLogin(), $auth->getPasswordLDAP());
        
        ldap_unbind($ldap); 
        return $bind;   
        
    }
	
	/** Вспомогательный метод для работы с поиском в LDAP */
	private function searchLDAP($query, $returnProperties)
	{
		$result = ldap_search($this->ldap, $this->base, $query, $returnProperties);
		if (!$result) {
			throw new Exception("Error performing LDAP search");
		}

		$result_ent = ldap_get_entries($this->ldap,$result);
		if (!$result_ent) {
			throw new Exception("Error fetching LDAP search result");
		}

		return $result_ent;
	}
	 
	/** Проверка принадлежности пользователя группе 
	@return Boolean
	*/
	public function checkLDAPGroupMembership($samaccountname, $groupName)
	{
		if (!$this->ldap) {
			throw new Exception("Not connected to LDAP server");
		}

		$result_ent = $this->searchLDAP("(sAMAccountName={$samaccountname})", array('memberof'));

		return count(preg_grep("/^CN=$groupName/", array_values($result_ent[0]['memberof']))) !=0;
	}
	
	//возвращает список групп пользователя
    public function getGroupLDAPUser($samaccountname)
    {
        if (!$this->ldap) {
			throw new Exception("Not connected to LDAP server");
		}

		$result_ent = $this->searchLDAP("(sAMAccountName={$samaccountname})", array('memberof'));
		if(isset($result_ent[0])){
		    if(isset($result_ent[0]['memberof'])){
		        $count=$result_ent[0]['memberof']['count'];
                for($i=0; $i<$count; $i++){
                    $arr_temp[$i]=$result_ent[0]['memberof'][$i];
                }
                    
                return $arr_temp;
            }
        }
    }


	/** Возвращает список аккаунтов, начинающихся с заданного префикса как список массивов следующего вида:
	(
		[ 
			'name' => 'Luke Skywalker', <- человеко-читаемое имя для отображения в интерфейсе
			'sAMAccountName' => 'skyluke'  <- название аккаунта
		],
		[
			'name' => 'Mara Jade Skywalker',
			'sAMAccountName' => 'skymara'
		]
	)
	*/
	const UF_ACCOUNT_DISABLED=2;
	const UF_WORKSTATION_TRUST_ACCOUNT=4096;
	const TECH_ACCOUNT='OU=service connections users';
	public function getLDAPAccountNamesByPrefix($prefix) 
	{
		if (!$this->ldap) {
			throw new Exception("Not connected to LDAP server");
		}

		$result_ent = $this->searchLDAP("(&(objectClass=person)(sAMAccountName=*{$prefix}*))", 
			array('name', 'useraccountcontrol', 'sAMAccountName', 'sn', 'givenName', 'mail', 'distinguishedName'));
        
		$names = array();
        //var_dump($result_ent);
		$iter = function($value, $key) use (&$names) 
		{
			if (is_array($value) && 
				isset($value['useraccountcontrol']) &&
				($value['useraccountcontrol'][0] & self::UF_ACCOUNT_DISABLED) != self::UF_ACCOUNT_DISABLED && 
				($value['useraccountcontrol'][0] & self::UF_WORKSTATION_TRUST_ACCOUNT) != self::UF_WORKSTATION_TRUST_ACCOUNT &&
				!stristr($value['dn'], self::TECH_ACCOUNT)) 
			{
				array_push($names, array('name'=>$value['name'][0], 'sAMAccountName'=>$value['samaccountname'][0], 'sn'=>$value['sn'][0],       'givenName'=>$value['givenname'][0], 'mail'=>$value['mail'][0]));
			}
		};

		array_walk($result_ent, $iter);
		return $names;
	}

	/** Возвращает список групп, начинающихся с заданного префикса как список массивов следующего вида:
	(
		[ 
			'name' => 'Jedi Knights',   <- человеко-читаемое имя для отображения в интерфейсе
			'sAMAccountName' => 'jedi'  <- название аккаунта
		],
		[
			'name' => 'Sith',
			'sAMAccountName' => 'sith'
		]
	)
	*/
	public function getLDAPGroupNamesByPrefix($prefix)
	{
		if (!$this->ldap) {
			throw new Exception("Not connected to LDAP server");
		}

		$result_ent = $this->searchLDAP("(&(objectClass=group)(sAMAccountName=*{$prefix}*))", array('name', 'sAMAccountName'));
		$names = array();
		$iter = function($value, $key) use (&$names)
		{
			if (is_array($value)) {
				array_push($names, array('name'=>$value['name'][0], 'sAMAccountName'=>$value['samaccountname'][0]));
			}
		};

		array_walk($result_ent, $iter);
		return $names;
	}

	/** Возвращает список членов группы, как список массивов следующего вида:
	(
		[ 
			'name' => 'Luke Skywalker',   <- человеко-читаемое имя для отображения в интерфейсе
			'sAMAccountName' => 'luke'    <- название аккаунта
		],
		[
			'name' => 'Obi-Wan Kenobi',
			'sAMAccountName' => 'kenobi'
		]
	)
	*/
	public function getGroupMembers($group)
	{
		if (!$this->ldap) {
			throw new Exception("Not connected to LDAP server");
		}

		$result_ent=$this->searchLDAP("(&(objectClass=group)(sAMAccountName=$group))", array('dn', 'distinguishedName'));
		$groupDN = $result_ent[0]['dn'];

		$result_ent=$this->searchLDAP("(&(objectClass=person)(memberOf=$groupDN))", 
			array('name', 'sAMAccountName', 'useraccountcontrol', 'sn', 'givenName', 'mail', 'distinguishedName'));
		$names = array();
		$iter = function($value, $key) use (&$names)
		{
			if (is_array($value) &&
				$value['useraccountcontrol'][0] != null &&
				($value['useraccountcontrol'][0] & self::UF_ACCOUNT_DISABLED) != self::UF_ACCOUNT_DISABLED &&
				($value['useraccountcontrol'][0] & self::UF_WORKSTATION_TRUST_ACCOUNT) != self::UF_WORKSTATION_TRUST_ACCOUNT &&
				!stristr($value['dn'], self::TECH_ACCOUNT))
				
			{
				// array_push($names, array('cn' => $value['cn'][0], 'useraccountcontrol' => $value['useraccountcontrol'][0]));
				array_push($names, array('name'=>$value['name'][0], 'sAMAccountName'=>$value['samaccountname'][0], 'sn'=>$value['sn'][0], 'givenName'=>$value['givenname'][0], 'mail'=>$value['mail'][0]));
			}
		};

		array_walk($result_ent, $iter);
		return $names;
	}
	
	public function getSubGroups($group)
	{
		if (!$this->ldap) {
			throw new Exception("Not connected to LDAP server");
		}

		$result_ent=$this->searchLDAP("(&(objectClass=group)(sAMAccountName=$group))", array('dn'));
		$groupDN = $result_ent[0]['dn'];
		$result_ent=$this->searchLDAP("(&(objectClass=group)(memberOf=$groupDN))", 
			array('name', 'sAMAccountName'));
		$names = array();

		$iter = function($value, $key) use (&$names)
		{
			if (is_array($value)) {
				array_push($names, array('name'=>$value['name'][0], 'sAMAccountName'=>$value['samaccountname'][0]));
			}
		};

		array_walk($result_ent, $iter);
		return $names;
	}

	public function usageExamples()
	{
		header('Content-Type: text/plain; charset=utf-8');
		$samaccountname = "smirnov.a";

		$ldap = new LdapOperations();
		$ldap->connect();

		/*echo "Подтверждение принадлежности пользователя к группе unixusers: ";
		var_dump($ldap->checkLDAPGroupMembership($samaccountname, 'unixusers'));

		echo "Подтверждение принадлежности пользователя к группе Managers: ";
		var_dump($ldap->checkLDAPGroupMembership($samaccountname, 'Managers'));

		echo "Подтверждение принадлежности пользователя к группе Aliens: ";
		var_dump($ldap->checkLDAPGroupMembership($samaccountname, 'Aliens'));

		echo "Users with names starting with smi: ";
		var_dump($ldap->getLDAPAccountNamesByPrefix('smi'));

		echo "Groups with names starting with rnd: ";
		var_dump($ldap->getLDAPGroupNamesByPrefix('Interns.nn'));
		*/
		echo "Members of group Employeess: ";
		var_dump($ldap->getGroupLDAPUser('arutyunyan.r'));
		
		//var_dump($ldap->getSubGroups('Employees'));
			}
}

//LdapOperations::usageExamples();
?>
