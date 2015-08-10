<!DOCTYPE html>
<html>
    <head>
        <title>{$title}</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">	
		<link href="css/simple-sidebar.css" rel="stylesheet">
		<link href="css/navbar-fixed-top.css" rel="stylesheet">
        <script src="js/bootstrap.min.js"></script>
        <link href="css/signin.css" rel="stylesheet">
    </head>
    <body>        
        <div class="container">
        <img src="img/tecom-EN.png" align="middle"></img>
            <h1 align="center">Автоматическая система тестирования</h1>
            <form class="form-signin" role="form" id="auth" method="post">
                <h3 class="form-signin-heading" style="color:Gray">Авторизируйтесь</h2>
                <input type="text" name="login" class="form-control" placeholder="Введите логин" required autofocus>
                <input type="password" name="pass" class="form-control" placeholder="Введите пароль" required>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
            </form>
            {if $error != ""}
                <div class="alert alert-danger">
                    <p><font size="5" face="Arial">{$error}</font>
                </div>
            {/if}
        </div>
    </body>
</html>
