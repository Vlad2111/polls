<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-03-19 10:05:31
         compiled from "templates\quiz.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18514550a672ba088a8-70035935%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bfd2b19e0f6c8caa86730ece86950200783687e3' => 
    array (
      0 => 'templates\\quiz.tpl',
      1 => 1426669333,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18514550a672ba088a8-70035935',
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
  'unifunc' => 'content_550a672c021f00_09797898',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_550a672c021f00_09797898')) {function content_550a672c021f00_09797898($_smarty_tpl) {?><html>
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
