<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-03-03 13:14:27
         compiled from "templates/administration_table_users.tpl" */ ?>
<?php /*%%SmartyHeaderCode:66900280354f58983ba6581-59998069%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '20109276fd7d653f553129f1c3e4a6b95aea3a55' => 
    array (
      0 => 'templates/administration_table_users.tpl',
      1 => 1425377630,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '66900280354f58983ba6581-59998069',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'id_user' => 0,
    'first_name' => 0,
    'last_name' => 0,
    'patronymic' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54f58983bc11d8_43605814',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54f58983bc11d8_43605814')) {function content_54f58983bc11d8_43605814($_smarty_tpl) {?><html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
                    <table  width="100%"  bgcolor="#CDC8B1">
                        <tr align="center">
                            <td bgcolor="#8B8378">
                                <button form="users" type="submit" formaction="administration.php">Выбрать пользователя</button>
                            </td>
                            <td bgcolor="#8B8378">
                                <button form="users" type="reset" value="reset">Reset</button>
                            </td>
                        </tr>
                    </table>
                    <table width="100%">
                        
                        <tr>
                            <td width="100%" bgcolor="#CDC8B1">
                               <form id="users">
                                   <table>
                                                                                  
                               <td><input type="radio" name="user_control" value="<?php echo $_smarty_tpl->tpl_vars['id_user']->value;?>
"> </td><td><?php echo $_smarty_tpl->tpl_vars['first_name']->value;?>
</td><td><?php echo $_smarty_tpl->tpl_vars['last_name']->value;?>
</td><td><?php echo $_smarty_tpl->tpl_vars['patronymic']->value;?>
</td>
                                        </tr>
                                    </table>
                              </form>
                            </td>
                        </tr>
                    </table>
    </body>
</html>
<?php }} ?>
