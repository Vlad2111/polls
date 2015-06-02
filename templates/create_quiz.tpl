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
            function setTimeLimit(value){
                
                switch(value){
                    case "Y":
                        $(".enter_time_limit").show();
                        break;
                    case "N":
                        $(".enter_time_limit").hide();
                        break;
                }
            }
            function addAnswerTypeYorn(value){
                if(parseInt(value) === 1){
                    $("#add_answer_type_yorn").show();
                    $("#addNewQuestion").show();
                    $("#add_answer_type_many_answers").hide();
                }
                if(parseInt(value) === 2){
                    $("#add_answer_type_many_answers").show();
                    $("#add_answer_type_yorn").hide();
                    $("#addNewQuestion").hide();
                }
                if(parseInt(value) === 3) {
                    $("#add_answer_type_many_answers").hide();
                    $("#add_answer_type_yorn").hide();
                    $("#addNewQuestion").hide();
                    $("#add_answer_type_many_answers_some").show();
                }
                if(parseInt(value) === 4) {
                    $("#add_answer_type_many_answers").hide();
                    $("#add_answer_type_yorn").hide();
                    $("#addNewQuestion").show();
                }
                
            }
            function checkTopicQuiz(value){
                $.post("checkForms.php", { action: "check", field: "topic quiz", name: value }, function( data ) {
                if(data == 'true'){
                    $("#yes_topic").show();
                    $(".unsuitable").show();
                    $("#no_topic").hide();
                }
                else{
                    $("#yes_topic").hide();
                    $(".unsuitable").hide();
                    $("#no_topic").show();
                }
              });              
            }
            function showEditQuiz(){
                $("#quiz").show();
            }
            function hideEditQuiz(){
                $("#quiz").hide();
            }  
            function addNewAnswer(){
                var answer = $('textarea[name = "answer_the_question"]').val();
                var text = '<tr><td><input type="radio" class="answer_the_question" name="answer_the_question" value="'+answer+'">'+answer+' <a href="#" onclick="$(\'[value = '+answer+']\').remove()">Удалить</a></td></tr>';
                $(".new_answer").append(text);
                $('textarea[name = "answer_the_question"]').val("");
                $("#addNewQuestion").show();
                
            }
            function addSomeNewAnswer(){
                var answer = $('textarea[name = "answer_some_the_question"]').val();
                var text = '<tr><td><input type="checkbox" class="answer_some_the_question" name="answer_some_the_question" value="'+answer+'">'+answer+' <a href="#" onclick="$(\'[value = '+answer+']\').remove()">Удалить</a></td></tr>';
                $(".new_some_answer").append(text);
                $('textarea[name = "answer_some_the_question"]').val("");
                $("#addNewQuestion").show();
                
            }
        </script>  
        <div class="wrapper">
            <div class="content">
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
                                        <input type='hidden' name='button_click' value='create_quiz'>
                                        Тема опроса:<br>
                                        <input type="text" name="topic_quiz" placeholder="Ваша тема" required  onblur="checkTopicQuiz(this.value)"> 
                                        <span class="unsuitable" id="no_topic" style="display: none; color: red">Такое название уже есть</span>
                                        <span id="yes_topic" style="display: none; color: green">Ок</span>
                                        <br>
                                        Время выполнения опроса:<Br>
                                        <input type="radio" name="time_limit" value="Y" id="time_limit" onchange = 'setTimeLimit((this.getAttribute("value")))'> Да<Br>
                                        <input type="radio" name="time_limit" value="N" id="time_limit" onchange = 'setTimeLimit((this.getAttribute("value")))' checked> Нет<Br>
                                        <div class="enter_time_limit" style="display: none">
                                            
                                            Установите время: <input type="time" name="set_time_limit" id="set_time_limit" value="{$max_time}">
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
                                        <span class="unsuitable">
                                            <input type="submit" value="Создать опрос"></span>         
                                    </form> 
                                {/capture} 
                                {capture name='menu_questions'}
                                    <h2>Опрос: {$data_one_quiz->topic}</h2>
                                    <form method="post">
                                        <a href='create_quiz.php?action=new_question'>Добавить вопрос</a>
                                        <a href='create_quiz.php?action=add_inteviewee'>Добавить тестируемых</a>
                                    </form>  
                                    <table>
                                    <tr>
                                        <td>
                                            Порядок вопроса
                                        </td>
                                        <td>
                                            Текст вопроса
                                        </td>
                                        <td>
                                            Тип вопроса
                                        </td>
                                        <td>
                                            Редактирование вопроса
                                        </td>
                                        <td>
                                            Удалить вопрос
                                        </td>
                                    </tr>
                                       {foreach $data_questions as $data_question_one}  
                                           {if $data_question_one}
                                       <tr>
                                           <td>
                                               №
                                           </td>
                                           <td>
                                            {$data_question_one->text_question}
                                           </td>
                                            <td>
                                                
                                                {if  {$data_question_one->id_questions_type}==1}
                                                Вопрос типа Да/Нет
                                              {elseif  {$data_question_one->id_questions_type}==2}
                                                  Вопрос с возможностью выбора одного ответа из списка
                                              {elseif  {$data_question_one->id_questions_type}==3}
                                                Вопрос с возможностью выбора одного или более ответов из списка
                                              {elseif  {$data_question_one->id_questions_type}==4}
                                                Произвольный текст
                                            {/if} 
                                           </td>
                                           <td>
                                                <a href="?action=edit_question&id_question={$data_question_one->id_question}">Редактировать</a>
                                           </td>
                                           <td>
                                               <a href="?action=delete&id_question={$data_question_one->id_question}">Удалить</a>
                                           </td>
                                       </tr>
                                       {/if}
                                {/foreach}
                                    </table>
                                {/capture}
                                {capture name='new_question'}
                                    <form method="post">
                                        Текст вопроса <br>
                                        <textarea rows="5" cols="40" name="text_question" placeholder="Ваш вопрос" required></textarea><br>
                                        Дополнительная информация<br>
                                        <textarea rows="5" cols="40" name="comment_question"></textarea><br>
                                        Тип вопроса<br>
                                        <select  name="question_type"  onchange ='addAnswerTypeYorn(this.options[this.selectedIndex].value);'>
                                            <option  value="1">Да/Нет/Не знаю</option>
                                            <option value="2">Один ответа из списка</option>
                                            <option value="3">Выбор одного или более ответов из списка</option>
                                            <option value="4" selected>Произвольный ответ</option>
                                        </select><br>  
                                        <div id='add_answer_type_yorn' style="display: none">
                                            Выберите привильный ответ<br>
                                            <input type='radio' name='add_answer_type_yorn' value='Yes' checked="">Да<br>
                                            <input type='radio' name='add_answer_type_yorn' value='No'>Нет
                                        </div>                                        
                                        <div id="addNewQuestion" style="display: none">
                                            <button name="button_click" value="add_question"> Создать вопрос</button>
                                        </div>
                                        <div id='add_answer_type_many_answers' style="display: none">
                                        <form  method='post'>
                                        Текст ответа<br>
                                        <textarea id='addQuestion' rows="5" cols="40" name="answer_the_question"></textarea> 
                                        <a href="javascript: void(0);" onclick="addNewAnswer();">Добавить ответ</a>
                                    
                                        <table>                                                
                                            <tr>
                                            <div class="new_answer"></div>
                                            </tr>                                       
                                        </table> 
                                        </form>
                                    </div>
                                        
                                        <div id='add_answer_type_many_answers_some' style="display: none">
                                        <form  method='post'>
                                        Текст ответа<br>
                                        <textarea id='addSomeQuestion' rows="5" cols="40" name="answer_some_the_question"></textarea> 
                                        <a href="javascript: void(0);" onclick="addSomeNewAnswer();">Добавить ответ</a>
                                    
                                        <table>                                                
                                            <tr>
                                            <div class="new_some_answer"></div>
                                            </tr>                                       
                                        </table> 
                                        </form>
                                    </div>
                                        
                                {/capture}
                                {capture name='add_answer_option_one'}
                                    <form  method='post'>
                                        Текст ответа<br>
                                        <textarea id='addQuestion' rows="5" cols="40" name="answer_the_question"></textarea> 
                                        <button name="button_click" value='add_answer_option_one'>Добавить ответ</button>
                                    
                                    <table>
                                        {foreach $data_answer_option as $one_data_answer_option}                                                
                                            <tr>
                                                <td>
                                                    {if $one_data_answer_option->right_answer == 'Y'}
                                                        <input type="radio" name="value_answer_option" value="{$one_data_answer_option->id_answer_option}" checked>
                                                    {elseif $one_data_answer_option->right_answer == 'N'}
                                                        <input type="radio" name="value_answer_option" value='{$one_data_answer_option->id_answer_option}'>
                                                    {/if}
                                                </td>
                                                <td> 
                                                    {$one_data_answer_option->answer_the_questions}
                                                </td>
                                            </tr>
                                        {/foreach}                                        
                                    </table>   
                                    <button name="button_click" value='add_right_answer_option_one'>Внести ответы</button>
                                    </form>
                                {/capture}
                                {capture name='add_answer_option_more'}
                                    Добавить несколько варианты ответов
                                {/capture}
                                {capture name='edit_quiz'}
                                    <h2><a href="javascript: void(0);" onclick="showEditQuiz();"><img src="img/edit.png" width='30' height='30'></a>Опрос: {$data_one_quiz->topic}</h2>
                                    <div id="quiz" style="display: none">
                                    <form method="post">
                                        <input type="hidden" name="id_quiz" value="{$data_one_quiz->id_test}">
                                        <table width="60%" align="center" bgcolor="#87CEFA">
                                            <tr>
                                                <td>
                                                    Тема опроса
                                                </td>
                                                <td>
                                                    <input type="text" name="topic" value="{$data_one_quiz->topic}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Ограничение времени
                                                </td>
                                                <td>
                                                    <input type="text" name="time_limit" value="{$data_one_quiz->time_limit}">
                                                </td>
                                            </tr>  
                                            <tr>
                                                <td>
                                                    Комментарий к опросу
                                                </td>
                                                <td>
                                                    <input type="text" name="comment_test" value="{$data_one_quiz->comment_test}">
                                                </td>
                                            </tr>  
                                            <tr>
                                                <td>
                                                    Смотреть результат
                                                </td>
                                                <td>
                                                    <input type="text" name="see_the_result" value="{$data_one_quiz->see_the_result}">
                                                </td>
                                            </tr> 
                                            <tr>
                                                <td>
                                                    Смотреть детальную информацию
                                                </td>
                                                <td>
                                                    <input type="text" name="see_details" value="{$data_one_quiz->see_details}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Состояние теста
                                                </td>
                                                <td>
                                                    <input type="text" name="id_status_test" value="{$data_one_quiz->id_status_test}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Статус теста
                                                </td>
                                                <td>
                                                    <input type="text" name="vasibility_test" value="{$data_one_quiz->vasibility_test}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="submit" value="Изменить опрос">
                                                </td>
                                                <td align="right">
                                                    <a href='javascript: void(0);' onclick='hideEditQuiz();'><img src="img/exit.png" width="20" height="20"></a>
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                    </div>            
                                    {$smarty.capture.menu_questions}
                                {/capture}
                                
                                {capture name=edit_question}
                                    Редактирование вопроса
                                {/capture}
                                {capture name=add_inteviewee}
                                    <h2>Добавить опрашиваемых</h2>
                                    <form method="post">
                                    <table>                                            
                                        <tr>
                                            <td>
                                                <h3>Добавить пользователя</h3>
                                            </td>
                                            <td>
                                                <h3>Добавить группу</h3>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" size="50%">
                                            </td>
                                            <td>
                                                <input type="text" size="50%">
                                            </td>
                                        </tr>
                                    </table>
                                    <input type="submit">
                                    </form>   
                                        
                                        
                                {/capture}    
                                    {if {$view_quiz} eq 'new_quiz'}
                                        {$smarty.capture.new_quiz}   
                                    {elseif {$view_quiz} eq 'menu_questions'}
                                        {$smarty.capture.menu_questions}
                                    {elseif {$view_quiz} eq 'new_question'}
                                        {$smarty.capture.new_question}
                                    {elseif {$view_quiz} eq 'add_answer_option_one'}
                                        {$smarty.capture.add_answer_option_one}
                                    {elseif {$view_quiz} eq 'add_answer_option_more'}
                                        {$smarty.capture.add_answer_option_more}    
                                    {elseif {$view_quiz} eq 'edit_quiz'}
                                        {$smarty.capture.edit_quiz}    
                                    {elseif {$view_quiz} eq 'add_inteviewee'}
                                        {$smarty.capture.add_inteviewee}     
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
                                </div>
        {include file='footer.tpl'}       
        </div>
    </body>
</html>
