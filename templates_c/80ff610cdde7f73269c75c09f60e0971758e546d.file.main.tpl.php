<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-04-08 14:26:30
         compiled from "templates\main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:31967551ea94505dce0-27734828%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '80ff610cdde7f73269c75c09f60e0971758e546d' => 
    array (
      0 => 'templates\\main.tpl',
      1 => 1428488708,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '31967551ea94505dce0-27734828',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_551ea94590cfa0_42805940',
  'variables' => 
  array (
    'title' => 0,
    'data_quiz' => 0,
    'data_one_quiz' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_551ea94590cfa0_42805940')) {function content_551ea94590cfa0_42805940($_smarty_tpl) {?><html>
    <head>
        <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
        <meta charset="UTF-8">
    </head>
    <body>
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
                                    <td>
                                        Статус
                                    </td>
                                </tr>
                                <?php  $_smarty_tpl->tpl_vars['data_one_quiz'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['data_one_quiz']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data_quiz']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['data_one_quiz']->key => $_smarty_tpl->tpl_vars['data_one_quiz']->value) {
$_smarty_tpl->tpl_vars['data_one_quiz']->_loop = true;
?>
                                    <tr>
                                        <td>
                                            <?php echo $_smarty_tpl->tpl_vars['data_one_quiz']->value->getTest()->getTopic();?>

                                        </td>
                                        <td>
                                            
                                            <?php if ($_smarty_tpl->tpl_vars['data_one_quiz']->value->getMarkTest()=='available') {?>
                                                Доступен
                                              <?php } elseif ($_smarty_tpl->tpl_vars['data_one_quiz']->value->getMarkTest()=='unfinished') {?>
                                                  Незаконченный
                                              <?php } else { ?>
                                                  Не доступен
                                            <?php }?>    
                                        </td>
                                        <td>
                                            <?php echo $_smarty_tpl->tpl_vars['data_one_quiz']->value->getUser()->getFirstName();?>
 <?php echo $_smarty_tpl->tpl_vars['data_one_quiz']->value->getUser()->getLastName();?>

                                        </td>
                                        <td>
                                            
                                            <?php if ($_smarty_tpl->tpl_vars['data_one_quiz']->value->getTest()->getTimeLimit()) {?>
                                                <?php echo $_smarty_tpl->tpl_vars['data_one_quiz']->value->getTest()->getTimeLimit();?>

                                            <?php } else { ?> Без ограничений    
                                            <?php }?>   
                                        </td>
                                        <td>
<button form="go" type="submit" formaction="quiz.php" name="testing" value=<?php echo $_smarty_tpl->tpl_vars['data_one_quiz']->value->getIdTesting();?>
>Пройти тест</button>
                                            <a href="quiz.php?testing=<?php echo $_smarty_tpl->tpl_vars['data_one_quiz']->value->getIdTesting();?>
">test</a>
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
