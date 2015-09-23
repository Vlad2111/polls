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
	<!-- MENU -->
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
                    <a href="create_quiz.php?link_click=new_quiz">Создать опрос</a>
                </li>
			{/if}
			{if isset($data_role[0]) && $data_role[0] eq 1}
                <li class="sidebar-brand">
                    Меню тестируемого
                </li>
                <li>
                    <a class="foc" href="main.php">Список тестов</a>
                </li>
			{/if}
            </ul>
        </div>
        <div id="page-content-wrapper">
            <div class="container-fluid">
                {if isset($data_role[0]) && $data_role[0] eq 1}
                <div class="row">
                    <div class="col-lg-12">
					    {if isset($data_quiz[0]['quiz']->topic) && $data_quiz[0]['quiz']->id_status_test == 2}
                            <table class="table table-hover">
							    <thead>
                                    <tr>
                                        <th>
                                            Тема теста
                                        </th>
                                        <th>
                                            Статус теста
                                        </th>  
									    <th>
									    </th>
                                    </tr>
							    </thead>
							    <tbody>
							        {foreach $data_quiz as $data_one_quiz}
							            {if isset($data_one_quiz['quiz']->topic) && $data_one_quiz['quiz']->id_status_test == 2}
                                            <tr>
                                                <td>
                                                    {$data_one_quiz['quiz']->topic}
                                                </td>  
								                {if $data_one_quiz['testing']}
									                {if $data_one_quiz['testing']->getMarkTest()==1}
										                <td>
											                Доступен
										                </td>
										                <td>
											                <a class="btn btn-xs btn-primary" href="quiz.php?status=available&testing={$data_one_quiz['quiz']->id_test}}" role="button">Пройти тест &raquo;</a>
										                </td>
									                {elseif $data_one_quiz['testing']->getMarkTest()==2}
										                <td>
											                Неоконченный
										                </td>
										                <td>
											                <a class="btn btn-xs btn-primary" href="quiz.php?status=unfinished&testing={$data_one_quiz['quiz']->id_test}" role="button">Продолжить тест &raquo;</a>
										                </td>
									                {elseif $data_one_quiz['testing']->getMarkTest()==3}
										                <td>
											                Не доступный
										                </td>
										                <td>
											                No
										                </td>
									                {elseif $data_one_quiz['testing']->getMarkTest()==4}
										                <td>
											                Завершенный
										                </td>
										                <td>
											                <a class="btn btn-xs btn-primary" href="quiz.php?status=finished&testing={$data_one_quiz['quiz']->id_test}" role="button">Посмотреть результат</a>
										                </td>
									                {/if}
								                {else}
										                <td>
											                Вы еще не открывали этот тест
										                </td>
										                <td>                                                                
											                <a class="btn btn-xs btn-primary" href="quiz.php?status=new_test&testing={$data_one_quiz['quiz']->id_test}" role="button">Начать тест &raquo;</a>
										                </td>
								                {/if} 
							                </tr>
								        {/if}
                                    {/foreach}
							    </tbody>
						    </table>
						{else}
				            <div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-warning-sign"></span>  У вас нет доступных тестов </div>
                        {/if}
                    </div>
                </div>
                {else}
                    <div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-warning-sign"></span>  Недостаточно прав </div>
                {/if}
            </div>
        </div>
           
    </div>
	<footer>
	
	</footer>
    </body>
</html>


