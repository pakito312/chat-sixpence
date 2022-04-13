$(document).ready(function(){

	fetch_message();
	var lastid=1;
	setInterval(function(){
		fetch_message();
	}, 5000);
	$('#message').emojioneArea({
		pickerPosition:"top",
		toneStyle: "bullet",
		search: false,
		inline: true
	   });
	
	function make_chat_dialog_box(username, message)
	{
		var modal_content = `<span class="uname">${username}</span>:
								<span class="msg">${message}</span>`;
		$('#chatlogs').append(modal_content);
	}

	

	$('.send_chat').on('click', function(){
		var to_user_id = $(this).attr('id');
		var chat_message = $.trim($('#chat_message_'+to_user_id).val());
		if(chat_message != '')
		{
			$.ajax({
				url:`traitement.php?action=add&uid=${uid}`,
				method:"POST",
				data:{username:to_user_id, message:chat_message},
				success:function(data)
				{
					var element = $('#chat_message_'+to_user_id).emojioneArea();
					element[0].emojioneArea.setText('');
					make_chat_dialog_box(data.username, data.message);
				}
			})
		}
		else
		{
			alert('Type something');
		}
	});

	function fetch_message()
	{
		$.ajax({
			url:`traitement.php?action=get&uid=${uid}&lastid=${lastid}`,
			method:"POST",
			success:function(data){
				for (let index = 0; index < data.length; index++) {
					const info = data[index];
					make_chat_dialog_box(info.username, info.message);
				}
			}
		})
	}


	

	



	
});  