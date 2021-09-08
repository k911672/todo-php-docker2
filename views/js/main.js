
$(function(){
    $("#checkbox").click(function(event){
        let status = $("#checkbox").val();
        let todo_id = $('li.todo').index();
        $.ajax({
            type: "POST",
            url: "../api/statusUp.php",
            data:{"status" : status, "todo_id" : todo_id },//todo_idを一旦１にする。
            dataType: "json"
        })
        // Ajaxリクエストが成功した場合
        // .done(function(data){
        //     if(data.result === "1") {
        //         $("#checkbox").prop('checked', true);
        //         $("#checkbox").closest("li").css("text-decoration", "line-through");
        //     }
        //     if(data.result === "0") {
        //         $("#checkbox").prop('checked', false);
        //         $("#checkbox").closest("li").css("text-decoration", "none");
        //     }
        // })
        .done(function(data){
            alert(data.result);
        })
        // Ajaxリクエストが失敗した場合
        .fail(function(XMLHttpRequest, textStatus, errorThrown){
            alert(errorThrown);
        });
    })
});
