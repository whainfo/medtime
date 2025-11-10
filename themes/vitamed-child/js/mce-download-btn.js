(function() {
    tinymce.create('tinymce.plugins.my_download_btn', {
        init : function(editor, url) {
            editor.addButton('my_download_btn', {
                text: 'Додати файл',
                icon: false,                 // можна додати свій icon URL
                classes: 'mce-widget mce-btn', // потрібні класи
                onclick: function() {
                    // Відкриваємо медіа-бібліотеку WP
                    var frame = wp.media({
                        title: 'Виберіть файл для завантаження',
                        button: { text: 'Вставити посилання' },
                        multiple: false
                    });

                    frame.on('select', function() {
                        var attachment = frame.state().get('selection').first().toJSON();
                        // Вставляємо у редактор посилання для скачування
                        editor.insertContent(
                            '<a href="' + attachment.url + '" download>' +
                            (attachment.title || 'Завантажити файл') +
                            '</a>'
                        );
                    });

                    frame.open();
                }
            });
        }
    });
    tinymce.PluginManager.add('my_download_btn', tinymce.plugins.my_download_btn);
})();