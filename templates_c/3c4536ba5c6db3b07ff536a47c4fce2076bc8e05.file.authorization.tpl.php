<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-06-29 15:36:43
         compiled from "templates/authorization.tpl" */ ?>
<?php /*%%SmartyHeaderCode:125719521055913bdb10f5f0-39913130%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3c4536ba5c6db3b07ff536a47c4fce2076bc8e05' => 
    array (
      0 => 'templates/authorization.tpl',
      1 => 1435580356,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '125719521055913bdb10f5f0-39913130',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
    'error' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55913bdb183cc4_22912660',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55913bdb183cc4_22912660')) {function content_55913bdb183cc4_22912660($_smarty_tpl) {?><!DOCTYPE html>
<html>
    <head>
        <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <?php echo '<script'; ?>
 src="js/bootstrap.min.js"><?php echo '</script'; ?>
>
        <link href="css/signin.css" rel="stylesheet">
    </head>
    <body>        
        <div class="container">
        <form class="form-signin" role="form" id="auth" method="post">
          <h2 class="form-signin-heading">Авторизируйтесь</h2>
          <input type="text" name="login" class="form-control" placeholder="Введите логин" required autofocus>
          <input type="password" name="pass" class="form-control" placeholder="Введите пароль" required>
          <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
        </form>
            <?php if ($_smarty_tpl->tpl_vars['error']->value!='') {?>
                <div class="alert alert-danger">
                    <p><font size="5" face="Arial"><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</font>
                </div>
            <?php }?>
      </div>
        
            
    </body>
</html>
<?php }} ?>
