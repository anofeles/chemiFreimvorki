<?php
@session_start();
include_once "mail_send/class.phpgmailer.php";

class home extends viuvset
{

    function __construct()
    {
        $this->load('wor');
        $this->load('home');
        $this->load('reg');
        $this->load('sheuft');
        $this->load('shetan');
        $this->load('ittan');
    }

    function index($resurs, $post)
    {
        /*var_dump($post);
        $testModel = new test_model();
        $testModel->test_viu();
        $data['info'] = $testModel->rows;*/
        $data['subview'] = 'index';
        $this->viu('layaut/layaut', $data);

    }

    function registration()
    {
    	
        $testModel = new reg();
       
        if (isset($this->post[0]['pnumb'])) {
            $testModel->shemuser($this->post[0]['pnumb']);
        if (isset($testModel->perscode[0]['PersCode'])) {
            if ($testModel->perscode[0]['PersCode'] != null) {
                $user = $this->post[0]['user'];
                $gvar = $this->post[0]['gvar'];
                $email = $this->post[0]['email'];
                $pnumb = $this->post[0]['pnumb'];
                if(!empty($this->post[0]['dampers'])){$dampers = $this->post[0]['dampers'];}else{$dampers = null;}
                $moxmarebeli = $this->post[0]['moxmarebeli'];
                $paroli = md5($this->post[0]['paroli']);
                $pc = $testModel->perscode[0]['PersCode'];
                $testModel->userreg($user, $gvar, $email, $pnumb, $moxmarebeli, $paroli, $pc, $dampers);
            } else {
                $data['errorinfo'] = "თქვენ არ გაქვთ რეგისტრაციის უფლება";
            }
        } 
       }
        $data['subview'] = 'registration';
        $this->viu('layaut/layaut', $data);
    }

    function login()
    {
        $user = $this->post[0]['user'];
        $pass = $this->post[0]['pass'];
        $testModel = new reg();
        $pass = md5($pass);
        $testModel->login($user, $pass);
        if (!empty($testModel->user[0][0]) && isset($testModel->user[0][0]) && $testModel->user[0][0] != null) {

            $userinfo = $testModel->autentif($testModel->user[0][0]['perscode']);
            $usergrant = $testModel->grant($testModel->user[0][0]['perscode']);
            $sheuft = $testModel->sheuft($testModel->user[0][0]['perscode']);
            $shestan = $testModel->shesytan($testModel->user[0][0]['perscode']);
            $itshetan = $testModel->itshes($testModel->user[0][0]['perscode']);
            $mysqitshetan = $testModel->sqlittan($testModel->user[0][0]['perscode']);

            $_SESSION['userinfo'] = $userinfo[0];
            if (!empty($usergrant[0]) && isset($usergrant[0]) && $usergrant[0] != null) {
                $_SESSION['usergrant'] = $usergrant;
            }
            if (!empty($sheuft[0]) && isset($sheuft[0]) && $sheuft[0] != null) {
                $_SESSION['sheuft'] = $sheuft;
            }
            if (!empty($shestan[0]) && isset($shestan[0]) && $shestan[0] != null) {
                $_SESSION['shestan'] = $shestan;
            }
            if(!empty($mysqitshetan[0]) && isset($mysqitshetan[0])){
               // var_dump($mysqitshetan[0]["perscode"]);
                if($mysqitshetan[0]["perscode"] == $itshetan[0]['PersCode']){
                    $_SESSION['ittan'] = $itshetan[0];
                }
            }

        }

        $data['subview'] = 'index';
        $this->viu('layaut/layaut', $data);
    }

