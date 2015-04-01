<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-04-01 14:06:23
         compiled from "templates\authorization.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6294550952f8757795-76089082%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0dc37aecc8b144235e2c0f56c4edbfd81d783e0e' => 
    array (
      0 => 'templates\\authorization.tpl',
      1 => 1427882780,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6294550952f8757795-76089082',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_550952f8a18242_84328394',
  'variables' => 
  array (
    'title' => 0,
    'action' => 0,
    'user_login' => 0,
    'error' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_550952f8a18242_84328394')) {function content_550952f8a18242_84328394($_smarty_tpl) {?><!DOCTYPE html>
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
            <button form="auth" type="submit" formaction="authorization.php" name="button_click" value='LDAP'>Войти как пользватель LDAP</button>
            </td><td>
            <button form="auth" type="submit" formaction="authorization.php" name="button_click" value='DB'>Войти как внутренний пользватель</button>
            </td></tr>
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
