  
    {if {$data_role[2]} eq 3}
            <table>
                <tr bgcolor="#4682B4" valign="top">
                    <td width="50%" height="10%" align="left" bgcolor="#6CA6CD">
                        Меню администратора
                    </td>                
                </tr>
                <tr  valign="top">
                    <td width="50%" height="10%" align="right" bgcolor="#87CEFA">
                        <a href="administration.php?link_click=show_quiz">Опросы</a>
                    </td>                
                </tr>
                <tr bgcolor="#87CEFA" valign="top">
                    <td width="50%" height="10%" align="right" bgcolor="#87CEFA">
                        <a href="administration.php?link_click=show_users">Пользователи</a>
                    </td>                
                </tr>
            </table> 
            {/if}
    {if {$data_role[1]} eq 2}
        <table>
            <tr bgcolor="#4682B4" valign="top">
                <td width="50%" height="10%" align="left" bgcolor="#6CA6CD">
                    Меню автора теста
                </td>                
            </tr>
            <tr  valign="top">
                <td width="50%" height="10%" align="right" bgcolor="#87CEFA">
                    <a href="author_quiz.php">Мои опросы</a>
                </td>                
            </tr>
            <tr bgcolor="#87CEFA" valign="top">
                <td width="50%" height="10%" align="right" bgcolor="#87CEFA">
                    <a href="create_quiz.php?link_click=new_quiz">Создать опрос</a>
                </td>                
            </tr>
        </table>
        {/if}
    {if  {$data_role[0]} eq 1}
        <table>
            <tr bgcolor="#4682B4" valign="top">
                <td width="50%" height="10%" align="left" bgcolor="#6CA6CD">
                    Меню тестируемого
                </td>                
            </tr>
            <tr  valign="top">
                <td width="50%" height="10%" align="right" bgcolor="#87CEFA">
                    <a href="main.php">Список тестов</a>
                </td>                
            </tr>            
        </table>
     {/if}