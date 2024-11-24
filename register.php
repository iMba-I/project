
<?php
// Подключение к базе данных
require_once 'ConClass.php';

$Salt = "1afa148eb41f2e7103f21410bf48346c";

// Получаем подключение к БД
$mysql = Database::connection();

// Переменные для данных из формы
$email = '';
$password1 = '';
$password2 = '';
$office_id = '';
$account_type = '';

$errors = [];

if (isset($_POST['register'])) {
    // Получаем данные из формы
    $email = htmlspecialchars($_POST['email']);
    $password1 = htmlspecialchars($_POST['password1']);
    $password2 = htmlspecialchars($_POST['password2']);
    $office_id = htmlspecialchars($_POST['office_id']);
    $account_type = isset($_POST['account_type']) ? intval($_POST['account_type']) : 0;  // Приводим к целому числу

    // Регулярные выражения для валидации
    $pattern_email = '/^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+\.[a-zA-Z]{2,}$/';
    $pattern_password = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{7,}$/';

    // Проверка email
    if (empty($email)) {
        $errors['email'] = 'Введите email.';
    } elseif (!preg_match($pattern_email, $email)) {
        $errors['email'] = 'Некорректный email.';
    }

    // Проверка пароля
    if (empty($password1)) {
        $errors['password'] = 'Введите пароль.';
    } elseif (!preg_match($pattern_password, $password1)) {
        $errors['password'] = 'Пароль должен содержать минимум 7 символов, заглавные и строчные буквы, цифры и спецсимволы.';
    } elseif ($password1 !== $password2) {
        $errors['password'] = 'Пароли не совпадают.';
    }

    // Проверка office_id
    if (empty($office_id)) {
        $errors['office_id'] = 'Введите ID офиса.';
    }

    // Проверка account_type
    //if (empty($account_type)) {
    //    $errors['account_type'] = 'Укажите тип аккаунта.';
    //}

    if (!in_array($account_type, [0, 1])) {
    $errors['account_type'] = 'Некорректный тип аккаунта.';
}


    if (empty($errors)) {
        // Хеширование пароля
        $passwordHash = md5($Salt . $password1);

        // Вставка в базу данных

        $query = "INSERT INTO users (email, password, office_id, account_type) VALUES (?, ?, ?, ?)";
        $stmt = $mysql->prepare($query);
        $stmt->bind_param("ssii", $email, $passwordHash, $office_id, $account_type);

        if ($stmt->execute()) {
            

            
            exit;
        } else {
            // Добавление ошибки, если не удалось вставить в БД
            $errors['db'] = 'Ошибка при регистрации в базе данных.';
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background: #fff;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
            color: #555;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        select {
            background-color: #fff;
            cursor: pointer;
        }
        .form-actions {
            text-align: center;
            margin-top: 20px;
        }
        button {
            padding: 10px 20px;
            font-size: 14px;
            border: none;
            background-color: #4CAF50;
            color: white;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #45a049;
        }
        .error {
            font-size: 12px;
            color: red;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Регистрация</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                <?php if (isset($errors['email'])): ?>
                    <div class="error"><?php echo $errors['email']; ?></div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="password1">Пароль:</label>
                <input type="password" id="password1" name="password1" required>
                <?php if (isset($errors['password'])): ?>
                    <div class="error"><?php echo $errors['password']; ?></div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="password2">Повторите пароль:</label>
                <input type="password" id="password2" name="password2" required>
                <?php if (isset($errors['password'])): ?>
                    <div class="error"><?php echo $errors['password']; ?></div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="office_id">ID Офиса:</label>
                <input type="text" id="office_id" name="office_id" value="<?php echo htmlspecialchars($office_id); ?>" required>
                <?php if (isset($errors['office_id'])): ?>
                    <div class="error"><?php echo $errors['office_id']; ?></div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="account_type">Тип аккаунта:</label>
                 <select id="account_type" name="account_type" required>
                    <option value="" selected>Выберите тип</option>
                    <option value="0" >Пользователь</option>
                    <option value="1" >Администратор</option>
                </select>
                <?php if (isset($errors['account_type'])): ?>
                    <div class="error"><?php echo $errors['account_type']; ?></div>
                <?php endif; ?>
            </div>
            <div class="form-actions">
                <button type="submit" name="register">Зарегистрироваться</button>
            </div>
        </form>
    </div>
</body>
</html>
