<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= env('APP_NAME') . '|Reset' ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css"
          integrity="sha512-GQGU0fMMi238uA+a/bdWJfpUGKUkBdgfFdgBm72SUQ6BeyWjoY/ton0tEjH+OSH9iP4Dfh+7HM0I9f5eR0L/4w=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="/css/login.css"/>
    <!--Google fonts -->

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap"
          rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Gugi&family=Lato:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700&family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400&family=Sofia&display=swap"
          rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">
</head>

<body>
<div class="login-container">
    <div class="container">
        <div class="logo"><?= env('APP_NAME') ?></div>
        <form method="POST" action="/reset">
            <h1>Reset Password</h1>
            <div>
                <input type="hidden" name="reset_token"value=<?=$resetInfo->reset_token?> >
                <label>Email</label>
                <input disabled type="email" class="form-control" aria-describedby="emailHelp"
                       placeholder="Enter email" name="email" value="<?= $resetInfo->email ?>">
                <div>
                    <label>Password</label>
                    <input type="password" class="form-control" placeholder="Password"
                           name="password">
                    <span class="text-danger"><?= getErrorMsg('password')?></span>
                </div>
                <div>
                    <label>Password Confirmation</label>
                    <input type="password" class="form-control" placeholder="Re-Password "
                           name="password_confirmation">
                </div>
                <button type="submit" class="submit" name="login">Reset</button>
            </div>
        </form>
    </div>
</div>
</body>

</html>