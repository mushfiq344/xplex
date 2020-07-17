function commentFunc(){

    $type = $('#container').attr("elemType");
    $id = $('#container').attr("elemId");
    $value = $('#commentText').val();

    $.ajax({
        type: 'GET',
        url:  '/ajax_comment/'+$type+'/'+$id+'/'+$value,
        data: '_token = <?php echo csrf_token() ?>',
        success: function (data) {

            console.log(data);


            if (data == "unlogged"){


                alert("You are not logged in!");

            }

            else {

                $('#commentList').prepend('                                <li>\n' +
                    '                                    <article>\n' +
                    '                                        <div class="comment-cont clearfix">\n' +
                    '                                            <a class="comment-author h4" href="#!"> Username:' + data.username + '</a>\n' +
                    '                                            <div class="date">\n' +
                    '                                                <i class="fa fa-calendar"></i> ' + data.created_at + '\n' +
                    '                                            </div>\n' +
                    '                                            <div class="comment-text">' + data.comment_message + '\n' +
                    '                                            </div>\n' +
                    '                                        </div>\n' +
                    '                                    </article>\n' +
                    '                                </li>')


                $('#commentText').val("");
            }

        }
    });
    return false;
}