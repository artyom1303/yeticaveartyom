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
<form id='form' class="form form--add-lot container <?=$form_valid?'':'form--invalid'?>" action="add.php" method="post" enctype="multipart/form-data"> <!-- form--invalid -->
    <h2>Добавление лота</h2>
    <div class="form__container-two">
        <div class="form__item <?=$errors[lot_name_ok]?'':'form__item--invalid'?>"> <!-- form__item--invalid -->
            <label for="lot-name">Наименование <sup>*</sup></label>
            <input id="lot-name" type="text" name="lot-name" placeholder="Введите наименование лота" value="<?=$fields_data[lot_name]?>">
            <span class="form__error">Введите наименование лота</span>
        </div>
        <div class="form__item <?=$errors[category_ok]?'':'form__item--invalid'?>">
            <label for="category">Категория <sup>*</sup></label>
            <select id="category" name="category">
                <option disabled selected>Выберите категорию</option>
            <?php foreach ($categories as $category){?>
                    <option <?=$fields_data[category]==$category['id']?'selected':''?> value="<?=$category['id']?>"><?=$category['rus']?></option>
            <?php } ?>
            </select>
            <span class="form__error">Выберите категорию</span>
        </div>
    </div>
    <div class="form__item form__item--wide <?=$errors[message_ok]?'':'form__item--invalid'?>">
        <label for="message">Описание <sup>*</sup></label>
        <textarea id="message" name="message" placeholder="Напишите описание лота"><?=$fields_data[message]?></textarea>
        <span class="form__error">Напишите описание лота</span>
    </div>
    <div class="form__item form__item--file <?=$errors[lot_img_ok]?'':'form__item--invalid'?>">
        <label>Изображение <sup>*</sup></label>
        <div class="form__input-file">
            <input class="visually-hidden" type="file" id="lot-img" name="lot-img">
            <label for="lot-img">
                Добавить
            </label>
        </div>
        <span class="form__error">Выберите файл</span>
    </div>
    <div class="form__container-three">
        <div class="form__item form__item--small <?=$errors[lot_rate_ok]?'':'form__item--invalid'?>">
            <label for="lot-rate">Начальная цена <sup>*</sup></label>
            <input id="lot-rate" type="text" name="lot-rate" placeholder="0" value="<?=$fields_data[lot_rate]?>">
            <span class="form__error">Введите начальную цену</span>
        </div>
        <div class="form__item form__item--small <?=$errors[lot_step_ok]?'':'form__item--invalid'?>">
            <label for="lot-step">Шаг ставки <sup>*</sup></label>
            <input id="lot-step" type="text" name="lot-step" placeholder="0" value="<?=$fields_data[lot_step]?>">
            <span class="form__error">Введите шаг ставки</span>
        </div>
        <div class="form__item <?=$errors[lot_date_ok]?'':'form__item--invalid'?>">
            <label for="lot-date">Дата окончания торгов <sup>*</sup></label>
            <input class="form__input-date" id="lot-date" type="text" name="lot-date" placeholder="Введите дату в формате ГГГГ-ММ-ДД" value="<?=$fields_data[lot_date]?>">
            <span class="form__error">Введите дату завершения торгов</span>
        </div>
    </div>
    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <button type="submit" class="button">Добавить лот</button>
</form>
