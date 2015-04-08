<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-04-02 09:48:48
         compiled from ".\templates\header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15765551cd840b4f6f7-92495623%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1f93ed950ee79f1e3b3c635831aea1c5483415b4' => 
    array (
      0 => '.\\templates\\header.tpl',
      1 => 1427151694,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15765551cd840b4f6f7-92495623',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'name_page' => 0,
    'role_user' => 0,
    'you' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_551cd840edcef3_16183878',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_551cd840edcef3_16183878')) {function content_551cd840edcef3_16183878($_smarty_tpl) {?><table width="100%"  bgcolor="#708090" >
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
                                <a href='authorization.php?link_click=exit'>Выход</a>
                            </td>
                        </tr>
                    </table>                           
        <?php }} ?>
