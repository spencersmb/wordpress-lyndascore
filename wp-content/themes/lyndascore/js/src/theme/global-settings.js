jQuery(document).ready(function($){
    $('.search-toggle').click(function(event){
        $("#search-container").slideToggle('slow', function(){
            $('.search-toggle').toggleClass('active');
        });
    });
});