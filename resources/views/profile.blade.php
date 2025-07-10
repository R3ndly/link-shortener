<!Doctype html>
<div class="card-header">Профиль</div>

<div class="card-body" id="profile-data"></div>
<button id="logout-btn">Выход из аккаунта</button><br>

<h2>Создание короткой ссылки</h2>
<input type="text" id="originalUrl" placeholder="Введите полный URL">
<button id="createLink">Сгенерировать</button>
<div id="result" style="display: none;">
    <p>Ваша короткая ссылка:</p>
    <a href="#" id="shortLink"></a>
</div>


<script src="/custom/profile.js"></script>
<script src="/custom/generateUrl.js"></script>
