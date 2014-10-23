function fixGrammar(selector, qty) {
    if(qty == 1) {
        $(selector).each(function() {
            var value = $(this).attr('value').replace('-', ' ');
            $(this).html(value);
        });
    } else {
        $(selector).each(function() {
            var value = $(this).attr('value').replace('-', ' ');
            $(this).html(value + (value.slice(-1) == 's' ? 'es' : 's'));
        });
    }
}