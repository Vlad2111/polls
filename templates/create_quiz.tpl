<html>
    <head>
        <title>{$title}</title>
        <meta charset="UTF-8">
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script src="js/jquery-2.1.3.min.js"></script>
        <link rel="stylesheet" href="css/styles.css">
		<link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">	
		<link href="css/simple-sidebar.css" rel="stylesheet">
		<link href="css/navbar-fixed-top.css" rel="stylesheet">
        <script src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/bootstrap-timepicker.min.js"></script>
		<script type="text/javascript" src="js/moment-with-locales.min.js"></script>
		<link rel="stylesheet" href="css/bootstrap-timepicker.min.css">
    </head>
    <body>
        <script type="text/javascript">
        $(document).ready(function()
        {
            addAnswerTypeYorn(document.getElementById("question_type").options[document.getElementById("question_type").selectedIndex].value);
        });
        $("#tags").autocomplete({
            source: 'search.php',
            onSelect: function(data, value){
                alert('data');
             },
             lookup: ['January', 'February', 'March']
        });
        
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
				if(parseInt(value) === 0){
                    $("#add_answer_type_many_answers").hide();
                    $("#add_answer_type_many_answers_some").hide();
                    $("#add_answer_type_yorn").hide();
					document.getElementById("create-question").disabled = true;
                }
                if(parseInt(value) === 1){
                    $("#add_answer_type_yorn").show();
					document.getElementById("create-question").disabled = false;
                    $("#add_answer_type_many_answers").hide();
                    $("#add_answer_type_many_answers_some").hide();
                }
                if(parseInt(value) === 2){
                    $("#add_answer_type_many_answers").show();
                    $("#add_answer_type_yorn").hide();
                    $("#add_answer_type_many_answers_some").hide();
                    document.getElementById("create-question").disabled = true;
                }
                if(parseInt(value) === 3) {
                    $("#add_answer_type_many_answers").hide();
                    $("#add_answer_type_yorn").hide();
                    document.getElementById("create-question").disabled = true;
                    $("#add_answer_type_many_answers_some").show();
                }
                if(parseInt(value) === 4) {
                    $("#add_answer_type_many_answers").hide();
                    $("#add_answer_type_many_answers_some").hide();
                    $("#add_answer_type_yorn").hide();
                    document.getElementById("create-question").disabled = false;
                }
            }
            function checkTopicQuiz(value){
			    if(value != ""){
                    $.post("checkForms.php", { action: "check", field: "topic quiz", name: value }, function( data ) {
				
                    if(data == 1){
					    $("#inp").removeClass("has-error");
                        $("#inp").addClass("has-success");
					    document.getElementById("button-create").disabled = false;
					    $("#glyphicon").removeClass("glyphicon-remove");
					    $("#glyphicon").addClass("glyphicon-ok");
                    }
                    else{
					    $("#inp").removeClass("has-success");
					    $("#inp").addClass("has-error");
					    document.getElementById("button-create").disabled = true;
					    $("#glyphicon").removeClass("glyphicon-ok");
					    $("#glyphicon").addClass("glyphicon-remove");
                    }
                  });  
			    }
			    else{
				    $("#inp").removeClass("has-success");
				    $("#inp").removeClass("has-error");
				    $("#glyphicon").removeClass("glyphicon-ok");
				    $("#glyphicon").removeClass("glyphicon-remove");
			    }
            }
            function showEditQuiz(){
                $("#quiz").show();
            }
            function hideEditQuiz(){
                $("#quiz").hide();
            }
            var int = 1;  
            function addNewAnswer(){
               /* var answer = $('textarea[name = "answer_the_question"]').val();
                var text = '<tr><td><input type="radio" class="answer_the_question" name="answer_the_question" value="'+answer+'">'+answer+' <a href="#" onclick="$(\'[value = '+answer+']\').remove()">Удалить</a></td></tr>';
                $(".new_answer").append(text);
                $('textarea[name = "answer_the_question"]').val("");
                $("#addNewQuestion").show();*/
                var text = '<div class="row" id="'+int+'"><div class="col-xs-10"><div  class="input-group"><span class="input-group-addon" id="radios[]"><input type="radio" value="'+int+'" name="rad[]" aria-label="..."></span><input type="text" name="texting[]" id="texting'+int+'" class="form-control" aria-label="..." onblur="checkAnswer(this.value)"></div></div><div class="col-xs-2 padding-top10"><a  onclick="$(\'[id = '+int+']\').remove()"><span class="glyphicon glyphicon-trash"></span></a></div></div>';
                $(".foraddradio").append(text);
                int++;
			    document.getElementById("create-question").disabled = true;
                
            }
            function checkAnswer(value) {
                var flag;
                for(var i=0;i<int;i++){
                    if(document.getElementById('texting'+i) && document.getElementById('texting'+i).value == ""){
                        flag=false;
                    }
                }
                
                if(flag == false){
			        document.getElementById("create-question").disabled = true;
                }
                else{   
				    document.getElementById("create-question").disabled = false;
                }
            }
            var intr = 1;
            function addSomeNewAnswer(){
                var text = '<div class="row" id="'+intr+'"><div class="col-xs-10"><div  class="input-group"><span class="input-group-addon" id="radios[]"><input type="checkbox" form="test_passing" value="'+intr+'" name="checkbox[]" aria-label="..."></span><input type="text" form="test_passing" name="textr[]" id="textr'+intr+'" class="form-control" aria-label="..." onblur="checkSomeAnswer(this.value)"></div></div><div class="col-xs-2 padding-top10"><a  onclick="$(\'[id = '+intr+']\').remove()"><span class="glyphicon glyphicon-trash"></span></a></div></div>';
                $(".foraddcheckbox").append(text);
                intr++;
			    document.getElementById("create-question").disabled = true;
            }
            function checkSomeAnswer(value) {
                var flagr;
                for(var j=0;j<intr;j++){
                    if(document.getElementById('textr'+j) && document.getElementById('textr'+j).value == ""){
                        flagr=false;
                    }
                }
                
                if(flagr == false){
			        document.getElementById("create-question").disabled = true;
                }
                else{   
				    document.getElementById("create-question").disabled = false;
                }
            }
        </script>  
        {include file='header.tpl'}
        <div id="wrapper">
            {capture name='new_quiz'}
            <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
			{if {$data_role[2]} eq 3}
                <li class="sidebar-brand">
                        Меню администратора
                </li>
                <li>
                    <a href="administration.php?link_click=show_quiz">Опросы</a>
                </li>
				<li>
					<a href="administration.php?link_click=show_users">Пользователи</a>
				</li>
			{/if}
			{if {$data_role[1]} eq 2}
                <li class="sidebar-brand">
                    Меню автора теста
                </li>
                <li>
                    <a href="author_quiz.php">Мои опросы</a>
                </li>
                <li>
                    <a class="foc" href="create_quiz.php?link_click=new_quiz">Создать опрос</a>
                </li>
			{/if}
			{if  {$data_role[0]} eq 1}
                <li class="sidebar-brand">
                    Меню тестируемого
                </li>
                <li>
                    <a href="main.php">Список тестов</a>
                </li>
			{/if}
            </ul>
        </div>
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <form method="post">
                    <table class="table">
                        <tbody>
						    <tr>
                                <td class='info' width="35%">
                                    <input type='hidden' name='button_click' value='create_quiz'>
                                    <b>Тема опроса:</b>
                                </td>
                                <td>
								    <div class="form-group has-feedback" id="inp">
                                    <input class="form-control" type="text" name="topic_quiz" placeholder="Ваша тема" required onblur=
								    "checkTopicQuiz(this.value)">
								    <span class="glyphicon form-control-feedback" id="glyphicon"></span>
								    </div>
							    </td>
						    </tr>
                            <!--<tr>
                                <td class='info' width="35%">
                                    <b>Время выполнения опроса:</b>
                                </td>
                                <td>
                                    <input type="radio" name="time_limit" value="Y" id="time_limit" onchange = 'setTimeLimit((this.getAttribute("value")))'> Да<Br>
                                    <input type="radio" name="time_limit" value="N" id="time_limit" onchange = 'setTimeLimit((this.getAttribute("value")))' checked> Нет
                                </td>
                            </tr>-->
                            <tr data-toggle="tooltip" data-placement="right" title="Усановите время в формате ЧЧ:ММ. Неустановленное время, означает о безлимитности теста">
                                <div class="enter_time_limit" style="display: none">
                                <td class='info'>
                                    <b>Установите время:</b>
                                </td>
                                <td>
                                    <div class="input-group">
								        <input class="form-control" type="number" pattern="[0-9]*" id="hour" name="hour" aria-describedby="basic-addon2"> 
								        <span class="input-group-addon" id="basic-addon2">ЧЧ</span>
								        
								        <input class="form-control" type="number" pattern="[0-9]*" id="minutes" name="minutes" aria-describedby="basic-addon3"> 
									    <span class="input-group-addon" id="basic-addon3">ММ</span>
								    </div>
                                </td>
                                </div>
                            </tr>
                            <tr>
                                <td class='info'>
                                    <b>Дополнительная информация:</b>
                                </td>
                                <td>
                                    <textarea rows="5" cols="40" name="comment_test" class="form-control" placeholder="Информация, которая необходима для прохождения теста"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td class='info'>
                                    <b>Разрешить смотреть результаты опроса:</b>
                                </td>
                                <td>
                                    <input type="radio" name="see_the_result" value="Y" checked> Да<Br>
                                    <input type="radio" name="see_the_result" value="N"> Нет
                                </td>
                            </tr>
                            <tr>
                                <td class='info'>
                                    <b>Разрешить смотреть детальную информацию:</b>
                                </td>
                                <td>
                                    <input type="radio" name="see_details" value="Y" checked> Да<Br>
                                    <input type="radio" name="see_details" value="N"> Нет<Br> 
                                </td>
                            </tr>
                        </tbody>
                    </table>                                       
                    <input type="hidden" name="status_test" value="1">
                    <span class="unsuitable">
                        <input class="btn btn-primary" id="button-create" type="submit" value="Создать опрос">
                    </span>         
                </form> 
            </div>
        </div>
        {/capture} 
        {capture name='menu_questions'}
        {include file='menu.tpl'}
            <form method="post">
                <a href='create_quiz.php?action=new_question'>Добавить вопрос</a>
                <a href='create_quiz.php?action=add_inteviewee'>Тестируемые</a>
            </form>  
            <table class='table'>
            <thead>
                <th>
                    Порядок вопроса
                </th>
                <th>
                    Текст вопроса
                </th>
                <th>
                    Тип вопроса
                </th>
                <th>
                    Удалить вопрос
                </th>
            </thead>
            <tbody>
           {foreach $data_questions as $data_question_one}  
               {if $data_question_one}
               <tr>
                   <td>
                       №
                   </td>
                   <td>
                    <a href="?action=edit_question&id_question={$data_question_one->id_question}">{$data_question_one->text_question}</a>
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
                       <a class="btn btn-primary btn-xs" href="?action=delete&id_question={$data_question_one->id_question}">Удалить</a>
                   </td>
               </tr>
               {/if}
        {/foreach}
            </tbody>
        </table>
        {/capture}
        {capture name='new_question'}
        {include file='menu.tpl'}
            <div id="page-content-wrapper">
                <div class="container-fluid">
                    <form method="post" id="test_passing">
                        <table class="table">
                            <tr>
                                <td class='info' width='35%'>
                                    <b>Текст вопроса</b> 
                                </td>
                                <td>
                                    <textarea class="form-control" rows="5" cols="40" name="text_question" placeholder="Ваш вопрос" required></textarea><br>
                                </td>
                            </tr>
                            <tr>
                                <td class='info'>
                                    <b>Дополнительная информация</b>
                                </td>
                                <td>
                                    <textarea class="form-control" rows="5" cols="40" name="comment_question"></textarea><br>
                                </td>
                            </tr>
                            <tr>
                                <td class='info'>
                                    <b>Тип вопроса</b>
                                </td>
                                <td>
                                    <select  name="question_type" id="question_type"  onchange ='addAnswerTypeYorn(this.options[this.selectedIndex].value);'>
										<option value="0" selected>--/--</option>
                                        <option value="1">Да/Нет/Не знаю</option>
                                        <option value="2">Один ответа из списка</option>
                                        <option value="3">Выбор одного или более ответов из списка</option>
                                        <option value="4">Произвольный ответ</option>
                                    </select>
                                </td>
                            </tr>
							<tr>
								<td class='info'>
								</td>
								<td>
									<div id='add_answer_type_yorn' style="display: none">
                                        Выберите привильный ответ<br>
                                        <input type='radio' form="test_passing" name='answer[]' value='Да' checked>Да<br>
                                        <input type='radio' form="test_passing" name='answer[]' value='Нет'>Нет
                                    </div>
								    <div id='add_answer_type_many_answers' style="display: none">
                                        <form  method='post'>
                                            Текст ответа<br>
                                            <div class="foraddradio">
                                                <div class="row" id="0">
                                                    <div class="col-xs-10">
                                                        <div  class="input-group">
                                                            <span class="input-group-addon" id="radios[]">
                                                                <input type="radio" value="0" name="rad[]" aria-label="..." checked>
                                                            </span>
                                                            <input type="text" name="texting[]" id="texting0" class="form-control" aria-label="..." onblur="checkAnswer(this.value)">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="javascript: void(0);" onclick="addNewAnswer();"><span class="glyphicon glyphicon-plus"></span></a>
                                        </form>
                                    </div>
                                    <div id='add_answer_type_many_answers_some' style="display: none">
                                        <form  method='post'>
                                            Текст ответа<br>
                                            <div class="foraddcheckbox">
                                                <div class="row" id="0">
                                                    <div class="col-xs-10">
                                                        <div  class="input-group">
                                                            <span class="input-group-addon">
                                                                <input type="checkbox" form="test_passing" value="0" name="checkbox[]" aria-label="..." checked>
                                                            </span>
                                                            <input type="text" form="test_passing" name="textr[]" id="textr0" class="form-control" aria-label="..." onblur="checkSomeAnswer(this.value)">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="javascript: void(0);" onclick="addSomeNewAnswer();"><span class="glyphicon glyphicon-plus"></span></a>
                                        </form>
                                    </div>
								</td>
							</tr>
                        </table>
                                              
                            <button class="btn btn-primary" id="create-question" form="test_passing" name="button_click" value="add_question" disabled> Создать вопрос</button>
                        
                        
                    </form>
                </div>
            </div>
        {/capture}
        {capture name='add_answer_option_one'}
		{include file='menu.tpl'}
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
                                {include file='menu.tpl'}
                                <div id="page-content-wrapper">
            <div class="container-fluid">
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
                                    </div>
                                </div>
                                {/capture}
                                
            {capture name=edit_question}
            {include file='menu.tpl'}
            <div id="page-content-wrapper">
                <div class="container-fluid">
                    <form method="post" id="test_passing">
                        <table class="table">
                            <tr>
                                <td class='info' width='35%'>
                                    <b>Текст вопроса</b> 
                                </td>
                                <td>
                                    <textarea class="form-control" rows="5" cols="40" name="text_question" placeholder="Ваш вопрос" required>{$data_one_question->text_question}</textarea><br>
                                </td>
                            </tr>
                            <tr>
                                <td class='info'>
                                    <b>Дополнительная информация</b>
                                </td>
                                <td>
                                    <textarea class="form-control" rows="5" cols="40" name="comment_question">{$data_one_question->comment_question}</textarea><br>
                                </td>
                            </tr>
                            <tr>
                                <td class='info'>
                                    <b>Тип вопроса</b>
                                </td>
                                <td>
                                    
                                    <select  name="question_type" id="question_type" onchange ='addAnswerTypeYorn(this.options[this.selectedIndex].value);'>
										<option value="0">--/--</option>
                                        <option value="1" {if $data_one_question->id_questions_type == 1}selected{/if}>Да/Нет/Не знаю</option>
                                        <option value="2" {if $data_one_question->id_questions_type == 2}selected{/if}>Один ответа из списка</option>
                                        <option value="3" {if $data_one_question->id_questions_type == 3}selected{/if}>Выбор одного или более ответов из списка</option>
                                        <option value="4" {if $data_one_question->id_questions_type == 4}selected{/if}>Произвольный ответ</option>
                                    </select>
                                </td>
                            </tr>
							<tr>
								<td class='info'>
								</td>
								<td>
									<div id='add_answer_type_yorn' style="display: none">
                                        Выберите привильный ответ<br>
                                        <input type='radio' form="test_passing" name='answer[]' value='Да' {if $option_one->right_answer == 'Y'}checked{/if}>Да<br>
                                        <input type='radio' form="test_passing" name='answer[]' value='Нет' {if $option_one->right_answer == 'Y'}checked{/if}>Нет
                                    </div>
								    <div id='add_answer_type_many_answers' style="display: none">
                                        <form  method='post'>
                                            Текст ответа<br>
                                            <div class="foraddradio">
                                            {$vars = 0}
                                            {foreach $data_answer_option as $option_one}
                                                {if $vars == 0}
                                                    <div class="row" id="0">
                                                        <div class="col-xs-10">
                                                            <div  class="input-group">
                                                                <span class="input-group-addon" id="radios[]">
                                                                    <input type="radio" value="0" name="rad[]" aria-label="..." {if $option_one->right_answer == 'Y'}checked{/if}>
                                                                </span>
                                                                <input type="text" name="texting[]" id="texting0" class="form-control" aria-label="..." onblur="checkAnswer(this.value)" value="{$option_one->answer_the_questions}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {$vars=1}
                                                {else}
                                                <script type="text/javascript">
                                                addRadioAnswer(1);
                                                   function addRadioAnswer(col){
                                                   if(col==1){
                                                    var text = '<div class="row" id="'+int+'"><div class="col-xs-10"><div  class="input-group"><span class="input-group-addon" id="radios[]"><input type="radio" value="'+int+'" name="rad[]" aria-label="..." {if $option_one->right_answer == 'Y'}checked{/if}></span><input type="text" name="texting[]" id="texting'+int+'" class="form-control" aria-label="..." onblur="checkAnswer(this.value)" value="{$option_one->answer_the_questions}"></div></div><div class="col-xs-2 padding-top10"><a  onclick="$(\'[id = '+int+']\').remove()"><span class="glyphicon glyphicon-trash"></span></a></div></div>';
                                                    }
                                                    else {
                                                    var text = '<div class="row" id="'+int+'"><div class="col-xs-10"><div  class="input-group"><span class="input-group-addon" id="radios[]"><input type="radio" value="'+int+'" name="rad[]" aria-label="..."></span><input type="text" name="texting[]" id="texting'+int+'" class="form-control" aria-label="..." onblur="checkAnswer(this.value)"></div></div><div class="col-xs-2 padding-top10"><a  onclick="$(\'[id = '+int+']\').remove()"><span class="glyphicon glyphicon-trash"></span></a></div></div>';
                                                    }
			                                        int++;
                                                    $(".foraddradio").append(text);
			                                        document.getElementById("create-question").disabled = true;
			                                        }
                                                </script>
                                                
                                                {/if}
                                            {/foreach}
                                            <script type="text/javascript">
                                                checkAnswer(0);
                                            </script>
                                            </div>
                                            <a href="javascript: void(0);" onclick="addRadioAnswer(0);"><span class="glyphicon glyphicon-plus"></span></a>
                                        </form>
                                    </div>
                                    <div id='add_answer_type_many_answers_some' style="display: none">
                                        <form  method='post'>
                                            Текст ответа<br>
                                            <div class="foraddcheckbox">
                                            {$vars = 0}
                                            {foreach $data_answer_option as $option_one}
                                                {if $vars == 0}
                                                <div class="row" id="0">
                                                    <div class="col-xs-10">
                                                        <div  class="input-group">
                                                            <span class="input-group-addon">
                                                                <input type="checkbox" form="test_passing" value="0" name="checkbox[]" aria-label="..." {if $option_one->right_answer == 'Y'}checked{/if}>
                                                            </span>
                                                            <input type="text" form="test_passing" name="textr[]" id="textr0" class="form-control" aria-label="..." onblur="checkSomeAnswer(this.value)" value="{$option_one->answer_the_questions}">
                                                        </div>
                                                    </div>
                                                </div>
                                                {$vars=1}
                                                {else}
                                                <script type="text/javascript">
                                                addCheckAnswer(1);
                                                   function addCheckAnswer(col){
                                                   if(col==1){
                                                    var text = '<div class="row" id="'+intr+'"><div class="col-xs-10"><div  class="input-group"><span class="input-group-addon" id="radios[]"><input type="checkbox" form="test_passing" value="'+intr+'" name="checkbox[]" aria-label="..." {if $option_one->right_answer == 'Y'}checked{/if}></span><input type="text" form="test_passing" name="textr[]" id="textr'+intr+'" class="form-control" aria-label="..." onblur="checkSomeAnswer(this.value)" value="{$option_one->answer_the_questions}"></div></div><div class="col-xs-2 padding-top10"><a  onclick="$(\'[id = '+intr+']\').remove()"><span class="glyphicon glyphicon-trash"></span></a></div></div>';
                                                    }
                                                    else {
                                                    var text = '<div class="row" id="'+intr+'"><div class="col-xs-10"><div  class="input-group"><span class="input-group-addon" id="radios[]"><input type="checkbox" form="test_passing" value="'+intr+'" name="checkbox[]" aria-label="..."></span><input type="text" form="test_passing" name="textr[]" id="textr'+intr+'" class="form-control" aria-label="..." onblur="checkSomeAnswer(this.value)"></div></div><div class="col-xs-2 padding-top10"><a  onclick="$(\'[id = '+intr+']\').remove()"><span class="glyphicon glyphicon-trash"></span></a></div></div>';
                                                    }
			    intr++;         
                $(".foraddcheckbox").append(text);
			    document.getElementById("create-question").disabled = true;
			    }
                                                </script>
                                                
                                                {/if}
                                            {/foreach}
                                            <script type="text/javascript">
                                                checkSomeAnswer(0);
                                            </script>
                                            </div>
                                            <a href="javascript: void(0);" onclick="addCheckAnswer(0);"><span class="glyphicon glyphicon-plus"></span></a>
                                        </form>
                                    </div>
								</td>
							</tr>
                        </table>
                                              
                            <button class="btn btn-primary" id="create-question" form="test_passing" name="button_click" value="edit_question" disabled> Создать вопрос</button>
                        
                        
                    </form>
                </div>
            </div>
            {/capture}
            {capture name=add_inteviewee}
            {include file='menu.tpl'}
            <div id="page-content-wrapper">
                <div class="container-fluid">
                    Тестируемые пользователи
                    <table class="table">
                        <thead>
                            <th>
                                Фамилия пользователя
                            </th>
                            <th>
                                Имя пользователя
                            </th>
                            <th>
                                Тип пользователя
                            </th>
                            <th>
                                Статус пользователя
                            </th>
                            <th>
                                
                            </th>
                        </thead>
                        {foreach $users_data as $one_user_data}                                          
                            <tr>
                                <td class='info'>
                                    {$one_user_data->getLastName()}
                                </td>
                                <td class='info'>
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
                                    {if $one_user_data->getUserVasibility()==1}
                                        Активный
                                    {else}
                                        Неактивный
                                    {/if}    
                                </td>
                                <td>
                                    {if $one_user_data->getLdapUser()==0}
                                        <a>Удалить</a>
                                    {/if}
                                </td>
                            </tr>
                        {/foreach}
                    </table>
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
                                                <input id="tags" name="tags" type="text" size="50%">
                                            </td>
                                            <td>
                                                <input type="text" size="50%">
                                            </td>
                                        </tr>
                                    </table>
                                    <input type="submit">
                                    </form>   
                </div>
            </div>        
                                        
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
                                    {elseif {$view_quiz} eq 'edit_question'}
                                        {$smarty.capture.edit_question}    
                                    {elseif {$view_quiz} eq 'add_inteviewee'}
                                        {$smarty.capture.add_inteviewee}     
                                     {/if}
         </div>
    </body>
</html>

