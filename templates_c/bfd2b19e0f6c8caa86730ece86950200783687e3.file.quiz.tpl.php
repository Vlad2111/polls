<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-04-08 14:17:15
         compiled from "templates\quiz.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14668551cd84022f176-23676017%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bfd2b19e0f6c8caa86730ece86950200783687e3' => 
    array (
      0 => 'templates\\quiz.tpl',
      1 => 1428488181,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14668551cd84022f176-23676017',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_551cd840af7034_34996462',
  'variables' => 
  array (
    'title' => 0,
    'data_one_testing' => 0,
    'question' => 0,
    'type_answer' => 0,
    'status_test' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_551cd840af7034_34996462')) {function content_551cd840af7034_34996462($_smarty_tpl) {?><html>
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
            <?php $_smarty_tpl->_capture_stack[0][] = array('taking_a_test', null, null); ob_start(); ?>
                <table width="30%" align="center">
            <tr align="center">
            <th>
                Тема теста: <?php echo $_smarty_tpl->tpl_vars['data_one_testing']->value->getTest()->getTopic();?>

            </th>
            </tr>
            <tr align="center">
                <td>
                    Вопрос №1
                </td>
            </tr> 
            <tr align="center">
                <td> 
                <?php echo $_smarty_tpl->tpl_vars['question']->value->getTextQuestion();?>

                </td>
            </tr> 
            <tr align="left">
                <td>
                    <?php $_smarty_tpl->_capture_stack[0][] = array('radio', null, null); ob_start(); ?>
                        <form>                      
                          <p><input type="radio" name="Y" value="a1">Да<Br>
                          <input type="radio" name="N" value="a2">Нет<Br>
                          <input type="radio" name="N" value="a3">Не знаю</p>
                         </form>
                    <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
                    <?php $_smarty_tpl->_capture_stack[0][] = array('radio_list', null, null); ob_start(); ?>
                        <form>           
                          <input type="radio" name="answer" value="a">var</p>
                         </form>
                    <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
                    <?php $_smarty_tpl->_capture_stack[0][] = array('checkbox_list', null, null); ob_start(); ?>
                        <form>
                           <input type="checkbox" name="option1" value="a1">var<Br>                           
                        </form>
                    <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
                    <?php $_smarty_tpl->_capture_stack[0][] = array('textarea', null, null); ob_start(); ?>
                        <form>
                           <textarea name="comment" maxlength="1000" cols="80" rows="10"></textarea></p>                          
                        </form>
                    <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
                    <?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['type_answer']->value;?>
<?php $_tmp1=ob_get_clean();?><?php if ($_tmp1=='1') {?>
                        <?php echo Smarty::$_smarty_vars['capture']['radio'];?>
    
                    <?php } else {?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['type_answer']->value;?>
<?php $_tmp2=ob_get_clean();?><?php if ($_tmp2=='2') {?>
                        <?php echo Smarty::$_smarty_vars['capture']['radio_list'];?>

                    <?php } else {?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['type_answer']->value;?>
<?php $_tmp3=ob_get_clean();?><?php if ($_tmp3=='3') {?>
                        <?php echo Smarty::$_smarty_vars['capture']['checkbox_list'];?>

                    <?php } else {?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['type_answer']->value;?>
<?php $_tmp4=ob_get_clean();?><?php if ($_tmp4=='4') {?>
                        <?php echo Smarty::$_smarty_vars['capture']['textarea'];?>

                    <?php }}}}?>
                   <?php echo Smarty::$_smarty_vars['capture']['table_users'];?>

                </td>
            </tr>  
            <tr align="center">
                <td>
                    
                    <table>
                        <tr>
                            <td>
                                <button form="test_passing" type="submit" formaction="quiz.php" name="button_click" value='prev'>Следующий вопрос</button>                                
                            </td>
                            <td>
                                <button form="test_passing" type="submit" formaction="quiz.php" name="button_click" value='end'>Следующий вопрос</button>
                              
                            </td>    
                            <td>
                                <button form="test_passing" type="submit" formaction="quiz.php" name="button_click" value='next'>Следующий вопрос</button>
                                
                            </td> 
                        </tr>    
                    </table> 
            <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
            <?php $_smarty_tpl->_capture_stack[0][] = array('start_test', null, null); ob_start(); ?>
                <table width="30%" align="center">
                    <tr>
                        <td>
                            Тема теста:
                        </td>
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['data_one_testing']->value->getTest()->getTopic();?>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            Ограничение по времени
                        </td>
                        <td>
                            <?php if ($_smarty_tpl->tpl_vars['data_one_testing']->value->getTest()->getTimeLimit()) {?>
                            <?php echo $_smarty_tpl->tpl_vars['data_one_testing']->value->getTest()->getTimeLimit();?>

                            <?php } else { ?> Отсутсвует
                            <?php }?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Комментани автора:
                        </td>
                        <td>
                            <?php if ($_smarty_tpl->tpl_vars['data_one_testing']->value->getTest()->getCommentQuiz()) {?>
                            <?php echo $_smarty_tpl->tpl_vars['data_one_testing']->value->getTest()->getCommentQuiz();?>

                            <?php } else { ?> Отсутсвует
                            <?php }?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                           Автор теста: 
                        </td>
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['data_one_testing']->value->getTest()->getAuthorTest()->getLastName();?>
 
                            <?php echo $_smarty_tpl->tpl_vars['data_one_testing']->value->getTest()->getAuthorTest()->getFirstName();?>
 
                        </td>
                    </tr>
                    <tr align="center">
                        <td colspan="2">
<button form="test_passing" type="submit" formaction="quiz.php" name="button_click" value='start_quiz'>Начать тест</button>
                        </td>
                    </tr>
                </table>
            <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
            <?php $_smarty_tpl->_capture_stack[0][] = array("finished_test", null, null); ob_start(); ?>
                <table width="30%" align="center">
                    <tr>
                        <td>
                            Вы уже прошли этот тест
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="main.php">Перейти на начальную страницу</a>
                        </td>
                    </tr>
                </table>
            <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
            <?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['status_test']->value;?>
<?php $_tmp5=ob_get_clean();?><?php if ($_tmp5=='start_test') {?>
                       <?php echo Smarty::$_smarty_vars['capture']['start_test'];?>

                    <?php } else {?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['status_test']->value;?>
<?php $_tmp6=ob_get_clean();?><?php if ($_tmp6=='taking_a_test') {?>
                        <?php echo Smarty::$_smarty_vars['capture']['taking_a_test'];?>

                    <?php } else {?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['status_test']->value;?>
<?php $_tmp7=ob_get_clean();?><?php if ($_tmp7=='end_test') {?>
                        <?php echo Smarty::$_smarty_vars['capture']['end_test'];?>

                    <?php } else {?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['status_test']->value;?>
<?php $_tmp8=ob_get_clean();?><?php if ($_tmp8=='finished_test') {?>
                        <?php echo Smarty::$_smarty_vars['capture']['finished_test'];?>

                    <?php }}}}?>
            </td>
            </tr>
        </table>  
</td> 
  </tr>            
        </table> 
    </body>
</html>
<?php }} ?>