    function sheuft()
    {
        if (!isset($_SESSION['sheuft']) || empty($_SESSION['sheuft'])) {
            header('Location: http://intranet.tsu.ge/grantebi/index.php/home/index');
        }
        $wer = new sheuft();
        foreach ($wer->wer() as $item) {
            $data['grnid'] = $wer->grntviu($item['workerID']);
        }
        if (isset($this->url[0][4])) {
            $data['grantid'] = $this->url[0][3];
            $data['werid'] = $this->url[0][4];
            $data['grvtitle'] = $wer->worved($this->url[0][3], $this->url[0][4]);
            $data['grnameviu'] = $wer->grviu($this->url[0][3]);

            if(isset($_GET['red'])){
                $shes = new shetan();
                $data['grformedit'] = $shes->grformedit($this->url[0][3], $this->url[0][4], $_GET['red']);
                $data['inv'] = $shes->invent();
                $data['prod'] = $shes->prod();
                $data['pr'] = $shes->pr();
                $data['inp'] = $shes->inp();
            }
            if (isset($_GET['peredit'])) {
                $data['edit'] = $_GET['peredit'];
            }

            $data['workerUser'] = $wer->grwername($this->url[0][4]);
            if (isset($_GET['persdell'])) {
                $data['persdell'] = $_GET['persdell'];
                $wer->userqeredell($this->url[0][3], $this->url[0][4], $_GET['persdell']);
            }
        }
        if (isset($this->url[0][3]) && $this->url[0][3] == "tanadd") {
            foreach ($wer->persone() as $shestanitem) {
                $wer->loctanadd($shestanitem["Sname"], $shestanitem["Fname"], $shestanitem["PersCode"]);
            }
        }
        $data['gweril'] = $wer->weril();
        $data['dawer'] = $wer->dakwer();
        if (isset($this->url[0][3]) && $this->url[0][3] != "tanadd") {
            $data['grusers'] = $wer->loctan();

            if (isset($_GET['peredit'])) {
                $data['edit'] = $_GET['peredit'];
            }

            $data['grid'] = $this->url[0][3];

            $data['pesone'] = $wer->loctan();
        }
        if (isset($_POST['gusepers'])) {
            $gid = intval($_POST['grid']);
            $wid = intval($_POST['werrid']);
            $pid = intval($_POST['gusepers']);
            $wer->userqeradd($gid, $wid, $pid);
        }
        if (isset($_POST['gusepersedit'])) {
            $gid = intval($_POST['grid']);
            $wid = intval($_POST['werrid']);
            $pid = intval($_POST['gusepersedit']);
            $wer->userqeredit($gid, $wid, $pid);
        }
        $data['subview'] = 'sheuft';
        $this->viu('layaut/layaut', $data);
    }

