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
