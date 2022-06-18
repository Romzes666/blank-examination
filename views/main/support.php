<div class="support-page">
    <div class="supportContainer">
        <h3>Опишите свою проблему</h3>
        <form method="post" id="support-form">
            <textarea id="text-problem"></textarea>
            <input hidden readonly name="user_id_supp" id="user_id_supp" value="1" class="form-control"/>
            <input type="hidden" name="action" id="hidden_action" value="Отправить" />
            <button type="submit" id="support-send" class="btn">Отправить</button>
        </form>
    </div>
</div>
<script>
    let user_id = $('#user_id_supp').val();
    $('#support-form').parsley();
    $('#support-form').on('submit', function(event){
        event.preventDefault();
        let textProblem = $('#expert_name').val();
        if($('#support-form').parsley().validate())
        {
            $.ajax({
                url:"/user_ajax_action.php",
                method:"POST",
                data:{action:'support_user', page:'support', user_id: user_id, textProblem:textProblem},
                dataType:"json",
                beforeSend:function(){
                    $('#support-send').attr('disabled', 'disabled');
                    $('#support-send').val('Подождите...');
                },
                success:function(data)
                {
                    if(data.success)
                    {
                        $('#message').html('<div class="alert alert-success">'+data.success+'</div>');
                        $('#expert_name').val('')
                        $('#sendExpertModal').modal('hide');
                    }
                    $('#support-send').attr('disabled', false);
                    $('#support-send').val($('#hidden_action').val());
                }
            });
        }
    });
</script>
