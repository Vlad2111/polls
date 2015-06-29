<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-06-29 15:52:19
         compiled from "templates/main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:123517386055913f830adaf5-46085088%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '81d3f68c4cc398aac1402b7f95093f5d55a0b9d1' => 
    array (
      0 => 'templates/main.tpl',
      1 => 1435580356,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '123517386055913f830adaf5-46085088',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
    'data_quiz' => 0,
    'data_one_quiz' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55913f8314b789_63932416',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55913f8314b789_63932416')) {function content_55913f8314b789_63932416($_smarty_tpl) {?><html>
    <head>
        <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
        <meta charset="UTF-8">
        <?php echo '<script'; ?>
 type="text/javascript" src="https://www.google.com/jsapi"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="js/jquery-2.1.3.min.js"><?php echo '</script'; ?>
>
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
        <div class="wrapper">
            <div class="content">
<form id="go" method="post">
                        </form>
        <table width="100%">
            <tr>
                <td  width="100%">
                    <?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

                </td>
            </tr>
            <tr>
                <td>
                <table width="100%" >
                    <tr>                        
                        <td width="30%" valign="top">
                            <?php echo $_smarty_tpl->getSubTemplate ('menu.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

                        </td>
                        <td width="70%">
                            <table>
                                <tr>
                                    <td>
                                        Тема теста
                                    </td>
                                    <td>
                                        Статус теста
                                    </td>                                    
                                </tr>
                                <?php  $_smarty_tpl->tpl_vars['data_one_quiz'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['data_one_quiz']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data_quiz']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['data_one_quiz']->key => $_smarty_tpl->tpl_vars['data_one_quiz']->value) {
$_smarty_tpl->tpl_vars['data_one_quiz']->_loop = true;
?>
                                    <tr>
                                        <td>
                                            <?php echo $_smarty_tpl->tpl_vars['data_one_quiz']->value['quiz']->topic;?>

                                        </td>   
                                        <td>
                                            <table>
                                                <tr>
                                                        <?php if ($_smarty_tpl->tpl_vars['data_one_quiz']->value['testing']) {?>
                                                            <?php if ($_smarty_tpl->tpl_vars['data_one_quiz']->value['testing']->getMarkTest()==1) {?>
                                                                <td>
                                                                    Доступен
                                                                </td>
                                                                <td>
                                                                    <a href="quiz.php?status=available&testing=<?php echo $_smarty_tpl->tpl_vars['data_one_quiz']->value['testing']->getIdTesting();?>
">Пройти тест</a>
                                                                </td>
                                                            <?php } elseif ($_smarty_tpl->tpl_vars['data_one_quiz']->value['testing']->getMarkTest()==2) {?>
                                                                 <td>
                                                                    Неоконченный
                                                                </td>
                                                                <td>
                                                                    <a href="quiz.php?status=unfinished&testing=<?php echo $_smarty_tpl->tpl_vars['data_one_quiz']->value['testing']->getIdTesting();?>
">Продолжить тест</a>
                                                                </td>
                                                            <?php } elseif ($_smarty_tpl->tpl_vars['data_one_quiz']->value['testing']->getMarkTest()==3) {?>
                                                                <td>
                                                                    Не доступный
                                                                </td>
                                                                <td>
                                                                    No
                                                                </td>
                                                            <?php } elseif ($_smarty_tpl->tpl_vars['data_one_quiz']->value['testing']->getMarkTest()==4) {?>
                                                                <td>
                                                                    Законченный
                                                                </td>
                                                                <td>
                                                                    No
                                                                </td>
                                                            <?php }?>
                                                        <?php } else { ?>
                                                                <td>
                                                                    Вы еще не открывали этот тест
                                                                </td>
                                                                <td>                                                                
                                                                   <a href="quiz.php?status=new_test&testing=<?php echo $_smarty_tpl->tpl_vars['data_one_quiz']->value['quiz']->id_test;?>
">Начать тест</a>
                                                                </td>
                                                        <?php }?>   
                                                </tr>
                                            </table>
                                        </td> 
                                    </tr>
                                <?php } ?>
                            </table>
                        </td>
                    </tr>
                </table>
                </td>
            </tr>
        </table>
        </div>
        <?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

        </div>                 
    </body>
</html>
<?php }} ?>
