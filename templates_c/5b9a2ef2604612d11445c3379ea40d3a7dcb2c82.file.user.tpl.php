<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-09 18:01:39
         compiled from "template_smarty\templates\user.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2966454d8bb828663d7-49911574%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5b9a2ef2604612d11445c3379ea40d3a7dcb2c82' => 
    array (
      0 => 'template_smarty\\templates\\user.tpl',
      1 => 1423490497,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2966454d8bb828663d7-49911574',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54d8bb82936ff6_85759645',
  'variables' => 
  array (
    'title' => 0,
    'user_login' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d8bb82936ff6_85759645')) {function content_54d8bb82936ff6_85759645($_smarty_tpl) {?><!DOCTYPE html>
<html>
    <head>
        <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <?php if (isset($_smarty_tpl->tpl_vars['user_login']->value)) {?>
            <h3>Вы зашли под именем <?php echo $_smarty_tpl->tpl_vars['user_login']->value;?>
</h3>
        <?php } else { ?><h3>Пользователь с такими данными не найден</h3>
        <?php }?>

    </body>
</html>
<?php }} ?>
