<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-04-26 10:03:55
         compiled from "templates\authorization.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18476553c7fcb139e39-26408573%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0dc37aecc8b144235e2c0f56c4edbfd81d783e0e' => 
    array (
      0 => 'templates\\authorization.tpl',
      1 => 1429961618,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18476553c7fcb139e39-26408573',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
    'action' => 0,
    'error' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_553c7fcb3dca49_14614932',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_553c7fcb3dca49_14614932')) {function content_553c7fcb3dca49_14614932($_smarty_tpl) {?><!DOCTYPE html>
<html>
    <head>
        <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <form id="auth" action=<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
 method="post">
            <h2>Меню авторизации</h2>
            <table>
                <tr>         
               <td>Введите логин:</td>
               <td> <input type="text" name="login"></td></tr>
            <tr><td>Введите пароль:</td>
            <td><input type="password" name="pass"></td></tr>
            <tr><td> 
            <input type="submit" value="Войти">
            </td></tr>
            </table>
        
        </form>

            <p><font size="5" color="red" face="Arial"><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</font>
    </body>
</html>
<?php }} ?>
