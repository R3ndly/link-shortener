<!Doctype html>
<h2>Ваши ссылки</h2>
<div>
    <table>
        <thead>
            <tr>
                <th>Оригинальная ссылка</th>
                <th>Короткая ссылка</th>
                <th>Дата создания</th>
                <th>Дата обновления</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody id="links-container"></tbody>
        <template id="links-template">
            <tr>
                <th class="originalUrl"></th>
                <th class="shortUrl"></th>
                <th class="createdAt"></th>
                <th class="updatedAt"></th>
                <th>
                    <form class="js-delete-form">
                        <button type="submit">Удалить</button>
                    </form>
                </th>
            </tr>
        </template>
    </table>
</div>


<script src="/custom/linksCRUD.js"></script>
