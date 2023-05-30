$(document).ready(function (){
    $('body').on('submit', '.tag-form', function(){
        $.post(
            $('.tag-form').attr('action'),
            $(this).serialize(),
            function(html) {
                $('section').html(html).animate({height: 'show'}, 1000);
            });
        return false;
    });
    $('#form-data').on('beforeSubmit', function(){
        $.post(
            $(this).attr('action'),
            $(this).serialize(),
            function(html) {
                $('.output').html(html).animate({height: 'show'}, 1000);
            });
        return false;
    });
    $('#card-form').on('beforeSubmit', function(){
        $.post(
            $(this).attr('action'),
            $(this).serialize(),
            function(html) {
                $('.content > .card').html(html).animate({height: 'show'}, 1000);
            });
        return false;
    });
    $('.ajax').on('click', function(event){
        event.preventDefault();
        $.get(
            $(this).attr('href'),
            function(html) {
                $(".tab-content").html(html).animate({height: 'show'}, 1000);
            });
    });

});