    function grant()
    {
        if (!isset($_SESSION['usergrant']) || empty($_SESSION['usergrant'])) {
            header('Location: http://intranet.tsu.ge/grantebi/index.php/home/index');
        }
        $testModel = new reg();
        $data['grantviu'] = $testModel->workerviu();
        
        if (!empty($this->url[0][3])) {
            $data['grid'] = $this->url[0][3];
            $data['grnameviu'] = $testModel->grviu($this->url[0][3]);
        }
        if(!empty($this->url[0][4])){
            $data['wertitlenameviu'] = $testModel->wertitlenameviu($this->url[0][3], $this->url[0][4]);
        }
        if (isset($_GET['weredit']) && !empty($_GET['weredit'])) {
            $weredit = intval($_GET['weredit']);
            $data['weredit'] = $testModel->workedit($weredit);
        }
        if (isset($_GET['weredel']) || !empty($_GET['weredel'])) {

            $weredel = $_GET['weredel'];
            $testModel->dellworker($weredel);
        }

        /******************************/
if(isset($this->url[0][4])){
    $data['categori'] = $testModel->categroi();
    $data['wernomeri'] = $this->url[0][4];
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 10; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $mowy = new work();
        if(isset($_GET['cat'])){$data['inv'] = $mowy->invent($_GET['cat']);}
        $data['inv1'] = $mowy->invent1();
        $data['prod'] = $mowy->prod();
        $data['pr'] = $mowy->pr();
        $data['inp'] = $mowy->inp();
        $data['chekb'] = $mowy->chekb($this->url[0][3], $this->url[0][4]);
        $data['grvtitle'] = $mowy->worved($this->url[0][3], $this->url[0][4]);
        $data['grgagz'] = $mowy->grgagz($this->url[0][3], $this->url[0][4]);
        if (isset($_GET['red'])) {
            $data['grformedit'] = $mowy->grformedit($this->url[0][3], $this->url[0][4], $_GET['red']);
            $data['chat'] = $mowy->chat($this->url[0][3], $this->url[0][4], $_GET['red']);
            if (!empty($_POST['chat'])) {
                $chat = htmlspecialchars($_POST['chat']);
                $name = $_SESSION['usergrant'][0]['Fname'] . " " . $_SESSION['usergrant'][0]['Sname'];
                $tarigi = date('Y-m-d H:i:s');
                $shemail = $mowy->mailsend($this->url[0][3],$this->url[0][4]);
                foreach ($shemail as $shemailitem) {
                    $content = "<b>$name</b> <span>$tarigi</span><br><span>$chat</span>";
                    $from = $testModel->grviu($this->url[0][3])[0]['GrantName'].' '.$testModel->grviu($this->url[0][3])[0]['GrantN'];
                    $mail = new PHPGMailer();
                    $mail->Username = 'contact@tsu.ge';
                    $mail->Password = '2014contact';
                    $mail->From = $shemailitem["email"];
                    $mail->FromName = $from;
                    $mail->Subject = $from;
                    $mail->AddAddress($shemailitem["email"]);
                    $mail->isHTML(true);
                    $mail->Body = $content;
                    $mail->Send();
                }
                $itactive = $mowy->itactive($this->url[0][3],$this->url[0][4]);
                if($itactive[0]['invCode'] == "1" || $itactive[0]['invCode'] == "2"){
                    foreach ($mowy->ituser() as $ituseritem) {
                        $content = "<b>$name</b> <span>$tarigi</span><br><span>$chat</span>";
                        $from = $testModel->grviu($this->url[0][3])[0]['GrantName'].' '.$testModel->grviu($this->url[0][3])[0]['GrantN'];
                        $mail = new PHPGMailer();
                        $mail->Username = 'contact@tsu.ge';
                        $mail->Password = '2014contact';
                        $mail->From = $ituseritem["email"];
                        $mail->FromName = $from;
                        $mail->Subject = $from;
                        $mail->AddAddress($ituseritem["email"]);
                        $mail->isHTML(true);
                        $mail->Body = $content;
                        $mail->Send();
                    }
                }
                $mowy->chatadd($name, $chat, $this->url[0][3], $this->url[0][4], $_GET['red'],$tarigi);
            }
        }

        if (!empty($_POST['inv'])) {

            $prodrao = count($_POST['prod']);
            for ($i = 0; $i < $prodrao; $i++) {
                $prrao = count($_POST['pr']);
                for ($k = 0; $k < $prrao; $k++) {
                    $prgay = explode("/", $_POST['pr'][$k]);
                    if ($_POST['prod'][$i] == $prgay[1]) {
                        $post = $mowy->prin($_POST['prod'][$i], $prgay[0]);
                        $teqValuem = @$_POST[$post];
                        $proCode = $_POST['prod'][$i];
                        $prSetCode = $prgay[0];
                        if(isset($_POST['kom'])){$kom = $_POST['kom'];}else{$kom=" ";}
                        $doc = $_FILES['invois']['name'];
                        $uploaddir = 'images/invois/';
                        $uploadfile = $uploaddir . basename($_FILES['invois']['name']);
                        move_uploaded_file($_FILES['invois']['tmp_name'], $uploadfile);
                        $kontaqt = $randomString;
                        $invCode = $_POST['inv'];
                        $grantID = $this->url[0][3];
                        $werID = $this->url[0][4];
                        $title = $_POST['fname'];
                        if (isset($_POST['active']) && !empty($_POST['active'])) {
                            $active = 1;
                            $editinp = 0;
                        } else {
                            $active = 0;
                            $editinp = 1;
                        }
                        $mowy->addworker($grantID, $werID, $invCode, $proCode, $prSetCode, $teqValuem, $kom, $doc, $kontaqt, $title, $active, $editinp);
                    }
                }
            }
        }
        if (!empty($_POST['prodedi'])) {
            $prodrao = count($_POST['prodedi']);
            for ($i = 0; $i < $prodrao; $i++) {
                $prrao = count($_POST['pr']);
                for ($k = 0; $k < $prrao; $k++) {

                    $prgay = explode("/", $_POST['pr'][$k]);
                    if ($_POST['prodedi'][$i] == $prgay[1]) {


                        $post = $mowy->prin($_POST['prodedi'][$i], $prgay[0]);
                        $idpost = $post."1";

                        $id = @$_POST[$idpost];
                        $teqValuem = @$_POST[$post];
                        $kom = $_POST['kom'];

                        if (empty($_FILES['invois']['name'])) {
                            @$doc = $mowy->chekb($this->url[0][3], $this->url[0][4])[0]['doc'];
                        } else {
                            @$doc = $_FILES['invois']['name'];
                            $uploaddir = 'images/invois/';
                            $uploadfile = $uploaddir . basename($_FILES['invois']['name']);
                            move_uploaded_file($_FILES['invois']['tmp_name'], $uploadfile);
                            $uploadfile = $uploaddir . basename($_FILES['invois']['name']);
                        }
                        $kontaqt = $_GET['red'];

                        if (!empty($_POST["active"])) {
                            $active = 1;
                            $editinp = 0;
                        } else {
                            $active = 0;
                            $editinp = 1;
                        }

                        $mowy->updworker($teqValuem, $kom, $doc, $id, $active, $editinp);
                    }
                }
            }
        }

        if (!empty($_GET['dell'])) {
            $grid = $this->url[0][3];
            $werid = $this->url[0][4];
            $kontaqt = $_GET['dell'];
            $incode = $_GET['incode'];
            $mowy->delworker($grid, $werid, $kontaqt, $incode);
        }
    }
        /*******************************/
        $data['subview'] = 'grant';
        $this->viu('layaut/layaut', $data);
    }

