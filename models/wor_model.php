<?php

class work extends dataase
{
    public $inv = array(), $pro = array(), $prSetings = array(), $inpType = array(), $inpTypein = array(), $fomrtitle = array(), $frominpvalue = array(), $chekv=array();

    function invent($id)
    {
        $query = $this->mySQL->query("SELECT * FROM invetar WHERE catid = $id");
        while ($row = $query->fetch()) {
            $this->inv[] = $row;
        }
        return $this->inv;
    }

    function invent1()
    {
        $query = $this->mySQL->query("SELECT * FROM invetar ");
        while ($row = $query->fetch()) {
            $this->inv[] = $row;
        }
        return $this->inv;
    }

    function prod()
    {
        $query = $this->mySQL->query("SELECT * FROM product ORDER BY adg");
        while ($row = $query->fetch()) {
            $this->pro[] = $row;
        }
        return $this->pro;
    }

    function pr()
    {
        $query = $this->mySQL->query("SELECT * FROM prSetings");
        while ($row = $query->fetch()) {
            $this->prSetings[] = $row;
        }
        return $this->prSetings;
    }

    function prin($proCode, $proSetCode)
    {
        $query = $this->mySQL->query("SELECT * FROM prSetings WHERE proCode = $proCode AND proSetCode = $proSetCode");
        $query->execute();
        $this->prSetings = $query->fetchAll()[0][6];
        return $this->prSetings;
    }

    function inp()
    {
        $query = $this->mySQL->query("SELECT * FROM inpType");
        while ($row = $query->fetch()) {
            $this->inpTypein[] = $row;
        }
        return $this->inpTypein;
    }

    function worved($grantID, $werID)
    {
        //echo "SELECT title, kontaqt,invCode FROM teqn WHERE grantID = $grantID AND werID = $werID AND active = 0 GROUP BY title,kontaqt";
        $query = $this->mySQL->query("SELECT title, kontaqt,invCode FROM teqn WHERE grantID = $grantID AND werID = $werID AND active = 0 AND grdas = 0 GROUP BY title,kontaqt");
        while ($row = $query->fetch()) {
            $this->fomrtitle[] = $row;
        }
        return $this->fomrtitle;
    }
     public $grgagz=array();
    function grgagz($grantID, $werID)
    {
        //echo "SELECT title, kontaqt,invCode FROM teqn WHERE grantID = $grantID AND werID = $werID AND grdas = 1 GROUP BY title,kontaqt";
        $query = $this->mySQL->query("SELECT title, kontaqt,invCode,grdas FROM teqn WHERE grantID = $grantID AND werID = $werID AND grdas = 1 GROUP BY title,kontaqt");
        while ($row = $query->fetch()) {
            $this->grgagz[] = $row;
        }
        return $this->grgagz;
    }

    function grformedit($grantID, $werID, $titcode)
    {
        $query = $this->mySQL->query("SELECT * FROM teqn WHERE grantID = $grantID AND werID = $werID AND kontaqt = '$titcode'");
        while ($row = $query->fetch()) {
            $this->frominpvalue[] = $row;
        }
        return $this->frominpvalue;
    }

