<html>
    <head>
        <title>{$title}</title>
        <meta charset="UTF-8">
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script src="js/jquery-2.1.3.min.js"></script>
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
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
                            <table>
                                <tr>
                                    <td>
                                        Тема теста
                                    </td>
                                    <td>
                                        Статус теста
                                    </td>                                    
                                </tr>
                                {foreach $data_quiz as $data_one_quiz}
                                    <tr>
                                        <td>
                                            {$data_one_quiz['quiz']->topic}
                                        </td>   
                                        <td>
                                            <table>
                                                <tr>
                                                        {if $data_one_quiz['testing']}
                                                            {if $data_one_quiz['testing']->getMarkTest()==1}
                                                                <td>
                                                                    Доступен
                                                                </td>
                                                                <td>
                                                                    <a href="quiz.php?status=available&testing={$data_one_quiz['testing']->getIdTesting()}">Пройти тест</a>
                                                                </td>
                                                            {elseif $data_one_quiz['testing']->getMarkTest()==2}
                                                                 <td>
                                                                    Неоконченный
                                                                </td>
                                                                <td>
                                                                    <a href="quiz.php?status=unfinished&testing={$data_one_quiz['testing']->getIdTesting()}">Продолжить тест</a>
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
                                                                    Законченный
                                                                </td>
                                                                <td>
                                                                    No
                                                                </td>
                                                            {/if}
                                                        {else}
                                                                <td>
                                                                    Вы еще не открывали этот тест
                                                                </td>
                                                                <td>                                                                
                                                                   <a href="quiz.php?status=available&testing={$data_one_quiz['quiz']->id_test}">Начать тест</a>
                                                                </td>
                                                        {/if}   
                                                </tr>
                                            </table>
                                        </td> 
                                    </tr>
                                {/foreach}
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
