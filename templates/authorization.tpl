<!DOCTYPE html>
<html>
    <head>
        <title>{$title}</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <form id="auth" action={$action} method="post">
            <h2>Меню авторизации</h2>
            <table>
                <tr>         
               <td>Введите логин:</td>
               <td> <input type="text" name="login"></td></tr>
            <tr><td>Введите пароль:</td>
            <td><input type="password" name="pass"></td></tr>
            <tr><td> 
            <button form="auth" type="submit" formaction="authorization.php" name="button_click" value='LDAP'>Войти как пользватель LDAP</button>
            </td><td>
            <button form="auth" type="submit" formaction="authorization.php" name="button_click" value='DB'>Войти как внутренний пользватель</button>
            </td></tr>
            </table>
        
        </form>

        {if isset($user_login)}
            <h3>Вы зашли под именем {$user_login}</h3>
        {else}<p><font size="5" color="red" face="Arial">{$error}</font>
        {/if}
    </body>
</html>
