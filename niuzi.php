<?php
ini_set("error_reporting","E_ALL & ~E_NOTICE");
$con=mysqli_connect("localhost","api_user_lxyddic","cWn3dBbAFyyhyFA2","api_user_lxyddic");
// 检测连接
if ($con->connect_error) {
    die("连接失败: " . $conn->connect_error);
}




$timeday=date("ymd");
$timehour=date("ymdh");
$timemin=date("ymdhi");
$timenow=time();
$qq=$_POST["uid"];
$qq2=$POST_["uid2"];
$lx=$_POST["lx"];
$name=$_POST["name"]






/*强制刷新数据*/;
if ($lx=="get"){
$result = mysqli_query($con,"SELECT * FROM niuzi WHERE qq='$qq'");
$num = mysqli_num_rows($result);
 //获取行数
if ($num == '1'){
echo "你已经有牛子了，不能再获取";
$con->close();
exit();
    }else{
$niuzi=16;
$name = htmlspecialchars($name);
$stmt = $con->prepare("INSERT INTO niuzi (qq, name, niuzi) VALUES (?, ?, ?)");
$stmt->bind_param("dsd", $qq, $name, $niuzi);
$stmt->execute();
    echo "你获得了一根牛子！它的长度是16cm";
    exit();
}}
$result = mysqli_query($con,"SELECT * FROM niuzi WHERE qq='$qq'");
$num = mysqli_num_rows($result);
 //获取行数
if ($num != '1'){
    echo "你没有获取牛子，请输入/nzget获取";
    $con->close();
    exit();
}else{
    while($row = mysqli_fetch_array($result)){
        $ban=$row['ban'];
        $joy=$row['joy'];
        $cd=$row['cd'];
        $sx=$row['suoxuets'];
    }
    if ($cd<0){
        mysqli_query($con,"UPDATE niuzi SET ban='1' WHERE qq='$qq'");
    }
    if ($cd>0 and $ban!="2"){
        mysqli_query($con,"UPDATE niuzi SET ban='0' WHERE qq='$qq'");
    } elseif($sx<$timenow and $ban !="1"){
        mysqli_query($con,"UPDATE niuzi SET ban='0' WHERE qq='$qq'");
    }
    if ($qq2!=""){
        $result = mysqli_query($con,"SELECT * FROM niuzi WHERE qq='$qq2'");
        $num = mysqli_num_rows($result);
        if ($num == '1'){
            while($row = mysqli_fetch_array($result)){
            $ban=$row['ban'];
            $joy=$row['joy'];
            $cd=$row['cd'];
            }
            if ($cd<0){
                mysqli_query($con,"UPDATE niuzi SET ban='1' WHERE qq='$qq2'");
            }
                if ($cd>0 and $ban!="2"){
                    mysqli_query($con,"UPDATE niuzi SET ban='0' WHERE qq='$qq2'");
                }elseif($sx<$timenow and $ban !="1"){
                    mysqli_query($con,"UPDATE niuzi SET ban='0' WHERE qq='$qq'");
                }
        }
    }
}


$result = mysqli_query($con,"SELECT * FROM niuzi WHERE qq='$qq'");

$num = mysqli_num_rows($result);
 //获取行数
if ($num == '1'){
$have=1;
while($row = mysqli_fetch_array($result))
{
    $ban=$row['ban'];
    $joy=$row['joy'];
}
}else{
    exit();
    
}
if ($lx=="jh"){
$result = mysqli_query($con,"SELECT * FROM niuzi WHERE qq='$qq'");
while($row = mysqli_fetch_array($result))
{
    $ban=$row['ban'];
    $joy=$row['joy'];
    if ($ban==2) {
        mysqli_query($con,"UPDATE niuzi SET ban='0' WHERE qq='$qq' ");
        echo "你决定破戒";
        exit();
    } 
     if ($ban==0) {
     mysqli_query($con,"UPDATE niuzi SET ban='2' WHERE qq='$qq' ");
     $joy=$joy-1;
     mysqli_query($con,"UPDATE niuzi SET joy='$joy' WHERE qq='$qq' ");
     $ts=time();
     $js=$ts+64800;
     mysqli_query($con,"UPDATE niuzi SET suoxuets='$js' WHERE qq='$qq' ");
     $js=date("Y-m-d H:i:s",$js);
        echo "你决定戒欲，愉悦值-1，该阶段将在".$js."强制结束";
        exit();
    }
     if ($ban==1) {
        echo "修改失败，原因是你已经被封禁了";
    }
}}

