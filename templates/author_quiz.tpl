<html>
    <head>
        <title>{$title}</title>
        <meta charset="UTF-8">
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
                                       <a href="create_quiz.php">Создать опрос</a>
                                   </td>
                               </tr>
                               <tr>
                                   <td>
                                       <h1>
                                            Созданные тесты
                                       </h1>
                                   </td>
                               </tr>
                                {foreach $data_quiz as $data_one_quiz}
                                       <tr>
                                           <td>
                                            {$data_one_quiz->topic}
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
    </body>
</html>
