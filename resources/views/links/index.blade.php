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
                    <a href="" class="js-edit-link">Редактировать</a>
                    <form class="js-delete-form">
                        <button type="submit">Удалить</button>
                    </form>
                </th>
            </tr>
        </template>
    </table>
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const token = localStorage.getItem('auth_token');
    const container = document.getElementById('links-container');
    const template = document.getElementById('links-template');

    let loadLinks = async () => {
        try {
            let response = await fetch('/api/links', {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });
            const data = await response.json();

            container.innerHTML = '';
            data.links.forEach(link => {
                let clone = template.content.cloneNode(true);

                clone.querySelector('.originalUrl').textContent = link.original_url;
                clone.querySelector('.shortUrl').textContent = `http://localhost/${link.short_url}`;
                clone.querySelector('.createdAt').textContent = new Date(link.created_at).toLocaleString();
                clone.querySelector('.updatedAt').textContent = new Date(link.updated_at).toLocaleString();

                clone.querySelector('.js-edit-link').href = `/links/edit/${link.link_id}`;

                clone.querySelector('.js-delete-form').onsubmit = async (event) => {
                    event.preventDefault();
                    await fetch(`/api/links/${link.link_id}`, {
                        method: 'DELETE',
                        headers: {
                            'Authorization': `Bearer ${token}`
                        }
                    });
                    loadLinks();
                };

                container.appendChild(clone);
            });
        } catch(error) {
            console.error("Error:", error);
        }
    };
    loadLinks();
});
</script>
