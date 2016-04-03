$(function () {
    // При выборе Кода события изменяем список доступных переменных в шаблоне
    $('#notificationtemplate-event_code').change(function () {
        $('div.field-notificationtemplate-body .hint-block span').html(bodyHints[$(this).val()].join(' '));
    });
});
