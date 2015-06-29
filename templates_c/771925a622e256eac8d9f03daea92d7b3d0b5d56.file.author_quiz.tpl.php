<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-06-29 15:52:28
         compiled from "templates/author_quiz.tpl" */ ?>
<?php /*%%SmartyHeaderCode:125601989055913f8c24f084-66524128%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '771925a622e256eac8d9f03daea92d7b3d0b5d56' => 
    array (
      0 => 'templates/author_quiz.tpl',
      1 => 1435580356,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '125601989055913f8c24f084-66524128',
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
  'unifunc' => 'content_55913f8c2c8a59_51312687',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55913f8c2c8a59_51312687')) {function content_55913f8c2c8a59_51312687($_smarty_tpl) {?><html>
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
