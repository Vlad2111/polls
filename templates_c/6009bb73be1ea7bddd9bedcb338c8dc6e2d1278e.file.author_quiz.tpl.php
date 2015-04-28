<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-04-26 18:05:38
         compiled from "templates\author_quiz.tpl" */ ?>
<?php /*%%SmartyHeaderCode:24692553cf0b2257479-02474701%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6009bb73be1ea7bddd9bedcb338c8dc6e2d1278e' => 
    array (
      0 => 'templates\\author_quiz.tpl',
      1 => 1429650821,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '24692553cf0b2257479-02474701',
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
  'unifunc' => 'content_553cf0b2587540_92382570',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_553cf0b2587540_92382570')) {function content_553cf0b2587540_92382570($_smarty_tpl) {?><html>
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
                            <table width="100%">
                               <tr>
                                   <td>
                                       <a href="create_quiz.php">Создать опрос</a>
                                   </td>
                               </tr>
                               <tr>
                                   <td>
                                       <h1>
                                            Созданные тесты
                                       </h1>
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
