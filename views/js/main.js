$(function(){
    $('input[name="check[]"]').change(function(){
        let status = "1";
        let checkStatus = $(this).is(":checked");
        let todo_id = $(this).attr('id');

        if(checkStatus === true) {
            status = "2";
        } else {
            status = "1";
        };
        $.ajax({
            type: "POST",
            url: "../api/statusUp.php",
            data:{"status" : status, "todo_id" : todo_id },
            dataType: "json"
        }).done(function (data) {
            if(data.result === "success"){
                $('.msg').text(data.msg);
                if(data.todo.status == "2"){
                    $('#' + data.todo.todo_id).parent().css("text-decoration","line-through");
                } else {
                    $('#' + data.todo.todo_id).parent().css("text-decoration", "none");
                };
            } else if(data.result === "fail"){
                $('.msg').text(data.msg);
            }
        }).fail(function (XMLHttpRequest, textStatus, errorThrown) {
            alert(errorThrown);
        })
    });
});

$(function(){
    $('button[name="delete[]"]').click(function(){
        let delete_at = "1";
        let todo_id = $(this).attr('id');

        $.ajax({
            type: "POST",
            url: "../api/deleteTodo.php",
            data:{"delete_at" : delete_at, "todo_id" : todo_id },
            dataType: "json"
        }).done(function (data) {
            if(data.result === "success"){
                alert(data.msg);
                window.location.reload();
            } else if(data.result === "fail"){
                alert(data.msg);
            }
        }).fail(function (XMLHttpRequest, textStatus, errorThrown) {
            alert(errorThrown);
        })
    });
});
