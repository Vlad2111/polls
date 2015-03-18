<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-03-18 12:02:16
         compiled from "templates/quiz.tpl" */ ?>
<?php /*%%SmartyHeaderCode:116368087354ff7d278d0479-75350064%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fcce0bdae3f9db301c4bb57def617401de3c1050' => 
    array (
      0 => 'templates/quiz.tpl',
      1 => 1426669333,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '116368087354ff7d278d0479-75350064',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54ff7d278e3517_76648129',
  'variables' => 
  array (
    'title' => 0,
    'data_quiz' => 0,
    'data_one_quiz' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54ff7d278e3517_76648129')) {function content_54ff7d278e3517_76648129($_smarty_tpl) {?><html>
    <head>
        <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
        <meta charset="UTF-8">
    </head>
    <body>
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
                            <table id='menu_quiz'>
                                <tr bgcolor="#F5F5F5" valign="top">
                                    <td width="50%" height="10%" align="left" bgcolor="#6CA6CD">
                                        <a>Пункт меню</a>
                                    </td>
                                </tr>   
                            </table>
                        </td>
                        <td width="70%">
                            <table align="left" width="100%" bgcolor="#CDC8B1">
                                <tr bgcolor="#8B8378">
                                    <td>
                                        Тема теста
                                    </td>
                                    <td>
                                        Статус теста
                                    </td>
                                    <td>
                                        Автор теста
                                    </td>
                                    <td>
                                        Ограничение времени
                                    </td>
                                </tr>
                                <?php  $_smarty_tpl->tpl_vars['data_one_quiz'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['data_one_quiz']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data_quiz']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['data_one_quiz']->key => $_smarty_tpl->tpl_vars['data_one_quiz']->value) {
$_smarty_tpl->tpl_vars['data_one_quiz']->_loop = true;
?>
                                    <tr>
                                        <td>
                                            <?php echo $_smarty_tpl->tpl_vars['data_one_quiz']->value['topic_test'];?>

                                        </td>
                                        <td>
                                            
                                            <?php if ($_smarty_tpl->tpl_vars['data_one_quiz']->value['mark_test']=='available') {?>
                                                Доступен
                                              <?php } elseif ($_smarty_tpl->tpl_vars['data_one_quiz']->value['mark_test']=='unfinished') {?>
                                                  Незаконченный
                                              <?php } else { ?>
                                                  Не доступен
                                            <?php }?>    
                                        </td>
                                        <td>
                                            <?php echo $_smarty_tpl->tpl_vars['data_one_quiz']->value['author_quiz'][1];?>
 <?php echo $_smarty_tpl->tpl_vars['data_one_quiz']->value['author_quiz'][2];?>
 <?php echo $_smarty_tpl->tpl_vars['data_one_quiz']->value['author_quiz'][3];?>

                                        </td>
                                        <td>
                                            
                                            <?php if ($_smarty_tpl->tpl_vars['data_one_quiz']->value['time_limit']) {?>
                                                <?php echo $_smarty_tpl->tpl_vars['data_one_quiz']->value['time_limit'];?>

                                            <?php } else { ?> Без ограничений    
                                            <?php }?>   
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
    </body>
</html>
<?php }} ?>
