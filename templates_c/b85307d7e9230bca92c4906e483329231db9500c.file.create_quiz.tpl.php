<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-06-29 15:53:33
         compiled from "templates/create_quiz.tpl" */ ?>
<?php /*%%SmartyHeaderCode:201589788755913fcd2f6075-23854408%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b85307d7e9230bca92c4906e483329231db9500c' => 
    array (
      0 => 'templates/create_quiz.tpl',
      1 => 1435580356,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '201589788755913fcd2f6075-23854408',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
    'max_time' => 0,
    'data_one_quiz' => 0,
    'data_questions' => 0,
    'data_question_one' => 0,
    'data_answer_option' => 0,
    'one_data_answer_option' => 0,
    'view_quiz' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55913fcd4708a1_10510982',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55913fcd4708a1_10510982')) {function content_55913fcd4708a1_10510982($_smarty_tpl) {?><html>
    <head>
        <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
        <meta charset="UTF-8">
        <?php echo '<script'; ?>
 type="text/javascript" src="https://www.google.com/jsapi"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="js/jquery-2.1.3.min.js"><?php echo '</script'; ?>
>
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
        <?php echo '<script'; ?>
 type="text/javascript">
            function setTimeLimit(value){
                
                switch(value){
                    case "Y":
                        $(".enter_time_limit").show();
                        break;
                    case "N":
                        $(".enter_time_limit").hide();
                        break;
                }
            }
            function addAnswerTypeYorn(value){
                if(parseInt(value) === 1){
                    $("#add_answer_type_yorn").show();
                    $("#addNewQuestion").show();
                    $("#add_answer_type_many_answers").hide();
                }
                if(parseInt(value) === 2){
                    $("#add_answer_type_many_answers").show();
                    $("#add_answer_type_yorn").hide();
                    $("#addNewQuestion").hide();
                }
                if(parseInt(value) === 3) {
                    $("#add_answer_type_many_answers").hide();
                    $("#add_answer_type_yorn").hide();
                    $("#addNewQuestion").hide();
                    $("#add_answer_type_many_answers_some").show();
                }
                if(parseInt(value) === 4) {
                    $("#add_answer_type_many_answers").hide();
                    $("#add_answer_type_yorn").hide();
                    $("#addNewQuestion").show();
                }
                
            }
            function checkTopicQuiz(value){
                $.post("checkForms.php", { action: "check", field: "topic quiz", name: value }, function( data ) {
                if(data == 'true'){
                    $("#yes_topic").show();
                    $(".unsuitable").show();
                    $("#no_topic").hide();
                }
                else{
                    $("#yes_topic").hide();
                    $(".unsuitable").hide();
                    $("#no_topic").show();
                }
              });              
            }
            function showEditQuiz(){
                $("#quiz").show();
            }
            function hideEditQuiz(){
                $("#quiz").hide();
            }  
            function addNewAnswer(){
                var answer = $('textarea[name = "answer_the_question"]').val();
                var text = '<tr><td><input type="radio" class="answer_the_question" name="answer_the_question" value="'+answer+'">'+answer+' <a href="#" onclick="$(\'[value = '+answer+']\').remove()">Удалить</a></td></tr>';
                $(".new_answer").append(text);
                $('textarea[name = "answer_the_question"]').val("");
                $("#addNewQuestion").show();
                
            }
            function addSomeNewAnswer(){
                var answer = $('textarea[name = "answer_some_the_question"]').val();
                var text = '<tr><td><input type="checkbox" class="answer_some_the_question" name="answer_some_the_question" value="'+answer+'">'+answer+' <a href="#" onclick="$(\'[value = '+answer+']\').remove()">Удалить</a></td></tr>';
                $(".new_some_answer").append(text);
                $('textarea[name = "answer_some_the_question"]').val("");
                $("#addNewQuestion").show();
                
            }
        <?php echo '</script'; ?>
>  
        <div class="wrapper">
            <div class="content">
<form id="go" method="post">
                        </form>
        <table width="100%">
            <tr>
                <td  width="100%">
                    <?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

                </td>
            </tr>
            <tr>
                <td>
                <table width="100%" >
                    <tr>                        
                        <td width="30%" valign="top">
                            <?php echo $_smarty_tpl->getSubTemplate ('menu.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

                        </td>
                        <td width="70%">
                            <table width="100%">
                               <tr>
                                <td>    
                                <?php $_smarty_tpl->_capture_stack[0][] = array('new_quiz', null, null); ob_start(); ?>
                                    <form method="post">
                                        <input type='hidden' name='button_click' value='create_quiz'>
                                        Тема опроса:<br>
                                        <input type="text" name="topic_quiz" placeholder="Ваша тема" required  onblur="checkTopicQuiz(this.value)"> 
                                        <span class="unsuitable" id="no_topic" style="display: none; color: red">Такое название уже есть</span>
                                        <span id="yes_topic" style="display: none; color: green">Ок</span>
                                        <br>
                                        Время выполнения опроса:<Br>
                                        <input type="radio" name="time_limit" value="Y" id="time_limit" onchange = 'setTimeLimit((this.getAttribute("value")))'> Да<Br>
                                        <input type="radio" name="time_limit" value="N" id="time_limit" onchange = 'setTimeLimit((this.getAttribute("value")))' checked> Нет<Br>
                                        <div class="enter_time_limit" style="display: none">
                                            
                                            Установите время: <input type="time" name="set_time_limit" id="set_time_limit" value="<?php echo $_smarty_tpl->tpl_vars['max_time']->value;?>
">
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
                                        <span class="unsuitable">
                                            <input type="submit" value="Создать опрос"></span>         
                                    </form> 
                                <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?> 
                                <?php $_smarty_tpl->_capture_stack[0][] = array('menu_questions', null, null); ob_start(); ?>
                                    <h2>Опрос: <?php echo $_smarty_tpl->tpl_vars['data_one_quiz']->value->topic;?>
</h2>
                                    <form method="post">
                                        <a href='create_quiz.php?action=new_question'>Добавить вопрос</a>
                                        <a href='create_quiz.php?action=add_inteviewee'>Добавить тестируемых</a>
                                    </form>  
                                    <table>
                                    <tr>
                                        <td>
                                            Порядок вопроса
                                        </td>
                                        <td>
                                            Текст вопроса
                                        </td>
                                        <td>
                                            Тип вопроса
                                        </td>
                                        <td>
                                            Редактирование вопроса
                                        </td>
                                        <td>
                                            Удалить вопрос
                                        </td>
                                    </tr>
                                       <?php  $_smarty_tpl->tpl_vars['data_question_one'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['data_question_one']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data_questions']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['data_question_one']->key => $_smarty_tpl->tpl_vars['data_question_one']->value) {
$_smarty_tpl->tpl_vars['data_question_one']->_loop = true;
?>  
                                           <?php if ($_smarty_tpl->tpl_vars['data_question_one']->value) {?>
                                       <tr>
                                           <td>
                                               №
                                           </td>
                                           <td>
                                            <?php echo $_smarty_tpl->tpl_vars['data_question_one']->value->text_question;?>

                                           </td>
                                            <td>
                                                
                                                <?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['data_question_one']->value->id_questions_type;?>
<?php $_tmp1=ob_get_clean();?><?php if ($_tmp1==1) {?>
                                                Вопрос типа Да/Нет
                                              <?php } else {?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['data_question_one']->value->id_questions_type;?>
<?php $_tmp2=ob_get_clean();?><?php if ($_tmp2==2) {?>
                                                  Вопрос с возможностью выбора одного ответа из списка
                                              <?php } else {?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['data_question_one']->value->id_questions_type;?>
<?php $_tmp3=ob_get_clean();?><?php if ($_tmp3==3) {?>
                                                Вопрос с возможностью выбора одного или более ответов из списка
                                              <?php } else {?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['data_question_one']->value->id_questions_type;?>
<?php $_tmp4=ob_get_clean();?><?php if ($_tmp4==4) {?>
                                                Произвольный текст
                                            <?php }}}}?> 
                                           </td>
                                           <td>
                                                <a href="?action=edit_question&id_question=<?php echo $_smarty_tpl->tpl_vars['data_question_one']->value->id_question;?>
">Редактировать</a>
                                           </td>
                                           <td>
                                               <a href="?action=delete&id_question=<?php echo $_smarty_tpl->tpl_vars['data_question_one']->value->id_question;?>
">Удалить</a>
                                           </td>
                                       </tr>
                                       <?php }?>
                                <?php } ?>
                                    </table>
                                <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
                                <?php $_smarty_tpl->_capture_stack[0][] = array('new_question', null, null); ob_start(); ?>
                                    <form method="post">
                                        Текст вопроса <br>
                                        <textarea rows="5" cols="40" name="text_question" placeholder="Ваш вопрос" required></textarea><br>
                                        Дополнительная информация<br>
                                        <textarea rows="5" cols="40" name="comment_question"></textarea><br>
                                        Тип вопроса<br>
                                        <select  name="question_type"  onchange ='addAnswerTypeYorn(this.options[this.selectedIndex].value);'>
                                            <option  value="1">Да/Нет/Не знаю</option>
                                            <option value="2">Один ответа из списка</option>
                                            <option value="3">Выбор одного или более ответов из списка</option>
                                            <option value="4" selected>Произвольный ответ</option>
                                        </select><br>  
                                        <div id='add_answer_type_yorn' style="display: none">
                                            Выберите привильный ответ<br>
                                            <input type='radio' name='add_answer_type_yorn' value='Yes' checked="">Да<br>
                                            <input type='radio' name='add_answer_type_yorn' value='No'>Нет
                                        </div>                                        
                                        <div id="addNewQuestion" style="display: none">
                                            <button name="button_click" value="add_question"> Создать вопрос</button>
                                        </div>
                                        <div id='add_answer_type_many_answers' style="display: none">
                                        <form  method='post'>
                                        Текст ответа<br>
                                        <textarea id='addQuestion' rows="5" cols="40" name="answer_the_question"></textarea> 
                                        <a href="javascript: void(0);" onclick="addNewAnswer();">Добавить ответ</a>
                                    
                                        <table>                                                
                                            <tr>
                                            <div class="new_answer"></div>
                                            </tr>                                       
                                        </table> 
                                        </form>
                                    </div>
                                        
                                        <div id='add_answer_type_many_answers_some' style="display: none">
                                        <form  method='post'>
                                        Текст ответа<br>
                                        <textarea id='addSomeQuestion' rows="5" cols="40" name="answer_some_the_question"></textarea> 
                                        <a href="javascript: void(0);" onclick="addSomeNewAnswer();">Добавить ответ</a>
                                    
                                        <table>                                                
                                            <tr>
                                            <div class="new_some_answer"></div>
                                            </tr>                                       
                                        </table> 
                                        </form>
                                    </div>
                                        
                                <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
                                <?php $_smarty_tpl->_capture_stack[0][] = array('add_answer_option_one', null, null); ob_start(); ?>
                                    <form  method='post'>
                                        Текст ответа<br>
                                        <textarea id='addQuestion' rows="5" cols="40" name="answer_the_question"></textarea> 
                                        <button name="button_click" value='add_answer_option_one'>Добавить ответ</button>
                                    
                                    <table>
                                        <?php  $_smarty_tpl->tpl_vars['one_data_answer_option'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['one_data_answer_option']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data_answer_option']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['one_data_answer_option']->key => $_smarty_tpl->tpl_vars['one_data_answer_option']->value) {
$_smarty_tpl->tpl_vars['one_data_answer_option']->_loop = true;
?>                                                
                                            <tr>
                                                <td>
                                                    <?php if ($_smarty_tpl->tpl_vars['one_data_answer_option']->value->right_answer=='Y') {?>
                                                        <input type="radio" name="value_answer_option" value="<?php echo $_smarty_tpl->tpl_vars['one_data_answer_option']->value->id_answer_option;?>
" checked>
                                                    <?php } elseif ($_smarty_tpl->tpl_vars['one_data_answer_option']->value->right_answer=='N') {?>
                                                        <input type="radio" name="value_answer_option" value='<?php echo $_smarty_tpl->tpl_vars['one_data_answer_option']->value->id_answer_option;?>
'>
                                                    <?php }?>
                                                </td>
                                                <td> 
                                                    <?php echo $_smarty_tpl->tpl_vars['one_data_answer_option']->value->answer_the_questions;?>

                                                </td>
                                            </tr>
                                        <?php } ?>                                        
                                    </table>   
                                    <button name="button_click" value='add_right_answer_option_one'>Внести ответы</button>
                                    </form>
                                <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
                                <?php $_smarty_tpl->_capture_stack[0][] = array('add_answer_option_more', null, null); ob_start(); ?>
                                    Добавить несколько варианты ответов
                                <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
                                <?php $_smarty_tpl->_capture_stack[0][] = array('edit_quiz', null, null); ob_start(); ?>
                                    <h2><a href="javascript: void(0);" onclick="showEditQuiz();"><img src="img/edit.png" width='30' height='30'></a>Опрос: <?php echo $_smarty_tpl->tpl_vars['data_one_quiz']->value->topic;?>
</h2>
                                    <div id="quiz" style="display: none">
                                    <form method="post">
                                        <input type="hidden" name="id_quiz" value="<?php echo $_smarty_tpl->tpl_vars['data_one_quiz']->value->id_test;?>
">
                                        <table width="60%" align="center" bgcolor="#87CEFA">
                                            <tr>
                                                <td>
                                                    Тема опроса
                                                </td>
                                                <td>
                                                    <input type="text" name="topic" value="<?php echo $_smarty_tpl->tpl_vars['data_one_quiz']->value->topic;?>
">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Ограничение времени
                                                </td>
                                                <td>
                                                    <input type="text" name="time_limit" value="<?php echo $_smarty_tpl->tpl_vars['data_one_quiz']->value->time_limit;?>
">
                                                </td>
                                            </tr>  
                                            <tr>
                                                <td>
                                                    Комментарий к опросу
                                                </td>
                                                <td>
                                                    <input type="text" name="comment_test" value="<?php echo $_smarty_tpl->tpl_vars['data_one_quiz']->value->comment_test;?>
">
                                                </td>
                                            </tr>  
                                            <tr>
                                                <td>
                                                    Смотреть результат
                                                </td>
                                                <td>
                                                    <input type="text" name="see_the_result" value="<?php echo $_smarty_tpl->tpl_vars['data_one_quiz']->value->see_the_result;?>
">
                                                </td>
                                            </tr> 
                                            <tr>
                                                <td>
                                                    Смотреть детальную информацию
                                                </td>
                                                <td>
                                                    <input type="text" name="see_details" value="<?php echo $_smarty_tpl->tpl_vars['data_one_quiz']->value->see_details;?>
">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Состояние теста
                                                </td>
                                                <td>
                                                    <input type="text" name="id_status_test" value="<?php echo $_smarty_tpl->tpl_vars['data_one_quiz']->value->id_status_test;?>
">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Статус теста
                                                </td>
                                                <td>
                                                    <input type="text" name="vasibility_test" value="<?php echo $_smarty_tpl->tpl_vars['data_one_quiz']->value->vasibility_test;?>
">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="submit" value="Изменить опрос">
                                                </td>
                                                <td align="right">
                                                    <a href='javascript: void(0);' onclick='hideEditQuiz();'><img src="img/exit.png" width="20" height="20"></a>
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                    </div>            
                                    <?php echo Smarty::$_smarty_vars['capture']['menu_questions'];?>

                                <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
                                
                                <?php $_smarty_tpl->_capture_stack[0][] = array('edit_question', null, null); ob_start(); ?>
                                    Редактирование вопроса
                                <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
                                <?php $_smarty_tpl->_capture_stack[0][] = array('add_inteviewee', null, null); ob_start(); ?>
                                    <h2>Добавить опрашиваемых</h2>
                                    <form method="post">
                                    <table>                                            
                                        <tr>
                                            <td>
                                                <h3>Добавить пользователя</h3>
                                            </td>
                                            <td>
                                                <h3>Добавить группу</h3>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" size="50%">
                                            </td>
                                            <td>
                                                <input type="text" size="50%">
                                            </td>
                                        </tr>
                                    </table>
                                    <input type="submit">
                                    </form>   
                                        
                                        
                                <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>    
                                    <?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['view_quiz']->value;?>
<?php $_tmp5=ob_get_clean();?><?php if ($_tmp5=='new_quiz') {?>
                                        <?php echo Smarty::$_smarty_vars['capture']['new_quiz'];?>
   
                                    <?php } else {?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['view_quiz']->value;?>
<?php $_tmp6=ob_get_clean();?><?php if ($_tmp6=='menu_questions') {?>
                                        <?php echo Smarty::$_smarty_vars['capture']['menu_questions'];?>

                                    <?php } else {?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['view_quiz']->value;?>
<?php $_tmp7=ob_get_clean();?><?php if ($_tmp7=='new_question') {?>
                                        <?php echo Smarty::$_smarty_vars['capture']['new_question'];?>

                                    <?php } else {?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['view_quiz']->value;?>
<?php $_tmp8=ob_get_clean();?><?php if ($_tmp8=='add_answer_option_one') {?>
                                        <?php echo Smarty::$_smarty_vars['capture']['add_answer_option_one'];?>

                                    <?php } else {?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['view_quiz']->value;?>
<?php $_tmp9=ob_get_clean();?><?php if ($_tmp9=='add_answer_option_more') {?>
                                        <?php echo Smarty::$_smarty_vars['capture']['add_answer_option_more'];?>
    
                                    <?php } else {?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['view_quiz']->value;?>
<?php $_tmp10=ob_get_clean();?><?php if ($_tmp10=='edit_quiz') {?>
                                        <?php echo Smarty::$_smarty_vars['capture']['edit_quiz'];?>
    
                                    <?php } else {?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['view_quiz']->value;?>
<?php $_tmp11=ob_get_clean();?><?php if ($_tmp11=='add_inteviewee') {?>
                                        <?php echo Smarty::$_smarty_vars['capture']['add_inteviewee'];?>
     
                                     <?php }}}}}}}?>
                                </td>
                               </tr>
                           </table>  
                        </td>
                    </tr>
                </table>
                </td>
            </tr>
        </table>
                                </div>
        <?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
       
        </div>
    </body>
</html>
<?php }} ?>
