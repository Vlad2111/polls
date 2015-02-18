<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-16 16:23:09
         compiled from "template_smarty\templates\view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:272754e1bacabe6090-46480237%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '333336c07f03721f85f23d6cc0a680d57c5bf1d3' => 
    array (
      0 => 'template_smarty\\templates\\view.tpl',
      1 => 1424089387,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '272754e1bacabe6090-46480237',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54e1bacac4c874_74722181',
  'variables' => 
  array (
    'title' => 0,
    'action' => 0,
    'error' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54e1bacac4c874_74722181')) {function content_54e1bacac4c874_74722181($_smarty_tpl) {?><!DOCTYPE html>
<html>
    <head>
        <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
    <form action="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" method="POST">
        <table border="1">
            <tr>
                <td>
                    Текст
                </td>
                <td>
                    <input type="text" name="text_question" size="50">
                </td>
            </tr>
            <tr>
                <td>
                    Тип
                </td>
                <td>
                   <table >
                       <tr>
                           <td>
                               <input type="radio" name="type_question" value="1"> Да/Нет/Не знаю
                           </td>
                       </tr>
                       <tr>
                           <td>
                               <input type="radio" name="type_question" value="2">Ответ из списка
                            </td>
                       </tr>
                       <tr>
                           <td>
                               <input type="radio" name="type_question" value="3">Выбор одного и более ответов из списка
                            </td>
                       </tr>
                       <tr>
                           <td>
                               <input type="radio" name="type_question" value="4">Написание ответа в виде произвольного текста
                            </td>
                       </tr>
                               
                   </table>
                </td>
            </tr>
            <tr>
                <td>
                    Ответ
                </td>
                <td>
                    <input type="text" name="answer_question" size="50">
                </td>
            </tr>
            <tr>
                <td>
                    Комментарий
                </td>
                <td>
                    <input type="text" name="coment_question" size="50">
                </td>
            </tr>
            <tr>
                <td>
                </td>
                <td>
                    <input type="submit" value="Отправить">
                </td>                   
            </tr>
            
        </table>
    </form>    
<p><font size="5" color="red" face="Arial"><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</font>

        </body>    
</html>
<?php }} ?>
