<h1>Вход</h1>
    <div class="login__form">
        <form id="loginForm">
            <input name="email" type="text" placeholder="Email" required>

            <input name="password" type="password" placeholder="Пароль" required>

            <div class="mb-3">
                <a href="/register">Регистрация</a>
            </div>

            <button type="submit">Войти</button>
        </form>
    </div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('loginForm');

    form.addEventListener('submit', async function(e) {
        e.preventDefault();

        try {
            const response = await fetch('/api/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                credentials: 'include',
                body: JSON.stringify({
                    email: form.email.value,
                    password: form.password.value
                })
            });

            const data = await response.json();

            if (!response.ok) {
                alert(data.message || 'Ошибка входа');
                return;
            }

            localStorage.setItem('auth_token', data.token);
            window.location.href = '/';

        } catch (error) {
            console.error('Ошибка:', error);
            alert(error.message || 'Ошибка авторизации');
        }
    });
});

</script>
