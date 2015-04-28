<html>
    <head>
        <title>{$title}</title>
        <meta charset="UTF-8">
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script src="js/jquery-2.1.3.min.js"></script>
    </head>
    <body>
        <script type="text/javascript">
            function setTimeLimit(value){
                switch(value){
                    case "Y":
                        $(".enter_time_limit").show();
                        $("#set_time_limit").val("12:00:00");
                        break;
                    case "N":
                        $(".enter_time_limit").hide();
                        break;
                }
            }
        </script>   
<form id="go" method="post">
                        </form>
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
                            {include file='menu.tpl'}
                        </td>
                        <td width="70%">
                            <table width="100%">
                               <tr>
                                <td>    
                                {capture name='new_quiz'}
                                    <form method="post">
                                        Тема опроса:<br>
                                        <input type="text" name="topic_quiz" placeholder="Ваша тема" required><br>
                                        Время выполнения опроса:<Br>
                                        <input type="radio" name="time_limit" value="Y" id="time_limit" onchange = 'setTimeLimit((this.getAttribute("value")))'> Да<Br>
                                        <input type="radio" name="time_limit" value="N" id="time_limit" onchange = 'setTimeLimit((this.getAttribute("value")))' checked> Нет<Br>
                                        <div class="enter_time_limit" style="display: none">
                                            Установите время: <input type="time" name="set_time_limit" id="set_time_limit" >
                                         </div>
                                        Дополнительная информация:<Br>
                                        <textarea rows="5" cols="40" name="comment_test" placeholder="Информация, которая необходима для прохождения теста"></textarea><br>
                                        Разрешить смотреть результаты опроса:<Br>
                                        <input type="radio" name="see_the_result" value="Y" checked> Да<Br>
                                        <input type="radio" name="see_the_result" value="N"> Нет<Br>
                                        Разрешить смотреть детальную информацию:<Br>
                                        <input type="radio" name="see_details" value="Y" checked> Да<Br>
                                        <input type="radio" name="see_details" value="N"> Нет<Br>                                        
                                        <input type="hidden" name="status_test" value="1">
                                        <input type="submit" value="Создать опрос"><br>         
                                    </form> 
                                {/capture} 
                                {capture name='add_question'}
                                    <form method="post">
                                        <button name="button_create_quiz" value="new_question"> Добавить вопрос</button>                    
                                    </form>  
                                    <table>
                                    <tr>
                                        <td>
                                            текст вопроса
                                        </td>
                                        <td>
                                            тип вопроса
                                        </td>
                                    </tr>
                                       {foreach $data_question as $data_question_one}
                                       <tr>
                                           <td>
                                            {$data_question_one->text_question}
                                           </td>
                                            <td>
                                                
                                                {if  {$data_question_one->id_questions_type}==1}
                                                Вопрос, предлогающий ответ типа Да/Нет/Не знаю
                                              {elseif  {$data_question_one->id_questions_type}==2}
                                                  Вопрос с возможностью выбора одного ответа из списка
                                              {elseif  {$data_question_one->id_questions_type}==3}
                                                Вопрос с возможностью выбора одного или более ответов из списка
                                              {elseif  {$data_question_one->id_questions_type}==4}
                                                Вопрос, предполагающий написание ответа в виде произвольного текста длиной до 1000 символов
                                            {/if} 
                                           </td>
                                       </tr>
                                {/foreach}
                                    </table>
                                {/capture}
                                {capture name='new_question'}
                                    <form method="post">
                                        Текст вопроса<br>
                                        <textarea rows="5" cols="40" name="text_question" placeholder="Ваш вопрос" required></textarea><br>
                                        Дополнительная информация<br>
                                        <textarea rows="5" cols="40" name="comment_question"></textarea><br>
                                        Тип вопроса<br>
                                        <select  name="question_type">
                                            <option  selected value="1">Да/Нет/Не знаю</option>
                                            <option value="2">Один ответа из списка</option>
                                            <option value="3">Выбор одного или более ответов из списка</option>
                                            <option value="4">Произвольный ответ</option>
                                        </select><br>
                                        <button name="add_question" value="yes"> Создать вопрос</button>
                                    </form> 
                                {/capture}
                                {capture name='add_answer_option'}
                                    Добавить варианты ответов
                                {/capture}
                                    
                                    {if {$forms} eq 'new_quiz'}
                                        {$smarty.capture.new_quiz}   
                                    {elseif {$forms} eq 'add_question'}
                                        {$smarty.capture.add_question}
                                    {elseif {$forms} eq 'new_question'}
                                        {$smarty.capture.new_question}
                                    {elseif {$forms} eq 'add_answer_option'}
                                        {$smarty.capture.add_answer_option}
                                     {/if}
                                </td>
                               </tr>
                           </table>  
                        </td>
                    </tr>
                </table>
                </td>
            </tr>
                
        </table>
    </body>
</html>
