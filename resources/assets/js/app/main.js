$(document).ready(function(){

    if($('div.testimonies')) {
        var how_many = $('div.testimonies blockquote').length;
        var random_quote = Math.floor(Math.random()*how_many);
        $('.testimonies blockquote').hide();
        $('.testimonies blockquote').eq(random_quote).fadeIn();
    }

    var replaceURLWithHTMLLinks = function(text) {
        var exp = /(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig;
        return text.replace(exp,"<a target='_blank' href='$1'>$1</a>");
    }



    if($('div.sites div.site').length) {
        $('div.sites div.site').each(function(){
            var text = $(this).html();
            var fixed = replaceURLWithHTMLLinks(text);
            $(this).html(fixed);
        });
    };

    if($('div.sites div.site-ignore').length) {
        $('div.sites div.site-ignore').each(function(){
            $('a', this).text('http://javascript.example.com');
        });
    };

    $("img.lazy").lazyload();
});