<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-06-29 15:52:19
         compiled from "./templates/menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:152171651255913f8315a280-89293602%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'de60109f0e0946a6ce33fcbb25ef0ac8f1b3f33f' => 
    array (
      0 => './templates/menu.tpl',
      1 => 1435580356,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '152171651255913f8315a280-89293602',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data_role' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55913f83178d89_24249061',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55913f83178d89_24249061')) {function content_55913f83178d89_24249061($_smarty_tpl) {?>  
    <?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['data_role']->value[2];?>
<?php $_tmp1=ob_get_clean();?><?php if ($_tmp1==3) {?>
            <table>
                <tr bgcolor="#4682B4" valign="top">
                    <td width="50%" height="10%" align="left" bgcolor="#6CA6CD">
                        Меню администратора
                    </td>                
                </tr>
                <tr  valign="top">
                    <td width="50%" height="10%" align="right" bgcolor="#87CEFA">
                        <a href="administration.php?link_click=show_quiz">Опросы</a>
                    </td>                
                </tr>
                <tr bgcolor="#87CEFA" valign="top">
                    <td width="50%" height="10%" align="right" bgcolor="#87CEFA">
                        <a href="administration.php?link_click=show_users">Пользователи</a>
                    </td>                
                </tr>
            </table> 
            <?php }?>
    <?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['data_role']->value[1];?>
<?php $_tmp2=ob_get_clean();?><?php if ($_tmp2==2) {?>
        <table>
            <tr bgcolor="#4682B4" valign="top">
                <td width="50%" height="10%" align="left" bgcolor="#6CA6CD">
                    Меню автора теста
                </td>                
            </tr>
            <tr  valign="top">
                <td width="50%" height="10%" align="right" bgcolor="#87CEFA">
                    <a href="author_quiz.php">Мои опросы</a>
                </td>                
            </tr>
            <tr bgcolor="#87CEFA" valign="top">
                <td width="50%" height="10%" align="right" bgcolor="#87CEFA">
                    <a href="create_quiz.php?link_click=new_quiz">Создать опрос</a>
                </td>                
            </tr>
        </table>
        <?php }?>
    <?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['data_role']->value[0];?>
<?php $_tmp3=ob_get_clean();?><?php if ($_tmp3==1) {?>
        <table>
            <tr bgcolor="#4682B4" valign="top">
                <td width="50%" height="10%" align="left" bgcolor="#6CA6CD">
                    Меню тестируемого
                </td>                
            </tr>
            <tr  valign="top">
                <td width="50%" height="10%" align="right" bgcolor="#87CEFA">
                    <a href="main.php">Список тестов</a>
                </td>                
            </tr>            
        </table>
     <?php }?><?php }} ?>
