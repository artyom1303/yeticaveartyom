
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
<form class="form container <?=($all_inputed and $no_errors)?'':'form--invalid'?>" action="sign-up.php" method="post" enctype="multipart/form-data" autocomplete="off">
      <h2>Регистрация нового аккаунта</h2>
      <div class="form__item <?=$errors['email']==''?'':'form__item--invalid'?>">
        <label for="email">E-mail <sup>*</sup></label>
        <input id="email" type="text" name="email" placeholder="Введите e-mail" value="<?=$fields_data['email']?>">
        <span class="form__error"><?=$errors['email']?></span>
      </div>
      <div class="form__item <?=$errors['password']==''?'':'form__item--invalid'?>">
        <label for="password">Пароль <sup>*</sup></label>
        <input id="password" type="password" name="password" placeholder="Введите пароль" value="<?=$fields_data['password']?>">
        <span class="form__error"><?=$errors['password']?></span>
      </div>
      <div class="form__item <?=$errors['name']==''?'':'form__item--invalid'?>">
        <label for="name">Имя <sup>*</sup></label>
        <input id="name" type="text" name="name" placeholder="Введите имя" value="<?=$fields_data['name']?>">
        <span class="form__error"><?=$errors['name']?></span>
      </div>
      <div class="form__item <?=$errors['contacts']==''?'':'form__item--invalid'?>">
        <label for="contacts">Контактные данные <sup>*</sup></label>
        <textarea id="contacts" name="contacts" placeholder="Напишите как с вами связаться"><?=$fields_data['contacts']?></textarea>
        <span class="form__error"><?=$errors['contacts']?></span>
      </div>
    <div class="form__item form__item--file <?=$errors['avatar']==''?'':'form__item--invalid'?>">
        <label>Аватар <sup>*</sup></label>
        <div class="form__input-file">
            <input class="visually-hidden" type="file" id="avatar" name="avatar">
            <label for="avatar">
                Добавить
            </label>
        </div>
        <span class="form__error"><?=$errors['avatar']?></span>
    </div>
      <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
      <button type="submit" class="button">Зарегистрироваться</button>
      <a class="text-link" href="login.php">Уже есть аккаунт</a>
</form>