    function chekb($gid,$qeid)
    {
        $query = $this->mySQL->query("SELECT teqn.doc, teqn.kom FROM inpType INNER JOIN prSetings ON prSetings.inpTypeID = inpType.typID INNER JOIN teqn ON teqn.prSetCode = prSetings.proSetCode  WHERE
	teqn.grantID = $gid
AND teqn.werID = $qeid
AND teqn.active = 0
GROUP BY teqn.doc, teqn.kom");
        while ($row = $query->fetch()) {
            $this->chekv[] = $row;
        }
        return $this->chekv;
    }

    function addworker($grantID, $werID, $invCode, $proCode, $prSetCode, $teqValue, $kom, $doc, $kontaqt, $title, $active, $editinp)
    {
if($editinp == 0) {
    $sql = "INSERT INTO teqn(grantID,werID,invCode,proCode,prSetCode,teqValue,kom,doc,kontaqt,title,active,editinp) VALUES (:grantID,:werID,:invCode,:proCode,:prSetCode,:teqValue,:kom,:doc,:kontaqt,:title,:active,:editinp)";
    $stmt = $this->mySQL->prepare($sql);
    $stmt->bindParam(':grantID', $grantID, PDO::PARAM_STR);
    $stmt->bindParam(':werID', $werID, PDO::PARAM_STR);
    $stmt->bindParam(':invCode', $invCode, PDO::PARAM_STR);
    $stmt->bindParam(':proCode', $proCode, PDO::PARAM_STR);
    $stmt->bindParam(':prSetCode', $prSetCode, PDO::PARAM_STR);
    $stmt->bindParam(':teqValue', $teqValue, PDO::PARAM_STR);
    $stmt->bindParam(':kom', $kom, PDO::PARAM_STR);
    $stmt->bindParam(':doc', $doc, PDO::PARAM_STR);
    $stmt->bindParam(':kontaqt', $kontaqt, PDO::PARAM_STR);
    $stmt->bindParam(':title', $title, PDO::PARAM_STR);
    $stmt->bindParam(':active', $active, PDO::PARAM_STR);
    $stmt->bindParam(':editinp', $editinp, PDO::PARAM_STR);
    $stmt->execute();
}else{
    $sql = "INSERT INTO teqn(grantID,werID,invCode,proCode,prSetCode,teqValue,kom,doc,kontaqt,title,active) VALUES (:grantID,:werID,:invCode,:proCode,:prSetCode,:teqValue,:kom,:doc,:kontaqt,:title,:active)";
    $stmt = $this->mySQL->prepare($sql);
    $stmt->bindParam(':grantID', $grantID, PDO::PARAM_STR);
    $stmt->bindParam(':werID', $werID, PDO::PARAM_STR);
    $stmt->bindParam(':invCode', $invCode, PDO::PARAM_STR);
    $stmt->bindParam(':proCode', $proCode, PDO::PARAM_STR);
    $stmt->bindParam(':prSetCode', $prSetCode, PDO::PARAM_STR);
    $stmt->bindParam(':teqValue', $teqValue, PDO::PARAM_STR);
    $stmt->bindParam(':kom', $kom, PDO::PARAM_STR);
    $stmt->bindParam(':doc', $doc, PDO::PARAM_STR);
    $stmt->bindParam(':kontaqt', $kontaqt, PDO::PARAM_STR);
    $stmt->bindParam(':title', $title, PDO::PARAM_STR);
    $stmt->bindParam(':active', $active, PDO::PARAM_STR);
    $stmt->execute();
}
    }

    function woredit($grid,$werid,$kontaqt)
    {
        $query = $this->mySQL->query("SELECT * FROM `teqn` WHERE `grantID` = $grantID AND `werID` = $werID AND `kontaqt` = '$kontaqt'");
        while ($row = $query->fetch()) {
            $this->frominpvalue[] = $row;
        }
        return $this->frominpvalue;
    }

    function updworker($teqValue,$kom,$doc,$active,$kontaqt,$editinp)
    {

        if($editinp == 0) {
            $sql = "UPDATE `teqn` SET `teqValue` = '$teqValue',`kom` = '$kom',`doc` = '$doc',`active` = $kontaqt, `editinp` = $editinp WHERE `id` = $active";
        }else{$sql = "UPDATE `teqn` SET `teqValue` = '$teqValue',`kom` = '$kom',`doc` = '$doc',`active` = $kontaqt WHERE `id` = $active";}
        $stmt = $this->mySQL->query($sql);
    }

    function delworker($grid,$werid,$kont,$incode){
        $sql = "DELETE FROM `teqn`  WHERE `grantID` = $grid AND `werID` = $werid AND `kontaqt` = '$kont' AND `invCode` = $incode";
        //echo $sql;
        $stmt = $this->mySQL->query($sql);
    }

    function chat($grid,$wrid,$red){
        $query = $this->mySQL->query("SELECT name,text,grid,werid,red,tarigi FROM chat WHERE grid = $grid AND werid = $wrid AND `red` = '$red'  GROUP BY id ");
        while ($row = $query->fetch()) {
            $this->chat[] = $row;
        }
        return $this->chat;
    }

    function chatadd($name,$texst,$grid, $wrid,$red,$tarigi)
    {
        if (!empty($texst)) {
            $sql1 = "INSERT INTO `chat`(`name`,`text`,`grid`,`werid`, `red`,`tarigi`) VALUES('$name','$texst',$grid,$wrid,'$red','$tarigi')";
            $stmt1 = $this->mySQL->query($sql1);
        }
    }
    public $mailuser = array();
    function mailsend($grid,$weris)
    {
        $query = $this->mySQL->query("SELECT
users.email
FROM
grweruser
INNER JOIN shesTan ON grweruser.perscode = shesTan.PersCode
INNER JOIN users ON shesTan.PersCode = users.perscode
WHERE
grweruser.grid = $grid AND
grweruser.werid = $weris
");
        while ($row = $query->fetch()) {
            $this->mailuser[] = $row;
        }
        return $this->mailuser;
    }
    public $itactive=array();
    function itactive($grid,$weris)
    {
        $query = $this->mySQL->query("SELECT
invCode
FROM
teqn
WHERE
grantID = $grid AND
werID = $weris
GROUP BY invCode
");
        while ($row = $query->fetch()) {
            $this->itactive[] = $row;
        }
        return $this->itactive;
    }
    public $itusmail=array();
    function ituser(){
        $query = $this->mySQL->query("SELECT
users.email
FROM
users
INNER JOIN ittan ON users.perscode = ittan.perscode
");
        while ($row = $query->fetch()) {
            $this->itusmail[] = $row;
        }
        return $this->itusmail;
    }

}


?>