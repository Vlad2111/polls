<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-04-29 00:24:38
         compiled from ".\templates\header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10378553c7fcf41a853-51317654%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1f93ed950ee79f1e3b3c635831aea1c5483415b4' => 
    array (
      0 => '.\\templates\\header.tpl',
      1 => 1430252676,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10378553c7fcf41a853-51317654',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_553c7fcf47d552_18366370',
  'variables' => 
  array (
    'you' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_553c7fcf47d552_18366370')) {function content_553c7fcf47d552_18366370($_smarty_tpl) {?><table width="100%"  bgcolor="#708090" >
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
