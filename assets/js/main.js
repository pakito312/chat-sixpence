var lastid=0;
$(document).ready(function(){
	fetch_cadeau()
	fetch_message();
	setInterval(function(){
		fetch_message();
	}, 5000);
	$('#message').emojioneArea({
		pickerPosition:"top",
		toneStyle: "bullet",
		search: false,
		inline: true,
		events: {
            keyup: function (editor, event) {
                if(event.which == 13){
                    
                    if(event.shiftKey) {
                        // With shift
                    }else {
                        event.preventDefault(); 
                        sendMessage();
                    }
                }
            },
			input:function (editor, event) {
                if(event.which == 13){
                    
                    if(event.shiftKey) {
                        // With shift
                    }else {
                        event.preventDefault(); 
                        sendMessage();
                    }
                }
            }
        }
	   });
	$('#getusename').emojioneArea({
		pickerPosition:"top",
		toneStyle: "bullet",
		search: false,
		inline: true,
		events: {
			keyup: function (editor, event) {
                if(event.which == 13){
                    
                    if(event.shiftKey) {
                        // With shift
                    }else {
                        event.preventDefault(); 
                        
                    }
                }
            },
		}
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

	function sendMessage(e){
		var chat_message = $('#message').data("emojioneArea").getText().trim();
		console.log(chat_message)
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
	}

	function fetch_message()
	{
		$.ajax({
			url:`traitement.php?action=get&uid=${uid}&lastid=${lastid}`,
			method:"GET",
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
	
	function fetch_cadeau()
	{
		$.ajax({
			url:`traitement.php?action=cadeau`,
			method:"GET",
			dataType: "json",
			success:function(response){
				for (let index = 0; index < response.data.length; index++) {
					var info = response.data[index];
					listcadeau(info)
				}
				
			}
		})
	}

	$("#setting").popover({
		html: true, 
		content: function() {
			  return  $('#list-popover').html();
			}
	});
	$("#getun").popover({
		html: true, 
		content: function() {
			  return  $('.usernm').html();
			}
	});
	
	$("#cadeau").popover({
		html: true, 
		content: function() {
			  return $('.get-gift').html();
			}
	});
	
	function listcadeau(params) {
		$('.gift').append(`
		<div class="col-3 col-sm-4 col-md-3 col-lg-3 col-xxl-3 un_article">
			<img class="image_produit img-fluid btn-addcart" src="https://www.sixpence.tv/images_content/produits/image-produits_${params.idprod}.png" data-idprod="${params.idprod}">
			<p class="titre_produit text-xs-left float-xs-left">${params.nom_prod}</p>
			<p class="prix_produit text-xs-right float-xs-right">${params.prix_prod}Pt</p>
			<p class="description_produit float-left"></p>
			<div style="clear: both;"></div>
		</div>
		`)
	}
	



	
});  