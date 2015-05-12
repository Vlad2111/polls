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
                        $("#set_time_limit").val("12:00:00");
                        break;
                    case "N":
                        $(".enter_time_limit").hide();
                        break;
                }
            }
            function addAnswerTypeYorn(value){
                if(parseInt(value)===1){
                    $("#add_answer_type_yorn").show();
                }
                else{
                    $("#add_answer_type_yorn").hide();
                }
            }
            function checkTopicQuiz(value){
                $.post("checkForms.php", { action: "check", field: "topic quiz", name: value }, function( data ) {
                if(data=='true'){
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
                                        <span class="unsuitable">
                                            <input type="submit" value="Создать опрос"></span>         
                                    </form> 
                                {/capture} 
                                {capture name='add_question'}
                                    <form method="post">
                                        <button name="button_click" value="new_question"> Добавить вопрос</button>                    
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
                                       {foreach $data_question as $data_question_one}
                                       <tr>
                                           <td>
                                               №
                                           </td>
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
                                           <td>
                                               Edit
                                           </td>
                                           <td>
                                               Delete
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
                                        <select  name="question_type"  onchange ='addAnswerTypeYorn(this.options[this.selectedIndex].value);'>
                                            <option  value="1">Да/Нет/Не знаю</option>
                                            <option value="2">Один ответа из списка</option>
                                            <option value="3">Выбор одного или более ответов из списка</option>
                                            <option value="4" selected>Произвольный ответ</option>
                                        </select><br>  
                                        <div id='add_answer_type_yorn' style="display: none">
                                            <input type='radio' name='add_answer_type_yorn' value='Yes' checked="">Да<br>
                                            <input type='radio' name='add_answer_type_yorn' value='No'>Нет
                                        </div>
                                        <button name="button_click" value="add_question"> Создать вопрос</button>
                                    </form> 
                                {/capture}
                                {capture name='add_answer_option_one'}
                                    <form  method='post'>
                                        Текст ответа<br>
                                        <textarea rows="5" cols="40" name="text_question"></textarea> 
                                        <button name="button_click" value="add_answer_option_one">Добавить ответ</button>
                                    </form>
                                {/capture}
                                {capture name='add_answer_option_more'}
                                    Добавить несколько варианты ответов
                                {/capture}
                                {capture name='edit_quiz'}
                                    {$smarty.capture.add_question}
                                {/capture}    
                                    
                                    {if {$view_quiz} eq 'new_quiz'}
                                        {$smarty.capture.new_quiz}   
                                    {elseif {$view_quiz} eq 'add_question'}
                                        {$smarty.capture.add_question}
                                    {elseif {$view_quiz} eq 'new_question'}
                                        {$smarty.capture.new_question}
                                    {elseif {$view_quiz} eq 'add_answer_option_one'}
                                        {$smarty.capture.add_answer_option_one}
                                    {elseif {$view_quiz} eq 'add_answer_option_more'}
                                        {$smarty.capture.add_answer_option_more}    
                                    {elseif {$view_quiz} eq 'edit_quiz'}
                                        {$smarty.capture.edit_quiz}    
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
        {include file='footer.tpl'}                        
    </body>
</html>
