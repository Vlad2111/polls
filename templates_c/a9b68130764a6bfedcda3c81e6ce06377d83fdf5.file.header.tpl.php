<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-03-12 02:23:17
         compiled from "./templates/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:165004468654ff711cce0bc3-12120489%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a9b68130764a6bfedcda3c81e6ce06377d83fdf5' => 
    array (
      0 => './templates/header.tpl',
      1 => 1426116193,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '165004468654ff711cce0bc3-12120489',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54ff711cce3df2_25896611',
  'variables' => 
  array (
    'name_page' => 0,
    'role_user' => 0,
    'you' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54ff711cce3df2_25896611')) {function content_54ff711cce3df2_25896611($_smarty_tpl) {?><table width="100%"  bgcolor="#708090" >
                        <tr >
                            <td width="70%" height="70" align="center">
                                <h2>Автоматическая система тестирования</h2>
                            </td>
                            <td width="10%" height="70">
                                <table>
                                        <?php if ($_smarty_tpl->tpl_vars['name_page']->value!='quiz') {?>
                                        <tr>
                                            <td>
                                                <a href='quiz.php'>Стать тестируемым</a>
                                            </td>
                                        </tr>
                                        <?php }?>
                                        <?php if ($_smarty_tpl->tpl_vars['role_user']->value>=2) {?>
                                            <?php if ($_smarty_tpl->tpl_vars['name_page']->value!='create_test') {?>
                                            <tr>
                                                <td>
                                                    <a href='create.php'>Стать автором тестов</a>
                                                </td>
                                            </tr>
                                            <?php }?>
                                            <?php if ($_smarty_tpl->tpl_vars['role_user']->value==3) {?>
                                                <?php if ($_smarty_tpl->tpl_vars['name_page']->value!='administration') {?>
                                                <tr>
                                                    <td>
                                                        <a href='administration.php'>Стать администратором</a>
                                                    </td>
                                                </tr>
                                                <?php }?>
                                            <?php }?>    
                                        <?php }?>
                                </table>
                            </td>
                            <td width="15%" height="70">
                                <?php echo $_smarty_tpl->tpl_vars['you']->value;?>

                            </td>
                            <td width="5%" height="70">
                                <a href='<?php echo $_smarty_tpl->tpl_vars['name_page']->value;?>
.php?link_click=exit'>Выход</a>
                            </td>
                        </tr>
                    </table>                           
        <?php }} ?>
