(function() {

    /* side nav transitions */

    $('#button').on('click', function() {
        $('#content').toggleClass('isOpen');
        $(this).toggleClass('active');
    });

})();