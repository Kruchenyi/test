<?php require VIEWS . '/incs/header.tpl.php' ?>

<form action="" method="post" class="form" id="#form">
    <h2 class="form__title"><a href="index">Введите номер</a></h2>
    <div class="form__block">
        <div class="form__item">
            <input class="form__input form__code" type="number" name="code" id="code" placeholder="+код" value="<?= old('code') ?>">
            <input class="form__input form__number" type="number" name="number" id="number" placeholder="номер" value="<?= old('number') ?>">
        </div>
        <?= $validator->hasError() ? $validator->output('code') : '' ?>
        <?= $validator->hasError() ? $validator->output('number') : '' ?>
    </div>
    <div class="form__button"><button class="form__btn" type="submit">Отправить</button></div>
</form>
<h1 class="country"> <?= isset($country['country']) ? $country['country'] : '' ?></h1>


<?php require VIEWS . '/incs/footer.tpl.php' ?>