<html>
    <head>
        <title>{$title}</title>
        <meta charset="UTF-8">
    </head>
    <body>
        <table width="100%">
            <tr>
                <td  width="100%" height="70" bgcolor="#708090">
                    <table width="100%">
                        <tr>
                            <td width="80%" align="center">
                                <h2>Автоматическая система тестирования</h2>
                            </td>
                            <td width="30%">
                                {$you}
                            </td>
                            <td width="10%">
                                <a href='administration.php?exit=ok'>Выход</a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                <table width="100%" >
                    <tr>                        
                <td width="20%" valign="top">
                <table id='menu_administration'>
                    <tr bgcolor="#F5F5F5" valign="top">
                            <td width="50%" height="10%" align="left" bgcolor="#6CA6CD">
                                <a href=administration.php?tab=quiz>Опросы</a>
                            </td>
                    </tr>
                    <tr>   
                            <td width="50%" height="10%" align="left" bgcolor="#8DB6CD">
                                <a href=administration.php?tab=users>Пользователи</a>
                            </td>
                    </tr>    
                </table>
                </td>
           
                <td width="80%">
                {capture name='table_users'}    
                    <table  width="100%"  bgcolor="#CDC8B1">
                        <tr align="center">
                            <td bgcolor="#8B8378">
                                <button form="users"  type="submit" formaction="administration.php">Выбрать пользователя</button>
                            </td>
                            <td bgcolor="#8B8378">
                                <button form="users" type="reset" value="reset">Отменить выбор</button>
                            </td>
                             <td bgcolor="#8B8378">
                                <button form="users" type="submit" formaction="administration.php" name="new_user" value='ok'>Создать пользователя</button>
                            </td>
                        </tr>
                    </table>
                    <table width="100%">
                        
                        <tr>
                            <td width="100%" bgcolor="#CDC8B1">
                               <form id="users" method='post'>
                                   <table width="100%">
                                        {foreach $users_data as $one_user_data}                                          
                                           <tr> <td><input type="radio" name="user_control" value="{$one_user_data[0]}"> </td>
                                                <td>{$one_user_data[1]}</td>
                                                <td>{$one_user_data[2]}</td>
                                                <td>{$one_user_data[3]}</td>
                                                <td>{$one_user_data[4]}</td>
                                        </tr>

                                        {/foreach}
                                    </table>
                              </form>
                            </td>
                        </tr>
                    </table> 
                {/capture}
                {capture name='table_quiz'}    
                    <table  width="100%"  bgcolor="#CDC8B1">
                        <tr align="center">
                            <td bgcolor="#8B8378">
                                <button form="quiz" type="submit" formaction="administration.php">Выбрать опрос</button>
                            </td>
                            <td bgcolor="#8B8378">
                                <button form="quiz" type="reset" value="reset">Отменить выбор</button>
                            </td>
                        </tr>
                    </table>
                    <table width="100%">
                        
                        <tr>
                            <td width="100%" bgcolor="#CDC8B1">
                               <form id="quiz" method='POST'>
                                   <table width="100%">
                                       <tr align='center' bgcolor='#838B8B'>
                                           <td width='20%'>
                                           Название теста    
                                           </td>
                                           <td wight='40%'>
                                               Автор теста
                                           </td>
                                           <td wight='40%'>
                                               Статус теста
                                           </td>
                                       </tr>
                                   </table>
                                       <table width="100%">
                                    {foreach $quiz_data as $one_quiz_data}  
                                       <tr align='center'>                                             
                               <td width='5'><input type="radio" name="quiz_control" value="{$one_quiz_data[3]}"> </td>
                               <td width='15%' align='left'>{$one_quiz_data[0]} </td>
                                <td width='40%' >    {$one_quiz_data[1][1]} 
                                    {$one_quiz_data[1][2]} 
                                    {$one_quiz_data[1][3]}</td>
                                <td   width='40%'>{$one_quiz_data[2]}</td>
                                        </tr>
                                    {/foreach}
                                    </table>
                              </form>
                            </td>
                        </tr>
                    </table>
                {/capture}
                {capture name='create_user'}
                    <table  width="100%"  bgcolor="#CDC8B1">
                        <tr align="center">
                            <td bgcolor="#8B8378">
                                <button form="create_user" type="submit" formaction="administration.php">Создать пользователя</button>
                            </td>
                            <td bgcolor="#8B8378">
                                <button form="create_user" type="reset" value="reset">Очистить поля</button>
                            </td>
                        </tr>
                    </table>
                    <table width="100%">                       
                        <tr>
                            <td width="100%" bgcolor="#CDC8B1">
                                <form id="create_user">
                                    <table width="60%" align="center">                                    
                                    <tr>
                                        <td bgcolor="#8DB6CD" align="right">Фамилия </td>
                                        <td><input type="text" name="last_name" required><td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#8DB6CD" align="right">Имя </td>
                                        <td><input type="text" name="first_name" required><td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#8DB6CD" align="right">Отчество </td>
                                        <td><input type="text" name="patronymic" required><td>
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
                                            <select name="role">
                                                <option selected value="1">Опрашиваемый</option>
                                                <option value="2">Составитель опросов</option>
                                                <option value="3">Администратор</option>                                               
                                            </select>    
                                        <td>
                                    </tr>
                                    </table>
                                </form>    
                            </td>
                        </tr>
                    </table>
                {/capture}
                {capture name='edit_quiz'}
                    <table  width="100%"  bgcolor="#CDC8B1">
                        <tr align="center">
                            <td bgcolor="#8B8378">
                                <a href='administration.php'>Удалить опрос(false)</a>
                            </td>
                             <td bgcolor="#8B8378">
                                <button form="delete_quiz" type="submit" formaction="administration.php" name="return_tables_quiz" value='ok'>Отменить</button>
                            </td>
                        </tr>
                    </table>
                    <table width="100%">
                        
                        <tr>
                            <td width="100%" bgcolor="#CDC8B1">
                               <form id="delete_quiz" method='post'>
                                   <table width="100%">
                                       <tr align='center' bgcolor='#838B8B'>
                                           <td width='20%'>
                                           Название теста    
                                           </td>
                                           <td wight='40%'>
                                               Автор теста
                                           </td>
                                           <td wight='40%'>
                                               Статус теста
                                           </td>
                                       </tr>
                                        <tr align='center'>
                                            <td>
                                                {$array_one_quiz[0]}
                                            </td>
                                            <td>
                                                {$array_one_quiz[1][1]}
                                                {$array_one_quiz[1][2]}
                                                {$array_one_quiz[1][3]}
                                            </td>
                                            <td>
                                                {$array_one_quiz[2]}
                                            </td>
                                        </tr>
                                    </table>
                              </form>
                            </td>
                        </tr>
                    </table> 
                {/capture}
                {capture name='create_user_info'}
                         <table width="100%">
                        
                        <tr>
                            <td width="100%" bgcolor="#CDC8B1">
                               <form id="delete_quiz" method='post'>
                                   <table width="100%">
                                        <h3 align='center'>Добавлен пользователь: {$create_user_fio}</h3>
                                    </table>
                              </form>
                            </td>
                        </tr>
                    </table>                
                {/capture}
                {if {$view_admin} eq 'table_users'}
                   {$smarty.capture.table_users}
                {elseif {$view_admin} eq 'create_user'}
                    {$smarty.capture.create_user}
                {elseif {$view_admin} eq 'table_quiz'}
                    {$smarty.capture.table_quiz}
                {elseif {$view_admin} eq 'edit_quiz'}
                    {$smarty.capture.edit_quiz}    
                {elseif {$view_admin} eq 'create_user_info'}
                    {$smarty.capture.create_user_info}    
                 {/if}   
                </td>
                    </tr> 
                </table>
                </td>  
            </tr>
        </table>
    </body>
</html>
