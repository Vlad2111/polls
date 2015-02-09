<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-07 14:46:48
         compiled from "authorization.php" */ ?>
<?php /*%%SmartyHeaderCode:1445454d5ed186ff8f7-82189357%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ac3685c357fcdf1d6ead54426be0d0e99c726852' => 
    array (
      0 => 'authorization.php',
      1 => 1423306005,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1445454d5ed186ff8f7-82189357',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54d5ed1874b849_97680290',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d5ed1874b849_97680290')) {function content_54d5ed1874b849_97680290($_smarty_tpl) {?><?php echo '<?php'; ?>

include_once 'smarty_lib/Smarty.class.php';
$title="Авторизация";
$action="user.php";
$smarty= new Smarty();
$smarty->assign('title', $title);
$smarty->assign('action', $action);
$smarty->display('authorization.php');

<?php echo '?>'; ?>

<?php }} ?>
