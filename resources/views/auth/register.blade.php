<div class="login__form">
    <h1>Регистрация</h1>

    <form id="registerForm">
        <input name="name" type="text" placeholder="Имя" required>

        <input name="email" type="email" placeholder="Email" required>

        <input name="password" type="password" placeholder="Пароль" required>

        <select name="gender_id" id="genderSelect" required>
            <option value="">Выберите пол</option>
        </select>
        <br>

        <a href="/login">Уже есть аккаунт?</a><br>

        <button type="submit" id="submitBtn">Зарегистрироваться</button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', async function() {
    const form = document.getElementById('registerForm');
    const genderSelect = document.getElementById('genderSelect');

    try {
        const response = await fetch('/api/genders');

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const genders = await response.json();

        genders.forEach(gender => {
            const option = document.createElement('option');
            option.value = gender.gender_id;
            option.textContent = gender.gender_name;
            genderSelect.appendChild(option);
        });
    } catch (error) {
        console.error('Ошибка загрузки гендеров:', error);
        genderSelect.innerHTML = '<option value="">Ошибка загрузки списка</option>';
    }

    form.addEventListener('submit', async function(e) {
        e.preventDefault();

        try {
            const response = await fetch('/api/register', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    email: form.email.value,
                    password: form.password.value,
                    gender_id: form.gender_id.value
                })
            });

            const data = await response.json();

            localStorage.setItem('auth_token', data.token);
            window.location.href = '/';

        } catch (error) {
            console.error('Ошибка:', error);
            alert(error.message);
        }
    });
});
</script>
