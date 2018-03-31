notifyMe();
function notifyMe() {


     if (Notification.permission !== 'denied') {
        Notification.requestPermission(function (permission) {
            // Whatever the user answers, we make sure we store the information
            if (!('permission' in Notification)) {
                Notification.permission = permission;
            }
        });
    }

    // At last, if the user already denied any notification, and you
    // want to be respectful there is no need to bother them any more.
}