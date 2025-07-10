document.addEventListener('DOMContentLoaded', function() {
    const resultDiv = document.getElementById('result');
    const shortLink = document.getElementById('shortLink');
    const token = localStorage.getItem('auth_token');

    document.getElementById('createLink').addEventListener('click', async function() {
        const url = document.getElementById('originalUrl').value.trim();

        if (!url) {
            alert('Пожалуйста, введите URL');
        }

        try {
            const response = await fetch('/api/generate-short-link', {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    original_url: url
                })
            });

            if (!response.ok) {
                const error = await response.json();
                throw new Error(error.message || 'Ошибка сервера');
            }

            const data = await response.json();

            shortLink.href = "http://localhost/" + data.short_url;
            shortLink.textContent = "http://localhost/" + data.short_url;
            resultDiv.style.display = 'block';

        } catch (error) {
            console.error('Ошибка:', error);
            alert(error.message || 'Произошла ошибка при создании ссылки');
        }
    });
});
