document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('likePostForm');
    const likeButton = document.getElementById('likePostButton');

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(form);

        fetch('/slam/like', {
            method: 'POST',
            body: formData,
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    likeButton.innerHTML = data.user_has_liked > 0
                        ? `Unlike: ${data.num_likes}`
                        : `Like: ${data.num_likes}`;
                    likeButton.classList.toggle('btn-danger');
                    likeButton.classList.toggle('btn-secondary');
                    console.log(data.user_has_liked);
                } else {
                    console.error('Error:', data.message);
                }
            })
            .catch(error => {
                window.location.href = '/session';
            });
    });
});
