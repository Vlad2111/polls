<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-07 14:47:49
         compiled from ".\templates\authorization.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1371554d5ed552ecfd2-78687249%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9e64ac256b724b14edad57cfbe7231e46e40e4e7' => 
    array (
      0 => '.\\templates\\authorization.tpl',
      1 => 1423305243,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1371554d5ed552ecfd2-78687249',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
    'action' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54d5ed55349299_16783560',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d5ed55349299_16783560')) {function content_54d5ed55349299_16783560($_smarty_tpl) {?><!DOCTYPE html>
<html>
    <head>
        <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <form action=<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
 method="post">
            <h2>Меню авторизации</h2>
            <table>
                <tr>         
               <td>Введите логин:</td>
               <td> <input type="text" name="login"></td></tr>
            <tr><td>Введите пароль:</td>
            <td><input type="password" name="pass"></td></tr>
            <tr><td></td><td><input type="submit" value="отправить"></td></tr>
            </table>
        </form>
    </body>
</html>
<?php }} ?>
