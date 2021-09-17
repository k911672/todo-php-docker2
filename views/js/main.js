
$(function(){
    $('input[name="check[]"]').change(function(){
        let status = "1";
        let checkStatus = $(this).is(":checked");
        let todo_id = $(this).attr('id');

        if(checkStatus === true) {
            status = "2";
        } else {
            status = "1";;
        };
        $.ajax({
            type: "POST",
            url: "../api/statusUp.php",
            data:{"status" : status, "todo_id" : todo_id },
            dataType: "json"
        }).done(function (data) {
            console.log(data.result);
            if(data.todo.status === "2"){
                $('#' + data.todo.todo_id).parent().css("text-decoration","line-through");
            } else {
                $('#' + data.todo.todo_id).parent().css("text-decoration", "none");
            };
        }).fail(function (XMLHttpRequest, textStatus, errorThrown) {
            alert(errorThrown);
        })
    });
});
