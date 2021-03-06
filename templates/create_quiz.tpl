<html>
    <head>
        <title>{$title}</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script src="js/jquery-2.1.3.min.js"></script>
        <link rel="stylesheet" href="css/styles.css">
		<link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">	
		<link href="css/simple-sidebar.css" rel="stylesheet">
		<link href="css/navbar-fixed-top.css" rel="stylesheet">
		<link href="css/bootstrap-switch.css" rel="stylesheet">
		<link href="css/highlight.css" rel="stylesheet">
		<link href="http://getbootstrap.com/assets/css/docs.min.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/moment-with-locales.min.js"></script>
		<script type="text/javascript" src="js/autocomplete.js"></script>
		<script type="text/javascript" src="js/bootstrap-switch.js"></script>
    </head>
    <body>
        <script type="text/javascript">
            function changeOfResults(){
                if(ISchecked('see_the_result') && ISchecked('see_details')){
                    checkTopicQuiz($('#topic_quiz').val());
                } 
                else {
                    document.getElementById("button-create").disabled = true;
                }

            }
            function ISchecked(name)
            {
              var elements = document.getElementsByName(name);
              for (var i=0; i<elements.length; i++)  {
                if  (elements[i].checked) return true
              }
              return false
            }

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
				    $("#trForOptions").hide();
                    $("#add_answer_type_many_answers").hide();
                    $("#add_answer_type_many_answers_some").hide();
                    $("#add_answer_type_yorn").hide();
                    $("#add_rating_type").hide();
					document.getElementById("create-question").disabled = true;
					$("#trForSwitch").hide();
                }
                if(parseInt(value) === 1){
                    $("#trForOptions").show();
                    $("#add_answer_type_yorn").show();
					document.getElementById("create-question").disabled = false;
                    $("#add_answer_type_many_answers").hide();
                    $("#add_answer_type_many_answers_some").hide();
                    $("#add_rating_type").hide();
                    $("#trForSwitch").show();
                    if($('[name="switch"]').bootstrapSwitch('state')){
                        $("#trForWeight").show();
                        $("#trForChart").hide();
                    }
                    else {
                        $("#trForWeight").hide();
                        $("#trForChart").show();
                        $("#weight").val(null);
                        jQuery("input:radio").attr('disabled',true);
                        jQuery("input[name='checkbox[]']").attr('disabled',true);
                        jQuery("input:radio").attr('checked',false);
                        jQuery("input[name='checkbox[]']").attr('checked',false);
                    }
                    jQuery("input[name='show_chart']").attr('checked',false);
                }
                if(parseInt(value) === 2){
                    $("#trForOptions").show();
                    $("#add_answer_type_many_answers").show();
                    $("#add_answer_type_yorn").hide();
                    $("#add_answer_type_many_answers_some").hide();
                    $("#add_rating_type").hide();
                    document.getElementById("create-question").disabled = true;
                    $("#trForSwitch").show();
                    if($('[name="switch"]').bootstrapSwitch('state')){
                        $("#trForWeight").show();
                        $("#trForChart").hide();
                    }
                    else {
                        $("#trForWeight").hide();
                        $("#trForChart").show();
                        $("#weight").val(null);
                        jQuery("input:radio").attr('disabled',true);
                        jQuery("input[name='checkbox[]']").attr('disabled',true);
                        jQuery("input:radio").attr('checked',false);
                        jQuery("input[name='checkbox[]']").attr('checked',false);
                    }
                    jQuery("input[name='show_chart']").attr('checked',false);
                }
                if(parseInt(value) === 3) {
                    $("#trForOptions").show();
                    $("#add_answer_type_many_answers").hide();
                    $("#add_answer_type_yorn").hide();
                    document.getElementById("create-question").disabled = true;
                    $("#add_answer_type_many_answers_some").show();
                    $("#add_rating_type").hide();
                    $("#trForSwitch").show();
                    if($('[name="switch"]').bootstrapSwitch('state')){
                        $("#trForWeight").show();
                        $("#trForChart").hide();
                    }
                    else {
                        $("#trForWeight").hide();
                        $("#trForChart").show();
                        $("#weight").val(null);
                        jQuery("input:radio").attr('disabled',true);
                        jQuery("input[name='checkbox[]']").attr('disabled',true);
                        jQuery("input:radio").attr('checked',false);
                        jQuery("input[name='checkbox[]']").attr('checked',false);
                    }
                    jQuery("input[name='show_chart']").attr('checked',false);
                }
                if(parseInt(value) === 4) {
                    $("#trForOptions").hide();
                    $("#add_answer_type_many_answers").hide();
                    $("#add_answer_type_many_answers_some").hide();
                    $("#add_answer_type_yorn").hide();
                    document.getElementById("create-question").disabled = false;
                    $("#add_rating_type").hide();
                    $("#trForSwitch").hide();
                    $("#trForWeight").hide();
                    $("#trForChart").hide();
                    $("#weight").val(null);
                    jQuery("input:radio").attr('disabled',false);
                    jQuery("input[name='checkbox[]']").attr('disabled',false);
                    jQuery("input:radio").attr('checked',false);
                    jQuery("input[name='checkbox[]']").attr('checked',false);
                    jQuery("input[name='show_chart']").attr('checked',false);
                }
                if(parseInt(value) === 5) {
                    $("#trForOptions").show();
                    $("#add_answer_type_many_answers").hide();
                    $("#add_answer_type_many_answers_some").hide();
                    $("#add_answer_type_yorn").hide();
                    document.getElementById("create-question").disabled = false;
                    $("#add_rating_type").show();
                    $("#trForSwitch").hide();
                    $("#trForWeight").hide();
                    $("#trForChart").show();
                    $("#weight").val(null);
                    jQuery("input:radio").attr('disabled',false);
                    jQuery("input[name='checkbox[]']").attr('disabled',false);
                    jQuery("input[name='checkbox[]']").attr('checked',false);
                    jQuery("input[name='show_chart']").attr('checked',false);
                }
            }
            function checkLogin() {
                var value = $('#inputName').val();
			    if(value != ""){
                    $.post("checkForms.php", { action: "check", field: "login user", name: value }, function( data ) {
                        if (data == 1) {
                            $('#btn').click();
                        } else {
                            alert("Wrong login");
                        }
                    });
                }
            }
            function checkGroup() {
                var value = $('#inputGroup').val();
			    if(value != ""){
                    $.post("checkForms.php", { action: "check", field: "group", name: value }, function( data ) {
                        if (data == 1) {
                            $('#btnGroup').click();
                        } else {
                            alert("Wrong group");
                        }
                    });
                }
            }
            function checkNumber(value){
                if(value != "" && value >= 0 && value <= 100){
                    $("#weightDiv").addClass("has-success");
                    $("#weightGli").addClass("glyphicon-ok");
                    document.getElementById("create-question").disabled = false;
                }
                else {
                    $("#weightDiv").addClass("has-error");
                    $("#weightGli").addClass("glyphicon-remove");
                    document.getElementById("create-question").disabled = true;
                }
                if(value == ""){
                    $("#weightDiv").removeClass("has-success");
                    $("#weightGli").removeClass("glyphicon-ok");
                    $("#weightDiv").removeClass("has-error");
                    $("#weightGli").removeClass("glyphicon-remove");
                    document.getElementById("create-question").disabled = false;
                }
            }
            function checkTopicQuiz(value){
			    if(value != ""){
                    $.post("checkForms.php", { action: "check", field: "topic quiz", name: value }, function( data ) {
				
                    if(data == 1){
					    $("#inp").removeClass("has-error");
                        $("#inp").addClass("has-success");
					    $("#glyphicon").removeClass("glyphicon-remove");
					    $("#glyphicon").addClass("glyphicon-ok");
					    //if(ISchecked('see_the_result') && ISchecked('see_details')){
                            document.getElementById("button-create").disabled = false;
                        //}
                        //else {
                        //    document.getElementById("button-create").disabled = true;
                        //} 
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
				    document.getElementById("button-create").disabled = true;
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
                var text = '<div class="row" id="'+int+'"><div class="col-xs-10"><div  class="input-group"><span class="input-group-addon" id="radios[]"><input type="radio" value="'+int+'" name="rad[]" aria-label="..."></span><input type="text" name="texting[]" id="texting'+int+'" class="form-control" size="30" maxlength="1000" aria-label="..." onblur="checkAnswer(this.value)"></div></div><div class="col-xs-2 padding-top10"><a  onclick="$(\'[id = '+int+']\').remove()"><span class="glyphicon glyphicon-trash"></span></a></div></div>';
                $(".foraddradio").append(text);
                if($('[name="switch"]').bootstrapSwitch('state')){
                    jQuery("input:radio").attr('disabled',false);
                }
                else {
                    jQuery("input:radio").attr('disabled',true);
                    $("#trForWeight").hide();
                }
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
                var text = '<div class="row" id="'+intr+'"><div class="col-xs-10"><div  class="input-group"><span class="input-group-addon" id="radios[]"><input type="checkbox" form="test_passing" value="'+intr+'" name="checkbox[]" aria-label="..."></span><input type="text" form="test_passing" name="textr[]" id="textr'+intr+'" size="30" maxlength="1000" class="form-control" aria-label="..." onblur="checkSomeAnswer(this.value)"></div></div><div class="col-xs-2 padding-top10"><a  onclick="$(\'[id = '+intr+']\').remove()"><span class="glyphicon glyphicon-trash"></span></a></div></div>';
                $(".foraddcheckbox").append(text);
                if($('[name="switch"]').bootstrapSwitch('state')){
                    jQuery("input:checkbox").attr('disabled',false);
                }
                else {
                    jQuery("input:checkbox").attr('disabled',true);
                    $("#trForWeight").hide();
                }
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
            function changeStatusOfTest(value, id_test){
			    $.post("checkForms.php", { action: "update", field: "statusOfTest", status: value, id: id_test }, function( data ) {
			        if(parseInt(value) === 1){
			            jQuery("a").attr("disabled", false);
			            $("#testing_users_btn").attr("disabled", false);
		            }
		            if(parseInt(value) === 2){
		                jQuery("a").attr("disabled", true);
		                $("#testing_users_btn").attr("disabled", false);
		            }
		            if(parseInt(value) === 3) {
		                jQuery("a").attr("disabled", true);
		                $("#testing_users_btn").attr("disabled", true);
		            }
                });
            }
            function selectAll(){
                var inputList = document.getElementsByName("rowcheckboxes[]");
                if(document.getElementById("allcheckboxes").checked == true){
                    for ( var i = 0, elem; (elem = inputList[i++] ); ) {
                        if ( elem.type == 'checkbox') {
                            elem.checked = 'checked';
                        }
                    }
                }
                else {
                    for ( var i = 0, elem; (elem = inputList[i++] ); ) {
                        if ( elem.type == 'checkbox') {
                            elem.checked = '';
                        }
                    }
                }
            }
            function SendEmails(){
                var incrimentSendEmail = 0;
                {if isset($mails[0]) && isset($message)}
                    {foreach $mails as $ma}
                        var to = '{$ma}';
                        var message = "{$message}";
                        $.post("sendEmails.php", { subject: '{$subject}', message: message, to: to, from: '{$emailFrom->getEmail()}', name: '{$emailFrom->getFirstName()}', lastname: '{$emailFrom->getLastName()}' }, function( data ) {
                            if(data == 1) {
                                $("#Email"+incrimentSendEmail).addClass("success");
                            } else {
                                $("#Email"+incrimentSendEmail).addClass("danger");
                            }
                            incrimentSendEmail++;
                        });
                    {/foreach}
                {/if}
            }
            var incrimentFroEmail = 0;
            
            function checkRadio() {
                if(document.getElementById("question_type").selectedIndex == 1) {
                    var checked = ISchecked("answer[]");
                    if($('[name="switch"]').bootstrapSwitch('state') && checked == false){
                        alert("Выберите вариант ответа");
                    }
                    else {
                        $("#create-question_hide").click();
                    }
                }
                else if(document.getElementById("question_type").selectedIndex == 2) {
                    var checked = ISchecked("rad[]");
                    if($('[name="switch"]').bootstrapSwitch('state') &&  checked == false){
                        alert("Выберите вариант ответа");
                    }
                    else {
                        $("#create-question_hide").click();
                    }
                }
                else if(document.getElementById("question_type").selectedIndex == 5) {
                    var checked = ISchecked("rating");
                    if(checked == false){
                        alert("Выберите вариант ответа");
                    }
                    else {
                        $("#create-question_hide").click();
                    }
                }
                else {
                    $("#create-question_hide").click();
                }
            }
            function checkEdit(question, isAnswered) {
                //if(isAnswered == null){
                     document.getElementById('edit'+question).click();
               //}
               // else {
                //    alert("Изменение либо удаление невозможно! Пользователи уже отвечали на этот вопрос.");
               // }
            }
            function checkDelete(question, isAnswered) {
               if(isAnswered == null){
                     document.getElementById('delete'+question).click();
               }
               else {
                  document.getElementById('deleteModal'+question).click();
               }
            }
        </script>  
        {include file='header.tpl'}
        <div id="wrapper">
		{capture name='form_for_quiz'}
			<tr>
				<td class='info' width="35%">
					<input type='hidden' name='button_click' value='create_quiz'>
					<b>Тема опроса</b>
				</td>
				<td>
					<div class="form-group has-feedback" id="inp">
					    <input class="form-control" type="text" size="30" maxlength="150" value="{if isset($data_one_quiz->topic)}{$data_one_quiz->topic}{/if}" name="topic_quiz" id="topic_quiz" placeholder="Ваша тема" required onblur="checkTopicQuiz(this.value)">
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
					<b>Время на прохождение опроса</b>
				</td>
				<td>
					<div class="input-group">
						<input class="form-control" type="number" pattern="[0-9]*" id="hour" name="hour" aria-describedby="basic-addon2" value="{if isset($data_one_quiz->time_limit)}{$time_array[0]}{/if}"> 
						<span class="input-group-addon" id="basic-addon2">ЧЧ</span>
						
						<input class="form-control" type="number" pattern="[0-9]*" id="minutes" name="minutes" aria-describedby="basic-addon3" value="{if isset($data_one_quiz->time_limit)}{$time_array[1]}{/if}"> 
						<span class="input-group-addon" id="basic-addon3">ММ</span>
					</div>
				</td>
				</div>
			</tr>
			<tr>
				<td class='info'>
					<b>Дополнительная информация</b>
				</td>
				<td>
					<textarea rows="5" cols="40" maxlength="1000" name="comment_test" class="form-control" placeholder="Информация, которая необходима для прохождения теста" >{if isset($data_one_quiz->comment_test)}{$data_one_quiz->comment_test}{/if}</textarea>
				</td>
			</tr>
			<tr>
				<td class='info'>
					<b>Разрешить смотреть результаты опроса</b>
				</td>
				<td>
					<!--<input type="radio" name="see_the_result" id="see_the_result" value="Y" onchange="changeOfResults()" checked> Да<Br>
					<input type="radio" name="see_the_result" id="see_the_result" value="N" onchange="changeOfResults()" {if isset($data_one_quiz->see_the_result)}{if $data_one_quiz->see_the_result == "N"}checked{/if}{/if}> Нет-->
					<input type="checkbox" id="see_the_result" name="see_the_result" data-off-text="Нет" data-on-text="Да" {if !isset($data_one_quiz->see_the_result)} checked {/if}{if isset($data_one_quiz->see_the_result)}{if $data_one_quiz->see_the_result == "Y"}checked{/if}{/if}>
                        <script>
                            $(function(argument) {
                              $('[name="see_the_result"]').bootstrapSwitch();
                            });
                        </script>
				</td>
			</tr>
			<tr>
				<td class='info'>
					<b>Разрешить смотреть детальную информацию</b>
				</td>
				<td>
					<!--<input type="radio" name="see_details" id="see_details" value="Y" onchange="changeOfResults()" checked> Да<Br>
					<input type="radio" name="see_details" id="see_details" value="N" onchange="changeOfResults()" {if isset($data_one_quiz->see_details)}{if $data_one_quiz->see_details == "N"}checked{/if}{/if}> Нет<Br> -->
					<input type="checkbox" id="see_details" name="see_details" data-off-text="Нет" data-on-text="Да" {if !isset($data_one_quiz->see_details)} checked {/if}{if isset($data_one_quiz->see_details)}{if $data_one_quiz->see_details == "Y"}checked{/if}{/if}>
                        <script>
                            $(function(argument) {
                              $('[name="see_details"]').bootstrapSwitch();
                            });
                        </script>
				</td>
			</tr>
		{/capture}
        {capture name='new_quiz'}
            <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
			{if isset($data_role[2]) && $data_role[2] eq 3}
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
			{if isset($data_role[1]) && $data_role[1] eq 2}
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
			{if isset($data_role[0]) && $data_role[0] eq 1}
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
						        {$smarty.capture.form_for_quiz}
                            </tbody>
                        </table>                                       
                        <input type="hidden" name="status_test" value="1">
                        <span class="unsuitable">
                            <input class="btn btn-primary" id="button-create" type="submit" value="Создать опрос" disabled>
                        </span>         
                    </form> 
                </div>
            </div>
        {/capture}
        {capture name='new_question'}
        {include file='menu.tpl'}
            <div id="page-content-wrapper">
                <div class="container-fluid">
                     {if isset($data_one_quiz->id_status_test) && $data_one_quiz->id_status_test == 1}
                    <form method="post" id="test_passing">
                        <table class="table">
                            <tr>
                                <td class='info' width='35%'>
                                    <b>Текст вопроса</b> 
                                </td>
                                <td>
                                    <textarea class="form-control" rows="3" cols="40" name="text_question" placeholder="Ваш вопрос" maxlength="150" required></textarea><br>
                                </td>
                            </tr>
                            <tr>
                                <td class='info'>
                                    <b>Дополнительная информация</b>
                                </td>
                                <td>
                                    <textarea class="form-control" rows="5" cols="40" maxlength="1000" name="comment_question"></textarea><br>
                                </td>
                            </tr>
                            <tr>
                                <td class='info'>
                                    <b>Тип вопроса</b>
                                </td>
                                <td>
                                    <select class="form-control" name="question_type" id="question_type"  onchange ='addAnswerTypeYorn(this.options[this.selectedIndex].value);'>
										<option value="0" selected>--/--</option>
                                        <option value="1">Да/Нет</option>
                                        <option value="2">Один ответа из списка</option>
                                        <option value="3">Выбор одного или более ответов из списка</option>
                                        <option value="4">Произвольный ответ</option>
                                        <option value="5">Оценочная шкала</option>
                                    </select>
                                </td>
                            </tr>
                            <tr id="trForSwitch" style="display: none">
                                <td class='info'>
                                    <b>Валидация ответа</b>
                                </td>
                                <td>
                                    <input type="checkbox" id="switch" name="switch" data-off-text="Нет" data-on-text="Да" form="test_passing" checked>
                                    <script>
                                        $(function(argument) {
                                          $('[name="switch"]').bootstrapSwitch();
                                        });
                                        $('input[name="switch"]').on('switchChange.bootstrapSwitch', function(event, state) {
                                            if(state == true) {
                                                jQuery("input:radio").attr('disabled',false);
                                                jQuery("input[name='checkbox[]']").attr('disabled',false);
                                                jQuery("input:radio").attr('checked',false);
                                                jQuery("input[name='checkbox[]']").attr('checked',false);
                                                $("#trForWeight").show();
                                                $("#trForChart").hide();
                                            }
                                            else {
                                                jQuery("input:radio").attr('disabled',true);
                                                jQuery("input[name='checkbox[]']").attr('disabled',true);
                                                jQuery("input:radio").attr('checked',false);
                                                jQuery("input[name='checkbox[]']").attr('checked',false);
                                                $("#trForWeight").hide();
                                                $("#trForChart").show();
                                            }
                                        });
                                    </script>
                                </td>
                            </tr>
                            <tr id="trForWeight" style="display:none">
                                <td class='info'>
                                    <b>Вес вопроса</b>
                                </td>
                                <td>
                                <div class="form-group has-feedback" id="weightDiv">
                                    <input  class="form-control" type="number" id="weight" name="weight" form="test_passing" onchange="checkNumber(this.value)" >
                                    
				                    <span class="glyphicon form-control-feedback" id="weightGli"></span>
                                </div>
                                </td>
                            </tr>
							<tr id="trForOptions" style="display:none">
								<td class='info'>
								</td>
								<td>
									<div id='add_answer_type_yorn' style="display: none">
                                        Выберите правильный ответ<br>
                                        <input type='radio' form="test_passing" name='answer[]' value='Да'>Да<br>
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
                                                                <input type="radio" value="0" name="rad[]" aria-label="...">
                                                            </span>
                                                            <input  type="text" name="texting[]" id="texting0" class="form-control" aria-label="..." onblur="checkAnswer(this.value)" size="30" maxlength="1000">
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
                                                                <input type="checkbox" form="test_passing" value="0" name="checkbox[]" aria-label="...">
                                                            </span>
                                                            <input type="text" form="test_passing" name="textr[]" id="textr0" class="form-control" aria-label="..." onblur="checkSomeAnswer(this.value)" size="30" maxlength="1000">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="javascript: void(0);" onclick="addSomeNewAnswer();"><span class="glyphicon glyphicon-plus"></span></a>
                                        </form>
                                    </div>
                                    <div id='add_rating_type' style="display: none">
                                        <form  method='post'>
                                            Выберите вариант ответов</br>
                                            {foreach $mark_rating_type as $mrt}
                                            <div class="row padding-left10">
                                                    <input form="test_passing" type="radio" value="{$mrt[0]->option}" name="rating" id="{$mrt[0]->option}">
                                                    <label class="well well-sm" for="{$mrt[0]->option}">{$mrt[0]->text}</br> {$mrt[1]->text}</br> {$mrt[2]->text}</br> {$mrt[3]->text}</br> {$mrt[4]->text}</label>
                                            </div>
                                            {/foreach}
                                        </form>
                                    </div>
								</td>
							</tr>
							<tr id="trForChart" >
							    <form method='post'>
                                    <td class='info' width='35%'>
                                        <b>Показывать график</b> 
                                    </td>
                                    <td>
                                       <input type="checkbox" id="show_chart" form="test_passing" name="show_chart" data-off-text="Нет" data-on-text="Да">
                                        <script>
                                            $(function(argument) {
                                              $('[name="show_chart"]').bootstrapSwitch();
                                            });
                                        </script> 
                                    </td>
                                 </form>
                            </tr>
                        </table>
                        <input onclick="checkRadio()" class="btn btn-primary" id="create-question" value="Создать вопрос" disabled> 
                         <button style="display: none" class="btn btn-primary" id="create-question_hide" form="test_passing" name="button_click" value="add_question" > Создать вопрос</button>
                    </form>
                    {else}
                        <div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign"></span>     Вопрос не в статусе редактируемый</div>
                    {/if}
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
                            {if isset($one_data_answer_option->right_answer) && $one_data_answer_option->right_answer == 'Y'}
                                <input type="radio" name="value_answer_option" value="{$one_data_answer_option->id_answer_option}" checked>
                            {elseif isset($one_data_answer_option->right_answer) && $one_data_answer_option->right_answer == 'N'}
                                <input type="radio" name="value_answer_option" value="{$one_data_answer_option->id_answer_option}">
                            {/if}
                        </td>
                        <td> 
                            {if isset($one_data_answer_option->answer_the_questions)}
                                {$one_data_answer_option->answer_the_questions}
                            {/if}
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
                                
            {capture name='edit_data_quiz'}
            {include file='menu.tpl'}
                <div id="page-content-wrapper">
                    <div class="container-fluid">
                     {if isset($data_one_quiz->id_status_test) && $data_one_quiz->id_status_test == 1}
                        <form method="post">
                            <input type="hidden" name="id_quiz" value="{if isset($data_one_quiz->id_test)}{$data_one_quiz->id_test}{/if}">
                            <table width="60%" align="center" bgcolor="#87CEFA" class="table">
			                    {$smarty.capture.form_for_quiz}
                            </table>
                            <input type="hidden" name="status_test" value="1">
                            <button class="btn btn-primary" name='button_click' value='edit_data_quiz'>Изменить опрос</button>
                        </form>
                    {else}
                        <div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign"></span>     Вопрос не в статусе редактируемый</div>
                    {/if}
                    </div>
                </div>
            {/capture}                    
            {capture name='edit_quiz'}
            {include file='menu.tpl'}
            <div id="page-content-wrapper">
                <div class="container-fluid">
                    <h2><a href="javascript: void(0);" onclick="showEditQuiz();"><img src="img/edit.png" width='30' height='30'></a>Опрос: {if isset($data_one_quiz->topic)}{$data_one_quiz->topic}{/if}</h2>
                    <!--<div id="quiz" style="display: none">-->
                    {if isset($data_questions[0]->text_question)}
                    <table class='table' >
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
                                Вес вопроса
                            </th>
                            <th>
                                Удалить вопрос
                            </th>
                            <th>
                            </th>
                        </thead>
                        <tbody>
                        {for $i=0;$i<count($data_questions);$i++}  
                            <tr>
                                <td>
                                   № {$i+1} 
                                </td>
                                <td>
                                    <a class="btn" onclick="checkEdit({$data_questions[$i]->id_question}, {if isset($data_questions[$i]->isAnswered[0])} 1 {else} null{/if})" id='buttons_disabled[]' {if isset($data_one_quiz->id_status_test)}{if $data_one_quiz->id_status_test != 1}disabled{/if}{/if}>{$data_questions[$i]->text_question}</a>
                                    <a style="display:none" class="btn" href="?action=edit_question&id_quiz={$data_questions[$i]->id_test}&id_question={$data_questions[$i]->id_question}" id="edit{$data_questions[$i]->id_question}"> </a>
                                </td>
                                <td>
                                    {if  {$data_questions[$i]->id_questions_type}==1}
                                        Вопрос типа Да/Нет
                                    {elseif  {$data_questions[$i]->id_questions_type}==2}
                                          Вопрос с возможностью выбора одного ответа из списка
                                    {elseif  {$data_questions[$i]->id_questions_type}==3}
                                        Вопрос с возможностью выбора одного или более ответов из списка
                                    {elseif  {$data_questions[$i]->id_questions_type}==4}
                                        Произвольный текст
                                    {elseif  {$data_questions[$i]->id_questions_type}==5}
                                        Оценочная шкала
                                    {/if} 
                                </td>
                                <td>
                                    {$data_questions[$i]->weight}
                                </td>
                                <td>
                                    <a class="btn btn-primary btn-xs" onclick="checkDelete({$data_questions[$i]->id_question}, {if isset($data_questions[$i]->isAnswered[0])} 1 {else} null{/if})" id='buttons_disabled[]' {if isset($data_one_quiz->id_status_test)}{if $data_one_quiz->id_status_test != 1}disabled{/if}{/if}><span class="glyphicon glyphicon-trash"></span>   Удалить</a>
                                   <a style="display:none" class="btn btn-primary btn-xs" href="?action=delete&id_quiz={$data_one_quiz->id_test}&id_question={$data_questions[$i]->id_question}" id="delete{$data_questions[$i]->id_question}"><span class="glyphicon glyphicon-trash"></span>   Удалить</a>
<a style="display:none" class="btn btn-primary btn-xs" data-toggle="modal" data-idquestion="{$data_questions[$i]->id_question}" data-target="#removeModal" id="deleteModal{$data_questions[$i]->id_question}"><span class="glyphicon glyphicon-trash"></span>   Удалить</a>
                                </td>
                                <td>
                                {if $i != 0 }
                                    <a class="btn" href="?action=upQuestion&id_quiz={$data_one_quiz->id_test}&id_question={$data_questions[$i]->id_question}&first={if isset($data_questions[$i-1])}{$data_questions[$i-1]->question_number}{else}0{/if}&second={if isset($data_questions[$i-2])}{$data_questions[$i-2]->question_number}{else}0{/if}" id='buttons_disabled[]' {if isset($data_one_quiz->id_status_test)}{if $data_one_quiz->id_status_test != 1}disabled{/if}{/if}><span class="glyphicon glyphicon-chevron-up"></span></a>
                                {else}
                                    <a class="btn" disabled><span class="glyphicon glyphicon-chevron-up"></span></a>
                                {/if}
                                {if $i != count($data_questions)-1}
                                    <a class="btn" href="?action=upQuestion&id_quiz={$data_one_quiz->id_test}&id_question={$data_questions[$i]->id_question}&first={$data_questions[$i+1]->question_number}&second={if isset($data_questions[$i+2])}{$data_questions[$i+2]->question_number}{else}{$data_questions[$i+1]->question_number+1}{/if}" id='buttons_disabled[]' {if isset($data_one_quiz->id_status_test)}{if $data_one_quiz->id_status_test != 1}disabled{/if}{/if}><span class="glyphicon glyphicon-chevron-down"></span></a>
                                {else}
                                <a class="btn"disabled><span class="glyphicon glyphicon-chevron-down"></span></a>
                                {/if}
                                </td>
                            </tr>
                        {/for}
                        </tbody>
                    </table>
           
                    {else}
                        <div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-warning-sign"></span>   Список вопросов данного теста пуст </div>
                    {/if}
                    <div class="row">
                        <div class="col-xs-4">
                            <a class="btn btn-md btn-primary" id='buttons_disabled[]' href='create_quiz.php?action=new_question&id_quiz={if isset($data_one_quiz->id_test)}{$data_one_quiz->id_test}{/if}' {if isset($data_one_quiz->id_status_test)}{if $data_one_quiz->id_status_test != 1}disabled{/if}{/if}><span class="glyphicon glyphicon-plus"></span>  Добавить вопрос</a>
                        </div>
                        <div class="col-xs-4">
                            <a class="btn btn-md btn-primary" id='testing_users_btn' href='create_quiz.php?action=add_inteviewee&id_quiz={if isset($data_one_quiz->id_test)}{$data_one_quiz->id_test}{/if}' {if isset($data_one_quiz->id_status_test)}{if $data_one_quiz->id_status_test == 3}disabled{/if}{/if}><span class="glyphicon glyphicon-list"></span>  Тестируемые</a>
                        </div>
                        <div class="col-xs-4">
                            <a class="btn btn-md btn-primary" id='buttons_disabled[]' href='create_quiz.php?action=edit_data_quiz&id_quiz={if isset($data_one_quiz->id_test)}{$data_one_quiz->id_test}{/if}' {if isset($data_one_quiz->id_status_test)}{if $data_one_quiz->id_status_test != 1}disabled{/if}{/if}><span class="glyphicon glyphicon-pencil"></span>   Редактировать опрос</a>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="row">
                        <label for="change_status_test">Статус опроса:</label>
                        <select  class="form-control" name="change_status_test" id="change_status_test" onchange ='changeStatusOfTest(this.options[this.selectedIndex].value, {if isset($data_one_quiz->id_test)}{$data_one_quiz->id_test}{/if});'>
                            <option value="1" {if isset($data_one_quiz->id_status_test)}{if $data_one_quiz->id_status_test == 1}selected{/if}{/if}>Редактируемый</option>
                            <option value="2" {if isset($data_one_quiz->id_status_test)}{if $data_one_quiz->id_status_test == 2}selected{/if}{/if}>Доступный для прохождения</option>
                            <option value="3" {if isset($data_one_quiz->id_status_test)}{if $data_one_quiz->id_status_test == 3}selected{/if}{/if}>Завершенный</option>
                        </select>
                    </div>
                    <form method="post" id="test_passing">
                    <button class="btn btn-md btn-primary margin-top" name="button_click" value="getExcel" ><span class="glyphicon glyphicon-list-alt"></span>  Скачать отчет</button>
                    <button class="btn btn-md btn-primary margin-top" name="button_click" value="showReport" ><span class="glyphicon glyphicon-picture"></span>  Графики</button>
                    </form>
                </div>
            </div>
            {/capture}
           <div class="modal fade" id="removeModal" tabindex="-1" role="dialog" style="margin: 0 auto;">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<h4 class="modal-title" id="removeModalLabel"></h4>
								</div>							
								<form >
									<div class="modal-body">
									</div>
									<div class="modal-footer">
										<input id="idQuestion" type="hidden" value="">
										<button id="buttonModalF" type="button" class="btn btn-default pull-left" data-dismiss="modal" style="width: 200px">Отмена</button>
										<button id="buttonModalS" onclick="checkDelete(document.getElementById('idQuestion').value , null );" type="submit" data-dismiss="modal" class="btn btn-primary" style="width: 200px">Да</button>
									</div>
								</form>
							</div>
						</div>
					</div>   
            {capture name=edit_question}
            {include file='menu.tpl'}
            <div id="page-content-wrapper">
                <div class="container-fluid">
                    <form method="post" id="test_passing">
										<div id="editDiv"></div>
										<input class="form-control" id="deleteDataAnswers" type="hidden" name="deleteDataAnswers" form="test_passing" value="FALSE">
                    <input onclick="checkRadio()" class="btn btn-primary" id="create-question" value="Изменить вопрос" disabled> 
                    <button style="display: none" class="btn btn-primary" id="create-question_hide" form="test_passing" name="button_click" value="edit_question"> Изменить вопрос</button>
                        <table class="table">
                            <tr>
                                <td class='info' width='35%'>
                                    <b>Текст вопроса</b> 
                                </td>
                                <td>
                                    <textarea class="form-control" rows="3" cols="40" maxlength="150" name="text_question" placeholder="Ваш вопрос" required>{if isset($data_one_question->text_question)}{$data_one_question->text_question}{/if}</textarea><br>
                                </td>
                            </tr>
                            <tr>
                                <td class='info'>
                                    <b>Дополнительная информация</b>
                                </td>
                                <td>
                                    <textarea class="form-control" rows="5" cols="40" maxlength="1000" name="comment_question">{if isset($data_one_question->comment_question)}{$data_one_question->comment_question}{/if}</textarea><br>
                                </td>
                            </tr>
                            <tr>
                                <td class='info'>
                                    <b>Тип вопроса</b>
                                </td>
                                <td>
                                    
                                    <select class="form-control" name="question_type" id="question_type" onchange ="addAnswerTypeYorn(this.options[this.selectedIndex].value);
$('#editDiv').html('<b>Все ответы пользователей удаляются</b>');$('#deleteDataAnswers').val('TRUE');">
										<option value="0">--/--</option>
                                        <option value="1" {if isset($data_one_question->id_questions_type) && $data_one_question->id_questions_type == 1}selected{/if}>Да/Нет</option>
                                        <option value="2" {if isset($data_one_question->id_questions_type) && $data_one_question->id_questions_type == 2}selected{/if}>Один ответа из списка</option>
                                        <option value="3" {if isset($data_one_question->id_questions_type) && $data_one_question->id_questions_type == 3}selected{/if}>Выбор одного или более ответов из списка</option>
                                        <option value="4" {if isset($data_one_question->id_questions_type) && $data_one_question->id_questions_type == 4}selected{/if}>Произвольный ответ</option>
                                        <option value="5" {if isset($data_one_question->id_questions_type) && $data_one_question->id_questions_type == 5}selected{/if}>Оценочная шкала</option>
                                    </select>
                                </td>
                            </tr>
                             <tr  id="trForSwitch" style="display: none">
                                <td class='info'>
                                    <b>Валидация ответа</b>
                                </td>
                                <td>
                                    <input type="checkbox" id="switch" name="switch" data-off-text="Нет" data-on-text="Да" form="test_passing" {if isset($data_one_question->validation) && $data_one_question->validation == 'Y'}checked{/if} >
                                    <script>
                                        $(function(argument) {
                                          $('[name="switch"]').bootstrapSwitch();
                                        });
                                        $('input[name="switch"]').on('switchChange.bootstrapSwitch', function(event, state) {
                                            if(state == true) {
                                                jQuery("input:radio").attr('disabled',false);
                                                jQuery("input[name='checkbox[]']").attr('disabled',false);
                                                jQuery("input:radio").attr('checked',false);
                                                jQuery("input[name='checkbox[]']").attr('checked',false);
                                                $("#trForWeight").show();
                                                $("#trForChart").hide();
                                            }
                                            else {
                                                jQuery("input:radio").attr('disabled',true);
                                                jQuery("input[name='checkbox[]']").attr('disabled',true);
                                                jQuery("input:radio").attr('checked',false);
                                                jQuery("input[name='checkbox[]']").attr('checked',false);
                                                $("#trForWeight").hide();
                                                $("#trForChart").show();
                                            }
                                        });
                                            //jQuery('input[name="switch"]').attr('checked',true);
                                    </script>
                                </td>
                            </tr>
                            <tr id="trForWeight" style="display:none">
                                <td class='info'>
                                    <b>Вес вопроса</b>
                                </td>
                                <td>
                                <div class="form-group has-feedback" id="weightDiv">
                                    <input class="form-control" type="number" id="weight" name="weight" value="{if isset($data_one_question->weight)}{$data_one_question->weight}{/if}" form="test_passing" onchange="checkNumber(this.value)" >
				                    <span class="glyphicon form-control-feedback" id="weightGli"></span>
                                </div>
                                </td>
                            </tr>
							<tr id="trForOptions" style="display:none">
								<td class='info'>
								</td>
								<td>
									<div id='add_answer_type_yorn' style="display: none">
                                        Выберите правильный ответ<br>
                                        {if isset($data_one_question->id_questions_type) && $data_one_question->id_questions_type == 1}
                                            {foreach $data_answer_option as $option_one}
                                                <input type='radio' form="test_passing" name='answer[]' value='{$option_one->answer_the_questions}' {if isset($data_one_question->id_questions_type) && $data_one_question->id_questions_type == 1 && $option_one->right_answer == 'Y'}checked{/if}>{$option_one->answer_the_questions}<br>
                                            {/foreach}
                                        {else}
                                            <input type='radio' form="test_passing" name='answer[]' value='Да'>Да<br>
                                            <input type='radio' form="test_passing" name='answer[]' value='Нет'>Нет<br>
                                        {/if}
                                    </div>
								    <div id='add_answer_type_many_answers' style="display: none">
                                        <form  method='post'>
                                            Текст ответа<br>
                                            <div class="foraddradio">
                                            {$vars = 0}
                                            {foreach $data_answer_option as $option_one}
                                                    <div class="row" id="{$vars}">
                                                        <div class="col-xs-10">
                                                            <div  class="input-group">
                                                                <span class="input-group-addon" id="radios[]">
                                                                    <input type="radio" value="{$vars}" name="rad[]" aria-label="..." {if $data_one_question->id_questions_type == 2 && $option_one->right_answer == 'Y'}checked{/if}>
                                                                </span>
                                                                <input type="text" name="texting[]" id="texting{$vars}" class="form-control" aria-label="..." onblur="checkAnswer(this.value)" size="30" maxlength="1000" value="{if $data_one_question->id_questions_type == 2}{$option_one->answer_the_questions}{/if}">
                                                            </div>
                                                        </div>
							{if $vars != 0}<div class="col-xs-2 padding-top10">
								<a  onclick="$('[id = {$vars}]').remove(); $('#editDiv').html('<b>Все ответы пользователей удаляются</b>');$('#deleteDataAnswers').val('TRUE');">
									<span class="glyphicon glyphicon-trash"></span>
								</a>
							</div>{/if}
                                                    </div>
                                                    {$vars=$vars+1}
                                            {/foreach}
                                                <script type="text/javascript">
							var int={$vars};
                                                   function addRadioAnswer(){
						   var text = '<div class="row" id="'+int+'"><div class="col-xs-10"><div  class="input-group"><span class="input-group-addon" id="radios[]"><input type="radio" value="'+int+'" name="rad[]" aria-label="..."></span><input type="text" name="texting[]" id="texting'+int+'" class="form-control" size="30" maxlength="1000" aria-label="..." onblur="checkAnswer(this.value)"></div></div><div class="col-xs-2 padding-top10"><a  onclick="$(\'[id = '+int+']\').remove()"><span class="glyphicon glyphicon-trash"></span></a></div></div>';
                                                    int++;
                                                    $(".foraddradio").append(text);
			                                 document.getElementById("create-question").disabled = true;
			                             }
                                                </script>
                                            <script type="text/javascript">
                                                checkAnswer(0);
                                            </script>
                                            </div>
                                            <a href="javascript: void(0);" onclick="addRadioAnswer(0); $('#editDiv').html('<b>Все ответы пользователей удаляются</b>');$('#deleteDataAnswers').val('TRUE');"><span class="glyphicon glyphicon-plus"></span></a>
                                        </form>
                                    </div>
                                    <div id='add_answer_type_many_answers_some' style="display: none">
                                        <form  method='post'>
                                            Текст ответа<br>
                                            <div class="foraddcheckbox">
                                            {$vars = 0}
                                            {foreach $data_answer_option as $option_one}
                                                <div class="row" id="{$vars}">
                                                    <div class="col-xs-10">
                                                        <div  class="input-group">
                                                            <span class="input-group-addon">
                                                                <input type="checkbox" form="test_passing" value="{$vars}" name="checkbox[]" aria-label="..." {if $data_one_question->id_questions_type == 3 && $option_one->right_answer == 'Y'}checked{/if}>
                                                            </span>
                                                            <input type="text" form="test_passing" name="textr[]" id="textr{$vars}" class="form-control" aria-label="..." onblur="checkSomeAnswer(this.value)" size="30" maxlength="1000" value="{if $data_one_question->id_questions_type == 3}{$option_one->answer_the_questions}{/if}">
                                                        </div>
                                                    </div>
							{if $vars != 0}<div class="col-xs-2 padding-top10">
								<a  onclick="alert(intr);$('[id = {$vars}]').remove(); $('#editDiv').html('<b>Все ответы пользователей удаляются</b>');$('#deleteDataAnswers').val('TRUE');">
									<span class="glyphicon glyphicon-trash"></span>
								</a>
							</div>{/if}
                                                </div>
                                                {$vars=$vars+1}
                                            {/foreach}
                                                    <script type="text/javascript">
							var intr={$vars};
                                                       function addCheckAnswer(){
                                                        var text = '<div class="row" id="'+intr+'"><div class="col-xs-10"><div  class="input-group"><span class="input-group-addon" id="radios[]"><input type="checkbox" form="test_passing" value="'+intr+'" name="checkbox[]" aria-label="..."></span><input type="text" form="test_passing" name="textr[]" size="30" maxlength="1000" id="textr'+intr+'" class="form-control" aria-label="..." onblur="checkSomeAnswer(this.value)"></div></div><div class="col-xs-2 padding-top10"><a  onclick="$(\'[id = '+intr+']\').remove()"><span class="glyphicon glyphicon-trash"></span></a></div></div>';
                                                        
                                                        intr++;         
                                                        $(".foraddcheckbox").append(text);
                                                          document.getElementById("create-question").disabled = true;
                                                        }
                                                    </script>
                                            <script type="text/javascript">
                                                checkSomeAnswer(0);
                                            </script>
                                            </div>
                                            <a href="javascript: void(0);" onclick="addCheckAnswer(); $('#editDiv').html('<b>Все ответы пользователей удаляются</b>');$('#deleteDataAnswers').val('TRUE');"><span class="glyphicon glyphicon-plus"></span></a>
                                        </form>
                                    </div>
                                    <div id='add_rating_type' style="display: none">
                                        <form  method='post'>
                                            Тип ответа</br>
                                            {foreach $mark_rating_type as $mrt}
                                                    <input form="test_passing" type="radio" value="{$mrt[0]->option}" name="rating" id="{$mrt[0]->option}" {foreach $data_answer_option as $option_one}{if isset($option_one->answer_the_questions) && $option_one->answer_the_questions == $mrt[0]->text}checked{/if} {/foreach}>
                                                    <div class="well well-sm"><label for="{$mrt[0]->option}">{$mrt[0]->text}</br> {$mrt[1]->text}</br> {$mrt[2]->text}</br> {$mrt[3]->text}</br> {$mrt[4]->text}</label></div>
                                            {/foreach}
                                        </form>
                                    </div>
								</td>
							</tr>
							<tr id="trForChart" style="display:none">
                                <td class='info' width='35%'>
                                    <b>Показывать график</b> 
                                </td>
                                <td>
                                   <input type="checkbox" form="test_passing" id="show_chart" name="show_chart" data-off-text="Нет" data-on-text="Да"  {if isset($data_one_question->show_chart) && $data_one_question->show_chart == 'Y'}checked{/if}>
                                    <script>
                                        $(function(argument) {
                                          $('[name="show_chart"]').bootstrapSwitch();
                                        });
                                    </script> 
                                </td>
                            </tr>
                        </table>
                                              
                            
                    <script>
                        {if isset($data_one_question->validation) && $data_one_question->validation == 'N'}
                            jQuery("input:radio").attr('disabled',true);
                            jQuery("input[name='checkbox[]']").attr('disabled',true);
                            jQuery("input:radio").attr('checked',false);
                            jQuery("input[name='checkbox[]']").attr('checked',false);
                            $("#trForWeight").hide();
                        {/if}
                        $(document).ready(function()
                        {
                            addAnswerTypeYorn(document.getElementById("question_type").options[document.getElementById("question_type").selectedIndex].value);
                        });
                    </script>
                        
                    </form>
                </div>
            </div>
            {/capture}
            {capture name=add_inteviewee}
            {include file='menu.tpl'}
            <div id="page-content-wrapper">
                <div class="container-fluid">
                    {if isset($users_data[0])}  
                    <h3>Тестируемые пользователи</h3>
                    <table class="table">
                        <thead>
                            <th>
                                <input type="checkbox" id="allcheckboxes"  onclick="selectAll();"> 
                            </th>
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
                            </th>
                            <th>
                                
                            </th>
                        </thead>
                        {foreach $users_data as $one_user_data}                                          
                            <tr>
                                <td>
                                    <input type="checkbox" name="rowcheckboxes[]" form="test_passing" value="{$one_user_data->getemail()}"> 
                                </td>
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
                                    {if $one_user_data->getViewed() == 2}
                                        <span class="glyphicon glyphicon-ok-circle" aria-hidden="true" title="Тест пройден"></span>
                                    {elseif $one_user_data->getViewed() == 1}
                                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true" title="Тест открыт"></span>
                                    {/if}
                                </td>
                                <td>
                                    <a href="?action=deleteUser&id_user={$one_user_data->getIdUser()}&id_quiz={if isset($data_one_quiz->id_test)}{$data_one_quiz->id_test}{/if}"><span class="glyphicon glyphicon-trash"></span></a>
                                </td>
                            </tr>
                        {/foreach}
                    </table>
                    <button class="btn btn-md btn-primary" name="button_click" form="test_passing" value="sendListOfMail" ><span class="glyphicon glyphicon-envelope"></span>  Отправить напоминания</button>
                    <!--<a href="?action=sendEmail&id_quiz={if isset($data_one_quiz->id_test)}{$data_one_quiz->id_test}{/if}"><span class="glyphicon glyphicon-trash"></span></a>-->
                    {else}
                        <div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-warning-sign"></span>   Нет добавленных пользователей</div></br>
                    {/if}
                    <h3>Добавить опрашиваемых</h3>
                    <form method="post" id="test_passing">
                        <table>                                            
                            <tr>
                                <td>
                                    Добавить пользователя
                                </td>
                                <td>
                                    Добавить группу
                                </td>
                            </tr>
                            <tr>
                                <td>
								    <div class="input_container">
								        <div class="input-append">
									        <input id="inputName" name="inputName" form="test_passing" type="text" size="50%" onkeyup="autocomplet()">
									        <ul id="country_list_id"></ul>
									        <a onclick="checkLogin();"><span class="glyphicon glyphicon-plus"></span></a>
									    </div>
								    </div>
                                </td>
                                <td>
                                    <div class="input_container">
                                        <div class="input-append">
                                            <input id="inputGroup" name="inputGroup" form="test_passing" type="text" size="50%" onkeyup="autocompleteGroup()">
                                            <ul id="group_list_id"></ul>
                                            <a onclick="checkGroup();"><span class="glyphicon glyphicon-plus"></span></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        
                        <button style="display: none" id="btn" form="test_passing" name='button_click' value='addUserIntoTest'></button>
                        <button style="display: none" id="btnGroup" form="test_passing" name='button_click' value='addGroupIntoTest'></button>
                    </form>   
                </div>
            </div>        
            <script type="text/javascript">
			function autocomplet() {
				var min_length = 1; // min caracters to display the autocomplete
				var keyword = $('#inputName').val();
				if (keyword.length > min_length) {
					$.ajax({
						url: 'search.php',
						type: 'POST',
						data: { keyword: keyword, field: "user"},
						success:function(data){
							$('#country_list_id').show();
							$('#country_list_id').html(data);
						}
					});
				} else {
					$('#country_list_id').hide();
				}
			}

			// set_item : this function will be executed when we select an item
			function set_item(item) {
				// change input value
				$('#inputName').val(item);
				// hide proposition list
				$('#country_list_id').hide();
			}
			
			function autocompleteGroup() {
				var min_length = 0; // min caracters to display the autocomplete
				var keyword = $('#inputGroup').val();
				if (keyword.length > min_length) {
					$.ajax({
						url: 'search.php',
						type: 'POST',
						data: { keyword: keyword, field: "group"},
						success:function(data){
							$('#group_list_id').show();
							$('#group_list_id').html(data);
						}
					});
				} else {
					$('#group_list_id').hide();
				}
			}

			function set_item_group(item) {
				$('#inputGroup').val(item);
				$('#group_list_id').hide();
			}
            
            </script>
            {/capture}    
            {capture name=sendEmail}
            {include file='menu.tpl'}
            <div id="page-content-wrapper">
                <div class="container-fluid">
                <form method="post" id="test_passing">
                    <label for="head">Заголовок</label>
                    <input id="head" name="head" type="text" class="form-control" value="Прохождение опроса: {if isset($data_one_quiz->topic)}{$data_one_quiz->topic}{/if}">
                    <label for="testOfMale">Текст письма</label>
                    <textarea id="testOfMale" rows="5" cols="40" name="testOfMale" class="form-control">Приглашаем вас пройти тест "{if isset($data_one_quiz->topic)}{$data_one_quiz->topic}{/if}"<br> Прохождение теста доступно по адресу: <a href="http://polls/authorization.php?re=quiz.php?status=new_test%testing={if isset($data_one_quiz->id_test)}{$data_one_quiz->id_test}{/if}">http://polls/authorization.php?re=quiz.php?status=new_test%testing={if isset($data_one_quiz->id_test)}{$data_one_quiz->id_test}{/if}</a></textarea>
                    {if isset($mails[0])}
                    <table class="table" id="mailsTable">
                        {foreach $mails as $ma}
                            <script>
                             var text = '<tr id="Email'+incrimentFroEmail+'" class=""><td>{$ma}</td><td></td></tr>';
                                $("#mailsTable").append(text);
                             incrimentFroEmail++;</script>
                        {/foreach}
                    </table>
                    <button class="btn btn-md btn-primary" name="button_click" value="checkMailStatus" ><span class="glyphicon glyphicon-envelope"></span>  Отправить напоминания</button>
                    {else}
                        <div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-warning-sign"></span>  Пользователи для отправки напоминаний не были выбраны </div>
                    {/if}
                    </form>
                </div>
            </div>
            {/capture}
            {capture name=checkEmail}
            {include file='menu.tpl'}
            <div id="page-content-wrapper">
                <div class="container-fluid">
                    {if isset($mails[0])}
                        <table class="table" id="mailsTable">
                        {foreach $mails as $ma}
                            <script>
                             var text = '<tr id="Email'+incrimentFroEmail+'" class=""><td>{$ma}</td><td></td></tr>';
                                $("#mailsTable").append(text);
                             incrimentFroEmail++;</script>
                        {/foreach}
                        </table>
                        <a class="btn btn-lg btn-primary" href="create_quiz.php?link_click=edit_quiz&id_quiz={if isset($data_one_quiz->id_test)}{$data_one_quiz->id_test}{/if}">Вернуться</a>
                    {else}
                        <div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-warning-sign"></span>  Пользователи для отправки напоминаний не были выбраны </div>
                    {/if}
                </div>
            </div>
            <script>
            SendEmails();
            </script>
            {/capture}
            {capture name=showReport}
            {include file='menu.tpl'}
                <div id="page-content-wrapper">
                <div class="container-fluid">
                    <script type="text/javascript">
                   /*   google.load("visualization", "1.1", { packages: ["table"] });
                      google.setOnLoadCallback(drawTable);
                        var users = {json_encode($users_data)};
                      function drawTable() {
                        var data = new google.visualization.DataTable();
                        data.addColumn('string', 'Name');
                        data.addColumn('number', 'Salary');
                        data.addColumn('boolean', 'Full Time Employee');
                        data.addColumn('number', 'Salary');
                        {foreach $users_data as $ua}
                           data.addRow([
                              '{$ua->getLastName()}',  { v: 10000, f: '$10,000'}, true, 0
                            ]);
                            {/foreach}
                         
                            
                        var table = new google.visualization.Table(document.getElementById('table_div'));

                        table.draw(data, { showRowNumber: true, width: '100%', height: '100%'});
                      }*/
                    </script>
                     <div id="table_div"></div>
                     <script>
                        var isEmpty = null;
                    </script>
            {foreach $questions as $one_question}
                <div class="row">
                {if $one_question['data_questions']->getShowChart() == 'Y'}
                    <div id="{$one_question['data_questions']->getIdQuestion()}" style="width:400; height:300"></div>
                    
                    <script>
                        var isEmpty = 1;
                        google.load('visualization', '1', { 'packages': ['corechart'] });

                        google.setOnLoadCallback(drawChart);

                        function drawChart() {

                        var data = new google.visualization.DataTable();
                        data.addColumn('string', 'Topping');
                        data.addColumn('number', 'Slices');
                        {foreach $one_question['data_questions']->getAnswerOption() as $option}
                            data.addRow([{if isset({$option->getAnswerTheQuestions()})} '{$option->getAnswerTheQuestions()}'{/if}, {if isset($countOfAnswersAboutAllUsers[$one_question['data_questions']->getIdQuestion()][$option->getAnswerTheQuestions()])} {$countOfAnswersAboutAllUsers[$one_question['data_questions']->getIdQuestion()][$option->getAnswerTheQuestions()]} {else} 0 {/if}]);
                        {/foreach}
                        var options = { 'title': "{$one_question['data_questions']->getTextQuestion()}",
                        'width':400,
                        'height':300};

                        var chart = new google.visualization.PieChart(document.getElementById("{$one_question['data_questions']->getIdQuestion()}"));
                        chart.draw(data, options);
                        }
                    </script>
                    </div>
                {/if}
                </div>
            {/foreach}
            <div style="display:none" id="isEmptyReport" class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-warning-sign"></span>  Графики отсутствуют </div>
            <script>
                if(isEmpty == null){
                    $('#isEmptyReport').show();
                }
            </script>
            <a class="btn btn-lg btn-primary" href="create_quiz.php?link_click=edit_quiz&id_quiz={if isset($data_one_quiz->id_test)}{$data_one_quiz->id_test}{/if}">Вернуться</a>
            </div>
            </div>
            {/capture}
                                    {if {$view_quiz} eq 'new_quiz'}
                                        {$smarty.capture.new_quiz}   
									{elseif {$view_quiz} eq 'form_for_quiz'}
                                        {$smarty.capture.form_for_quiz}
                                    {elseif {$view_quiz} eq 'edit_data_quiz'}
                                        {$smarty.capture.edit_data_quiz}
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
                                    {elseif {$view_quiz} eq 'sendEmail'}
                                        {$smarty.capture.sendEmail}    
                                    {elseif {$view_quiz} eq 'checkEmail'}
                                        {$smarty.capture.checkEmail}
                                    {elseif {$view_quiz} eq 'showReport'}
                                        {$smarty.capture.showReport}     
                                     {/if}
         </div>
					
			<script>
				$('#removeModal').on('show.bs.modal', function (event) {
					var button = $(event.relatedTarget);
					var modal = $(this);
					var idQuestion = button.data('idquestion');
					modal.find('.modal-title').html('Вы уверены, что хотите удалить данный вопрос? Ответы пользователей будут удалены.');
					document.getElementById('idQuestion').value = idQuestion;
				});
			</script>
    </body>
</html>


