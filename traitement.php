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
        $data=[
            'uid'=>$uid,
            'message'=>$message,
            'username'=>$username
        ];
        $query->save('messages',$data) ;
        echo  json_encode($data);exit;
    }
}
if(isset($_GET['action']) && $_GET['action'] == "get"){
    $uid=strip_tags($_GET['uid']);
    $lastid=strip_tags($_GET['uid']);
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
