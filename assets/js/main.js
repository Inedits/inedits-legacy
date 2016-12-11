$( document ).ready(function($) {

    tinymce.init({
        setup : function(ed){
             ed.on('submit', function(e){
                if ($('#app_post_new_file').prop('files').length === 0) {
                    if (460 > ed.plugins.wordcount.getCount())
                    {
                        e.preventDefault();
                        alert('Nombre de mots insuffisant');
                    }
                    if (1130 < ed.plugins.wordcount.getCount())
                    {
                        e.preventDefault();
                        alert('Nombre de mots trop grand');
                    }
                }
             });
        },
        selector: '.wysiwyg',
        plugins: "wordcount"
    });
});
