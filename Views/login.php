<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="Public/css/style.css"/>
        <title>YourGameBook</title>
    </head>
    <body>
        <div class="container">
            <div class="logo">
                <img src="Public/img/logo.svg" alt="logo">
            </div>
            <div class="login-container">
                <form class="login" action="login" method="POST">
                    <div class="messages">
                        <?php
                        if(isset($messages)){
                            foreach($messages as $message) {
                                echo $message;
                            }
                        }
                        ?>
                    </div>

                    <p class="input-names">Email</p>
                    <input name="email" type="text" placeholder="email@email.com">
                    <p class="input-names">Password</p>
                    <input name="password" type="password" placeholder="password">
                    <button class="sign-in" type="submit"><span>Sign in</span></button>
                    <a href="register" class="register-button"><span>Register</span></button></a>
                </form>
            </div>
        </div>
    </body>
</html>