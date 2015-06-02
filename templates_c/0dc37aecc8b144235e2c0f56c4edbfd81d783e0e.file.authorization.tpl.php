<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-30 01:24:34
         compiled from "templates\authorization.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18476553c7fcb139e39-26408573%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0dc37aecc8b144235e2c0f56c4edbfd81d783e0e' => 
    array (
      0 => 'templates\\authorization.tpl',
      1 => 1432934672,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18476553c7fcb139e39-26408573',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_553c7fcb3dca49_14614932',
  'variables' => 
  array (
    'title' => 0,
    'error' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_553c7fcb3dca49_14614932')) {function content_553c7fcb3dca49_14614932($_smarty_tpl) {?><!DOCTYPE html>
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
