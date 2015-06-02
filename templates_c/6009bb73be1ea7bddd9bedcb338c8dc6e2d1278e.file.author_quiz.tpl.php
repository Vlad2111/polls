<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-31 16:50:57
         compiled from "templates\author_quiz.tpl" */ ?>
<?php /*%%SmartyHeaderCode:24692553cf0b2257479-02474701%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6009bb73be1ea7bddd9bedcb338c8dc6e2d1278e' => 
    array (
      0 => 'templates\\author_quiz.tpl',
      1 => 1433076654,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '24692553cf0b2257479-02474701',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_553cf0b2587540_92382570',
  'variables' => 
  array (
    'title' => 0,
    'data_quiz' => 0,
    'data_one_quiz' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_553cf0b2587540_92382570')) {function content_553cf0b2587540_92382570($_smarty_tpl) {?><html>
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
                            <table width="100%">
                               <tr>
                                   <td>
                                       <a href="create_quiz.php?link_click=new_quiz">Создать опрос</a>
                                   </td>
                               </tr>
                               <tr>
                                   <td>
                                       <table width="100%" align="center">
                                           <tr>                                               
                                               <td>
                                                   Тема теста
                                               </td>
                                               <td>
                                                   Дата создания
                                               </td>
                                               <td>
                                                   Последние изменения
                                               </td>
                                               <td>
                                                   Статус опроса
                                               </td>
                                               <td colspan="2">
                                                   Операции
                                               </td>
                                           </tr>
                                           <?php  $_smarty_tpl->tpl_vars['data_one_quiz'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['data_one_quiz']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data_quiz']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['data_one_quiz']->key => $_smarty_tpl->tpl_vars['data_one_quiz']->value) {
$_smarty_tpl->tpl_vars['data_one_quiz']->_loop = true;
?>
                                            <tr>
                                                <td>
                                                    <?php echo $_smarty_tpl->tpl_vars['data_one_quiz']->value->topic;?>

                                                </td>
                                                <td>
                                                   01.01.2015
                                               </td>
                                               <td>
                                                   ---
                                               </td>
                                               <td>
                                                   <?php if ($_smarty_tpl->tpl_vars['data_one_quiz']->value->vasibility_test==1) {?>
                                                        Тест доступен 
                                                    <?php } else { ?>
                                                        Тест заблокирован
                                                    <?php }?>
                                               </td>
                                                <td>
                                                    <a href="create_quiz.php?link_click=edit_quiz&id_quiz=<?php echo $_smarty_tpl->tpl_vars['data_one_quiz']->value->id_test;?>
">Редактировать тест</a>
                                                </td>
                                                <td>
                                                    <a href="javascript: void(0);">Заблокировать</a>
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
                </td>
            </tr>                
        </table>
      </div>
        <?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

        </div>                                
    </body>
</html>
<?php }} ?>