    function worker()
    {
        //$login = new reg();
        $wnumb = $_POST['wnumb'];
        $grantmonac = $_POST['grantmonac'];
        $name = $_POST['name'];
        $wnumbedit = $_POST['wnumbedit'];

        $testModel = new reg();var_dump($wnumb);
        if (isset($wnumb) || !empty($wnumb)) {
            $testModel->addworker($wnumb, $name, $grantmonac);
        }
        if (isset($wnumbedit) || !empty($wnumbedit)) {
            $werid = $this->post[0]['werid'];
            $testModel->updworker($name, $wnumbedit, $werid);
        }

        header('Location: http://intranet.tsu.ge/grantebi/index.php/home/grant');
        /*$data['subview'] = 'grant';
        $this->viu('layaut/layaut', $data);*/
    }

    /**********შესყიდვების თანამშრომელბი******************/
    function shestan()
    {
        if (!isset($_SESSION['shestan']) || empty($_SESSION['shestan'])) {
            header('Location: http://intranet.tsu.ge/grantebi/index.php/home/index');
        }
        $shes = new shetan();
        // session_destroy(); AND dasr = 1
        //session_destroy();
        //var_dump($_SESSION['userinfo']);
        $data['grant'] = $shes->shegrant($_SESSION['userinfo']['PersCode']);
        $data['grname'] = $shes->grant();
        $data['werval'] = $shes->wertitle($_SESSION['userinfo']['PersCode']);
        $data['grvtitle'] = $shes->worved();

            if(isset($_POST['teqid'])){
                $teqid = $_POST['teqid'];
                $shes->arqteqn($teqid);
            }
        
        if (isset($this->url[0][3])) {
            $data['grid'] = $this->url[0][3];
        }
        if (isset($this->url[0][4]) && !empty($this->url[0][4])) {
            $data['grnameviu'] = $shes->grviu($this->url[0][3]);
            $data['wertitlenameviu'] = $shes->wertitlenameviu($this->url[0][3], $this->url[0][4]);
            $data['worvedviutitle'] = $shes->worvedviutitle($this->url[0][3], $this->url[0][4], $_GET['red']);
            $data['wrid'] = $this->url[0][4];
            $data['inv'] = $shes->invent();
            $data['prod'] = $shes->prod();
            $data['pr'] = $shes->pr();
            $data['inp'] = $shes->inp();
            if (isset($_GET['red'])) {
                $data['grformedit'] = $shes->grformedit($this->url[0][3], $this->url[0][4], $_GET['red']);
            }
            $data['chekb'] = $shes->chekb();
            $data['chat'] = $shes->chat($this->url[0][3],$this->url[0][4],$_GET['red']);
            foreach ($shes->damperssql($this->url[0][3]) as $damperssqlitem) {
                $shes->damxuser($damperssqlitem['PersCode']);
                $data['damx']=$shes->daminform;
            }
        }
        if (isset($this->url[0][4]) && !empty($this->url[0][4]) && !empty($_GET['red'])) {
            foreach ($shes->grformedit($this->url[0][3], $this->url[0][4], $_GET['red']) as $pritem) {
                if (isset($_POST[$pritem['id']])) {
                    $shes->pasux($pritem['id']);
                }
            }
        }
        if(!empty($_POST["chattext"])){
            $tarigi = date('Y-m-d H:i:s');
            $saxgvar = $_SESSION['userinfo']['Fname']." ".$_SESSION['userinfo']['Sname'];
            $gropt = $shes->grpc($this->url[0][3]);

            $content = "<b>$saxgvar</b> <span>$tarigi</span><br><span>".$_POST["chattext"]."</span>";
            $from = $gropt[0]['GrantName'] ." " . $gropt[0]['GrantN'];
            $gruser=$shes->grufuser($gropt[0]['PersCode']);
            $mail = new PHPGMailer();
            $mail->Username = 'contact@tsu.ge';
            $mail->Password = '2014contact';
            $mail->From = $gruser[0]["email"];
            $mail->FromName = $from;
            $mail->Subject = $from;
            $mail->AddAddress($gruser[0]["email"]);
            $mail->isHTML(true);
            $mail->Body = $content;
            $mail->Send();
            $shes->chatadd($saxgvar,$_POST["chattext"],$this->url[0][3],$this->url[0][4],$_GET['red'],$tarigi);
        }

        $data['subview'] = 'shestan';
        $this->viu('layaut/layaut', $data);
    }
/**********************************************/
    function workerviu()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 10; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $mowy = new work();
        $data['inv'] = $mowy->invent();
        $data['prod'] = $mowy->prod();
        $data['pr'] = $mowy->pr();
        $data['inp'] = $mowy->inp();
        $data['chekb'] = $mowy->chekb($this->url[0][3],$this->url[0][4]);
        $data['grvtitle'] = $mowy->worved($this->url[0][3], $this->url[0][4]);
        if (isset($_GET['red'])) {
            $data['grformedit'] = $mowy->grformedit($this->url[0][3], $this->url[0][4], $_GET['red']);
            $data['chat'] = $mowy->chat($this->url[0][3], $this->url[0][4], $_GET['red']);
            if(!empty($_POST['chat']))
            {
                $chat = htmlspecialchars($_POST['chat']);
                $name = $_SESSION['usergrant'][0]['Fname'] . " " . $_SESSION['usergrant'][0]['Sname'];
                $mowy->chatadd($name, $chat, $this->url[0][3], $this->url[0][4], $_GET['red']);
            }
        }

