<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-13 00:22:19
         compiled from "templates\administration.tpl" */ ?>
<?php /*%%SmartyHeaderCode:26616553c7fe07cf333-56964283%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0f4bb3d4e4d8e4cb0b378da26ca9015b44dffe24' => 
    array (
      0 => 'templates\\administration.tpl',
      1 => 1431462136,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '26616553c7fe07cf333-56964283',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_553c7fe1418130_17536914',
  'variables' => 
  array (
    'title' => 0,
    'users_data' => 0,
    'one_user_data' => 0,
    'quizs_data' => 0,
    'one_quiz_data' => 0,
    'id_edit_user' => 0,
    'array' => 0,
    'other_data_user' => 0,
    'other_data_user_test' => 0,
    'other_data_user_testing' => 0,
    'view_admin' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_553c7fe1418130_17536914')) {function content_553c7fe1418130_17536914($_smarty_tpl) {?><html>
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
            function setNewPassword(value){
                switch(value){
                    case "Yes":
                        $(".enter_new_password").show();
                        $("#set_new_password").val("");
                        break;
                    case "No":
                        $(".enter_new_password").hide();
                        $("#set_new_password").val("***");
                        break;
                }
            }
            function otherInformation(value){
                switch(value){
                    case "show":
                        $("#show_other_information_user").hide();
                        $("#hide_other_information_user").show();
                        $(".other_information_user").show();                        
                        break;
                    case "hide":
                        $("#show_other_information_user").show();
                        $("#hide_other_information_user").hide();
                        $(".other_information_user").hide();
                        break;
                }
            }
            function checkEmailUser(value){
                $.post("checkForms.php", { action: "check", field: "email user", name: value }, function( data ) {
                    console.log(data);
                if(data=='true'){
                    $("#yes_email").show();
                    $(".unsuitable").show();
                    $("#no_email").hide();
                }
                else{
                    $("#yes_email").hide();
                    $(".unsuitable").hide();
                    $("#no_email").show();
                }
              });
            }
            function checkLoginUser(value){
                $.post("checkForms.php", { action: "check", field: "login user", name: value }, function( data ) {
                    console.log(data);
                if(data=='true'){
                    $("#yes_login").show();
                    $(".unsuitable").show();
                    $("#no_login").hide();
                }
                else{
                    $("#yes_login").hide();
                    $(".unsuitable").hide();
                    $("#no_login").show();
                }
              });
            }
        <?php echo '</script'; ?>
> 
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
                <td width="20%" valign="top">
                    <?php echo $_smarty_tpl->getSubTemplate ('menu.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

                </td>           
                <td width="80%">
                <form id="go" method="post">
                        </form>
                    <?php $_smarty_tpl->_capture_stack[0][] = array('table_users', null, null); ob_start(); ?>
                        <a href="administration.php?link_click=new_user&&type_user=internal_user">Создать внутреннего пользователя</a>
                        <table width="80%" align="center">
                            <tr>
                                <td>
                                    Фамилия пользователя
                                </td>
                                <td>
                                    Имя пользователя
                                </td>
                                <td>
                                    Тип пользователя
                                </td>
                                <td>
                                    Статус пользователя
                                </td>
                                <td>
                                    
                                </td>
                            </tr>
                            <?php  $_smarty_tpl->tpl_vars['one_user_data'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['one_user_data']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['users_data']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['one_user_data']->key => $_smarty_tpl->tpl_vars['one_user_data']->value) {
$_smarty_tpl->tpl_vars['one_user_data']->_loop = true;
?>                                          
                                <tr>
                                    <td>
                                        <?php echo $_smarty_tpl->tpl_vars['one_user_data']->value->getLastName();?>

                                    </td>
                                    <td>
                                        <?php echo $_smarty_tpl->tpl_vars['one_user_data']->value->getFirstName();?>

                                    </td>
                                    <td>
                                        <?php if ($_smarty_tpl->tpl_vars['one_user_data']->value->getLdapUser()==0) {?>
                                            Внутренний пользователь
                                        <?php } elseif ($_smarty_tpl->tpl_vars['one_user_data']->value->getLdapUser()==1) {?>
                                            Пользователь LDAP
                                        <?php }?>
                                    </td>
                                    <td>
                                        <?php if ($_smarty_tpl->tpl_vars['one_user_data']->value->getUserVasibility()==1) {?>
                                            Активный
                                        <?php } else { ?>
                                            Неактивный
                                        <?php }?>    
                                    </td>
                                    <td>
                                        <?php if ($_smarty_tpl->tpl_vars['one_user_data']->value->getLdapUser()==0) {?>
                                            <a href="administration.php?link_click=edit_user&&id_user=<?php echo $_smarty_tpl->tpl_vars['one_user_data']->value->getIdUser();?>
">Изменить пользователя</a>
                                        <?php }?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>
                    <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
                    <?php $_smarty_tpl->_capture_stack[0][] = array('table_quizs', null, null); ob_start(); ?>
                        <form method="POST">
                        <table width="100%">
                            <tr>
                                <td>
                                    Тема теста
                                </td>
                                <td>
                                    Состояние теста
                                </td>
                                <td>
                                    Автор теста
                                </td>
                                <td>
                                    Статус теста
                                </td>
                            </tr>
                            <?php  $_smarty_tpl->tpl_vars['one_quiz_data'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['one_quiz_data']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['quizs_data']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['one_quiz_data']->key => $_smarty_tpl->tpl_vars['one_quiz_data']->value) {
$_smarty_tpl->tpl_vars['one_quiz_data']->_loop = true;
?>                                          
                                <tr>
                                    <td>
                                        <?php echo $_smarty_tpl->tpl_vars['one_quiz_data']->value->getTopic();?>

                                    </td>
                                    <td>
                                        <?php if ($_smarty_tpl->tpl_vars['one_quiz_data']->value->getIdStatusQuiz()==1) {?>
                                            Редактируемый
                                        <?php } elseif ($_smarty_tpl->tpl_vars['one_quiz_data']->value->getIdStatusQuiz()==2) {?>
                                            Готов к опубликованию
                                        <?php } elseif ($_smarty_tpl->tpl_vars['one_quiz_data']->value->getIdStatusQuiz()==3) {?>
                                            Активный
                                        <?php } elseif ($_smarty_tpl->tpl_vars['one_quiz_data']->value->getIdStatusQuiz()==4) {?>
                                            Завершённый
                                        <?php }?>
                                    </td>
                                    <td>
                                        <?php echo $_smarty_tpl->tpl_vars['one_quiz_data']->value->getAuthorTest()->getLastName();?>
 
                                        <?php echo $_smarty_tpl->tpl_vars['one_quiz_data']->value->getAuthorTest()->getFirstName();?>

                                    </td>                                    
                                    <td>
                                        <?php if ($_smarty_tpl->tpl_vars['one_quiz_data']->value->getVasibilityTest()==1) {?>
                                            Тест доступен 
                                        <?php } else { ?>
                                            Тест заблокирован
                                        <?php }?>   
                                    </td>
                                    <td>
                                            <?php if ($_smarty_tpl->tpl_vars['one_quiz_data']->value->getVasibilityTest()==1) {?>
                                                <button type="submit" formaction="administration.php?link_click=show_quiz" name="deactivate_quiz" value="<?php echo $_smarty_tpl->tpl_vars['one_quiz_data']->value->getIdQuiz();?>
">Заблокировать тест</button>
                                            <?php } else { ?>
                                                <button type="submit" formaction="administration.php?link_click=show_quiz" name="activate_quiz" value="<?php echo $_smarty_tpl->tpl_vars['one_quiz_data']->value->getIdQuiz();?>
">Активировать тест</button>
                                            <?php }?>      
                                    </td>
                                </tr>
                            <?php } ?>
                        </table> 
                        </form>   
                    <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
                    <?php $_smarty_tpl->_capture_stack[0][] = array('new_internal_user', null, null); ob_start(); ?>
                        
                            <form action="administration.php" method="POST">
                                <input type="hidden" name="button_click" value="create_internal_user">
                                <table align="center">
                                    <tr>
                                        <td bgcolor="#8DB6CD" align="right">Фамилия </td>
                                        <td><input type="text" name="last_name" required><td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#8DB6CD" align="right">Имя </td>
                                        <td><input type="text" name="first_name" required><td>
                                    </tr>                                
                                    <tr>
                                        <td bgcolor="#8DB6CD" align="right">Email</td>
                                        <td><input type="email" name="email" onblur="checkEmailUser(this.value)">
                                            <span id="no_email" style="display: none; color: red">Такое название уже есть</span>
                                            <span id="yes_email" style="display: none; color: green">Ок</span>
                                        <td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#8DB6CD" align="right">Логин</td>
                                        <td><input type="text" name="login"  onblur="checkLoginUser(this.value)">
                                            <span  id="no_login" style="display: none; color: red">Такое название уже есть</span>
                                            <span id="yes_login" style="display: none; color: green">Ок</span>
                                        <td>    
                                    </tr>
                                    <tr>
                                        <td bgcolor="#8DB6CD" align="right">Пароль</td>
                                        <td><input type="text" name="password"><td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#8DB6CD" align="right" required>Роль пользователя</td>
                                        <td>
                                            <input type="checkbox" name="role_admin" value="1" checked>Опрашиваемый <br>
                                            <input type="checkbox" name="role_author" value="2">Составитель опросов <br>
                                            <input type="checkbox" name="role_interviewees" value="3">Администратор
                                        <td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <span class="unsuitable">
                                            <input type="submit" value="Создать пользователя">
                                            </span>
                                       </td>
                                    </tr>
                                </table>
                            </form>
                            
                    <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
                    <?php $_smarty_tpl->_capture_stack[0][] = array('new_ldap_user', null, null); ob_start(); ?>
                        Пользователь LDAP
                    <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
                    <?php $_smarty_tpl->_capture_stack[0][] = array('edit_user', null, null); ob_start(); ?>
                        <?php  $_smarty_tpl->tpl_vars['one_user_data'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['one_user_data']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['users_data']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['one_user_data']->key => $_smarty_tpl->tpl_vars['one_user_data']->value) {
$_smarty_tpl->tpl_vars['one_user_data']->_loop = true;
?>
                            <?php if ($_smarty_tpl->tpl_vars['one_user_data']->value->getIdUser()==$_smarty_tpl->tpl_vars['id_edit_user']->value) {?>
                                <form action="administration.php" method="POST">
                                    <input type="hidden" name="button_click" value="edit_user">
                                    <input type="hidden" name="id_user" value="<?php echo $_smarty_tpl->tpl_vars['id_edit_user']->value;?>
">
                                    <table align="center">
                                        <tr>
                                            <td colspan="2" align="center">
                                                <?php if ($_smarty_tpl->tpl_vars['one_user_data']->value->getUserVasibility()==1) {?>                                                    
                                                    <p><font size="4" color="blue" face="Arial">Активный пользователь</font>   
                                                <?php } else { ?>
                                                    <p><font size="4" color="red" face="Arial">Неактивный пользователь</font>                                                    
                                                <?php }?> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#8DB6CD" align="right">Фамилия </td>
                                            <td><input type="text" name="last_name"  value="<?php echo $_smarty_tpl->tpl_vars['one_user_data']->value->getLastName();?>
" required><td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#8DB6CD" align="right">Имя </td>
                                            <td><input type="text" name="first_name" value="<?php echo $_smarty_tpl->tpl_vars['one_user_data']->value->getFirstName();?>
" required><td>
                                        </tr>                                
                                        <tr>
                                            <td bgcolor="#8DB6CD" align="right">Email</td>
                                            <td><input type="email" name="email" value="<?php echo $_smarty_tpl->tpl_vars['one_user_data']->value->getEmail();?>
" required><td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#8DB6CD" align="right">Логин</td>
                                            <td><input type="text" name="login" value="<?php echo $_smarty_tpl->tpl_vars['one_user_data']->value->getLogin();?>
"  required><td>
                                        </tr>                                
                                        <tr>
                                            <td bgcolor="#8DB6CD" align="right">Роль пользователя</td>
                                            <td>
                                                <?php $_smarty_tpl->tpl_vars['array'] = new Smarty_variable($_smarty_tpl->tpl_vars['one_user_data']->value->getRoles(), null, 0);?>
                                                <?php if ($_smarty_tpl->tpl_vars['array']->value[0]==1) {?>
                                                    <input type="checkbox" name="role_admin" value="1" checked>Опрашиваемый <br>
                                                <?php } else { ?>
                                                    <input type="checkbox" name="role_admin" value="1">Опрашиваемый <br>
                                                <?php }?>   
                                                <?php if ($_smarty_tpl->tpl_vars['array']->value[1]==2) {?>
                                                    <input type="checkbox" name="role_author" value="2" checked>Составитель опросов <br>
                                                <?php } else { ?>
                                                    <input type="checkbox" name="role_author" value="2">Составитель опросов <br>
                                                <?php }?> 
                                                <?php if ($_smarty_tpl->tpl_vars['array']->value[2]==3) {?>
                                                    <input type="checkbox" name="role_interviewees" value="3" checked>Администратор
                                                <?php } else { ?>
                                                    <input type="checkbox" name="role_interviewees" value="3">Администратор
                                                <?php }?>    
                                            <td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#8DB6CD" align="right">Изменить пароль</td>
                                            <td>
                                                <input type="radio" name="reset_password" value="Yes" onchange = 'setNewPassword((this.getAttribute("value")))'>да</br>
                                                <input type="radio" name="reset_password" value="No" onchange = 'setNewPassword((this.getAttribute("value")))' checked>нет</br>
                                                <div class="enter_new_password" style="display: none">
                                                    Установить пароль: <br><input type="text" name="set_new_password" id="set_new_password" value="***" required>
                                                 </div>
                                            </td>
                                        </tr> 
                                        <tr>
                                            <td>
                                                <button type="submit" formaction="administration.php" name="update_user" value=<?php echo $_smarty_tpl->tpl_vars['id_edit_user']->value;?>
>Изменить пользователя</button>
                                           </td>
                                           <td>
                                               <button type="submit" formaction="administration.php" name="delete_user" value="<?php echo $_smarty_tpl->tpl_vars['id_edit_user']->value;?>
" title='При удалении пользователя, также удалиться вся зависимая информация представленная внизу в Дополнительной информации'>Удалить пользователя</button>
                                               
                                           </td>    
                                        </tr>
                                        <tr>
                                            <td>
                                                <?php if ($_smarty_tpl->tpl_vars['one_user_data']->value->getUserVasibility()==1) {?>
                                                     <button type="submit" formaction="administration.php?link_click=edit_user&&id_user=<?php echo $_smarty_tpl->tpl_vars['id_edit_user']->value;?>
" name="deactivate_user" value="<?php echo $_smarty_tpl->tpl_vars['id_edit_user']->value;?>
">Заблокировать пользователя</button>
                                                <?php } else { ?>
                                                     <button type="submit" formaction="administration.php?link_click=edit_user&&id_user=<?php echo $_smarty_tpl->tpl_vars['id_edit_user']->value;?>
" name="activate_user" value="<?php echo $_smarty_tpl->tpl_vars['id_edit_user']->value;?>
">Активировать пользователя</button>
                                                <?php }?>                                                 
                                            </td>
                                                <td>
                                                    <div id="show_other_information_user">
                                                        <input type="button" name="other_information" value="Показать дополнительную информацию" onclick = 'otherInformation("show");'>                                                         
                                                   </div>
                                                   <div id="hide_other_information_user" style="display: none">
                                                        <input type="button" name="other_information" value="Скрыть дополнительную информацию" onclick = 'otherInformation("hide");'>   
                                                   </div>
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                                        
                                            <div class="other_information_user" style="display: none">
                                                <h2>Дополнительная информация </h2>
                                                <p>Созданные тесты </p>
                                                <?php if ($_smarty_tpl->tpl_vars['other_data_user']->value['test'][0]!=false) {?>
                                                    <table>
                                                        <tr>
                                                            <td>
                                                                Тема теста
                                                            </td>    
                                                            <td>
                                                                Статус теста
                                                            </td>    
                                                        </tr>    
                                                        <?php  $_smarty_tpl->tpl_vars['other_data_user_test'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['other_data_user_test']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['other_data_user']->value['test']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['other_data_user_test']->key => $_smarty_tpl->tpl_vars['other_data_user_test']->value) {
$_smarty_tpl->tpl_vars['other_data_user_test']->_loop = true;
?>
                                                            <tr>
                                                                <td>
                                                                    <?php echo $_smarty_tpl->tpl_vars['other_data_user_test']->value->topic;?>

                                                                </td>    
                                                                <td>
                                                                    <?php echo $_smarty_tpl->tpl_vars['other_data_user_test']->value->description_status_test;?>

                                                                </td>    
                                                            </tr> 
                                                         <?php } ?> 
                                                    </table>     
                                                    <?php } else { ?> Пользователь не составлял тесты
                                                <?php }?>   
                                                <p>Активированные тесты </p>
                                                <?php if ($_smarty_tpl->tpl_vars['other_data_user']->value['testing'][0]!=false) {?>
                                                        <table>
                                                        <tr>
                                                            <td>
                                                                Тема опроса
                                                            </td>    
                                                            <td>
                                                                Статус опроса
                                                            </td>    
                                                        </tr>    
                                                        <?php  $_smarty_tpl->tpl_vars['other_data_user_testing'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['other_data_user_testing']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['other_data_user']->value['testing']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['other_data_user_testing']->key => $_smarty_tpl->tpl_vars['other_data_user_testing']->value) {
$_smarty_tpl->tpl_vars['other_data_user_testing']->_loop = true;
?>
                                                            <tr>
                                                                <td>
                                                                    <?php echo $_smarty_tpl->tpl_vars['other_data_user_testing']->value->topic;?>

                                                                </td>    
                                                                <td>
                                                                    <?php echo $_smarty_tpl->tpl_vars['other_data_user_testing']->value->description_mark_test;?>

                                                                </td>    
                                                            </tr> 
                                                         <?php } ?> 
                                                    </table>
                                                    <?php } else { ?> Пользователь не активировал тесты
                                                <?php }?> 
                                            </div>    
                                 
                            <?php }?>
                        <?php } ?>
                        
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
<?php $_tmp2=ob_get_clean();?><?php if ($_tmp2=='table_quizs') {?>
                    <?php echo Smarty::$_smarty_vars['capture']['table_quizs'];?>

                <?php } else {?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['view_admin']->value;?>
<?php $_tmp3=ob_get_clean();?><?php if ($_tmp3=='edit_user') {?>
                    <?php echo Smarty::$_smarty_vars['capture']['edit_user'];?>

                <?php } else {?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['view_admin']->value;?>
<?php $_tmp4=ob_get_clean();?><?php if ($_tmp4=='new_internal_user') {?>
                    <?php echo Smarty::$_smarty_vars['capture']['new_internal_user'];?>

                <?php } else {?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['view_admin']->value;?>
<?php $_tmp5=ob_get_clean();?><?php if ($_tmp5=='new_ldap_user') {?>
                    <?php echo Smarty::$_smarty_vars['capture']['new_ldap_user'];?>

                 <?php }}}}}?>   
                </td>
                    </tr> 
                </table>
                </td>  
            </tr>            
        </table>
        <?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    </body>
</html>
<?php }} ?>
