<!Doctype html>
<h2>Редактирование ссылок</h2>

<form id="editForm">
    <input type="text" id="original_url" placeholder="Оригинальная ссылка" required>
    <input type="text" id="short_url" placeholder="Короткая ссылка" required>

    <button type="submit">Сохранить изменения</button>
</form>

<script>
document.addEventListener('DOMContentLoaded', async function() {
    const linkId = window.location.pathname.split('/').pop();
    const token = localStorage.getItem('auth_token');

    let response = await fetch(`/api/links/${linkId}`, {
        headers: {
            'Authorization': `Bearer ${token}`,
            'Accept': 'application/json'
        }
    });
        const data = await response.json();
        document.getElementById('original_url').value = data.link.original_url;
        document.getElementById('short_url').value = data.link.short_url;

    document.getElementById('editForm').addEventListener('submit', async function(event) {
        event.preventDefault();

        const formData = {
            original_url: document.getElementById('original_url').value,
            short_url: document.getElementById('short_url').value,
            _method: 'PUT'
        };

        try {
            const response = await fetch(`/api/links/${linkId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`
                },
                body: JSON.stringify(formData)
            });

            window.location.href = '/links';
        } catch (error) {
            console.error(error);
        }
    });
});
</script>
