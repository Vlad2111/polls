<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-16 14:09:38
         compiled from "template_smarty\templates\menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:253754e1c1e235d434-76387227%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f4e5bd61626c8e42645b58fb9e8ed48bc593bb61' => 
    array (
      0 => 'template_smarty\\templates\\menu.tpl',
      1 => 1424081213,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '253754e1c1e235d434-76387227',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
    'href1' => 0,
    'value1' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54e1c1e23d51b8_02027043',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54e1c1e23d51b8_02027043')) {function content_54e1c1e23d51b8_02027043($_smarty_tpl) {?><!DOCTYPE html>
<html>
    <head>
        <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <table>
            <tr>
                <td>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['href1']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['value1']->value;?>
</a>
                </td>
            </tr>
        </table>
        </body>    
</html>
<?php }} ?>
