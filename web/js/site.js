var init = function () {
    // При выборе Кода события изменяем список доступных переменных в шаблоне
    $('#notificationtemplate-event_code').change(function () {
        $('div.field-notificationtemplate-body .hint-block span').html(bodyHints[$(this).val()].join(' '));
    });

    //Пометить уведомление как прочитанное
    $('.close.notification-review').click(function () {
        $.post('/notification/review', {'id': $(this).data('id')}).done(function () {
            $.pjax.reload({container:'#notification-container'});
        });
    })
};

$(function () {
    init();
});

$(document).on('pjax:complete', function() {
    init();
});
