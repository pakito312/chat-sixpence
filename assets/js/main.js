var lastid=0;
$(document).ready(function(){

	fetch_message();
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
		var modal_content = `<br /><span class="uname">${username}</span>:
								<span class="msg">${message}</span><br />`;
		$('#chatlogs').append(modal_content);
	}

	$('#message').keypress(function (e) {
		console.log(e)
		if (e.which == 13) {
		  $('form#form1').submit();
		  return false;    //<---- Add this line
		}
	  });

	$('.send_chat').on('click', function(e){
		e.preventDefault();
		console.log('ici')
		var chat_message = $('#message').val();
		if(chat_message != '')
		{
			$.ajax({
				url:`traitement.php?action=add&uid=${uid}`,
				method:"POST",
				data:{username:username, message:chat_message},
				dataType: "json",
				success:function(data)
				{
					var element = $('#message').emojioneArea();
					element[0].emojioneArea.setText('');
					
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
			dataType: "json",
			success:function(data){
				for (let index = 0; index < data.length; index++) {
					var info = data[index];
					make_chat_dialog_box(info.username, info.message);
				}
				let n=data.length;
				if(data[n-1]!=undefined){
					lastid=data[n-1].id;
				}
			}
		})
	}

	
	

	



	
});  