socket.on("returnNotification",function(data){
    var count =$('.count-notification').text();
    var title= document.title;

    if(count){
      var strfind= "("+count+")";
        title=title.slice(strfind.length);
        count=parseInt(count)+1;
    }else{
        count=1;
    }

    $('.count-notification').text(count).show();
    document.title="("+count+") "+title;

    if (!("Notification" in window)) {
        alert("This browser does not support desktop notification");
    }

    // Let's check if the user is okay to get some notification
    else if (Notification.permission === "granted") {
        // If it's okay let's create a notification
        var options = {
            body: "This is the body of the notification",
            icon: "icon.jpg",
            dir : "ltr"
        };
        var notification = new Notification("Hi there",options);
        notification.onclick = function () {
            notification.close();
            window.open("http://stackoverflow.com/");
        };
    }
});

socket.on("returnReadNoti",function(data){
    console.log('ádf');
    //var count =$('.count-notification').text();
    //var title= document.title;
    //
    //if(count){
    //    var strfind= "("+count+")";
    //    title=title.slice(strfind.length);
    //    count=parseInt(count)+1;
    //}else{
    //    count=1;
    //}
    //
    //$('.count-notification').text(count).show();
    //document.title="("+count+") "+title;
});