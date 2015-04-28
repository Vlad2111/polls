<html>
    <head>
        <title>hi</title>
        <meta charset="UTF-8">
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script src="js/jquery-2.1.3.min.js"></script>
    </head>
    <body>
        <script type="text/javascript">
            function setTimeLimit(value){
                switch(value){
                    case "Y":
                        $(".enter_time_limit").show();
                        $("#set_time_limit").val("12:00:00");
                        break;
                    case "N":
                        $(".enter_time_limit").hide();
                        break;
                }
            }
            function aer(){
                var str = document.getElementById("time_limit").value;
                switch(str){
                    case "1":
                        //document.getElementById('default_money').setAttribute('style','display:block');
                        alert(document.getElementById('email').setAttribute('style','display:block'));
                        break
                    case "2":
                        alert(2);
                        break;
                }
            }
            
        </script>    
<form id="go" method="post">
                        </form>
        <table width="100%">
            <tr>
                <td  width="100%">                        
        
                </td>
            </tr>
            <tr>
                <td>
<!--                    <select class="newTypePeaople" id="email" onchange = 'typePeople()'>
                    
                <select class="newTypePeaople" onchange = 'typePeople(parseInt(this.getAttribute("value")))'>расчёт по чему рассчитывается больничный лист
                    <option value="0" selected>Выбрать</option>
                    <option value="1"> на общих основаниях</option>
                    <option value="2"> для граждан Крыма</option>
                </select>-->

            <div class="default_money" style="display: none">
               <input type="text" id="kaz">
            </div>
<!--                    <form method="get">
                                        Тема опроса:<br>
                                        <input type="text" name="topic_quiz" placeholder="Ваша тема" required><br>
                                        Время выполнения опроса:<Br>
                                        <input type="radio" name="time_limit" value="Y" id="time_limit" onchange = 'setTimeLimit((this.getAttribute("value")))'> Да<Br>
                                        <input type="radio" name="time_limit" value="N" id="time_limit" onchange = 'setTimeLimit((this.getAttribute("value")))' checked> Нет<Br>
                                        <div class="enter_time_limit" style="display: none">
                                            Установите время: <input type="time" name="set_time_limit" id="set_time_limit" value="00:00:00">
                                         </div>
                                        Дополнительная информация:<Br>
                                        <textarea rows="5" cols="40" name="comment_test" placeholder="Информация, которая необходима для прохождения теста"></textarea><br>
                                        Разрешить смотреть результаты опроса:<Br>
                                        <input type="radio" name="see_the_result" value="Y" checked> Да<Br>
                                        <input type="radio" name="see_the_result" value="N"> Нет<Br>
                                        Разрешить смотреть детальную информацию:<Br>
                                        <input type="radio" name="see_details" value="Y" checked> Да<Br>
                                        <input type="radio" name="see_details" value="N"> Нет<Br>                                        
                                        <input type="hidden" name="status_test" value="1">
                                        <input type="submit" value="Создать опрос"><br>         
                                    </form>-->
                    <form method="post">
                                        Текст вопроса<br>
                                        <textarea rows="5" cols="40" name="text_question" placeholder="Ваш вопрос" required></textarea><br>
                                        Дополнительная информация<br>
                                        <textarea rows="5" cols="40" name="comment_question"></textarea><br>
                                        Тип вопроса<br>
                                        <select  name="question_type">
                                            <option  selected value="1">Да/Нет/Не знаю</option>
                                            <option value="2">Один ответа из списка</option>
                                            <option value="3">Выбор одного или более ответов из списка</option>
                                            <option value="4">Произвольный ответ</option>
                                        </select><br>
                                        <button name="add_question" value="yes"> Создать вопрос</button>
                                    </form> 
  
                </td>
            </tr>
                
        </table>
    </body>
</html>
