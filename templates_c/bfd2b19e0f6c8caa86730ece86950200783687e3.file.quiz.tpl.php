<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-04 22:36:42
         compiled from "templates\quiz.tpl" */ ?>
<?php /*%%SmartyHeaderCode:236835547939aa3d8f2-82591857%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bfd2b19e0f6c8caa86730ece86950200783687e3' => 
    array (
      0 => 'templates\\quiz.tpl',
      1 => 1430764598,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '236835547939aa3d8f2-82591857',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5547939ac833d7_17183981',
  'variables' => 
  array (
    'title' => 0,
    'data_test' => 0,
    'data_questions' => 0,
    'question' => 0,
    'data_one_question' => 0,
    'status_testing' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5547939ac833d7_17183981')) {function content_5547939ac833d7_17183981($_smarty_tpl) {?><html>
    <head>
        <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
        <meta charset="UTF-8">
    </head>
    <body>
<form id="test_passing" method="post">
                        </form>
    <table width="100%">
            <tr>
                <td  width="100%">
                    <?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

                </td>
            </tr>
            <tr>
                <td>
                    <?php $_smarty_tpl->_capture_stack[0][] = array("new_testing", null, null); ob_start(); ?>
                        <table width="100%" >
                            <tr>                        
                                <td width="30%" valign="top">
                                    <?php echo $_smarty_tpl->getSubTemplate ('menu.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

                                </td>
                                <td width="70%">
                                        <table width="60%" align="center">
                                            <tr>
                                                <td colspan='2'>
                                                    <h2>Информация по тесту</h2>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Тема теста:
                                                </td>
                                                <td>
                                                   <?php echo $_smarty_tpl->tpl_vars['data_test']->value->getTopic();?>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Ограничение по времени
                                                </td>
                                                <td>
                                                    <?php if ($_smarty_tpl->tpl_vars['data_test']->value->getTimeLimit()==''&&$_smarty_tpl->tpl_vars['data_test']->value->getTimeLimit()==null) {?>
                                                        Без ограничения времени
                                                    <?php }?>    
                                                </td>
                                            </tr>  
                                            <tr>
                                                <td>
                                                    Комментарий автора
                                                </td>
                                                <td>
                                                     <?php echo $_smarty_tpl->tpl_vars['data_test']->value->getCommentQuiz();?>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Результат
                                                </td>
                                                <td>
                                                    <?php if ($_smarty_tpl->tpl_vars['data_test']->value->getSeeTheResult()=='Y') {?>
                                                        Разрешено просматривать результат<br>
                                                    <?php }?>   
                                                    <?php if ($_smarty_tpl->tpl_vars['data_test']->value->getSeeDetails()=='Y') {?>
                                                        Разрешено просматривать детальны отчёт
                                                    <?php }?> 
                                                    <?php if ($_smarty_tpl->tpl_vars['data_test']->value->getSeeDetails()=='N'||$_smarty_tpl->tpl_vars['data_test']->value->getSeeTheResult()=='N') {?>
                                                        Запрещено просматривать результат
                                                    <?php }?> 
                                                </td>    
                                            </tr>
                                            <tr>
                                                <td>
                                                    Автор теста
                                                </td>
                                                <td>
                                                    <?php echo $_smarty_tpl->tpl_vars['data_test']->value->getAuthorTest()->getLastName();?>

                                                    <?php echo $_smarty_tpl->tpl_vars['data_test']->value->getAuthorTest()->getFirstName();?>

                                                </td>    
                                            </tr>
                                            <tr>
                                                <td colspan='2' align='center'>
                                                    <button form="test_passing" type="submit" formaction="quiz.php" name="button_click" value='start_quiz'>Начать тест</button>
                                                </td>
                                            </tr>
                                        </table>
                                </td>
                            </tr>    
                        </table>            
                    <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
                    <?php $_smarty_tpl->_capture_stack[0][] = array("continue_testing", null, null); ob_start(); ?>
                        <table width="100%" >
                            <tr>                        
                                <td width="30%" valign="top">
                                    <table>
                                        <tr>
                                            <td>
                                                Вопросы
                                            </td>
                                        </tr>
                                        <?php  $_smarty_tpl->tpl_vars['question'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['question']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data_questions']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['question']->key => $_smarty_tpl->tpl_vars['question']->value) {
$_smarty_tpl->tpl_vars['question']->_loop = true;
?>
                                                <tr>
                                                    <td>                                                        
                                                        <a href='quiz.php?id_question=<?php echo $_smarty_tpl->tpl_vars['question']->value["data_questions"]->getIdQuestion();?>
'>Вопрос № <?php echo $_smarty_tpl->tpl_vars['question']->value['number'];?>
</a>
                                                    </td>
                                                </tr>
                                        <?php } ?>
                                    </table>
                                </td>
                                <td width="70%">
                                    <table>
                                        <tr>
                                            <th>
                                                Тема теста: <?php echo $_smarty_tpl->tpl_vars['data_test']->value->getTopic();?>

                                            </th>
                                        </tr>
                                        <tr>
                                            <td>
                                                Вопрос №  <?php echo $_smarty_tpl->tpl_vars['data_one_question']->value["number"];?>
                                              
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                               <?php echo $_smarty_tpl->tpl_vars['data_one_question']->value["data_questions"]->getTextQuestion();?>
                                            
                                            </td>
                                        </tr> 
                                        <form id="question" method="post">
                                        <tr>
                                            <td>
                                                
                                               <?php $_smarty_tpl->_capture_stack[0][] = array('radio', null, null); ob_start(); ?>                     
                                                      <p><input type="radio" name="Y" value="a1">Да<Br>
                                                      <input type="radio" name="N" value="a2">Нет<Br>
                                                      <input type="radio" name="N" value="a3">Не знаю</p>
                                                <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
                                                <?php $_smarty_tpl->_capture_stack[0][] = array('radio_list', null, null); ob_start(); ?>       
                                                      <input type="radio" name="answer" value="a">var</p>                                                   
                                                <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
                                                <?php $_smarty_tpl->_capture_stack[0][] = array('checkbox_list', null, null); ob_start(); ?>
                                                       <input type="checkbox" name="option1" value="a1">var<Br>  
                                                <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
                                                <?php $_smarty_tpl->_capture_stack[0][] = array('textarea', null, null); ob_start(); ?>
                                                       <textarea name="comment" maxlength="1000" cols="80" rows="10"></textarea></p>                          
                                                   
                                                <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
                                                <?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['data_one_question']->value["data_questions"]->getIdQuestionsType();?>
<?php $_tmp1=ob_get_clean();?><?php if ($_tmp1=='1') {?>
                                                    <?php echo Smarty::$_smarty_vars['capture']['radio'];?>
    
                                                <?php } else {?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['data_one_question']->value["data_questions"]->getIdQuestionsType();?>
<?php $_tmp2=ob_get_clean();?><?php if ($_tmp2=='2') {?>
                                                    <?php echo Smarty::$_smarty_vars['capture']['radio_list'];?>

                                                <?php } else {?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['data_one_question']->value["data_questions"]->getIdQuestionsType();?>
<?php $_tmp3=ob_get_clean();?><?php if ($_tmp3=='3') {?>
                                                    <?php echo Smarty::$_smarty_vars['capture']['checkbox_list'];?>

                                                <?php } else {?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['data_one_question']->value["data_questions"]->getIdQuestionsType();?>
<?php $_tmp4=ob_get_clean();?><?php if ($_tmp4=='4') {?>
                                                    <?php echo Smarty::$_smarty_vars['capture']['textarea'];?>

                                                <?php }}}}?> 
                                                
                                         
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="submit" value="ответить">
                                            </td>                                             
                                        </tr>
                                        <tr>
                                            <td>
                                                <button type="submit" formaction="quiz.php" name="button_click" value='end_quiz'>Закончить тест</button>
                                            </td>                                             
                                        </tr>
                                        </form>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?> 
                    <?php $_smarty_tpl->_capture_stack[0][] = array("end_quiz", null, null); ob_start(); ?>
                        <table width="100%" >
                            <tr>                        
                                <td width="30%" valign="top">
                                    <?php echo $_smarty_tpl->getSubTemplate ('menu.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

                                </td>
                                <td width="70%">
                                        <table width="60%" align="center">
                                            <tr>
                                                <td>
                                                    Вы завершили тест
                                                </td>
                                            </tr>    
                                            <tr>
                                                <td>
                                                    <a hre="main.php">Перейти на главную страницу</a>
                                                </td>
                                            </tr> 
                                        </table>
                                </td>
                            </tr>    
                        </table>  
                    <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>    
                    <?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['status_testing']->value;?>
<?php $_tmp5=ob_get_clean();?><?php if ($_tmp5=='new_testing') {?>
                        <?php echo Smarty::$_smarty_vars['capture']['new_testing'];?>

                    <?php } else {?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['status_testing']->value;?>
<?php $_tmp6=ob_get_clean();?><?php if ($_tmp6=='continue_testing') {?>    
                        <?php echo Smarty::$_smarty_vars['capture']['continue_testing'];?>

                    <?php } else {?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['status_testing']->value;?>
<?php $_tmp7=ob_get_clean();?><?php if ($_tmp7=='end_quiz') {?>    
                        <?php echo Smarty::$_smarty_vars['capture']['end_quiz'];?>
    
                    <?php }}}?>    
                </td>
            </tr>
                
        </table>
    </body>
</html><?php }} ?>
