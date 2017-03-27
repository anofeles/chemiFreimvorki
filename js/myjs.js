/*$(".teq").change(function () {
    var sid = $(this).val();
    if(sid == 1){
        $(".pcseting").show();
        $(".leptopseting").hide();
    }
    else if(sid == 2){
        $(".leptopseting").show();
        $(".pcseting").hide();
    }
    else {
        $(".leptopseting").hide();
        $(".pcseting").hide();
    }
});
*/


    // bind change event to select
    $('.dynamic_select').on('change', function () {
        var url = $(this).val();
        if (url) {
            window.location = url; 
        }
        return false;
    });

    $('#grant').on('click',function () {
        var grid = $(this).val();

       /* var arr = { gridi: grid };
        $.ajax({
            url: 'Ajax.ashx',
            type: 'POST',
            data: JSON.stringify(arr),
            contentType: 'application/json; charset=utf-8',
            dataType: 'json',
            async: false,
            success: function(msg) {
                alert(msg);
            }
        });*/
    });
