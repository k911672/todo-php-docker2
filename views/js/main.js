
$(function(){
    $("#checkbox").click(function(event){
        let status = $("checkbox").val();
        $.ajax({
            type: "GET",
            url: "../api/statusUp",
            data:{"status" : status},
            dataType: "json"
        })
        // Ajaxリクエストが成功した場合
        .done(function(data){
            if ($(checkbox).is(":checked")) {
                $(checkbox).closest("p").css("text-decoration", "line-through");
                data.status = "1"
            } else {
                $(this).closest("p").css("text-decoration", "none");
                data.status = "0"
            }
        })
        // Ajaxリクエストが失敗した場合
        .fail(function(XMLHttpRequest, textStatus, errorThrown){
            alert(errorThrown);
        });
    });
});