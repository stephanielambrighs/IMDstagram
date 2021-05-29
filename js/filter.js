$("#filter").on('change', function(){
    $('.image-filter').removeClass().addClass('avatar img-thumbnail image-filter').addClass($(this).find(':selected').attr('data-class'));
});