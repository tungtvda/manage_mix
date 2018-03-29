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