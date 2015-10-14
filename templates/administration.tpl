<html>
    <head>
        <title>{$title}</title>
        <meta charset="UTF-8">
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script src="js/jquery-2.1.3.min.js"></script>
        <link rel="stylesheet" href="css/styles.css">
		<link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">	
		<link href="css/simple-sidebar.css" rel="stylesheet">
		<link href="css/navbar-fixed-top.css" rel="stylesheet">
        <script src="js/bootstrap.min.js"></script>
    </head>
    <body>
        <script type="text/javascript">
            function setNewPassword(value){
                switch(value){
                    case "Yes":
                        $(".enter_new_password").show();
                        $("#set_new_password").val("");
                        break;
                    case "No":
                        $(".enter_new_password").hide();
                        $("#set_new_password").val("***");
                        break;
                }
            }
            function otherInformation(value){
                switch(value){
                    case "show":
                        $("#show_other_information_user").hide();
                        $("#hide_other_information_user").show();
                        $(".other_information_user").show();                        
                        break;
                    case "hide":
                        $("#show_other_information_user").show();
                        $("#hide_other_information_user").hide();
                        $(".other_information_user").hide();
                        break;
                }
            }
            function checkEmailUser(value){
                if(value != "") {
                    $.post("checkForms.php", { action: "check", field: "email user", name: value }, function( data ) {
                    if(data == 1){
					    $("#inp").removeClass("has-error");
                        $("#inp").addClass("has-success");
					    $("#glyphicon").removeClass("glyphicon-remove");
					    $("#glyphicon").addClass("glyphicon-ok");
                        document.getElementById("button-create").disabled = false;
                    }
                    else{
					    $("#inp").removeClass("has-success");
					    $("#inp").addClass("has-error");
					    document.getElementById("button-create").disabled = true;
					    $("#glyphicon").removeClass("glyphicon-ok");
					    $("#glyphicon").addClass("glyphicon-remove");
                    }
                  });  
			    }
			    else{
				    $("#inp").removeClass("has-success");
				    $("#inp").removeClass("has-error");
				    $("#glyphicon").removeClass("glyphicon-ok");
				    $("#glyphicon").removeClass("glyphicon-remove");
				    document.getElementById("button-create").disabled = true;
			    }
            }
            function checkLoginUser(value){
                if(value != "") {
                    $.post("checkForms.php", { action: "check", field: "login user", name: value }, function( data ) {
                    if(data == 0){
					    $("#inpLog").removeClass("has-error");
                        $("#inpLog").addClass("has-success");
					    $("#glyphiconLog").removeClass("glyphicon-remove");
					    $("#glyphiconLog").addClass("glyphicon-ok");
                        document.getElementById("button-create").disabled = false;
                    }
                    else{
					    $("#inpLog").removeClass("has-success");
					    $("#inpLog").addClass("has-error");
					    document.getElementById("button-create").disabled = true;
					    $("#glyphiconLog").removeClass("glyphicon-ok");
					    $("#glyphiconLog").addClass("glyphicon-remove");
                    }
                  });  
                }
                else{
				    $("#inpLog").removeClass("has-success");
				    $("#inpLog").removeClass("has-error");
				    $("#glyphiconLog").removeClass("glyphicon-ok");
				    $("#glyphiconLog").removeClass("glyphicon-remove");
				    document.getElementById("button-create").disabled = true;
			    }
            }
            function confirmDelete() {
                if (confirm("Вы подтверждаете удаление?")) {
                        return true;
                } else {
                        return false;
            }
}
        </script> 
        {include file='header.tpl'}
        <div id="wrapper">
			<form id="test_passing" method="post"> 
					</form>
                    {capture name='table_users'}
                    <!-- MENU -->
                    <div id="sidebar-wrapper">
                        <ul class="sidebar-nav">
			            {if {$data_role[2]} eq 3}
                            <li class="sidebar-brand">
                                    Меню администратора
                            </li>
                            <li>
                                <a href="administration.php?link_click=show_quiz">Опросы</a>
                            </li>
				            <li>
					            <a href="administration.php?link_click=show_users" class="foc">Пользователи</a>
				            </li>
			            {/if}
			            {if {$data_role[1]} eq 2}
                            <li class="sidebar-brand">
                                Меню автора теста
                            </li>
                            <li>
                                <a href="author_quiz.php">Мои опросы</a>
                            </li>
                            <li>
                                <a href="create_quiz.php?link_click=new_quiz">Создать опрос</a>
                            </li>
			            {/if}
			            {if  {$data_role[0]} eq 1}
                            <li class="sidebar-brand">
                                Меню тестируемого
                            </li>
                            <li>
                                <a href="main.php">Список тестов</a>
                            </li>
			            {/if}
                        </ul>
                    </div>
                    <div id="page-content-wrapper">
				            <div class="container-fluid">
				            {if {$data_role[2]} eq 3}
                                <table class="table table-hover">
                                    <thead>
                                        <th>
                                            Фамилия пользователя
                                        </th>
                                        <th>
                                            Имя пользователя
                                        </th>
                                        <th>
                                            Тип пользователя
                                        </th>
                                        <th>
                                            Статус пользователя
                                        </th>
                                        <th>
                                            
                                        </th>
                                    </thead>
                                    {foreach $users_data as $one_user_data}                                          
                                        <tr>
                                            <td class='info'>
                                                {$one_user_data->getLastName()}
                                            </td>
                                            <td class='info'>
                                                {$one_user_data->getFirstName()}
                                            </td>
                                            <td>
                                                {if $one_user_data->getLdapUser()==0}
                                                    Внутренний пользователь
                                                {elseif $one_user_data->getLdapUser()==1}
                                                    Пользователь LDAP
                                                {/if}
                                            </td>
                                            <td>
                                                {if $one_user_data->getUserVasibility()==1}
                                                    Активный
                                                {else}
                                                    Неактивный
                                                {/if}    
                                            </td>
                                            <td>
                                                {if $one_user_data->getLdapUser()==0}
                                                    <a href="administration.php?link_click=edit_user&id_user={$one_user_data->getIdUser()}" title="Изменить пользователя"><img class="icon_on_page" src="img/edit-user.png"></a>
                                                {/if}
                                            </td>
                                        </tr>
                                    {/foreach}
                                </table>
                                <a href="administration.php?link_click=new_internal_user" title="Создать внутреннего пользователя"><img class="icon_on_page" src="img/add-user.png">Создать внутреннего пользователя</a>
                                {else}
                                    <div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-warning-sign"></span>  Недостаточно прав </div>
                                {/if}
                            </div>
                    </div>   
                    {/capture}
                    {capture name='table_quizs'}
                                        <!-- MENU -->
                    <div id="sidebar-wrapper">
                        <ul class="sidebar-nav">
			            {if {$data_role[2]} eq 3}
                            <li class="sidebar-brand">
                                    Меню администратора
                            </li>
                            <li>
                                <a href="administration.php?link_click=show_quiz" class="foc">Опросы</a>
                            </li>
				            <li>
					            <a href="administration.php?link_click=show_users">Пользователи</a>
				            </li>
			            {/if}
			            {if {$data_role[1]} eq 2}
                            <li class="sidebar-brand">
                                Меню автора теста
                            </li>
                            <li>
                                <a href="author_quiz.php">Мои опросы</a>
                            </li>
                            <li>
                                <a href="create_quiz.php?link_click=new_quiz">Создать опрос</a>
                            </li>
			            {/if}
			            {if  {$data_role[0]} eq 1}
                            <li class="sidebar-brand">
                                Меню тестируемого
                            </li>
                            <li>
                                <a href="main.php">Список тестов</a>
                            </li>
			            {/if}
                        </ul>
                    </div>
                    <div id="page-content-wrapper">
			            <div class="container-fluid">
			            {if {$data_role[2]} eq 3}
                        <form method="POST">
                        {if isset($quizs_data[0])}
                        <table class="table table-hover">
                            <thead>
                                <th>
                                    Тема теста
                                </th>
                                <th>
                                    Состояние теста
                                </th>
                                <th>
                                    Автор теста
                                </th>
                                <th>
                                    Дата создания
                                </th>
                            </thead>
                            <tbody>
                            {foreach $quizs_data as $one_quiz_data}                    
                                <tr>
                                    <td class='info'>
                                        <a href="create_quiz.php?link_click=edit_quiz&id_quiz={$one_quiz_data->getIdQuiz()}">{$one_quiz_data->getTopic()}
                                    </td>
                                    <td>
                                        {if $one_quiz_data->getIdStatusQuiz()==1}
                                            Редактируемый
                                        {elseif $one_quiz_data->getIdStatusQuiz()==2}
                                            Доступный для прохождения
                                        {elseif $one_quiz_data->getIdStatusQuiz()==3}
                                            Завершенный
                                        {/if}
                                    </td>
                                    <td>
                                        {$one_quiz_data->getAuthorTest()->getLastName()} 
                                        {$one_quiz_data->getAuthorTest()->getFirstName()}
                                    </td>                                    
                                    <td>
                                        {$one_quiz_data->getDateCreate()} 
                                    </td>
                                </tr>
                            {/foreach}
                            </tbody>
                        </table> 
                        {else}
                           <div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-warning-sign"></span>  Нет созданных опросов </div>
                        {/if}
                        </form>
                        {else}
                            <div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-warning-sign"></span>  Недостаточно прав </div>
                        {/if}
                        </div>
                    </div>   
                    {/capture}
                    {capture name='new_internal_user'}
                    {include file='menu.tpl'}
				    <div id="page-content-wrapper">
				        <div class="container-fluid">
				        {if {$data_role[2]} eq 3}
                            <form method="POST">
                                <input type="hidden" name="button_click" value="create_internal_user">
                                <table class="table">
                                    <tr>
                                        <td class='info' width='35%'><b>Фамилия</b></td>
                                        <td><input class="form-control" type="text" name="last_name" required><td>
                                    </tr>
                                    <tr>
                                        <td class='info' width='35%'><b>Имя</b></td>
                                        <td><input class="form-control" type="text" name="first_name" required><td>
                                    </tr>                                
                                    <tr>
                                        <td class='info' width='35%'><b>Email</b></td>
                                        <td>
                                            <div class="form-group has-feedback" id="inp">
					                            <input class="form-control" type="email" name="email" onblur="checkEmailUser(this.value)">
					                            <span class="glyphicon form-control-feedback" id="glyphicon"></span>
					                        </div>
                                        <td>
                                    </tr>
                                    <tr>
                                        <td class='info' width='35%'><b>Логин</b></td>
                                        <td>
                                            <div class="form-group has-feedback" id="inpLog">
                                                <input class="form-control" type="text" name="login"  onblur="checkLoginUser(this.value)">
                                                <span class="glyphicon form-control-feedback" id="glyphiconLog"></span>
					                        </div>
                                        <td>    
                                    </tr>
                                    <tr>
                                        <td class='info' width='35%'><b>Пароль</b></td>
                                        <td><input class="form-control" type="text" name="password"><td>
                                    </tr>
                                    <tr>
                                        <td class='info' width='35%' required><b>Роль пользователя</b></td>
                                        <td>
                                            <input type="checkbox" name="role_admin" value="1" checked>Опрашиваемый</br>
                                            <input type="checkbox" name="role_author" value="2">Составитель опросов</br>
                                            <input type="checkbox" name="role_interviewees" value="3">Администратор
                                        <td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <span class="unsuitable">
                                                <input class="btn btn-primary" type="submit" id="button-create" value="Создать пользователя">
                                            </span>
                                       </td>
                                    </tr>
                                </table>
                            </form>
                            {else}
                                <div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-warning-sign"></span>  Недостаточно прав </div>
                            {/if}
                        </div>
                    </div>
                    {/capture}
                    {capture name='edit_user'}   
                        {if $id_user != NULL}
                            {include file='menu.tpl'}
                            <div id="page-content-wrapper">
				                <div class="container-fluid">
				                {if {$data_role[2]} eq 3}
                                <form action="administration.php" method="POST">
                                    <input type="hidden" name="button_click" value="edit_user">
                                    <input type="hidden" name="id_user" value="{$id_user}">
                                    <table class="table">
                                                {if $data_edit_user->getUserVasibility()==1}                                                    
                                                    <h4 align="center"><font color="blue" face="Arial">Активный пользователь</font></h4>   
                                                {else}
                                                    <h4 align="center"><font color="red" face="Arial">Неактивный пользователь</font><h4>
                                                {/if}
                                        <tr>
                                            <td class='info' width='35%'><b>Фамилия</b></td>
                                            <td><input class="form-control" type="text" name="last_name"  value="{$data_edit_user->getLastName()}" required><td>
                                        </tr>
                                        <tr>
                                            <td class='info' width='35%'><b>Имя<b></td>
                                            <td><input class="form-control" type="text" name="first_name" value="{$data_edit_user->getFirstName()}" required><td>
                                        </tr>                                
                                        <tr>
                                            <td class='info' width='35%'><b>Email</b></td>
                                            <td><input class="form-control" type="email" name="email" value="{$data_edit_user->getEmail()}" required><td>
                                        </tr>
                                        <tr>
                                            <td class='info' width='35%'><b>Логин</b></td>
                                            <td><input class="form-control" type="text" name="login" value="{$data_edit_user->getLogin()}"  required><td>
                                        </tr>                                
                                        <tr>
                                            <td class='info' width='35%'><b>Роль пользователя</b></td>
                                            <td>
                                                {$array=$data_edit_user->getRoles()}
                                                
                                                    <input type="checkbox" name="role_admin" value="1" {if isset($array[0])}{if $array[0]==1}checked{/if}{/if}>Опрашиваемый <br>
                                                
                                                    <input type="checkbox" name="role_author" value="2" {if isset($array[1])}{if $array[1]==2}checked{/if}{/if}>Составитель опросов <br>
                                                    <input type="checkbox" name="role_interviewees" value="3" {if isset($array[2])}{if $array[2]==3}checked{/if}{/if} >Администратор   
                                            <td>
                                        </tr>
                                        <tr>
                                            <td class='info' width='35%'><b>Изменить пароль</b></td>
                                            <td>
                                                <input type="radio" name="reset_password" value="Yes" onchange = 'setNewPassword((this.getAttribute("value")));'>да</br>
                                                <input type="radio" name="reset_password" value="No" onchange = 'setNewPassword((this.getAttribute("value")))' checked>нет</br>
                                                <div class="enter_new_password" style="display: none"> Установить пароль: <br>
                                                    <input type="text" name="set_new_password" id="set_new_password" value="***" required>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                    <div class="row">
                                       <div class="col-lg-6">
                                            <button class="btn btn-primary"  type="submit" formaction="administration.php" name="update_user" value={$id_user}>Изменить пользователя</button>
                                       </div>
                                       <div class="col-lg-6">     
                                           <a href="?action=deleteUser&id_user={$id_user}" class="btn btn-primary" name="delete_user" onclick="return confirmDelete();" title="При удалении пользователя, также удалиться вся зависимая информация представленная внизу в Дополнительной информации"><span class="glyphicon glyphicon-trash"></span></a>
                                       </div>
                                    </div>
                                    <div class="row padding-top10">
                                        <div class="col-lg-6" >
                                            {if $data_edit_user->getUserVasibility()==1}
                                                <button class="btn btn-primary" type="submit" formaction="administration.php?link_click=edit_user&&id_user={$id_user}" name="deactivate_user" value="{$id_user}">Заблокировать пользователя</button>
                                            {else}
                                                 <button class="btn btn-primary" type="submit" formaction="administration.php?link_click=edit_user&&id_user={$id_user}" name="activate_user" value="{$id_user}">Активировать пользователя</button>
                                            {/if} 
                                        </div>
                                        <div class="col-lg-6">
                                           <div id="show_other_information_user">
                                                <input class="btn btn-primary" type="button" name="other_information" value="Показать дополнительную информацию" onclick='otherInformation("show");'>                                                         
                                           </div>
                                       </div>
                                       <div class="col-lg-6">
                                           <div id="hide_other_information_user" style="display: none">
                                                <input class="btn btn-primary" type="button" name="other_information" value="Скрыть дополнительную информацию" onclick='otherInformation("hide");'>   
                                           </div>
                                       </div>
                                   </div>
                                </form>
                                <div class="other_information_user" style="display: none">
                                    <h2>Дополнительная информация </h2>
                                    <p>Созданные тесты </p>
                                    {if $other_data_user['test'][0]!=false}
                                        <table>
                                            <tr>
                                                <td>
                                                    Тема теста
                                                </td>    
                                                <td>
                                                    Статус теста
                                                </td>    
                                            </tr>    
                                            {foreach $other_data_user['test'] as $other_data_user_test}
                                                <tr>
                                                    <td>
                                                        {$other_data_user_test->topic}
                                                    </td>    
                                                    <td>
                                                        {$other_data_user_test->description_status_test}
                                                    </td>    
                                                </tr> 
                                            {/foreach} 
                                        </table>     
                                    {else} 
                                        Пользователь не составлял тесты
                                    {/if}   
                                    <p>Активированные тесты </p>
                                    {if $other_data_user['testing'][0]!=false}
                                            <table>
                                            <tr>
                                                <td>
                                                    Тема опроса
                                                </td>    
                                                <td>
                                                    Статус опроса
                                                </td>    
                                            </tr>    
                                            {foreach $other_data_user['testing'] as $other_data_user_testing}
                                                <tr>
                                                    <td>
                                                        {$other_data_user_testing->topic}
                                                    </td>    
                                                    <td>
                                                        {$other_data_user_testing->description_mark_test}
                                                    </td>    
                                                </tr> 
                                             {/foreach} 
                                        </table>
                                        {else} Пользователь не активировал тесты
                                    {/if} 
                                </div> 
                                {else}
                                    <div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-warning-sign"></span>  Недостаточно прав </div>
                                 {/if}
                                </div>
                        </div>     
                        {/if}                    
                    {/capture}
                {if {$view_admin} eq 'table_users'}
                   {$smarty.capture.table_users}
                {elseif {$view_admin} eq 'table_quizs'}
                    {$smarty.capture.table_quizs}
                {elseif {$view_admin} eq 'edit_user'}
                    {$smarty.capture.edit_user}
                {elseif {$view_admin} eq 'new_internal_user'}
                    {$smarty.capture.new_internal_user}
                 {/if}  
             </div>
			
    </body>
</html>