if ($ban==2){
    echo "你正在静心戒欲，输入/nzjh来结束";
    exit();

}
if ($have==1){
    
if ($lx=="info"){
    $result = mysqli_query($con,"SELECT * FROM niuzi WHERE qq='$qq'");

while($row = mysqli_fetch_array($result))
{
 $jsl=$row['joy']*0.35;
    $zjl=$row['joy']*0.48;
    $joy=$row['joy'];
    $djxh=$joy*0.84;
    $ban=$row['ban'];
    $niuzi=$row['niuzi'];
    $name=$row["name"];
    $qq=$row["qq"];
    echo "名字：".$name."[".$qq."]\n";
    echo "长度：".$niuzi."cm";
    echo "\n";
    echo "愉悦值：".$row['joy'];
    echo "\n";
    if ($joy>=0) {
    echo "当前效果：pk失败与嗦牛子缩短量与-".$jsl."%，贴贴与签到增加量+".$zjl."%，打∠消耗量+".$djxh."%";
    if ($ban==1) {
        echo "\n由于牛子长度小于0，您已被封禁，请期待后续更新，感谢支持！";
    }
    } else {
    echo "当前效果：pk失败缩短量+".-$jsl."%，贴贴与签到增加量".$zjl."%，打∠消耗量-".-$djxh."%";
    if ($ban==1) {
        echo "\n由于牛子长度小于0，您已被封禁，请期待后续更新，感谢支持！";
    }}}}
    if ($lx=="qd"){
$result = mysqli_query($con,"SELECT * FROM niuzi WHERE qq='$qq'");
while($row = mysqli_fetch_array($result))
{
    if ($row['qd']==$timeday) {
    echo "你今天已经吃过强壮药丸了";
    } else {
        $result = mysqli_query($con,"SELECT * FROM niuzi WHERE qq='$qq'");
    while($row = mysqli_fetch_array($result))
    {
         $niuzi = $row['niuzi'];
         $joy=$row['joy'];
         $zjl=$joy*0.0048;
         $ewniuzi=0;
         if ($niuzi<8){
             $ewniuzi=0.5*8-round($niuzi,2);
         }
         if ($niuzi<0.2){
             $ewniuzi=$ewniuzi*1.5;
             $text="富贵险中求！";
         }
         $ewniuzi=$ewniuzi+1.8;
         $zjl=$ewniuzi*(1+$zjl);
    }
    $niuzi = $niuzi + $zjl;
    $name = $_POST["name"];
    $name = htmlspecialchars($name);
    mysqli_query($con,"UPDATE niuzi SET niuzi='$niuzi' WHERE qq='$qq' ");
    mysqli_query($con,"UPDATE niuzi SET qd='$timeday' WHERE qq='$qq' ");
    $result = mysqli_query($con,"SELECT * FROM dingbotuid WHERE uid='$qq'");
    while($row = mysqli_fetch_array($result))
    {
        $money = $row["money"];
    }
    $moneyc=$money+5;
    mysqli_query($con,"UPDATE dingbotuid SET money='$moneyc' WHERE uid='$qq' ");
    echo $text."你吃下了强壮药丸，长度+".$zjl."cm\n恭喜获得金钱x5";
    }
}}
if ($lx=="dj"){
$result = mysqli_query($con,"SELECT * FROM niuzi WHERE qq='$qq'");
while($row = mysqli_fetch_array($result))
{
 $jsl=$row['joy']*0.35;
    $zjl=$row['joy']*0.48;
    $joy=$row['joy'];
    $djxh=$row['joy']*0.84;
    $ban=$row['ban'];
    $niuzi=$row['niuzi'];
    $name=$row["name"];
    $qq=$row["qq"];
}
    $dajiao=rand(300000000,500000000);
    $dajiao=$dajiao/100000000;
    $dajiao=$dajiao*(1+$djxh/100);
    if ($niuzi>$dajiao){
        $niuzi=$niuzi-$dajiao;
        $joy=$joy+8;
        mysqli_query($con,"UPDATE niuzi SET niuzi='$niuzi' WHERE qq='$qq' ");
        mysqli_query($con,"UPDATE niuzi SET joy='$joy' WHERE qq='$qq' ");
        echo "打∠完成，消耗了".$dajiao."cm，愉悦值+8";
    }else{
        echo $name."，不要再冲了！";
        
    }
}
if ($lx=="zt"){
    $result = mysqli_query($con,"SELECT * FROM niuzi WHERE qq='$qq'");
while($row = mysqli_fetch_array($result))
{
 $jsl=$row['joy']*0.35;
    $zjl=$row['joy']*0.48;
    $joy=$row['joy'];
    $djxh=$row['joy']*0.63;
    $ban=$row['ban'];
    $niuzi=$row['niuzi'];
    $name=$row["name"];
    $qq=$row["qq"];
    $qd=$row["qd"];
    $lq=$row["lq"];
    $tietie=$row["tietie"];
    $ban=$row['ban'];
}
    if ($qd==$timeday){
        echo "每日强壮药丸：完成\n";
    }else{
        echo "每日强壮药丸：未完成\n";
    }
    if ($lq==$timemin){
        echo "对决：正在冷却\n";
    }else{
        echo "对决：精力充沛\n";
    }
    if ($tietie>$timenow){
        echo "贴贴/嗦牛子：疲惫不堪\n";
    }else{
        echo "贴贴/嗦牛子：可以\n";
    }
}
if ($lx=="pk"){
$qq1=$_POST["uid"];
$qq2=$_POST["uid2"];

$have="1";
if (!preg_match("/^[a-zA-Z0-9_]+$/" ,$qq2)){
$text="参数不合法";
$have=0;
}
if ($qq1==$qq2){
    $text="不能与自己pk";
    $have=0;
}
$result = mysqli_query($con,"SELECT * FROM niuzi WHERE qq='$qq1'");
$num = mysqli_num_rows($result);
 //获取行数
if ($num == '1'){
$result = mysqli_query($con,"SELECT * FROM niuzi WHERE qq='$qq1'");
while($row = mysqli_fetch_array($result))
{
    $qq1cd=$row['niuzi'];
    $qq1joy=$row['joy'];
    $lq1=$row['lq'];
    $qq1ban=$row['ban'];
    $qq1bsk=$row['bsk'];
}
    }else{
        $text="你没有获取牛子，输入/nzget以获取";
        $have="0";
    }

$result = mysqli_query($con,"SELECT * FROM niuzi WHERE qq='$qq2'");
$num = mysqli_num_rows($result);
 //获取行数
if ($num == '1'){
$result = mysqli_query($con,"SELECT * FROM niuzi WHERE qq='$qq2'");
while($row = mysqli_fetch_array($result))
{
    $qq2cd=$row['niuzi'];
    $qq2joy=$row['joy'];
    $lq2=$row['lq'];
    $qq2ban=$row['ban'];
    $qq2bsk=$row['bsk'];
}
    }else{
        $text="对方没有获取牛子";
        $have="0";
    }
if ($qq1ban!="0" or $qq2ban!="0" and $have!="0"){
    echo "你或者对方正在戒欲或被封禁，不能pk";
    $have=0;
}
if ($have!="0"){
$t=time();
if ($t>$lq1 and $t>$lq2){
$winnum=rand(0,100);
$num=rand(100000000000,1200000000000);
$num=$num/1000000000000;
$joypk=rand(0,100);

$hournow=date("H");
$twobei=0;
if ($hournow==17){
    $num=$num*1.5;
    $twobei=1;
}

if ($qq1bsk>0 and $winnum<=50){
    $qq1bsk=$qq1bsk-1;
    $winnum=99;
    $text="你这次发挥非常猛，";
}
if ($qq2bsk>0 and $winnum>50){
    $qq2bsk=$qq2bsk-1;
    $winnum=1;
    $text="这次对方卯足了劲，";
}

if ($winnum>50){
    $win="1";
    $qq1cd=$qq1cd+$num;
    $num1=$num-$num*$qq2joy*0.0035;
    $qq2cd=$qq2cd-$num1;
    $text=$text."对决成功，夺得了".$num."cm，对方长度缩短了".$num1;
    if ($joypk>50){
        $qq2joy=$qq2joy-1;
        $text=$text."且愉悦值-1";
    }
}else{
    $win="0";
    $num1=$num-$num*$qq1joy*0.0035;
    $qq1cd=$qq1cd-$num1;
    $qq2cd=$qq2cd+$num;
    $text=$text."对决失败，你损失了".$num1."cm，对方夺得了".$num."cm";
    if ($joypk>50){
        $qq1joy=$qq1joy-1;
        $text=$text."，你的愉悦值-1";
    }
}

if ($twobei==1){
    $te="\n特使时段pk量x1.5！";
}

$text=$text.$te;
mysqli_query($con,"UPDATE niuzi SET niuzi='$qq1cd' WHERE qq='$qq1'");
mysqli_query($con,"UPDATE niuzi SET niuzi='$qq2cd' WHERE qq='$qq2'");
mysqli_query($con,"UPDATE niuzi SET bsk='$qq1bsk' WHERE qq='$qq1'");
mysqli_query($con,"UPDATE niuzi SET bsk='$qq2bsk' WHERE qq='$qq2'");
mysqli_query($con,"UPDATE niuzi SET joy='$qq1joy' WHERE qq='$qq1' ");
mysqli_query($con,"UPDATE niuzi SET joy='$qq2joy' WHERE qq='$qq2' ");
if ($qq1cd<=0){
    mysqli_query($con,"UPDATE niuzi SET ban='1' WHERE qq='$qq1'");
}
if ($qq2cd<=0){
    mysqli_query($con,"UPDATE niuzi SET ban='1' WHERE qq='$qq2'");
}
$t=$t+60;
mysqli_query($con,"UPDATE niuzi SET lq='$t' WHERE qq='$qq1' ");
mysqli_query($con,"UPDATE niuzi SET lq='$t' WHERE qq='$qq2' ");
}else{
echo " 你或者对方牛子已经疲惫不堪了，不能对决！";
}}
echo $text;
}


if ($lx=="tt"){
    $qq1=$_POST["uid"];
    $qq2=$_POST["uid2"];

$have="1";
if (!preg_match("/^[a-zA-Z0-9_]+$/" ,$qq2)){
    $text='参数不合法';
    $code="-4031";
}
if ($qq1==$qq2){
$have=0;
    echo "不能和自己贴贴";
    exit();
}
    $result = mysqli_query($con,"SELECT * FROM niuzi WHERE qq='$qq1'");
    $num = mysqli_num_rows($result);
 //获取行数
if ($num == '1'){
        $result = mysqli_query($con,"SELECT * FROM niuzi WHERE qq='$qq1'");
    while($row = mysqli_fetch_array($result))
    {
        $qq1cd=$row["niuzi"];
        $qq1joy=$row['joy'];
        $tt1=$row['tietie'];
        $qq1ban=$row['ban'];
    }
        }else{
            $text="你没有获取牛子";
            //没有查询出任何数据 说明用户名不存在
            $have="0";
    }

$result = mysqli_query($con,"SELECT * FROM niuzi WHERE qq='$qq2'");
$num = mysqli_num_rows($result);
 //获取行数
if ($num == '1'){
$result = mysqli_query($con,"SELECT * FROM niuzi WHERE qq='$qq2'");
while($row = mysqli_fetch_array($result))
{
    $qq2cd=$row['niuzi'];
    $qq2joy=$row['joy'];
    $tt2=$row['tietie'];
    $qq2ban=$row['ban'];
}
    }else{
        $text="对方没有获取牛子";
        //没有查询出任何数据 说明用户名不存在
        $have="0";
    }
if ($qq1ban!="0" or $qq2ban!="0" and $have!="0"){

    $text="你或者对方正在戒欲或被封禁，不能贴贴";
    $have=0;
}
    if ($have!="0"){
$t=time();
if ($t>$tt1 and $t>$tt2){
    $winnum=rand(0,100);
    $num=rand(150000000000,400000000000);
    $num=$num/1000000000000;
    $joypk=rand(0,100);
    $qq1cda=$num+$num*$qq1joy*0.0048;
    $qq2cda=$num+$num*$qq2joy*0.0048;
    $qq1cd=$qq1cd+$qq1cda;
    $qq2cd=$qq2cd+$qq2cda;
    $text="贴贴成功惹！你的牛子增加了".$qq1cda."cm，对方增加了".$qq2cda."cm";
    mysqli_query($con,"UPDATE niuzi SET niuzi='$qq1cd' WHERE qq='$qq1'");
    mysqli_query($con,"UPDATE niuzi SET niuzi='$qq2cd' WHERE qq='$qq2'");
    mysqli_query($con,"UPDATE niuzi SET joy='$qq1joy' WHERE qq='$qq1' ");
    mysqli_query($con,"UPDATE niuzi SET joy='$qq2joy' WHERE qq='$qq2' ");
if ($qq1cd<=0){
    mysqli_query($con,"UPDATE niuzi SET ban='1' WHERE qq='$qq1'");
}
if ($qq2cd<=0){
    mysqli_query($con,"UPDATE niuzi SET ban='1' WHERE qq='$qq2'");
}
    $t=$t+36000;
    mysqli_query($con,"UPDATE niuzi SET tietie='$t' WHERE qq='$qq1' ");
    mysqli_query($con,"UPDATE niuzi SET tietie='$t' WHERE qq='$qq2' ");
}else{
echo "贴贴/嗦牛子还在冷却中";
}}
echo $text;
}

if ($lx=="ss"){
    $qq1=$_POST["uid"];
    $qq2=$_POST["uid2"];

$have="1";
if (!preg_match("/^[a-zA-Z0-9_]+$/" ,$qq2)){
    $text='参数不合法';
    $code="-4031";
}
if ($qq1==$qq2){
$have=0;
    echo "你的身体不够柔软，不能自己嗦自己牛子（？";
    exit();
}
    $result = mysqli_query($con,"SELECT * FROM niuzi WHERE qq='$qq1'");
    $num = mysqli_num_rows($result);
 //获取行数
if ($num == '1'){
        $result = mysqli_query($con,"SELECT * FROM niuzi WHERE qq='$qq1'");
    while($row = mysqli_fetch_array($result))
    {
        $qq1cd=$row["niuzi"];
        $qq1joy=$row['joy'];
        $tt1=$row['tietie'];
        $qq1ban=$row['ban'];
    }
        }else{
            $text="你没有获取牛子";
            //没有查询出任何数据 说明用户名不存在
            $have="0";
    }

$result = mysqli_query($con,"SELECT * FROM niuzi WHERE qq='$qq2'");
$num = mysqli_num_rows($result);
 //获取行数
if ($num == '1'){
$result = mysqli_query($con,"SELECT * FROM niuzi WHERE qq='$qq2'");
while($row = mysqli_fetch_array($result))
{
    $qq2cd=$row['niuzi'];
    $qq2joy=$row['joy'];
    $tt2=$row['tietie'];
    $qq2ban=$row['ban'];
}
    }else{
        $text="对方没有获取牛子";
        //没有查询出任何数据 说明用户名不存在
        $have="0";
    }
if ($qq1ban!="0" or $qq2ban!="0" and $have!="0"){

    $text="你或者对方正在戒欲或被封禁，不能嗦牛子";
    $have=0;
}
    if ($have!="0"){
$t=time();
if ($t>$tt1 and $t>$tt2){
    $winnum=rand(0,100);
    $num=rand(500000000000,120000000000);
    $num=$num/1000000000000;
    $joypk=rand(0,100);
    $qq1cda=$num-$num*$qq1joy*0.0035;
    $qq2cda=$num+$num*$qq2joy*0.0048*1.8;
    $qq1cd=$qq1cd-$qq1cda;
    $qq2cd=$qq2cd+$qq2cda;
    $qq1joy=$qq1joy+1;
    $qq2joy=$qq2joy+1;
    $text="好吃好吃！你的牛子减少了".$qq1cda."cm，你和对方愉悦值+1，对方增加了".$qq2cda."cm";
    mysqli_query($con,"UPDATE niuzi SET niuzi='$qq1cd' WHERE qq='$qq1'");
    mysqli_query($con,"UPDATE niuzi SET niuzi='$qq2cd' WHERE qq='$qq2'");
    mysqli_query($con,"UPDATE niuzi SET joy='$qq1joy' WHERE qq='$qq1'");
    mysqli_query($con,"UPDATE niuzi SET joy='$qq2joy' WHERE qq='$qq2'");
if ($qq1cd<=0){
    mysqli_query($con,"UPDATE niuzi SET ban='1' WHERE qq='$qq1'");
}
if ($qq2cd<=0){
    mysqli_query($con,"UPDATE niuzi SET ban='1' WHERE qq='$qq2'");
}
    $t=$t+36000;
    mysqli_query($con,"UPDATE niuzi SET tietie='$t' WHERE qq='$qq1' ");
    mysqli_query($con,"UPDATE niuzi SET tietie='$t' WHERE qq='$qq2' ");
}else{
echo "贴贴/嗦牛子还在冷却中";
}}
echo $text;
}
if ($lx=="xg"){
    $cd=$_POST["cd"];
    $qq=$_POST["s"];
    mysqli_query($con,"UPDATE niuzi SET niuzi='$cd' WHERE qq='$qq' ");
    $result = mysqli_query($con,"SELECT * FROM niuzi WHERE qq='$qq'");

while($row = mysqli_fetch_array($result))
{
    $cd=$row['niuzi'];
    if ($cd<=0) {
        mysqli_query($con,"UPDATE niuzi SET ban='1' WHERE qq='$qq' ");
        echo "修改成功";
    } else {
       
    }
    if ($cd>0) {
        mysqli_query($con,"UPDATE niuzi SET ban='0' WHERE qq='$qq' ");
        echo "修改成功";
    } 
}
}
if ($lx=="xj"){
mysqli_query($con,"UPDATE niuzi SET joy='$_POST[joy]' WHERE qq='$_POST[s]' ");
echo "修改成功";
}
if ($lx=="ph"){



$result = mysqli_query($con,"SELECT * FROM niuzi ORDER BY niuzi DESC");

while($row = mysqli_fetch_array($result))
{
    echo "UID：".$row['qq'];
    echo "";
    echo "用户名：".$row['name'];
    echo "；";
    echo "牛子长度：" . $row['niuzi'];
    echo "\n------------\n";
}}
$result = mysqli_query($con,"SELECT * FROM niuzi WHERE qq='$qq'");
while($row = mysqli_fetch_array($result))
{
    if ($lx=="pk" or $lx=="qd" or $lx=="tt" or $lx=="jh" or $lx=="ss"){
        $cd=$row['niuzi'];
        $joy=$row['joy'];
        if ($joy=="0"){
        $cd=$cd-0.5;
        mysqli_query($con,"UPDATE niuzi SET niuzi='$cd' WHERE qq='$qq'");
        echo "\n你的愉悦值太低了，很不开心，牛子长度-0.5cm";
    }}
}


if ($lx=="help"){
    echo "/nzhelp  牛子帮助\n/mynz  我的牛子\n/nzget  获取牛子\n/nzqd  吃下强壮药丸\n/nzdj  打胶\n/nzzt  牛子状态\n/nzpk <uid>  与某人比划比划\n/nztt <uid>  与某人贴贴\n/nzss <uid>  嗦嗦某人的牛子\n/nzwf  牛子游戏新手教程";
}
if ($lx=="wf"){
    echo "与别人交互的指令与uid之间有空格，获取了nz之后记得先打胶，签到的话如果你的nz太短会额外的动态签到量，愉悦值为0后会一直扣长度，嗦牛子共用贴贴的冷却，可以用/shop打开商店看看道具什么的！\n————开发者：lxyddice";
}
}
?>
