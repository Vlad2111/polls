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
                                    <td>
                                        Статус
                                    </td>
                                </tr>
                                {foreach $data_quiz as $data_one_quiz}
                                    <tr>
                                        <td>
                                            {$data_one_quiz->getTest()->getTopic()}
                                        </td>
                                        <td>
                                            
                                            {if $data_one_quiz->getMarkTest()=='available'}
                                                Доступен
                                              {elseif $data_one_quiz->getMarkTest()=='unfinished'}
                                                  Незаконченный
                                              {else}
                                                  Не доступен
                                            {/if}    
                                        </td>
                                        <td>
                                            {$data_one_quiz->getUser()->getFirstName()} {$data_one_quiz->getUser()->getLastName()}
                                        </td>
                                        <td>
                                            
                                            {if $data_one_quiz->getTest()->getTimeLimit()}
                                                {$data_one_quiz->getTest()->getTimeLimit()}
                                            {else} Без ограничений    
                                            {/if}   
                                        </td>
                                        <td>
                                            <a href="test_passing.php?testing={$data_one_quiz->getIdTesting()}">Пройти тест</a>
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
