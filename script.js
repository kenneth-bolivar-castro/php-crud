$(function(){

    $.get('comments.php', function(data){
        var response = JSON.parse(data);
        $.each(response, function(k, v) {
            var $div = $('<div></div>');
            $div.text(v);
            $('div#messages').append($div);
        });
    });

    $('a#hide-messages').click(function(e){
        e.preventDefault();

        $('div#messages').toggle('slow');
    });

    $('button').click(function() {
        var text = $('div#comments').text();
        if(text.length) {
            $.ajax({
                method: 'POST',
                url: 'endpoint.php',
                data: { 'comment': text }
            }).done(function(data) {
                var response = JSON.parse(data);
                if('saved' === response.status) {
                    $('div#comments').text(null);
                    alert('Commented stored.');
                }
            });
        }
    });
});
