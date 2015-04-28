<html>
    <head>
        <title>{$title}</title>
        <meta charset="UTF-8">
    </head>
    <body>
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
                        <a href=administration.php?link_click=new_user>Создать пользователя</a>
                        <table>
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
                                       <a href="administration.php?link_click=edit_user&&id_user={$one_user_data->getIdUser()}">Изменить пользователя</a>
                                    </td>
                                </tr>
                            {/foreach}
                        </table>
                    {/capture}
                    {capture name='table_quizs'}
                        <table>
                            <tr>
                                <td>
                                    Тема теста
                                </td>
                                <td>
                                    Статус теста
                                </td>
                                <td>
                                    Автор теста
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
                                </tr>
                            {/foreach}
                        </table>
                    {/capture}
                    {capture name='new_user'}
                        <a href="administration.php?link_click=new_user&&type_user=internal_user">Создать внутреннего пользователя</a> <br>
                        <a href="administration.php?link_click=new_user&&type_user=ldap_user">Создать пользователя LDAP</a>
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
                                        <td><input type="email" name="email"><td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#8DB6CD" align="right">Логин</td>
                                        <td><input type="text" name="login"><td>
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
                                            <input type="submit" value="Создать пользователя">
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
                                    <table align="center">
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
                                                <input type="checkbox" name="role_admin" value="1" checked>Опрашиваемый <br>
                                                <input type="checkbox" name="role_author" value="2">Составитель опросов <br>
                                                <input type="checkbox" name="role_interviewees" value="3">Администратор
                                            <td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <button type="submit" formaction="administration.php" name="update_user" value={$id_edit_user}>Изменить пользователя</button>
                                           </td>
                                           <td>
                                               <button type="submit" formaction="administration.php" name="delete_user" value="{$id_edit_user}" title='При удалении пользователя, также удалить вся зависимая информация представленная внизу в Дополнительной информации'>Удалить пользователя</button>
                                               
                                           </td>    
                                        </tr>
                                    </table>
                                </form>
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
                            {/if}
                        {/foreach}
                        
                    {/capture}
                {if {$view_admin} eq 'table_users'}
                   {$smarty.capture.table_users}
                {elseif {$view_admin} eq 'table_quizs'}
                    {$smarty.capture.table_quizs}
                {elseif {$view_admin} eq 'new_user'}
                    {$smarty.capture.new_user}
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
    </body>
</html>