        if (!empty($_POST['inv'])) {
            $prodrao = count($_POST['prod']);
            for ($i = 0; $i < $prodrao; $i++) {
                $prrao = count($_POST['pr']);
                for ($k = 0; $k < $prrao; $k++) {
                    $prgay = explode("/", $_POST['pr'][$k]);
                    if ($_POST['prod'][$i] == $prgay[1]) {
                        $post = $mowy->prin($_POST['prod'][$i], $prgay[0]);
                        $teqValuem = @$_POST[$post];
                        $proCode = $_POST['prod'][$i];
                        $prSetCode = $prgay[0];
                        $kom = $_POST['kom'];
                        $doc = $_FILES['invois']['name'];
                        $uploaddir = 'images/invois/';
                        $uploadfile = $uploaddir . basename($_FILES['invois']['name']);
                        move_uploaded_file($_FILES['invois']['tmp_name'], $uploadfile);
                        $kontaqt = $randomString;
                        $invCode = $_POST['inv'];
                        $grantID = $this->url[0][3];
                        $werID = $this->url[0][4];
                        $title = $_POST['fname'];
                        if (isset($_POST['active']) && !empty($_POST['active'])) {
                            $active = 1;
                            $editinp = 0;
                        } else {
                            $active = 0;
                            $editinp = 1;
                        }
                        $mowy->addworker($grantID, $werID, $invCode, $proCode, $prSetCode, $teqValuem, $kom, $doc, $kontaqt, $title, $active, $editinp);
                    }
                }
            }
        }

        if (!empty($_POST['inved'])) {
            $prodrao = count($_POST['prod']);
            for ($i = 0; $i < $prodrao; $i++) {
                $prrao = count($_POST['pr']);
                for ($k = 0; $k < $prrao; $k++) {
                    $prgay = explode("/", $_POST['pr'][$k]);
                    if ($_POST['prod'][$i] == $prgay[1]) {
                        $post = $mowy->prin($_POST['prod'][$i], $prgay[0]);
                        $id = @$_POST[$post . "1"];
                        $teqValuem = @$_POST[$post];
                        $kom = $_POST['kom'];
                        if (empty($_FILES['invois']['name']) || !isset($_FILES['invois']['name'])) {
                            @$doc = $mowy->chekb($this->url[0][3],$this->url[0][4])[0]['doc'];
                        } else {
                           @$doc = $_FILES['invois']['name'];
                            $uploaddir = 'images/invois/';
                            $uploadfile = $uploaddir . basename($_FILES['invois']['name']);
                            move_uploaded_file($_FILES['invois']['tmp_name'], $uploadfile);
                            $uploadfile = $uploaddir . basename($_FILES['invois']['name']);
                        }
                        $kontaqt = $_GET['red'];
                       // var_dump($_POST["active"]);
                        if (isset($_POST["active"]) && !empty($_POST["active"])) {
                            $active = 1;
                            $editinp = 0;
                        } else {
                            $active = 0;
                            $editinp = 1;
                        }
                        $mowy->updworker($teqValuem, $kom, $doc, $id, $active, $editinp);
                    }
                }
            }
        }

