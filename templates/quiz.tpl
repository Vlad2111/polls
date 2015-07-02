<html>
    <head>
        <title>{$title}</title>
        <meta charset="UTF-8">
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script src="js/jquery-2.1.3.min.js"></script>
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
        <div class="wrapper">
            <div class="content">
<form id="test_passing" method="post">
                        </form>
    <table width="100%">
            <tr>
                <td  width="100%">
                    {include file='header.tpl'}
                </td>
            </tr>
            <tr>
                <td>
                    {capture name="new_testing"}
                        <table width="100%" >
                            <tr>                        
                                <td width="30%" valign="top">
                                    {include file='menu.tpl'}
                                </td>
                                <td width="70%">
                                        <table width="60%" align="center">
                                            <tr>
                                                <td colspan='2'>
                                                    <h2>Информация по тесту</h2>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Тема теста:
                                                </td>
                                                <td>
                                                   {$data_test->getTopic()}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Ограничение по времени
                                                </td>
                                                <td>
                                                    {if $data_test->getTimeLimit()=="" && $data_test->getTimeLimit()==NULL}
                                                        Без ограничения времени
                                                    {/if}    
                                                </td>
                                            </tr>  
                                            <tr>
                                                <td>
                                                    Комментарий автора
                                                </td>
                                                <td>
                                                     {$data_test->getCommentQuiz()}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Результат
                                                </td>
                                                <td>
                                                    {if $data_test->getSeeTheResult()=='Y'}
                                                        Разрешено просматривать результат<br>
                                                    {/if}   
                                                    {if $data_test->getSeeDetails()=='Y'}
                                                        Разрешено просматривать детальны отчёт
                                                    {/if} 
                                                    {if $data_test->getSeeDetails()=='N' || $data_test->getSeeTheResult()=='N'}
                                                        Запрещено просматривать результат
                                                    {/if} 
                                                </td>    
                                            </tr>
                                            <tr>
                                                <td>
                                                    Автор теста
                                                </td>
                                                <td>
                                                    {$data_test->getAuthorTest()->getLastName()}
                                                    {$data_test->getAuthorTest()->getFirstName()}
                                                </td>    
                                            </tr>
                                            <tr>
                                                <td colspan='2' align='center'>
                                                    <button form="test_passing" type="submit" formaction="quiz.php" name="button_click" value='start_quiz'>Начать тест</button>
                                                </td>
                                            </tr>
                                        </table>
                                </td>
                            </tr>    
                        </table>            
                    {/capture}
                   
                    {capture name="end_quiz"}
                        <table width="100%" >
                            <tr>                        
                                <td width="30%" valign="top">
                                    {include file='menu.tpl'}
                                </td>
                                <td width="70%">
                                        <table width="60%" align="center">
                                            <tr>
                                                <td>
                                                    Вы завершили тест
                                                </td>
                                            </tr>    
                                            <tr>
                                                <td>
                                                    <a hre="main.php">Перейти на главную страницу</a>
                                                </td>
                                            </tr> 
                                        </table>
                                </td>
                            </tr>    
                        </table>  
                    {/capture}    
                    {if {$status_testing} eq 'new_testing'}
                        {$smarty.capture.new_testing}
                    {elseif {$status_testing} eq 'continue_testing'}    
                        {$smarty.capture.continue_testing}
                    {elseif {$status_testing} eq 'end_quiz'}    
                        {$smarty.capture.end_quiz}    
                    {/if}    
                </td>
            </tr>
        </table>
        </div>
        {include file='footer.tpl'}
        </div>       
    </body>
</html>
