/**
 * SiteSoft test task routine
 */
(function(){
    var section = $('div.container').find('section.main'),
        form = section.find('form').first(),
        textArea = form.find('textarea').first(),
        messageContainer = section.find('div.messages');

    function parseResponse( data , status)
    {
        if ( 'success' !== status ) {
            return;
        }

        var response = $.parseJSON(data);

        if ( response.errors ) {
            textArea.parent()
                .addClass('has-error')
                .end()
                .siblings('p.help-block')[0].innerHTML = response.content;
            return;
        } else {
            textArea.parent()
                .removeClass('has-error')
                .end()
                .siblings('p.help-block')[0].innerHTML = '';
        }

        messageContainer[0].innerHTML = response.content;
    }

    form.on('submit', function( e ){
        e.preventDefault();

        var message = textArea[0].value;

        textArea[0].value = '';

        $.post(
            form.attr('action'),
            {
                "MessageForm[message]": message,
                _csrf: form.find('input[name=_csrf]')[0].value
            },
            parseResponse
        );
    })
})();

