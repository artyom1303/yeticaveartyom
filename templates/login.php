
    <nav class="nav">
        <ul class="nav__list container">
            <?php
            foreach ($categories as $category)
            {
                ?>
                <li class="nav__item">
                    <a href="pages/all-lots.html"><?=$category['rus']?></a>
                </li>
                <?php
            }
            ?>
        </ul>
    </nav>
    <form class="form container" action="login.php" method="post">
      <h2>Вход</h2>
      <div class="form__item <?=(!$email_valid OR $email_wrong)?'form__item--invalid':''?>">
        <label for="email">E-mail <sup>*</sup></label>
        <input id="email" type="text" name="email" placeholder="Введите e-mail" value="<?=$fields_data['email']?>">
        <span class="form__error"><?=!$email_wrong?'Введите e-mail':'пользователя с таким почтовым адресом не существует'?></span>
      </div>
      <div class="form__item form__item--last <?=(!$password_valid OR $password_wrong)?'form__item--invalid':''?>">
        <label for="password">Пароль <sup>*</sup></label>
        <input id="password" type="password" name="password" placeholder="Введите пароль" value="<?=$fields_data['password']?>">
        <span class="form__error"><?=!$password_wrong?'Введите пароль':'Вы ввели неверный пароль'?></span>
      </div>
      <button type="submit" class="button" name="which_form" value="login" >Войти</button>
        <button type="submit" class="button" name="which_form" value="forgot" >Восстановление пароля</button>
    </form>

