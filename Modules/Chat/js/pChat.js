$(document).ready(function () {
    $(".privateChat").click(function () {
        var id = $(this).data("value");
        var sendData = "_token=" + "{{ csrf_token() }}" + "&" + "id=" + id;
        var url = 'chat/privateMessages';
        $.ajax({
            url: url,
            type: 'post',
            data: sendData,
            success: function(data)
            {
                alert(data);
            }
        });
    });
});