<html>
    <head>
        <title>{$title}</title>
        <meta charset="UTF-8">
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script src="js/jquery-2.1.3.min.js"></script>
        <link rel="stylesheet" href="css/styles.css">
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
                $.post("checkForms.php", { action: "check", field: "email user", name: value }, function( data ) {
                    console.log(data);
                if(data=='true'){
                    $("#yes_email").show();
                    $(".unsuitable").show();
                    $("#no_email").hide();
                }
                else{
                    $("#yes_email").hide();
                    $(".unsuitable").hide();
                    $("#no_email").show();
                }
              });
            }
            function checkLoginUser(value){
                $.post("checkForms.php", { action: "check", field: "login user", name: value }, function( data ) {
                    console.log(data);
                if(data=='true'){
                    $("#yes_login").show();
                    $(".unsuitable").show();
                    $("#no_login").hide();
                }
                else{
                    $("#yes_login").hide();
                    $(".unsuitable").hide();
                    $("#no_login").show();
                }
              });
            }
        </script> 
        <table width="100%">
            <tr>
                <td  width="100%">
                    {include file='header.tpl'}
                </td>
            </tr>
            <tr>
                <td>
                <table width="100%" >
                    <tr>                        
                <td width="20%" valign="top">
                    {include file='menu.tpl'}
                </td>           
                <td width="80%">
                <form id="go" method="post">
                        </form>
                    {capture name='table_users'}
                        <a href="administration.php?link_click=new_user&&type_user=internal_user">Создать внутреннего пользователя</a>
                        <table width="80%" align="center">
                            <tr>
                                <td>
                                    Фамилия пользователя
                                </td>
                                <td>
                                    Имя пользователя
                                </td>
                                <td>
                                    Тип пользователя
                                </td>
                                <td>
                                    Статус пользователя
                                </td>
                                <td>
                                    
                                </td>
                            </tr>
                            {foreach $users_data as $one_user_data}                                          
                                <tr>
                                    <td>
                                        {$one_user_data->getLastName()}
                                    </td>
                                    <td>
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
                                            <a href="administration.php?link_click=edit_user&&id_user={$one_user_data->getIdUser()}">Изменить пользователя</a>
                                        {/if}
                                    </td>
                                </tr>
                            {/foreach}
                        </table>
                    {/capture}
                    {capture name='table_quizs'}
                        <form method="POST">
                        <table width="100%">
                            <tr>
                                <td>
                                    Тема теста
                                </td>
                                <td>
                                    Состояние теста
                                </td>
                                <td>
                                    Автор теста
                                </td>
                                <td>
                                    Статус теста
                                </td>
                            </tr>
                            {foreach $quizs_data as $one_quiz_data}                                          
                                <tr>
                                    <td>
                                        {$one_quiz_data->getTopic()}
                                    </td>
                                    <td>
                                        {if $one_quiz_data->getIdStatusQuiz()==1}
                                            Редактируемый
                                        {elseif $one_quiz_data->getIdStatusQuiz()==2}
                                            Готов к опубликованию
                                        {elseif $one_quiz_data->getIdStatusQuiz()==3}
                                            Активный
                                        {elseif $one_quiz_data->getIdStatusQuiz()==4}
                                            Завершённый
                                        {/if}
                                    </td>
                                    <td>
                                        {$one_quiz_data->getAuthorTest()->getLastName()} 
                                        {$one_quiz_data->getAuthorTest()->getFirstName()}
                                    </td>                                    
                                    <td>
                                        {if $one_quiz_data->getVasibilityTest()==1}
                                            Тест доступен 
                                        {else}
                                            Тест заблокирован
                                        {/if}   
                                    </td>
                                    <td>
                                            {if $one_quiz_data->getVasibilityTest()==1}
                                                <button type="submit" formaction="administration.php?link_click=show_quiz" name="deactivate_quiz" value="{$one_quiz_data->getIdQuiz()}">Заблокировать тест</button>
                                            {else}
                                                <button type="submit" formaction="administration.php?link_click=show_quiz" name="activate_quiz" value="{$one_quiz_data->getIdQuiz()}">Активировать тест</button>
                                            {/if}      
                                    </td>
                                </tr>
                            {/foreach}
                        </table> 
                        </form>   
                    {/capture}
                    {capture name='new_internal_user'}
                        
                            <form action="administration.php" method="POST">
                                <input type="hidden" name="button_click" value="create_internal_user">
                                <table align="center">
                                    <tr>
                                        <td bgcolor="#8DB6CD" align="right">Фамилия </td>
                                        <td><input type="text" name="last_name" required><td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#8DB6CD" align="right">Имя </td>
                                        <td><input type="text" name="first_name" required><td>
                                    </tr>                                
                                    <tr>
                                        <td bgcolor="#8DB6CD" align="right">Email</td>
                                        <td><input type="email" name="email" onblur="checkEmailUser(this.value)">
                                            <span id="no_email" style="display: none; color: red">Такое название уже есть</span>
                                            <span id="yes_email" style="display: none; color: green">Ок</span>
                                        <td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#8DB6CD" align="right">Логин</td>
                                        <td><input type="text" name="login"  onblur="checkLoginUser(this.value)">
                                            <span  id="no_login" style="display: none; color: red">Такое название уже есть</span>
                                            <span id="yes_login" style="display: none; color: green">Ок</span>
                                        <td>    
                                    </tr>
                                    <tr>
                                        <td bgcolor="#8DB6CD" align="right">Пароль</td>
                                        <td><input type="text" name="password"><td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#8DB6CD" align="right" required>Роль пользователя</td>
                                        <td>
                                            <input type="checkbox" name="role_admin" value="1" checked>Опрашиваемый <br>
                                            <input type="checkbox" name="role_author" value="2">Составитель опросов <br>
                                            <input type="checkbox" name="role_interviewees" value="3">Администратор
                                        <td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <span class="unsuitable">
                                            <input type="submit" value="Создать пользователя">
                                            </span>
                                       </td>
                                    </tr>
                                </table>
                            </form>
                            
                    {/capture}
                    {capture name='new_ldap_user'}
                        Пользователь LDAP
                    {/capture}
                    {capture name='edit_user'}
                        {foreach $users_data as $one_user_data}
                            {if $one_user_data->getIdUser()==$id_edit_user}
                                <form action="administration.php" method="POST">
                                    <input type="hidden" name="button_click" value="edit_user">
                                    <input type="hidden" name="id_user" value="{$id_edit_user}">
                                    <table align="center">
                                        <tr>
                                            <td colspan="2" align="center">
                                                {if $one_user_data->getUserVasibility()==1}                                                    
                                                    <p><font size="4" color="blue" face="Arial">Активный пользователь</font>   
                                                {else}
                                                    <p><font size="4" color="red" face="Arial">Неактивный пользователь</font>                                                    
                                                {/if} 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#8DB6CD" align="right">Фамилия </td>
                                            <td><input type="text" name="last_name"  value="{$one_user_data->getLastName()}" required><td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#8DB6CD" align="right">Имя </td>
                                            <td><input type="text" name="first_name" value="{$one_user_data->getFirstName()}" required><td>
                                        </tr>                                
                                        <tr>
                                            <td bgcolor="#8DB6CD" align="right">Email</td>
                                            <td><input type="email" name="email" value="{$one_user_data->getEmail()}" required><td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#8DB6CD" align="right">Логин</td>
                                            <td><input type="text" name="login" value="{$one_user_data->getLogin()}"  required><td>
                                        </tr>                                
                                        <tr>
                                            <td bgcolor="#8DB6CD" align="right">Роль пользователя</td>
                                            <td>
                                                {$array=$one_user_data->getRoles()}
                                                {if $array[0]==1}
                                                    <input type="checkbox" name="role_admin" value="1" checked>Опрашиваемый <br>
                                                {else}
                                                    <input type="checkbox" name="role_admin" value="1">Опрашиваемый <br>
                                                {/if}   
                                                {if $array[1]==2}
                                                    <input type="checkbox" name="role_author" value="2" checked>Составитель опросов <br>
                                                {else}
                                                    <input type="checkbox" name="role_author" value="2">Составитель опросов <br>
                                                {/if} 
                                                {if $array[2]==3}
                                                    <input type="checkbox" name="role_interviewees" value="3" checked>Администратор
                                                {else}
                                                    <input type="checkbox" name="role_interviewees" value="3">Администратор
                                                {/if}    
                                            <td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#8DB6CD" align="right">Изменить пароль</td>
                                            <td>
                                                <input type="radio" name="reset_password" value="Yes" onchange = 'setNewPassword((this.getAttribute("value")))'>да</br>
                                                <input type="radio" name="reset_password" value="No" onchange = 'setNewPassword((this.getAttribute("value")))' checked>нет</br>
                                                <div class="enter_new_password" style="display: none">
                                                    Установить пароль: <br><input type="text" name="set_new_password" id="set_new_password" value="***" required>
                                                 </div>
                                            </td>
                                        </tr> 
                                        <tr>
                                            <td>
                                                <button type="submit" formaction="administration.php" name="update_user" value={$id_edit_user}>Изменить пользователя</button>
                                           </td>
                                           <td>
                                               <button type="submit" formaction="administration.php" name="delete_user" value="{$id_edit_user}" title='При удалении пользователя, также удалиться вся зависимая информация представленная внизу в Дополнительной информации'>Удалить пользователя</button>
                                               
                                           </td>    
                                        </tr>
                                        <tr>
                                            <td>
                                                {if $one_user_data->getUserVasibility()==1}
                                                     <button type="submit" formaction="administration.php?link_click=edit_user&&id_user={$id_edit_user}" name="deactivate_user" value="{$id_edit_user}">Заблокировать пользователя</button>
                                                {else}
                                                     <button type="submit" formaction="administration.php?link_click=edit_user&&id_user={$id_edit_user}" name="activate_user" value="{$id_edit_user}">Активировать пользователя</button>
                                                {/if}                                                 
                                            </td>
                                                <td>
                                                    <div id="show_other_information_user">
                                                        <input type="button" name="other_information" value="Показать дополнительную информацию" onclick = 'otherInformation("show");'>                                                         
                                                   </div>
                                                   <div id="hide_other_information_user" style="display: none">
                                                        <input type="button" name="other_information" value="Скрыть дополнительную информацию" onclick = 'otherInformation("hide");'>   
                                                   </div>
                                            </td>
                                        </tr>
                                    </table>
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
                                                    {else} Пользователь не составлял тесты
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
                                 
                            {/if}
                        {/foreach}
                        
                    {/capture}
                {if {$view_admin} eq 'table_users'}
                   {$smarty.capture.table_users}
                {elseif {$view_admin} eq 'table_quizs'}
                    {$smarty.capture.table_quizs}
                {elseif {$view_admin} eq 'edit_user'}
                    {$smarty.capture.edit_user}
                {elseif {$view_admin} eq 'new_internal_user'}
                    {$smarty.capture.new_internal_user}
                {elseif {$view_admin} eq 'new_ldap_user'}
                    {$smarty.capture.new_ldap_user}
                 {/if}   
                </td>
                    </tr> 
                </table>
                </td>  
            </tr>            
        </table>
        {include file='footer.tpl'}
    </body>
</html>
