<div class="card-header">Профиль</div>

<div class="card-body" id="profile-data"></div>
<button id="logout-btn" class="btn btn-danger">Выход из аккаунта</button>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const token = localStorage.getItem('auth_token');

    if (!token) {
        window.location.href = '/login';
        return;
    }

    fetch('/api/profile', {
        headers: {
            'Authorization': `Bearer ${token}`,
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) throw new Error('Ошибка загрузки профиля');
        return response.json();
    })
    .then(data => {
        document.getElementById('profile-data').innerHTML = `
            <p><strong>Email:</strong> ${data.email}</p>
            <p><strong>Пол:</strong> ${data.gender_name}</p>
        `;
    })
    .catch(error => {
        console.error(error);
        window.location.href = '/login';
    });

    document.getElementById('logout-btn').addEventListener('click', function() {
        fetch('/api/logout', {
            method: 'POST',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        .then(response => {
            localStorage.removeItem('auth_token');
            window.location.href = '/login';
        })
        .catch(error => {
            console.error('Ошибка выхода:', error);
        });
    });
});
</script>
