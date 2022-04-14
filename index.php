
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"><link href="assets/css/reset.css" rel="stylesheet" type="text/css">
<link href="assets/css/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<title>Chat Box</title>
</head>
<body>
<div id="container">
	<div class="header">
		<h6>CHAT DU STREAM</h6>
	</div>
    
	<div class="main">
		
    
	<div id="chatlogs">
    	LOADING CHATLOGS, PLEASE WAIT...
    </div>
    <form name="form1" id="form1" >
        <input type="text" id="message" name="msg" placeholder="Your message here...">
    </form>
	<div class="pull-right">
		<button class="btn " id="cadeau" data-toggle="popover" title="Cadeaux" data-container="body" data-placement="left" ><i class='fa fa-gift'></i></i></button>
		<button class="btn " id="setting" data-toggle="popover" title="Setting" data-container="body" data-placement="top" ><i class="fa fa-cog"></i></button>
		
	</div>
	</div>
	<div class="get-gift d-none">
		<div class="gift"></div>
		<button type="button" class="btn btn-default btn-sm" onclick="location.href='https:/\/\www.sixpence.tv/fr/portefeuille?pageask=wallet&idboutique=10';">RECHARGER</button>
	</div>
	<div id="list-popover" class="d-none">
	<ul class="list-group list-group-flush">
		<li class="list-group-item " style="cursor: pointer;" id="getun" data-toggle="popover" data-container="body" data-placement="right">Username setting </li>
		<li class="list-group-item " style="cursor: pointer;">text setting </li>
	</ul>
	</div>
	<div class="usernm d-none">
		<input type="text" name="usename" id="getusename" >
		<input type="color" name="text-color" id="">
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
<script>
	var uid="116fb54a-cae8-4bbe-9511-84e80ade8f1b";
	var username="salomon"
</script>
<script src="assets/js/main.js?v=<?=time()?>"></script>
</body>
</html>