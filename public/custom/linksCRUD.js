document.addEventListener('DOMContentLoaded', function() {
    const token = localStorage.getItem('auth_token');
    const container = document.getElementById('links-container');
    const template = document.getElementById('links-template');

let loadLinks = async () => {
    try {
        let response = await fetch('/api/links', {
            headers: {
                'Content-Type': 'application/json',
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

            container.appendChild(clone);
        });
    } catch(error) {
        console.error("Error:", error);
    }
};
    loadLinks();
});
