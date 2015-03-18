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
                        <td width="30%" valign="top">
                            <table id='menu_quiz'>
                                <tr bgcolor="#F5F5F5" valign="top">
                                    <td width="50%" height="10%" align="left" bgcolor="#6CA6CD">
                                        <a>Пункт меню</a>
                                    </td>
                                </tr>   
                            </table>
                        </td>
                        <td width="70%">
                            <table align="left" width="100%" bgcolor="#CDC8B1">
                                <tr bgcolor="#8B8378">
                                    <td>
                                        Тема теста
                                    </td>
                                    <td>
                                        Статус теста
                                    </td>
                                    <td>
                                        Автор теста
                                    </td>
                                    <td>
                                        Ограничение времени
                                    </td>
                                </tr>
                                {foreach $data_quiz as $data_one_quiz}
                                    <tr>
                                        <td>
                                            {$data_one_quiz.topic_test}
                                        </td>
                                        <td>
                                            
                                            {if $data_one_quiz.mark_test=='available'}
                                                Доступен
                                              {elseif $data_one_quiz.mark_test=='unfinished'}
                                                  Незаконченный
                                              {else}
                                                  Не доступен
                                            {/if}    
                                        </td>
                                        <td>
                                            {$data_one_quiz.author_quiz[1]} {$data_one_quiz.author_quiz[2]} {$data_one_quiz.author_quiz[3]}
                                        </td>
                                        <td>
                                            
                                            {if $data_one_quiz.time_limit}
                                                {$data_one_quiz.time_limit}
                                            {else} Без ограничений    
                                            {/if}   
                                        </td>
                                        </tr>
                                {/foreach}
                            </table>
                        </td>
                    </tr>
                </table>
                </td>
            </tr>
                
        </table>
    </body>
</html>
