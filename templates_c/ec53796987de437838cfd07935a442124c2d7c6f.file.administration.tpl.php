<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-03-04 06:17:54
         compiled from "templates/administration.tpl" */ ?>
<?php /*%%SmartyHeaderCode:24545942454f6352c5ee217-77496550%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ec53796987de437838cfd07935a442124c2d7c6f' => 
    array (
      0 => 'templates/administration.tpl',
      1 => 1425439072,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '24545942454f6352c5ee217-77496550',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54f6352c63fcf4_84186701',
  'variables' => 
  array (
    'title' => 0,
    'you' => 0,
    'users_data' => 0,
    'one_user_data' => 0,
    'quiz_data' => 0,
    'one_quiz_data' => 0,
    'array_one_quiz' => 0,
    'create_user_fio' => 0,
    'view_admin' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54f6352c63fcf4_84186701')) {function content_54f6352c63fcf4_84186701($_smarty_tpl) {?><html>
    <head>
        <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
        <meta charset="UTF-8">
    </head>
    <body>
        <table width="100%">
            <tr>
                <td  width="100%" height="70" bgcolor="#708090">
                    <table width="100%">
                        <tr>
                            <td width="80%" align="center">
                                <h2>Автоматическая система тестирования</h2>
                            </td>
                            <td width="30%">
                                <?php echo $_smarty_tpl->tpl_vars['you']->value;?>

                            </td>
                            <td width="10%">
                                <a href='administration.php?exit=ok'>Выход</a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                <table width="100%" >
                    <tr>                        
                <td width="20%" valign="top">
                <table id='menu_administration'>
                    <tr bgcolor="#F5F5F5" valign="top">
                            <td width="50%" height="10%" align="left" bgcolor="#6CA6CD">
                                <a href=administration.php?tab=quiz>Опросы</a>
                            </td>
                    </tr>
                    <tr>   
                            <td width="50%" height="10%" align="left" bgcolor="#8DB6CD">
                                <a href=administration.php?tab=users>Пользователи</a>
                            </td>
                    </tr>    
                </table>
                </td>
           
                <td width="80%">
                <?php $_smarty_tpl->_capture_stack[0][] = array('table_users', null, null); ob_start(); ?>    
                    <table  width="100%"  bgcolor="#CDC8B1">
                        <tr align="center">
                            <td bgcolor="#8B8378">
                                <button form="users"  type="submit" formaction="administration.php">Выбрать пользователя</button>
                            </td>
                            <td bgcolor="#8B8378">
                                <button form="users" type="reset" value="reset">Отменить выбор</button>
                            </td>
                             <td bgcolor="#8B8378">
                                <button form="users" type="submit" formaction="administration.php" name="new_user" value='ok'>Создать пользователя</button>
                            </td>
                        </tr>
                    </table>
                    <table width="100%">
                        
                        <tr>
                            <td width="100%" bgcolor="#CDC8B1">
                               <form id="users" method='post'>
                                   <table width="100%">
                                        <?php  $_smarty_tpl->tpl_vars['one_user_data'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['one_user_data']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['users_data']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['one_user_data']->key => $_smarty_tpl->tpl_vars['one_user_data']->value) {
$_smarty_tpl->tpl_vars['one_user_data']->_loop = true;
?>                                          
                                           <tr> <td><input type="radio" name="user_control" value="<?php echo $_smarty_tpl->tpl_vars['one_user_data']->value[0];?>
"> </td>
                                                <td><?php echo $_smarty_tpl->tpl_vars['one_user_data']->value[1];?>
</td>
                                                <td><?php echo $_smarty_tpl->tpl_vars['one_user_data']->value[2];?>
</td>
                                                <td><?php echo $_smarty_tpl->tpl_vars['one_user_data']->value[3];?>
</td>
                                                <td><?php echo $_smarty_tpl->tpl_vars['one_user_data']->value[4];?>
</td>
                                        </tr>

                                        <?php } ?>
                                    </table>
                              </form>
                            </td>
                        </tr>
                    </table> 
                <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
                <?php $_smarty_tpl->_capture_stack[0][] = array('table_quiz', null, null); ob_start(); ?>    
                    <table  width="100%"  bgcolor="#CDC8B1">
                        <tr align="center">
                            <td bgcolor="#8B8378">
                                <button form="quiz" type="submit" formaction="administration.php">Выбрать опрос</button>
                            </td>
                            <td bgcolor="#8B8378">
                                <button form="quiz" type="reset" value="reset">Отменить выбор</button>
                            </td>
                        </tr>
                    </table>
                    <table width="100%">
                        
                        <tr>
                            <td width="100%" bgcolor="#CDC8B1">
                               <form id="quiz" method='POST'>
                                   <table width="100%">
                                       <tr align='center' bgcolor='#838B8B'>
                                           <td width='20%'>
                                           Название теста    
                                           </td>
                                           <td wight='40%'>
                                               Автор теста
                                           </td>
                                           <td wight='40%'>
                                               Статус теста
                                           </td>
                                       </tr>
                                   </table>
                                       <table width="100%">
                                    <?php  $_smarty_tpl->tpl_vars['one_quiz_data'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['one_quiz_data']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['quiz_data']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['one_quiz_data']->key => $_smarty_tpl->tpl_vars['one_quiz_data']->value) {
$_smarty_tpl->tpl_vars['one_quiz_data']->_loop = true;
?>  
                                       <tr align='center'>                                             
                               <td width='5'><input type="radio" name="quiz_control" value="<?php echo $_smarty_tpl->tpl_vars['one_quiz_data']->value[3];?>
"> </td>
                               <td width='15%' align='left'><?php echo $_smarty_tpl->tpl_vars['one_quiz_data']->value[0];?>
 </td>
                                <td width='40%' >    <?php echo $_smarty_tpl->tpl_vars['one_quiz_data']->value[1][1];?>
 
                                    <?php echo $_smarty_tpl->tpl_vars['one_quiz_data']->value[1][2];?>
 
                                    <?php echo $_smarty_tpl->tpl_vars['one_quiz_data']->value[1][3];?>
</td>
                                <td   width='40%'><?php echo $_smarty_tpl->tpl_vars['one_quiz_data']->value[2];?>
</td>
                                        </tr>
                                    <?php } ?>
                                    </table>
                              </form>
                            </td>
                        </tr>
                    </table>
                <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
                <?php $_smarty_tpl->_capture_stack[0][] = array('create_user', null, null); ob_start(); ?>
                    <table  width="100%"  bgcolor="#CDC8B1">
                        <tr align="center">
                            <td bgcolor="#8B8378">
                                <button form="create_user" type="submit" formaction="administration.php">Создать пользователя</button>
                            </td>
                            <td bgcolor="#8B8378">
                                <button form="create_user" type="reset" value="reset">Очистить поля</button>
                            </td>
                        </tr>
                    </table>
                    <table width="100%">                       
                        <tr>
                            <td width="100%" bgcolor="#CDC8B1">
                                <form id="create_user">
                                    <table width="60%" align="center">                                    
                                    <tr>
                                        <td bgcolor="#8DB6CD" align="right">Фамилия </td>
                                        <td><input type="text" name="last_name" required><td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#8DB6CD" align="right">Имя </td>
                                        <td><input type="text" name="first_name" required><td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#8DB6CD" align="right">Отчество </td>
                                        <td><input type="text" name="patronymic" required><td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#8DB6CD" align="right">Email</td>
                                        <td><input type="email" name="email"><td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#8DB6CD" align="right">Логин</td>
                                        <td><input type="text" name="login"><td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#8DB6CD" align="right">Пароль</td>
                                        <td><input type="text" name="password"><td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#8DB6CD" align="right" required>Роль пользователя</td>
                                        <td>
                                            <select name="role">
                                                <option selected value="1">Опрашиваемый</option>
                                                <option value="2">Составитель опросов</option>
                                                <option value="3">Администратор</option>                                               
                                            </select>    
                                        <td>
                                    </tr>
                                    </table>
                                </form>    
                            </td>
                        </tr>
                    </table>
                <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
                <?php $_smarty_tpl->_capture_stack[0][] = array('edit_quiz', null, null); ob_start(); ?>
                    <table  width="100%"  bgcolor="#CDC8B1">
                        <tr align="center">
                            <td bgcolor="#8B8378">
                                <a href='administration.php'>Удалить опрос(false)</a>
                            </td>
                             <td bgcolor="#8B8378">
                                <button form="delete_quiz" type="submit" formaction="administration.php" name="return_tables_quiz" value='ok'>Отменить</button>
                            </td>
                        </tr>
                    </table>
                    <table width="100%">
                        
                        <tr>
                            <td width="100%" bgcolor="#CDC8B1">
                               <form id="delete_quiz" method='post'>
                                   <table width="100%">
                                       <tr align='center' bgcolor='#838B8B'>
                                           <td width='20%'>
                                           Название теста    
                                           </td>
                                           <td wight='40%'>
                                               Автор теста
                                           </td>
                                           <td wight='40%'>
                                               Статус теста
                                           </td>
                                       </tr>
                                        <tr align='center'>
                                            <td>
                                                <?php echo $_smarty_tpl->tpl_vars['array_one_quiz']->value[0];?>

                                            </td>
                                            <td>
                                                <?php echo $_smarty_tpl->tpl_vars['array_one_quiz']->value[1][1];?>

                                                <?php echo $_smarty_tpl->tpl_vars['array_one_quiz']->value[1][2];?>

                                                <?php echo $_smarty_tpl->tpl_vars['array_one_quiz']->value[1][3];?>

                                            </td>
                                            <td>
                                                <?php echo $_smarty_tpl->tpl_vars['array_one_quiz']->value[2];?>

                                            </td>
                                        </tr>
                                    </table>
                              </form>
                            </td>
                        </tr>
                    </table> 
                <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
                <?php $_smarty_tpl->_capture_stack[0][] = array('create_user_info', null, null); ob_start(); ?>
                         <table width="100%">
                        
                        <tr>
                            <td width="100%" bgcolor="#CDC8B1">
                               <form id="delete_quiz" method='post'>
                                   <table width="100%">
                                        <h3 align='center'>Добавлен пользователь: <?php echo $_smarty_tpl->tpl_vars['create_user_fio']->value;?>
</h3>
                                    </table>
                              </form>
                            </td>
                        </tr>
                    </table>                
                <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
                <?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['view_admin']->value;?>
<?php $_tmp1=ob_get_clean();?><?php if ($_tmp1=='table_users') {?>
                   <?php echo Smarty::$_smarty_vars['capture']['table_users'];?>

                <?php } else {?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['view_admin']->value;?>
<?php $_tmp2=ob_get_clean();?><?php if ($_tmp2=='create_user') {?>
                    <?php echo Smarty::$_smarty_vars['capture']['create_user'];?>

                <?php } else {?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['view_admin']->value;?>
<?php $_tmp3=ob_get_clean();?><?php if ($_tmp3=='table_quiz') {?>
                    <?php echo Smarty::$_smarty_vars['capture']['table_quiz'];?>

                <?php } else {?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['view_admin']->value;?>
<?php $_tmp4=ob_get_clean();?><?php if ($_tmp4=='edit_quiz') {?>
                    <?php echo Smarty::$_smarty_vars['capture']['edit_quiz'];?>
    
                <?php } else {?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['view_admin']->value;?>
<?php $_tmp5=ob_get_clean();?><?php if ($_tmp5=='create_user_info') {?>
                    <?php echo Smarty::$_smarty_vars['capture']['create_user_info'];?>
    
                 <?php }}}}}?>   
                </td>
                    </tr> 
                </table>
                </td>  
            </tr>
        </table>
    </body>
</html>
<?php }} ?>
