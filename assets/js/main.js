$( document ).ready(function() {

    tinymce.init({
        setup : function(ed){
             ed.on('submit', function(e){
                // e.preventDefault();
                // if (460 > ed.plugins.wordcount.getCount())
                // {
                //     alert('Nombre de mots insuffisant');
                // }
                // if (1130 < ed.plugins.wordcount.getCount())
                // {
                //     alert('Nombre de mots trop grand');
                // }
             });
        },
        selector: '.wysiwyg',
        plugins: "wordcount"
    });
});
