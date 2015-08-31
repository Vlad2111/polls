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
                        <a class="foc" href="author_quiz.php">Мои опросы</a>
                    </li>
                    <li>
                        <a href="create_quiz.php?link_click=new_quiz">Создать опрос</a>
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
                {if isset($data_quiz[0])}
                    <table class="table table-hover">
                       <thead>                                               
                           <th>
                               Тема теста
                           </th>
                           <th>
                               Дата создания
                           </th>
                           <th>
                               Последние изменения
                           </th>
                           <th>
                               Статус опроса
                           </th>
                       </thead>
                       
                           {foreach $data_quiz as $data_one_quiz}
                               <tbody>
                                    <td class="info">
                                        <a href="create_quiz.php?link_click=edit_quiz&id_quiz={$data_one_quiz->id_test}">{$data_one_quiz->topic}</a>
                                    </td>
                                    <td>
                                       {$data_one_quiz->date_create}
                                   </td>
                                   <td>
                                       ---
                                   </td>
                                   <td>
                                       {if $data_one_quiz->id_status_test == 1}
                                            Редактируемый 
                                       {elseif $data_one_quiz->id_status_test == 2}
                                           Доступный для прохождения
                                       {elseif $data_one_quiz->id_status_test == 3}
                                           Завершенный
                                       {/if}
                                   </td>
                           {/foreach}
                    </table>
                {else}
                    Вы еще не создавали опросы</br>
                {/if}
                
                    <a class="btn btn-lg btn-primary" href="create_quiz.php?link_click=new_quiz">Создать опрос</a>
                </div>
            </div>
        </div>                      
    </body>
</html>
