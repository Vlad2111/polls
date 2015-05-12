<html>
    <head>
        <title>{$title}</title>
        <meta charset="UTF-8">
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script src="js/jquery-2.1.3.min.js"></script>
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
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
                                       <a href="create_quiz.php?link_click=new_quiz">Создать опрос</a>
                                   </td>
                               </tr>
                               <tr>
                                   <td>
                                       <table width="100%" align="center">
                                           <tr>                                               
                                               <td>
                                                   Тема теста
                                               </td>
                                               <td>
                                                   Дата создания
                                               </td>
                                               <td>
                                                   Последние изменения
                                               </td>
                                               <td>
                                                   Статус опроса
                                               </td>
                                               <td colspan="2">
                                                   Операции
                                               </td>
                                           </tr>
                                           {foreach $data_quiz as $data_one_quiz}
                                            <tr>
                                                <td>
                                                    {$data_one_quiz->topic}
                                                </td>
                                                <td>
                                                   01.01.2015
                                               </td>
                                               <td>
                                                   ---
                                               </td>
                                               <td>
                                                   {if $data_one_quiz->vasibility_test==1}
                                                        Тест доступен 
                                                    {else}
                                                        Тест заблокирован
                                                    {/if}
                                               </td>
                                                <td>
                                                    <a href="create_quiz.php?link_click=edit_quiz&id_quiz={$data_one_quiz->id_test}">Редактировать тест</a>
                                                </td>
                                                <td>
                                                    <a href="javascript: void(0);">Заблокировать</a>
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
                </td>
            </tr>                
        </table>
      {include file='footer.tpl'}                                 
    </body>
</html>
