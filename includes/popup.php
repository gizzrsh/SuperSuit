<?php

?>

<div class="product__popup popup" id="popup">
    <form action="popup.php" method="post" class="popup__form">
        <h4 class="popup__title">Аренда костюма “<?= $product['name'] ?>”</h4>
        <p class="popup__subtitle">Пожалуйста, укажите ваши контактные данные, <br> чтобы мы забронировали костюм на ваше имя</p>

        <input type="text" class="popup__input" name="name" placeholder="Как вас зовут?" required>
        <input type="tel" class="popup__input" name="tel" placeholder="+7 (977) 325 - 41 -60" required>
        <select id="days" class="popup__input" name="days">
            <option value="">На сколько дней арендуете?</option>
            <option value="1">1</option>
            <option value="3">3</option>
            <option value="7">7</option>
            <option value="14">14</option>
            <option value="28">28</option>
        </select>
        <label for="checkbox" class="popup__checkbox">
            <input type="checkbox" name="agree" value="1" required>
            Я согласен на обработку моих персональных данных
        </label>

        <button type="submit" class="popup__btn btn">Оставить заявку</button>
    </form>
    <button type="button" class="popup__close"><img src="images/cross.svg" alt=""></button>
</div>