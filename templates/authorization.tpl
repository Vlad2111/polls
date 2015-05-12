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
               <td> <input type="text" name="login" required></td></tr>
            <tr><td>Введите пароль:</td>
                <td><input type="password" name="pass" required></td></tr>
            <tr><td> 
            <input type="submit" value="Войти">
            </td></tr>
            </table>
        
        </form>

            <p><font size="5" color="red" face="Arial">{$error}</font>
    </body>
</html>
