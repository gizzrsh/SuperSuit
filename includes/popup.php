<div class="product__popup popup" id="popup-rent">
    <form action="popup.php" method="post" class="popup__form-rent">
        <h4 class="popup__title">Аренда костюма “<?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?>”</h4>
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
    <button type="button" class="popup__close-rent"><img src="images/cross.svg" alt=""></button>
</div>

<div class="auth__popup popup" id="popup-auth" >
    <form action="./handlers/auth.php" method="post" class="popup__form-auth">
        <h4 class="popup__title">Авторизация</h4>
        <input type="email" class="popup__input" name="email" placeholder="Email" required>
        <input type="password" class="popup__input" name="password" placeholder="Пароль" required>
        <button type="submit" class="popup__btn btn">Войти</button>

        <div class="popup__actions">
            <button type="button" class="popup__action switch-to-register">Нет аккаунта? Создать</button>
        </div>

        <button type="button" class="popup__close-auth"><img src="images/cross.svg" alt=""></button>
    </form>
</div>

<div class="register__popup popup" id="popup-register">
    <form action="./handlers/register.php" method="post" class="popup__form-register">
        <h4 class="popup__title">Регистрация</h4>
        
        <input type="text" class="popup__input" name="name" placeholder="Имя" required>
        <input type="email" class="popup__input" name="email" placeholder="Email" required>
        <input type="password" class="popup__input" name="password" placeholder="Пароль" required>
        <input type="password" class="popup__input" name="password_confirm" placeholder="Повторите пароль" required>
        
        <label for="register-checkbox" class="popup__checkbox">
            <input type="checkbox" name="agree" value="1" id="register-checkbox" required>
            Я согласен на обработку моих персональных данных
        </label>

        <button type="submit" class="popup__btn btn">Зарегистрироваться</button>
        
        <div class="popup__actions">
            <button type="button" class="popup__action switch-to-auth">Уже есть аккаунт? Войти</button>
        </div>

        <button type="button" class="popup__close-register"><img src="images/cross.svg" alt=""></button>
    </form>
</div>

<!-- <div class="success__popup">
    <p class="success__popup-text">Вы зарегистрированы</p>
</div> -->