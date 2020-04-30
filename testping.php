<?php
header('Content-Type: application/json');
$telegrambot='12312312321:sdsdsdssdsdsdsd'; #masukkan token api bot telegramnya
$telegramchatid='1231231231232'; #masukkan chat id bot telegramnya

#change the host
$host="indolink.id"; 

exec("ping -c 4 " . $host, $output, $result);
function telegram($msg) {
        global $telegrambot,$telegramchatid;
        $url='https://api.telegram.org/bot'.$telegrambot.'/sendMessage';$data=array('chat_id'=>$telegramchatid,'text'=>$msg);
        $options=array('http'=>array('method'=>'POST','header'=>"Content-Type:application/x-www-form-urlencoded\r\n",'content'=>http_build_query($data),),);
        $context=stream_context_create($options);
        $result=file_get_contents($url,false,$context);
        return $result;
}

$pingsend=json_encode($output, JSON_PRETTY_PRINT);

if  ($result == 0) {
    telegram ("$host is Alive/Recovered❤
    $pingsend
    GREAT!!");
}
    elseif(strpos($pingsend, 'unreachable') !== false) 
{
    telegram ("$host in problem connection!!!❓
    $pingsend
    Please Check the device connection.");
}

    elseif(strpos($pingsend, 'filtered') !== false)
{
    telegram ("Network Failed!⚰
    $pingsend
    Please check your network connection.");
}
else
{
    telegram ("$host is not exist on the internet!!!☠ 
    $pingsend
    Please check this domain status.");
}

?>
