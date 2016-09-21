$( document ).ready(function() {

    tinymce.init({
        // setup : function(ed){
        //      ed.on('submit', function(e){
        //         if (0 === ed.getContent().length)
        //         {
        //             console.log(this);
        //             e.preventDefault();
        //             alert('Le corps ne peut rester vide');

        //             return false;
        //         }
        //      });
        // },
        selector: '.wysiwyg'
    });
});
