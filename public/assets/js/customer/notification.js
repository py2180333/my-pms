function sendMarkAsRead(id = null){
    return fetch("/customer/mark-as-read", {
        method: 'POST',
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            id: id
        })
    })
    .catch(error => console.error(error));
}

$(function() {
    $('.mark-as-read').on('click', function(e) {
        let request = sendMarkAsRead($(this).data('id'));

        request.then(() => {
            $(this).parents('li.notification-message').remove();
            let count = parseInt($('#notification-count').text()) - 1;
            $('#notification-count').text(count);
        });
    });

    $('#mark-all-as-read').on('click', function(e) {
        let request = sendMarkAsRead();

        request.then(() => {
            $('li.notification-message').remove();
            $('#notification-count').text('0');
        });
    });
});