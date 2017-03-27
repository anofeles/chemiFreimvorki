<?php

class ittan extends dataase
{
    public $tangrnum = array(), $usergrant = array(), $wervalue = array(), $chat = array(), $grname = array(), $grwername = array(), $weviutit=array();

    function shegrant($pc)
    {
        $query = $this->mySQL->query("SELECT
	grantID
FROM
	teqn
WHERE
	invCode = 1
OR invCode = 2
GROUP BY
	grantID");
        while ($row = $query->fetch()) {
            $this->tangrnum[] = $row;
        }
        return $this->tangrnum;
    }

    function wertitle($pc)
    {
        $query = $this->mySQL->query("SELECT
	worker.workerName,
	worker.workerUser,
	worker.id,
	teqn.grantID
FROM
teqn
INNER JOIN worker ON teqn.werID = worker.id
WHERE teqn.active = 1
AND teqn.grdas = 0 AND(
 teqn.invCode = 1 
OR teqn.invCode = 2)
GROUP BY
	worker.workerName,
	worker.workerUser,
	worker.id,
	teqn.grantID
");

        while ($row = $query->fetch()) {
            $this->wervalue[] = $row;
        }
        return $this->wervalue;
    }


    function wertitlenameviu($grid, $weid)
    {
        $query = $this->mySQL->query("SELECT
	worker.workerName,
	worker.workerUser,
	worker.id,
	grweruser.grid
FROM
	grweruser
INNER JOIN worker ON grweruser.grid = worker.workerID
AND grweruser.werid = worker.id
WHERE
	worker.id = $weid
AND grweruser.grid = $grid");

        while ($row = $query->fetch()) {
            $this->grwername[] = $row;
        }
        return $this->grwername;
    }


    function grviu($grid)
    {
        $raodqueri = mssql_query("SELECT
ng.GrantName,
ng.GrantID,
ng.GrantN,
GrantName
FROM
dbo.NGrants AS ng
WHERE GrantID = $grid
");
        while ($raodrov = mssql_fetch_array($raodqueri)) {
            $this->grname[] = $raodrov;
        }
        return $this->grname;
    }

    function grant()
    {
        $raodqueri = mssql_query("SELECT
GrantID,
GrantN,
GrantName,
GrantN        		
FROM
dbo.NGrants

");
        while ($raodrov = mssql_fetch_array($raodqueri)) {
            $this->usergrant[] = $raodrov;
        }
        return $this->usergrant;
    }


    function worved()
    {
        $query = $this->mySQL->query("SELECT title, kontaqt,invCode,grantID,werID,grdas FROM teqn WHERE  active = 1 GROUP BY title,kontaqt");
        while ($row = $query->fetch()) {
            $this->fomrtitle[] = $row;
        }
        return $this->fomrtitle;
    }


    function worvedviutitle($grid,$werid,$kode)
    {
        $query = $this->mySQL->query("SELECT
	title
FROM
	teqn
WHERE
	active = 1
AND grantID = $grid
AND werID = $werid
AND kontaqt = '$kode'
GROUP BY
	title,
	kontaqt");
        while ($row = $query->fetch()) {
            $this->weviutit[] = $row;
        }
        return $this->weviutit;
    }

    function invent()
    {
        $query = $this->mySQL->query("SELECT * FROM invetar");
        while ($row = $query->fetch()) {
            $this->inv[] = $row;
        }
        return $this->inv;
    }

    function prod()
    {
        $query = $this->mySQL->query("SELECT * FROM product");
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

    function inp()
    {
        $query = $this->mySQL->query("SELECT * FROM inpType");
        while ($row = $query->fetch()) {
            $this->inpTypein[] = $row;
        }
        return $this->inpTypein;
    }

    function grformedit($grantID, $werID, $titcode)
    {
        $query = $this->mySQL->query("SELECT * FROM teqn WHERE grantID = $grantID AND werID = $werID AND kontaqt = '$titcode'");
        while ($row = $query->fetch()) {
            $this->frominpvalue[] = $row;
        }
        return $this->frominpvalue;
    }

    function pasux($id)
    {
        $sql = "UPDATE `teqn` SET `active` = 0, `editinp` = 1 WHERE `id` = $id";
        $stmt = $this->mySQL->query($sql);

    }

    function chatadd($name, $texst, $grid, $wrid, $red,$tarigi)
    {
        if (!empty($texst)) {
            $sql1 = "INSERT INTO `chat`(`name`,`text`,`grid`,`werid`,`red`,`tarigi`) VALUES('$name','$texst',$grid,$wrid,'$red','$tarigi')";
            $stmt1 = $this->mySQL->query($sql1);
        }
    }

    function chat($grid, $wrid, $editinp)
    {
        //echo "SELECT `name`,`text`,`grid`,`werid`,`red` FROM `chat` WHERE `grid` = $grid AND `werid` = $wrid  AND `red` = '$editinp' GROUP BY `name`,`text`,`grid`,`werid`,`red` ";
        $query = $this->mySQL->query("SELECT `name`,`text`,`grid`,`werid`,`red`,`tarigi` FROM `chat` WHERE `grid` = $grid AND `werid` = $wrid  AND `red` = '$editinp' GROUP BY id ");
        while ($row = $query->fetch()) {
            $this->chat[] = $row;
        }
        return $this->chat;
    }

    function chekb()
    {
        $query = $this->mySQL->query("SELECT teqn.doc, teqn.kom, teqn.id, teqValue, typID, prSetCode, kontaqt FROM inpType INNER JOIN prSetings ON prSetings.inpTypeID = inpType.typID INNER JOIN teqn ON teqn.prSetCode = prSetings.proSetCode ");
        while ($row = $query->fetch()) {
            $this->chekv[] = $row;
        }
        return $this->chekv;
    }
    public $grpessql=array();
    function damperssql($grid)
    {
        $raodqueri = mssql_query("SELECT
dbo.Persone.PersCode
FROM
dbo.WorkerGrant AS wog
LEFT JOIN dbo.NGrants AS ng ON wog.GrantID = ng.GrantID
LEFT JOIN dbo.C_GrantMember AS cgm ON cgm.memberid = wog.memberid
LEFT JOIN dbo.Persone ON wog.PersCode = dbo.Persone.PersCode
WHERE
cgm.memberid = 1 
AND ng.GrantID = $grid
");
        while ($raodrov = mssql_fetch_array($raodqueri)) {
            $this->grpessql[] = $raodrov;
        }
        return $this->grpessql;
    }
    public $daminform=array();
    function damxuser($prnom)
    {
        $query = $this->mySQL->query("SELECT `name`, fname, sakpir FROM users WHERE perscode = $prnom");
        while ($row = $query->fetch()) {
            $this->daminform[] = $row;
        }
        return $this->daminform;
    }

    function arqteqn($cat)
    {
        $query = $this->mySQL->query("UPDATE `teqn` SET `grdas` = 1 WHERE `kontaqt` = '$cat'");
    }
    public $grvtitle=array();
    function teqarq ($grid,$werid)
    {
        $query = $this->mySQL->query("SELECT grdas FROM teqn WHERE grantID = $grid AND werID = $werid AND grdas = 0");
        while ($row = $query->fetch()) {
            $this->grvtitle[] = $row;
        }
        return $this->grvtitle;
    }
    public $grantarq=array();
    function grantarq($pcode)
    {
        $query = $this->mySQL->query("SELECT
teqn.grdas,
teqn.kontaqt
FROM
grweruser
INNER JOIN teqn ON grweruser.grid = teqn.grantID AND grweruser.werid = teqn.werID
WHERE
	invCode = 1
OR invCode = 2");
        while ($row = $query->fetch()) {
            $this->grantarq[] = $row;
        }
        return $this->grantarq;
    }
    public $grpc=array();
    function grpc($gid)
    {
        $raodqueri = mssql_query("SELECT
dbo.WorkerGrant.PersCode,
dbo.NGrants.GrantName,
dbo.NGrants.GrantN

FROM
dbo.WorkerGrant
INNER JOIN dbo.NGrants ON dbo.WorkerGrant.GrantID = dbo.NGrants.GrantID
WHERE
dbo.WorkerGrant.GrantID = $gid AND
dbo.WorkerGrant.memberid = 1
");
        while ($raodrov = mssql_fetch_array($raodqueri)) {
            $this->grpc[] = $raodrov;
        }
        return $this->grpc;
    }
    public $grufuser=array();
    function grufuser($pc)
    {
        $query = $this->mySQL->query("SELECT email FROM users WHERE perscode = $pc");
        while ($row = $query->fetch()) {
            $this->grufuser[] = $row;
        }
        return $this->grufuser;
    }
}


?>