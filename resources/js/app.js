require('./bootstrap');

$(function() {
    $.ajaxSetup({
        headers: {
            "X-CSRF-Token": document.querySelector("meta[name='csrf-token']").getAttribute("content")
        }
    });
});

window.deleteEntity = function (route, event, meessage = null, redirectUrl = null) {
    event.preventDefault();
    if(!meessage){
        meessage = 'Delete ?'
    }

    if (confirm(meessage)) {
        $.ajax({
            url: route,
            type: 'DELETE',
            success: function (result) {
                if (result.success === true) {
                    alert(result.message);
                    if (!redirectUrl) {
                        location.reload();
                        return;
                    }

                    window.location.href = redirectUrl;
                } else {
                    alert('ERROR. Try again or contact admin');
                }
            }
        }).fail(function (err) {
            alert('ERROR. Try again or contact admin');
        });
    }
}
