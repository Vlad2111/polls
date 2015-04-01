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
            {capture name='taking_a_test'}
                <table width="30%" align="center">
            <tr align="center">
            <th>
                Тема теста: {$temp_testing->getTest()->getTopic()}
            </th>
            </tr>
            <tr align="center">
                <td>
                    Вопрос №1
                </td>
            </tr> 
            <tr align="center">
                <td> 
                {$question->getTextQuestion()}
                </td>
            </tr> 
            <tr align="left">
                <td>
                    {capture name='radio'}
                        <form>                      
                          <p><input type="radio" name="Y" value="a1">Да<Br>
                          <input type="radio" name="N" value="a2">Нет<Br>
                          <input type="radio" name="N" value="a3">Не знаю</p>
                         </form>
                    {/capture}
                    {capture name='radio_list'}
                        <form>           
                          <input type="radio" name="answer" value="a">var</p>
                         </form>
                    {/capture}
                    {capture name='checkbox_list'}
                        <form>
                           <input type="checkbox" name="option1" value="a1">var<Br>                           
                        </form>
                    {/capture}
                    {capture name='textarea'}
                        <form>
                           <textarea name="comment" maxlength="1000" cols="80" rows="10"></textarea></p>                          
                        </form>
                    {/capture}
                    {if {$type_answer} eq '1'}
                        {$smarty.capture.radio}    
                    {elseif {$type_answer} eq '2'}
                        {$smarty.capture.radio_list}
                    {elseif {$type_answer} eq '3'}
                        {$smarty.capture.checkbox_list}
                    {elseif {$type_answer} eq '4'}
                        {$smarty.capture.textarea}
                    {/if}
                   {$smarty.capture.table_users}
                </td>
            </tr>  
            <tr align="center">
                <td>
                    <table>
                        <tr>
                            <td>
                                <a href="test_passing.php?prev">Предыдущий вопрос</a>
                            </td>
                            <td>
                                <a href="test_passing.php?end">Закончить тест</a>
                            </td>   
                            <td>
                                <a href="test_passing.php?interrupt">Прервать тест</a>
                            </td>
                            <td>
                                <a href="test_passing.php?next">Следующий вопрос</a>
                            </td> 
                        </tr>    
                    </table> 
            {/capture}
            {capture name='start_test'}
                <table width="30%" align="center">
                    <tr>
                        <td>
                            Тема теста:
                        </td>
                        <td>
                            {$temp_testing->getTest()->getTopic()}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Ограничение по времени
                        </td>
                        <td>
                            {if $temp_testing->getTest()->getTimeLimit()}
                            {$temp_testing->getTest()->getTimeLimit()}
                            {else} Отсутсвует
                            {/if}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Комментани автора:
                        </td>
                        <td>
                            {if $temp_testing->getTest()->getCommentQuiz()}
                            {$temp_testing->getTest()->getCommentQuiz()}
                            {else} Отсутсвует
                            {/if}
                        </td>
                    </tr>
                    <tr>
                        <td>
                           Автор теста: 
                        </td>
                        <td>
                            {$temp_testing->getTest()->getAuthorTest()->getLastName()} 
                            {$temp_testing->getTest()->getAuthorTest()->getFirstName()} 
                        </td>
                    </tr>
                    <tr align="center">
                        <td colspan="2">
                            <a href="test_passing.php?status_test=start">Начать тест</a>
                        </td>
                    </tr>
                </table>
            {/capture}
            {capture name="finished_test"}
                <table width="30%" align="center">
                    <tr>
                        <td>
                            Вы уже прошли этот тест
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="quiz.php">Перейти на начальную страницу</a>
                        </td>
                    </tr>
                </table>
            {/capture}
            {if {$status_test} eq 'start_test'}
                       {$smarty.capture.start_test}
                    {elseif {$status_test} eq 'taking_a_test'}
                        {$smarty.capture.taking_a_test}
                    {elseif {$status_test} eq 'end_test'}
                        {$smarty.capture.end_test}
                    {elseif {$status_test} eq 'finished_test'}
                        {$smarty.capture.finished_test}
                    {/if}
            </td>
            </tr>
        </table>  
</td> 
  </tr>            
        </table> 
    </body>
</html>
