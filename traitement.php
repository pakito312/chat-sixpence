<?php
require_once 'config/Validation.php';
require_once 'config/request.php';
$query = new Query();
$val = new Validation();
if (isset($_GET['action']) && $_GET['action'] == "add") {
    $message = isset($_POST['message']) ? strip_tags($_POST['message']) : null;
    $username = isset($_POST['username']) ? strip_tags($_POST['username']) : null;
    $uid=strip_tags($_GET['uid']);
    $val->name('text')->value($message)->required();
    $val->name('text')->value($username)->min(4)->required();
    if ($val->isSuccess()) {
        $date=date_create(date("Y-m-d H:i:s"));
        $data=[
            'uid'=>$uid,
            'message'=>$message,
            'username'=>$username,
            'created_at'=>date_format($date,"Y-m-d H:i:s")
        ];
        $query->save('messages',$data) ;
        echo  json_encode($data);exit;
    }
}
if(isset($_GET['action']) && $_GET['action'] == "get"){
    $uid=strip_tags($_GET['uid']);
    $lastid=strip_tags($_GET['lastid']);
    $messages=$query->getMessage($uid,$lastid);
    $data=[];
    foreach ($messages as $row) {
        $data[]=[
            'id'=>$row->id,
            'message'=>$row->message,
            'username'=>$row->username
        ];
    }
    echo  json_encode($data);exit;
}

if(isset($_GET['action']) && $_GET['action'] == "cadeau"){
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://www.sixpence.tv/assets_dibona/fonctions/Produits_site.php?action=listProduit&idpage=boutique&idcat=2&idetiq=0&idproduit=0');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"CL_CODE\":\"500100\",\"CL_PASS\":802140}");

    $headers = array();
    $headers[] = 'Content-Type: application/json';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    echo$result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
}