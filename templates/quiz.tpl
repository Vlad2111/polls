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
    </head>
    <body>
        {include file='header.tpl'}
        <div id="wrapper">
			<form id="test_passing" method="post"> 
					</form>
				{include file='menu.tpl'}
				<div id="page-content-wrapper">
				<div class="container-fluid">
				{capture name='new_testing'}
						<table class="table">
							<thead>
								<tr>
									<th colspan='2' align="center">
										<h2>Информация по тесту</h2>
									</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class='info' width='35%'>
										<b>Тема теста</b>
									</td>
									<td>
									   {$data_test->getTopic()}
									</td>
								</tr>
								<tr>
									<td class='info'>
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
										<b>Комментарий автора</b>
									</td>
									<td>
										{$data_test->getCommentQuiz()}
									</td>
								</tr>
								<tr>
									<td  class='info'>
										<b>Разрешено просматривать результат</b>
									</td>
									<td>
										{if $data_test->getSeeTheResult()=='Y'}
											<span class="glyphicon glyphicon-ok"></span>
										
										{else}
											<span class="glyphicon glyphicon-remove"></span>
										{/if}
									</td>    
								</tr>
								<tr>
									<td  class='info'>
										<b>Разрешено просматривать детальны отчёт</b>
									</td>
									<td>
										{if $data_test->getSeeDetails()=='Y'}
											<span class="glyphicon glyphicon-ok"></span>
										
										{else}
											<span class="glyphicon glyphicon-remove"></span>
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
						<div class="col-lg-4 timer">
						</div>
					</div>
					<hr width="100%" color="7088FF" />
					<div class="row">
						<div class="col-lg-12">
							<h3>{$data_one_question->getTextQuestion()} </h3>                                          
						</div>
					</div>
					<div class="row quiz-row">
						{capture name='radio'}   
						{foreach $data_one_question->getAnswerOption() as $option}                  
							 <div class="radio"><input form="test_passing" type="radio" name="answer" value="{$option->getIdAnswerOption()}" checked>Да</div>
							{/foreach}
						{/capture}
						{capture name='radio_list'}
							{foreach $data_one_question->getAnswerOption() as $option}
							  <div class="radio">
							  <input form="test_passing" type="radio" action="quiz.php" name="answer" value="{$option->getIdAnswerOption()}" checked>{$option->getAnswerTheQuestions()}</div>  
							{/foreach}
						{/capture}
						{capture name='checkbox_list'} 
							   {foreach $data_one_question->getAnswerOption() as $option}
								<div class="checkbox">
									<input form="test_passing" type="checkbox" action="quiz.php" name="answer[]" value="{$option->getIdAnswerOption()}">{$option->getAnswerTheQuestions()}
								</div>  
							{/foreach}
						{/capture}
						{capture name='textarea'}
							<div class="form-group">
								<textarea class = "form-control" form="test_passing" name="answer[]" action="quiz.php" maxlength="1000" cols="80" rows="10"></textarea>
							</div>                          
						{/capture}
						{if {$data_one_question->getIdQuestionsType()} eq '1'}
							{$smarty.capture.radio}    
						{elseif {$data_one_question->getIdQuestionsType()} eq '2'}
							{$smarty.capture.radio_list}
						{elseif {$data_one_question->getIdQuestionsType()} eq '3'}
							{$smarty.capture.checkbox_list}
						{elseif {$data_one_question->getIdQuestionsType()} eq '4'}
							{$smarty.capture.textarea}
						{/if} 
					</div>	
					<div class="row">
						<button class="btn btn-md btn-success" form="test_passing" type="submit" action="quiz.php" name="button_click" value='end_question'> Ответить</button>
						<button class="btn btn-md btn-danger" form="test_passing" type="submit" action="quiz.php" name="button_click" value='skip_question'> Пропустить</button>
					</div>
					<div class="row quiz-padding">
						<button class="btn btn-md btn-warning" form="test_passing" type="submit" action="quiz.php" name="button_click" value='skip_end_question'>Закончить тест</button>
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
					           Затраченое время: {$interval}
					        </div>
				        </div>
					    <div class="row quiz-answers">
					        <div class="col-lg-4 text-success">
							    Правильных ответов: {$countOfAnswers->right_answers}
							</div>
						    <div class="col-lg-4 text-danger">
							    Неправильных ответов: {$countOfAnswers->wrong_answers}
						    </div>
					        <div class="col-lg-4 text-warning">
							    Пропущенных ответов: {$countOfAnswers->skip_answers}
						    </div>
						</div>
											
					{else}
						<span class="glyphicon glyphicon-remove"></span>
					{/if}
					{if $data_test->getSeeDetails()=='Y'}
						
					{else}
						<span class="glyphicon glyphicon-remove"></span>
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
				</div>
			</div>
        {include file='footer.tpl'}
        </div>       
    </body>
</html>

