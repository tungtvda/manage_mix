notifyMe();
function notifyMe() {
    console.log(Notification.permission);
     if (Notification.permission !== 'denied') {

        Notification.requestPermission(function (permission) {
            if (!('permission' in Notification)) {
                Notification.permission = permission;
            }
        });
    }
    //if (Notification.permission !== "granted") {
    //    Notification.requestPermission()
    //        .then(function() {});
    //};

    // At last, if the user already denied any notification, and you
    // want to be respectful there is no need to bother them any more.
}