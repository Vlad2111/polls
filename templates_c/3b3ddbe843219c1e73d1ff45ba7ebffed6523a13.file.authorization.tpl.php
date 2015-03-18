<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-03-08 13:22:58
         compiled from "templates/authorization.tpl" */ ?>
<?php /*%%SmartyHeaderCode:53893501054fc230237ca03-83726966%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3b3ddbe843219c1e73d1ff45ba7ebffed6523a13' => 
    array (
      0 => 'templates/authorization.tpl',
      1 => 1424960373,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '53893501054fc230237ca03-83726966',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
    'action' => 0,
    'user_login' => 0,
    'error' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54fc23023ab558_83374577',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54fc23023ab558_83374577')) {function content_54fc23023ab558_83374577($_smarty_tpl) {?><!DOCTYPE html>
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

        <?php if (isset($_smarty_tpl->tpl_vars['user_login']->value)) {?>
            <h3>Вы зашли под именем <?php echo $_smarty_tpl->tpl_vars['user_login']->value;?>
</h3>
        <?php } else { ?><p><font size="5" color="red" face="Arial"><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</font>
        <?php }?>
    </body>
</html>
<?php }} ?>
