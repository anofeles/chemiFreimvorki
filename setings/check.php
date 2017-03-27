<?php


include('simple_html_dom.php');
/*
class db
{
    public function __construct()
    {
        $this->mysqli = new mysqli("localhost", "root", "rTul9834asdnha", "snd");
        $this->mysqli->set_charset("utf8");
    }

    public function add_result(){
    	$this->mysqli->query("INSERT INTO `sms` (`status`, `snd_date`) VALUES ('yes', NOW())");
    }

    public function count_rows(){
    	$result = $this->mysqli->query("SELECT * FROM `sms`");
    	$count = mysqli_num_rows($result);
    	return $count;
    }

}


class sms
{
	
	public function sendSMS(){
		$response1 = file_get_contents("http://91.151.128.64:7777/pls/sms/phttp2sms.Process?src=14460&dst=995577211625&txt=testMSG");
		$response2 = file_get_contents("http://91.151.128.64:7777/pls/sms/phttp2sms.Process?src=14460&dst=995577900331&txt=testMSG");
		$response3 = file_get_contents("http://91.151.128.64:7777/pls/sms/phttp2sms.Process?src=14460&dst=995593553776&txt=testMSG");

	}
} 
*/
/* mushaobs*/
class parser
{
	public function check_miner(){
		$content = file_get_contents("https://gancxadebebi.ge/ka/%E1%83%92%E1%83%90%E1%83%9C%E1%83%AA%E1%83%AE%E1%83%90%E1%83%93%E1%83%94%E1%83%91%E1%83%94%E1%83%91%E1%83%98/%E1%83%A3%E1%83%AB%E1%83%A0%E1%83%90%E1%83%95%E1%83%98-%E1%83%A5%E1%83%9D%E1%83%9C%E1%83%94%E1%83%91%E1%83%90-1/%E1%83%A3%E1%83%AB%E1%83%A0%E1%83%90%E1%83%95%E1%83%98-%E1%83%A5%E1%83%9D%E1%83%9C%E1%83%94%E1%83%91%E1%83%98%E1%83%A1-%E1%83%92%E1%83%90%E1%83%A5%E1%83%98%E1%83%A0%E1%83%90%E1%83%95%E1%83%94%E1%83%91%E1%83%90-5");

		$html = str_get_html($content);
        var_dump($html->find('.ua', 0));
		$e = $html->find('body',0);
		//echo $e->plaintext;

		$result = false;
		if($e->href != "javascript:;"){
			echo $e->href;
			$result = true;
		}
		return $result;

	}	

}

//$dbOBJ = new db();
$parserOBJ = new parser();
$parserOBJ->check_miner();
//$smsOBJ = new sms();
/*if($parserOBJ->check_miner() == true && $dbOBJ->count_rows() == 0){
	//$smsOBJ->sendSMS();
	//$dbOBJ->add_result();
}*/
?>