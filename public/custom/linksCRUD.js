document.addEventListener('DOMContentLoaded', function() {
    const token = localStorage.getItem('auth_token');
    fetchUserLinks(token);
});

async function fetchUserLinks(token) {
    try {
        const response = await fetch('/api/links', {
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json'
            },
            credentials: 'include'
        });

        if (!response.ok) {
            throw new Error('Ошибка при загрузке ссылок');
        }

        const data = await response.json();
        displayLinks(data.data);
    } catch (error) {
        console.error('Error:', error);
        document.getElementById('userLinks').innerHTML = `
            <div class="alert alert-danger">Не удалось загрузить ссылки. ${error.message}</div>
        `;
    }
}

function displayLinks(links) {
    const container = document.getElementById('userLinks');

    if (links.length === 0) {
        container.innerHTML = '<p>У вас пока нет ссылок.</p>';
        return;
    }

    let html = `
        <table class="table">
            <thead>
                <tr>
                    <th>Оригинальная ссылка</th>
                    <th>Короткая ссылка</th>
                    <th>Дата создания</th>
                    <th>Дата обновления</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
    `;

    links.forEach(link => {
        html += `
            <tr>
                <td><a href="${link.original_url}" target="_blank">${link.original_url}</a></td>
                <td><a href="/${link.short_url}" target="_blank">/${link.short_url}</a></td>
                <td>${new Date(link.created_at).toLocaleString()}</td>
                <td>${new Date(link.updated_at).toLocaleString()}</td>
            </tr>
        `;
    });

    html += `
            </tbody>
        </table>
    `;

    container.innerHTML = html;
}
