<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-06-29 15:52:19
         compiled from "./templates/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:212629281755913f831508a0-57917786%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9c1d4c18fe1d747089ab352c955a7e31f6c2c75f' => 
    array (
      0 => './templates/header.tpl',
      1 => 1435580356,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '212629281755913f831508a0-57917786',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'you' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55913f83156a46_16875741',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55913f83156a46_16875741')) {function content_55913f83156a46_16875741($_smarty_tpl) {?><table width="100%"  bgcolor="#708090" >
                        <tr >
                            <td width="70%" height="70" align="center">
                                <h2>Автоматическая система тестирования</h2>
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
