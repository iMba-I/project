<?php
include "loginLogic.php";
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emply - Forward to Productivity</title>
    <link rel="stylesheet" href="main-style.css">
    
</head>
<body>
    <div class="xdd">
    <header>
        <div class="container">
            <nav>
                <img src="img/icons/logo_black.png" alt="Empty Logo">
                <ul>
                    <li><button>Интеграция</button></li>
                    <li><a href="#">Продукты</a></li>
                    <li><a href="#">Сообщество</a></li>
                    <li><a href="#">Контакты</a></li>
                </ul>
            </nav>
            <div class="buttons" id="log">
                <button class="btn2" id="login">Sign in</button>
                <button class="btn2 hide" id="exitButton">EXIT</button>
            </div>
        </div>
    </header>


    <section class="hero active" id="startScreen_form">        
            <h1>Emply</h1>
            <div class="line1"></div>
            <p>forward to productivity</p>
    </section>
    <section class="forma" id="login_form">
        <form method="POST" action="">        
            <br>
            <p>Логин</p>
            <input type="email" id="email" name="logmail" size="30" placeholder="Введите логин" required />
            <p><?php echo $arrerr['login']?></p>
            <p>Пароль</p>
            <input type="text" name="logpass"  id="pass" name="password" minlength="8" placeholder="Введите пароль" required />
            <p><?php echo $arrerr['pass']?></p>
            <p><?php echo $arrerr['nouser']?></p>
            <button id="enterButton" name="login">Войти</button>
        </form>
        <a href="#"><p>Забыли пароль?</p></a>
    </section>
    </div>
    

    <footer>
            <div class="column">
               <img src="img/icons/logo_black.png" alt="Empty Logo">
               <p>forward to productivity</p>
            </div>   
            <div class="column">
                <h2>Use cases</h2>
                <ul>
                    <li>Diagramming</li>
                    <li>Brainstorming</li>
                    <li>Online whiteboard</li>
                    <li>Team collaboration</li>
                </ul>
            </div>
            <div class="column">
                <h2>Explore</h2>
                <ul>
                    <li>Design</li>
                    <li>Prototyping</li>
                    <li>Development features</li>
                    <li>Design systems</li>
                </ul>
            </div>
            <div class="column">
                <h2>Resources</h2>
                <ul>
                    <li>Blog</li>
                    <li>Best practices</li>
                    <li>Support</li>
                    <li>Developers</li>
                    <li>Resource library</li>
                </ul>
            </div>
    </footer>

</body>
<script src = "mainFrame_script.js"></script>
</html>