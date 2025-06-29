import './bootstrap';

//posts in home.blade.php, profile.blade.php
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.vk-show-more').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const postId = btn.getAttribute('data-post');
            const contentBlock = document.getElementById('post-content-' + postId);
            if (contentBlock.classList.contains('expanded')) {
                contentBlock.classList.remove('expanded');
                btn.textContent = 'Показать больше';
                contentBlock.querySelector('.vk-post-more').classList.add('d-none');
            } else {
                contentBlock.classList.add('expanded');
                btn.textContent = 'Скрыть';
                contentBlock.querySelector('.vk-post-more').classList.remove('d-none');
            }
        });
    });
});


//summernote in editor.blade.php
document.addEventListener('DOMContentLoaded', function () {
    $('#content').summernote({
        placeholder: 'Введите текст поста',
        tabsize: 2,
        height: 250,
        lang: 'ru-RU'
    });
});

$(function() {
    $('#content').summernote({
        placeholder: 'Введите текст поста',
        tabsize: 2,
        height: 250,
        lang: 'ru-RU'
    });
});