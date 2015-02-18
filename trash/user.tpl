<!DOCTYPE html>
<html>
    <head>
        <title>{$title}</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        {if isset($user_login)}
            <h3>Вы зашли под именем {$user_login}</h3>
        {else}<h3>Пользователь с такими данными не найден</h3>
        {/if}

    </body>
</html>