        if (!empty($_GET['dell'])) {
            $grid = $this->url[0][3];
            $werid = $this->url[0][4];
            $kontaqt = $_GET['dell'];
            $incode = $_GET['incode'];
            $mowy->delworker($grid, $werid, $kontaqt, $incode);
        }
        $data['subview'] = 'grant';
        //$data['subview'] = 'worker';
        $this->viu('layaut/layaut', $data);
    }

    function ittan(){
        if (!isset($_SESSION['ittan']) || empty($_SESSION['ittan'])) {
            header('Location: http://intranet.tsu.ge/grantebi/index.php/home/index');
        }
        $shes = new ittan();
        // session_destroy(); AND dasr = 1
        //session_destroy();
        //var_dump($_SESSION['userinfo']);
        $data['grant'] = $shes->shegrant($_SESSION['ittan']['PersCode']);
        $data['grname'] = $shes->grant();
        $data['werval'] = $shes->wertitle($_SESSION['ittan']['PersCode']);
        $data['grvtitle'] = $shes->worved();

        if(isset($_POST['teqid'])){
            $teqid = $_POST['teqid'];
            $shes->arqteqn($teqid);
        }

        if (isset($this->url[0][3])) {
            $data['grid'] = $this->url[0][3];
        }
        if (isset($this->url[0][4]) && !empty($this->url[0][4])) {
            $data['grnameviu'] = $shes->grviu($this->url[0][3]);
            $data['wertitlenameviu'] = $shes->wertitlenameviu($this->url[0][3], $this->url[0][4]);
            $data['worvedviutitle'] = $shes->worvedviutitle($this->url[0][3], $this->url[0][4], $_GET['red']);
            $data['wrid'] = $this->url[0][4];
            $data['inv'] = $shes->invent();
            $data['prod'] = $shes->prod();
            $data['pr'] = $shes->pr();
            $data['inp'] = $shes->inp();
            if (isset($_GET['red'])) {
                $data['grformedit'] = $shes->grformedit($this->url[0][3], $this->url[0][4], $_GET['red']);
            }
            $data['chekb'] = $shes->chekb();
            $data['chat'] = $shes->chat($this->url[0][3],$this->url[0][4],$_GET['red']);
            foreach ($shes->damperssql($this->url[0][3]) as $damperssqlitem) {
                $shes->damxuser($damperssqlitem['PersCode']);
                $data['damx']=$shes->daminform;
            }
        }
        if (isset($this->url[0][4]) && !empty($this->url[0][4]) && !empty($_GET['red'])) {
            foreach ($shes->grformedit($this->url[0][3], $this->url[0][4], $_GET['red']) as $pritem) {
                if (isset($_POST[$pritem['id']])) {
                    $shes->pasux($pritem['id']);
                }
            }
        }
        if(!empty($_POST["chattext"])){
            $tarigi = date('Y-m-d H:i:s');
            $saxgvar = $_SESSION['userinfo']['Fname']." ".$_SESSION['userinfo']['Sname'];
            $gropt = $shes->grpc($this->url[0][3]);

            $content = "<b>$saxgvar</b> <span>$tarigi</span><br><span>".$_POST["chattext"]."</span>";
            $from = $gropt[0]['GrantName'] ." " . $gropt[0]['GrantN'];
            $gruser=$shes->grufuser($gropt[0]['PersCode']);
            $mail = new PHPGMailer();
            $mail->Username = 'contact@tsu.ge';
            $mail->Password = '2014contact';
            $mail->From = $gruser[0]["email"];
            $mail->FromName = $from;
            $mail->Subject = $from;
            $mail->AddAddress($gruser[0]["email"]);
            $mail->isHTML(true);
            $mail->Body = $content;
            $mail->Send();

            $shes->chatadd($saxgvar,$_POST["chattext"],$this->url[0][3],$this->url[0][4],$_GET['red'],$tarigi);
        }


        $data['subview'] = 'ittan';
        $this->viu('layaut/layaut', $data);
    }

}

?>