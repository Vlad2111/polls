<!DOCTYPE html>
<html>
    <head>
        <title>{$title}</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
    <form action="{$action}" method="POST">
        <table border="1">
            <tr>
                <td>
                    Текст
                </td>
                <td>
                    <input type="text" name="text_question" size="50">
                </td>
            </tr>
            <tr>
                <td>
                    Тип
                </td>
                <td>
                   <table >
                       <tr>
                           <td>
                               <input type="radio" name="type_question" value="1"> Да/Нет/Не знаю
                           </td>
                       </tr>
                       <tr>
                           <td>
                               <input type="radio" name="type_question" value="2">Ответ из списка
                            </td>
                       </tr>
                       <tr>
                           <td>
                               <input type="radio" name="type_question" value="3">Выбор одного и более ответов из списка
                            </td>
                       </tr>
                       <tr>
                           <td>
                               <input type="radio" name="type_question" value="4">Написание ответа в виде произвольного текста
                            </td>
                       </tr>
                               
                   </table>
                </td>
            </tr>
            <tr>
                <td>
                    Ответ
                </td>
                <td>
                    <input type="text" name="answer_question" size="50">
                </td>
            </tr>
            <tr>
                <td>
                    Комментарий
                </td>
                <td>
                    <input type="text" name="coment_question" size="50">
                </td>
            </tr>
            <tr>
                <td>
                </td>
                <td>
                    <input type="submit" value="Отправить">
                </td>                   
            </tr>
            
        </table>
    </form>    
<p><font size="5" color="red" face="Arial">{$error}</font>

        </body>    
</html>
