<html>
    <head>
        <title>{$title}</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script src="js/jquery-2.1.3.min.js"></script>
        <link rel="stylesheet" href="css/styles.css">
		<link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">	
		<link href="css/simple-sidebar.css" rel="stylesheet">
		<link href="css/navbar-fixed-top.css" rel="stylesheet">
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.countdown.min.js"></script>
         <script src="js/kk.js"></script>
        <link rel="stylesheet" href="http://hilios.github.io/jQuery.countdown/css/syntax.css">
        <script type="text/javascript">
            /*$(document).ready(function(){

                	var secs = $("#secs").val(),
                        cdBox = $(".kkcountdown-2");
                    $("#secs").hide();
                    
	                cdBox.attr('data-seconds', {$dateinterval})
	                	.kkcountdown({
                            displayDays:        true,
                            displayZeroDays:    false,
    	                    hoursText:          ':',
    	                    minutesText:        ':',
    	                    secondsText:        '',
    	                    textAfterCount:     'TimeIsOut! ',
    	                    warnSeconds:        10,
    	                    warnClass:          'alert',
                            callback:           cBack
    	                });

            });
            */
            var flag=false;
            function cBack(){
                $("#skip_end_question").click();
            }
            
            window.onload = function() {
                timer();
                flag=false;
            }
            function clicked(){
                flag=false;
            }
            window.onbeforeunload = confirmExit;
            function confirmExit(){
                if($('#timer').text() && flag){
                    cBack();  
                }
            }
            function deleteRequired(){
            alert("ok");
                flag=false;
                $("#answer").removeAttr('required');

            }
            
              
        </script>
    </head>
    <body>
        {include file='header.tpl'}
        <div id="wrapper">
			<form id="test_passing" method="post"> 
					</form>
				{include file='menu.tpl'}
				<div id="page-content-wrapper">
				<div class="container-fluid">
                {if isset($data_role[0]) && $data_role[0] eq 1 && $data_test->getIdStatusQuiz() == 2}
				{capture name='new_testing'}
					<h1>{$data_test->getTopic()}</h1>
					<h4 style="color:Gray">{$data_test->getCommentQuiz()}</h4>
						<table class="table">
							<tbody>
								<tr>
									<td class='info' width='35%'>
										<b>Ограничение по времени</b>
									</td>
									<td>
										{if $data_test->getTimeLimit()=="" && $data_test->getTimeLimit()==NULL}
											<span class="glyphicon glyphicon-remove"></span>
										{else}
											{$data_test->getTimeLimit()}
										{/if}    
									</td>
								</tr>
								<tr>
									<td  class='info'>
										<b>Автор теста</b>
									</td>
									<td>
										{$data_test->getAuthorTest()->getLastName()}
										{$data_test->getAuthorTest()->getFirstName()}
									</td>    
								</tr>
								<tr>
									<td colspan='2' align='center'>
										<button class="btn btn-lg btn-primary" form="test_passing" type="submit" action="quiz.php" name="button_click" value='start_quiz'>Начать тест</button>
									</td>
								</tr>
							</tbody>
						</table>
				{/capture}
				{capture name='continue_testing'}
					<div class="row">
						<div class="col-lg-8 quiz-h">
							{$data_test->getTopic()}
						</div>
						<div class="col-lg-4 quiz-h">
                            <span id="timer"></span>
						</div>
					</div>
					<hr width="100%" color="7088FF" />
					<div class="row">
						<div class="col-lg-12">
							<h3>{$data_one_question->getTextQuestion()}</h3>                                          
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<h4 style="color:Gray">{$data_one_question->getCommentQuestion()}</h4>                                        
						</div>
					</div>
					<div class="row quiz-row">
						{capture name='radio'}   
						    {foreach $data_one_question->getAnswerOption() as $option}                  
							 <div class="radio"><input form="test_passing" type="radio" name="answer[]" id="answer" value="{$option->getIdAnswerOption()}" required>{$option->getAnswerTheQuestions()}</div>
							{/foreach}
						{/capture}
						{capture name='radio_list'}
							{foreach $data_one_question->getAnswerOption() as $option}
							  <div class="radio">
							  <input form="test_passing" type="radio" action="quiz.php" name="answer[]" id="answer" value="{$option->getIdAnswerOption()}" required>{$option->getAnswerTheQuestions()}</div>  
							{/foreach}
						{/capture}
						{capture name='checkbox_list'} 
							   {foreach $data_one_question->getAnswerOption() as $option}
								<div class="checkbox">
									<input form="test_passing" type="checkbox" action="quiz.php" name="answer[]" id="answer" value="{$option->getIdAnswerOption()}" >{$option->getAnswerTheQuestions()}
								</div>  
							{/foreach}
						{/capture}
						{capture name='textarea'}
							<div class="form-group">
								<textarea class = "form-control" form="test_passing" name="answer[]" id="answer" action="quiz.php" maxlength="1000" cols="80" rows="10"></textarea>
							</div>                          
						{/capture}
						{capture name='rating'}
						    {foreach $data_one_question->getAnswerOption() as $option}
							    <div class="radio">
								    <input form="test_passing" type="radio" action="quiz.php" name="answer[]" id="answer" value="{$option->getIdAnswerOption()}" required>{$option->getAnswerTheQuestions()}
							    </div>              
							{/foreach}          
						{/capture}
						{if {$data_one_question->getIdQuestionsType()} eq '1'}
							{$smarty.capture.radio}    
						{elseif {$data_one_question->getIdQuestionsType()} eq '2'}
							{$smarty.capture.radio_list}
						{elseif {$data_one_question->getIdQuestionsType()} eq '3'}
							{$smarty.capture.checkbox_list}
						{elseif {$data_one_question->getIdQuestionsType()} eq '4'}
							{$smarty.capture.textarea}
						{elseif {$data_one_question->getIdQuestionsType()} eq '5'}
							{$smarty.capture.rating}
						{/if} 
					</div>	
					<div class="row">
                        <button class="btn btn-md btn-primary col-xs-2" onclick="clicked()" form="test_passing" type="submit" action="quiz.php" name="button_click" value='end_question'> Ответить</button>
                    </div>
                    <div class="row padding-top10">
					    <button class="btn btn-sm col-xs-2" onclick="clicked()" formnovalidate="" form="test_passing" type="submit" action="quiz.php" name="button_click" value='skip_question'> Пропустить</button>
					</div>
					<div class="row padding-top10">
					    <button class="btn btn-sm col-xs-2"  id="skip_end_question" onclick="clicked()" formnovalidate="" form="test_passing" type="submit" action="quiz.php" name="button_click" value='skip_end_question'>Закончить тест</button>
					</div>	
					<div class="row quiz-padding">
							<div class="progress">
								<div class="progress-bar progress-bar-info" role="progressbar" style="width:{$countOfAnswered/$countOfQuestions*100}%">
									{$countOfAnswered}/{$countOfQuestions}
								</div>
							</div>
						</div>
				{/capture} 
				{capture name='end_quiz'}
					{if $data_test->getSeeTheResult()=='Y'}
				        <div class="row">
					        <div class="col-lg-8 quiz-h">
						       Тест:  {$data_test->getTopic()}
					        </div>
					        <div class="col-lg-4 timer">
					           Затраченное время: {$interval}
					        </div>
				        </div>
					    <div class="row quiz-answers">
					        <div class="col-lg-4">
							    <div id='rightAnswers'></div><!--Правильных ответов: {if isset($countOfAnswers->right_answers)}{$countOfAnswers->right_answers}{/if}-->
							</div>
						    <div class="col-lg-4">
							    <div id='wrongAnswers'></div><!--Неправильных ответов: {if isset($countOfAnswers->wrong_answers)}{$countOfAnswers->wrong_answers}{/if}-->
						    </div>
					        <div class="col-lg-4">
							    <div id='skipAnswers'></div><!--Пропущенных ответов: {if isset($countOfAnswers->skip_answers)}{$countOfAnswers->skip_answers}{/if}-->
						    </div>
						</div>
						<script> 
							right=0;document.getElementById('rightAnswers').innerHTML='Правильных ответов: '+right;
							wrong=0;document.getElementById('wrongAnswers').innerHTML='Неправильных ответов: '+wrong;
							skip=0;document.getElementById('skipAnswers').innerHTML='Пропущенных ответов: '+skip;
						function countAnswers(status) {
								if(status=='right'){
									right=right+1;
									document.getElementById('rightAnswers').innerHTML='Правильных ответов: '+right;
								}
								if(status=='wrong'){
									wrong=wrong+1;
									document.getElementById('wrongAnswers').innerHTML='Неправильных ответов: '+wrong;
								}
								if(status=='skip'){
									skip=skip+1;
									document.getElementById('skipAnswers').innerHTML='Пропущенных ответов: '+skip;
								}
							}							
						</script>
											
					{else}
					
					{/if}
					{if $data_test->getSeeDetails()=='Y'}
						<table class="table">
							<tbody>{$row=0}
							    {foreach $data_questions as $one_question}
							    {if isset($colors[$one_question['data_questions']->getIdQuestion()]['value'])}
							        
                                    <tr class="{$colors[$one_question['data_questions']->getIdQuestion()]['value']}">
					{if $colors[$one_question['data_questions']->getIdQuestion()]['value']==success}
						<script>countAnswers('right');</script>
					{elseif $colors[$one_question['data_questions']->getIdQuestion()]['value']==danger}
						<script>countAnswers('wrong');</script>
					{/if}
								{else}
								    <tr id="row{$row}">
								{/if}
									<td>
										<div class="row quiz-row">
										    <h3>{$one_question['data_questions']->getTextQuestion()}</h3>
									    </div>
									    <div class="row quiz-row">
									        <div class="col-lg-6">
					                            {capture name='radio'}  {$count='false'}
					                                {foreach $one_question['data_questions']->getAnswerOption() as $option}                  
						                               <div class="radio disabled">
						                                    <input form="test_passing" type="radio" name="{$one_question['data_questions']->getIdQuestion()}" value="{$option->getIdAnswerOption()}" {if isset($listOfAnswers[$one_question['data_questions']->getIdQuestion()][0]) &&  $listOfAnswers[$one_question['data_questions']->getIdQuestion()][0]==$option->getIdAnswerOption()} checked{$count='true'}{/if} disabled> {$option->getAnswerTheQuestions()}{if $option->getRightAnswer()=='Y'} <span class="glyphicon glyphicon-ok"></span> {/if}
						                               </div>
						                            {/foreach}
{if ($colors[$one_question['data_questions']->getIdQuestion()]['value']==null) and ($count=='false')}<script>countAnswers('skip');document.getElementById('row{$row}').className += "warning";</script>{/if} 
					                            {/capture}
					                            {capture name='radio_list'}{$count='false'}
					                                {foreach $one_question['data_questions']->getAnswerOption() as $option}
					                                  <div class="radio disabled">
					                                    <input form="test_passing" type="radio" action="quiz.php" name="{$one_question['data_questions']->getIdQuestion()}" value="{$option->getIdAnswerOption()}" {if isset($listOfAnswers[$one_question['data_questions']->getIdQuestion()][0]) && $listOfAnswers[$one_question['data_questions']->getIdQuestion()][0]==$option->getIdAnswerOption()} checked{$count='true'}{/if} disabled>{$option->getAnswerTheQuestions()}{if $option->getRightAnswer()=='Y'} <span class="glyphicon glyphicon-ok"></span> {/if}
					                                  </div>
					                                {/foreach}
{if ($colors[$one_question['data_questions']->getIdQuestion()]['value']==null) and ($count=='false')}<script>countAnswers('skip');document.getElementById('row{$row}').className += "warning";</script>{/if}
					                                <!--$listOfAnswers[$one_question['data_questions']->getIdQuestion()]['value']-->
					                            {/capture}
					                            {capture name='checkbox_list'} {$count='false'}
						                               {foreach $one_question['data_questions']->getAnswerOption() as $option}
							                            <div class="checkbox disabled">
								                            <input form="test_passing" type="checkbox" action="quiz.php" name="answer[]" value="{$option->getIdAnswerOption()}"  {if isset($listOfAnswers[$one_question['data_questions']->getIdQuestion()])}{foreach $listOfAnswers[$one_question['data_questions']->getIdQuestion()] as $Answer}{if $Answer == $option->getIdAnswerOption()} checked{$count='true'}{/if}{/foreach} disabled{/if}>{$option->getAnswerTheQuestions()}{if $option->getRightAnswer()=='Y'} <span class="glyphicon glyphicon-ok"></span> {/if}
							                            </div>  
						                            {/foreach}
{if ($colors[$one_question['data_questions']->getIdQuestion()]['value']==null) and ($count=='false')}<script>countAnswers('skip');document.getElementById('row{$row}').className += "warning";</script>{/if}
					                            {/capture}
					                            {capture name='textarea'}
{if $colors[$one_question['data_questions']->getIdQuestion()]['value']==warning}<script>countAnswers('skip');</script>{/if}
						                            <div class="form-group">
							                            <textarea class = "form-control" form="test_passing" name="answer[]" action="quiz.php" maxlength="1000" cols="80" rows="10" disabled>{if isset($listOfAnswers[$one_question['data_questions']->getIdQuestion()][0])}{$listOfAnswers[$one_question['data_questions']->getIdQuestion()][0]}{/if}</textarea>
						                            </div>                          
					                            {/capture}
					                            {capture name='rating'}
{if $colors[$one_question['data_questions']->getIdQuestion()]['value']==warning}<script>countAnswers('skip');</script>{/if}
						                            {foreach $one_question['data_questions']->getAnswerOption() as $option}
							                            <div class="radio disabled">
								                            <input form="test_passing" type="radio" action="quiz.php" name="{$one_question['data_questions']->getIdQuestion()}" value="{$option->getIdAnswerOption()}" {if isset($listOfAnswers[$one_question['data_questions']->getIdQuestion()][0]) && $listOfAnswers[$one_question['data_questions']->getIdQuestion()][0]==$option->getIdAnswerOption()} checked{/if} disabled>{$option->getAnswerTheQuestions()}
							                            </div>
							                        {/foreach}
						                        {/capture}
																		{$row=$row+1}
					                            {if {$one_question['data_questions']->getIdQuestionsType()} eq '1'}
						                            {$smarty.capture.radio}
					                            {elseif {$one_question['data_questions']->getIdQuestionsType()} eq '2'}
						                            {$smarty.capture.radio_list}
					                            {elseif {$one_question['data_questions']->getIdQuestionsType()} eq '3'}
						                            {$smarty.capture.checkbox_list}
					                            {elseif {$one_question['data_questions']->getIdQuestionsType()} eq '4'}
						                            {$smarty.capture.textarea}
					                            {elseif {$one_question['data_questions']->getIdQuestionsType()} eq '5'}
							                        {$smarty.capture.rating}
					                            {/if}
                                            </div>
                                            <div class="col-lg-6">
                                                {if $one_question['data_questions']->getShowChart() == 'Y'}
					                            <div id="{$one_question['data_questions']->getIdQuestion()}" style="width:400; height:300"></div>
					                            
					                            <script>
                                                    google.load('visualization', '1', { 'packages': ['corechart'] });

                                                    google.setOnLoadCallback(drawChart);

                                                    function drawChart() {

                                                    var data = new google.visualization.DataTable();
                                                    data.addColumn('string', 'Topping');
                                                    data.addColumn('number', 'Slices');
                                                    {foreach $one_question['data_questions']->getAnswerOption() as $option}
                                                        data.addRow([{if isset({$option->getAnswerTheQuestions()})} '{$option->getAnswerTheQuestions()}'{/if}, {if isset($countOfAnswersAboutAllUsers[$one_question['data_questions']->getIdQuestion()][$option->getAnswerTheQuestions()])} {$countOfAnswersAboutAllUsers[$one_question['data_questions']->getIdQuestion()][$option->getAnswerTheQuestions()]} {else} 0 {/if}]);
                                                    {/foreach}
                                                    var options = { 'title': "Общие результаты",
                                                    'width':400,
                                                    'height':300};

                                                    var chart = new google.visualization.PieChart(document.getElementById("{$one_question['data_questions']->getIdQuestion()}"));
                                                    chart.draw(data, options);
                                                    }
					                            </script>
				                                </div>
					                            {/if}
					                        </div>
				                        </div>
				                        <div class="row quiz-row">
				                            <p class="quiz-end-com">{$one_question['data_questions']->getCommentQuestion()}</p>
			                            </div>
					               </td>
								</tr>
								{/foreach}
							</tbody>
						</table>
					{else}
					
					{/if}
				    <div class="row">
			            <div class="col-lg-4">
				        </div>
			            <div class="col-lg-4">
			                <a class="btn btn-lg btn-primary" href="main.php">Перейти на главную страницу</a>
			            </div>
			            <div class="col-lg-4">
				        </div>
			        </div>					
				{/capture}    
				{if {$status_testing} eq 'new_testing'}
					{$smarty.capture.new_testing}
				{elseif {$status_testing} eq 'continue_testing'}    
					{$smarty.capture.continue_testing}
				{elseif {$status_testing} eq 'end_quiz'}    
					{$smarty.capture.end_quiz}    
				{/if}    
				{else}
                    <div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-warning-sign"></span>  Недостаточно прав </div>
                {/if}
				</div>
			</div>
			<script>
			    function timer() {
                var nowDate = new Date();
                {if isset($dateinterval)}
                    var st = '{$dateinterval}';
                    var t = st.split(/[- :]/);
                    var d = new Date(t[0], t[1]-1, t[2], t[3], t[4], t[5]);
                    var achiveDate = d;
                    var result = (achiveDate - nowDate)+1000;
                    flag=true;
                    if (result < 0) {
                        var elmnt = document.getElementById('timer');
                        elmnt.innerHTML = ' - : - - : - - : - - ';
                        flag=false;
                        cBack();
                    }
                    var seconds = Math.floor((result/1000)%60);
                    var minutes = Math.floor((result/1000/60)%60);
                    var hours = Math.floor((result/1000/60/60)%24);
                    //var days = Math.floor(result/1000/60/60/24);
                    if (seconds < 10) seconds = '0' + seconds;
                    if (minutes < 10) minutes = '0' + minutes;
                    if (hours < 10) hours = '0' + hours;
                    var elmnt = document.getElementById('timer');
                    elmnt.innerHTML = hours + ':' + minutes + ':' + seconds;
                    setTimeout(timer, 1000);
                {/if}
            }
            </script>
		
        {include file='footer.tpl'}
        </div>   
         
    </body>
</html>

