<?php

class sheuft extends dataase
{
    public $worker = array(), $userinfo = array(), $grwer=array(), $grtanuser=array(), $workerUser=array(), $dawer=array(),$persone=array(),$ltan=array();

    function wer()
    {
        $query = $this->mySQL->query("SELECT workerID FROM worker GROUP BY workerID");
        while ($row = $query->fetch()) {
            $this->worker[] = $row;
        }
        return $this->worker;
    }

    function weril()
    {
        $query = $this->mySQL->query("SELECT
worker.workerName,
worker.workerUser,
worker.workerID,
worker.id
FROM
worker
JOIN teqn ON worker.id = teqn.werID
WHERE 
teqn.active = 1
GROUP BY 
worker.workerName,
worker.workerUser,
worker.workerID,
worker.id");
        while ($row = $query->fetch()) {
            $this->grwer[] = $row;
        }
        return $this->grwer;
    }

    function grwername($id)
    {
        $query = $this->mySQL->query("SELECT * FROM worker WHERE id = $id");
        while ($row = $query->fetch()) {
            $this->workerUser[] = $row;
        }
        return $this->workerUser;
    }

    function loctan()
    {
        $query = $this->mySQL->query("SELECT * FROM shesTan WHERE active = 0");
        while ($row = $query->fetch()) {
            $this->ltan[] = $row;
        }
        return $this->ltan;
    }

    function loctanadd($Sname,$Fname,$PersCode)
    {
            $sql = "INSERT INTO shesTan(Sname,Fname,PersCode) VALUES ('$Sname','$Fname',$PersCode)";
            $this->mySQL->query($sql)or die("Unable to connect to");
    }

    function grntviu($gid)
    {
        $raodqueri = mssql_query("SELECT
	*
FROM
	dbo.NGrants
WHERE
	dbo.NGrants.GrantID = '$gid'");
        $raodrov = mssql_fetch_array($raodqueri);
        $this->userinfo[] = $raodrov;
        return $this->userinfo;
    }

    function grnttanuser()
    {
        $raodqueri = mssql_query("SELECT
	dbo.Persone.Sname,
	dbo.Persone.Fname,
	dbo.Persone.PersCode
FROM
	dbo.Persone
INNER JOIN dbo.Worker ON dbo.Persone.PersCode = dbo.Worker.PersCode
INNER JOIN dbo.Groups ON dbo.Worker.Grcode = dbo.Groups.Grcode
INNER JOIN dbo.Sector ON dbo.Groups.Secode = dbo.Sector.Secode
INNER JOIN dbo.C_Post ON dbo.Worker.PostCode = dbo.C_Post.PostCode
WHERE
	dbo.Groups.Grcode = 003130
AND dbo.C_Post.PostCode != 215
AND dbo.C_Post.PostCode != 236
AND dbo.Worker.Contract = 0
AND dbo.Worker.Activ < 20 
");
       while ($raodrov = mssql_fetch_array($raodqueri)) {
           $this->grtanuser[] = $raodrov;
       }
        return $this->grtanuser;
    }

    function userqeradd ($gid,$wid,$pid)
    {
        $sql = "INSERT INTO grweruser(grid,werid,perscode) VALUES (:grid,:werid,:perscode)";
        $stmt = $this->mySQL->prepare($sql);
        $stmt->bindParam(':grid', $gid, PDO::PARAM_STR);
        $stmt->bindParam(':werid', $wid, PDO::PARAM_STR);
        $stmt->bindParam(':perscode', $pid, PDO::PARAM_STR);
        $stmt->execute();
    }

    function userqeredit ($gid,$wid,$pid)
    {
        $sql = "UPDATE `grweruser` SET `perscode` = $pid WHERE `werid` = $wid AND `grid` = $gid ";
        $stmt = $this->mySQL->query($sql);
    }

    function userqeredell ($gid,$wid,$pid)
    {
        $sql = "DELETE FROM `grweruser`  WHERE `werid` = $wid AND `grid` = $gid AND `perscode` = $pid ";
        $stmt = $this->mySQL->query($sql);
    }

    function dakwer ()
    {
        $query = $this->mySQL->query("SELECT * FROM grweruser ");
        while ($row = $query->fetch()) {
            $this->dawer[] = $row;
        }
        return $this->dawer;
    }

    function persone ()
    {
        $raodqueri = mssql_query("SELECT
	dbo.Persone.Sname,
	dbo.Persone.Fname,
	dbo.Persone.PersCode
FROM
	dbo.Persone
INNER JOIN dbo.Worker ON dbo.Persone.PersCode = dbo.Worker.PersCode
INNER JOIN dbo.Groups ON dbo.Worker.Grcode = dbo.Groups.Grcode
INNER JOIN dbo.Sector ON dbo.Groups.Secode = dbo.Sector.Secode
INNER JOIN dbo.C_Post ON dbo.Worker.PostCode = dbo.C_Post.PostCode
WHERE
	dbo.Groups.Grcode = 003130
AND dbo.C_Post.PostCode != 215
AND dbo.Worker.Contract = 0
AND dbo.Worker.Activ < 20
");
        while ($raodrov = mssql_fetch_array($raodqueri)) {
            $this->persone[] = $raodrov;
        }
        return $this->persone;
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

    function wertitlenameviu($grid, $weid)
    {
        $query = $this->mySQL->query("SELECT
	worker.workerName,
	worker.workerUser,
	worker.id,
	worker.workerID
FROM
	worker
WHERE
	worker.id = $weid
AND worker.workerID = $grid");

        while ($row = $query->fetch()) {
            $this->grwername[] = $row;
        }
        return $this->grwername;
    }

    function worved($grantID, $werID)
    {
        //echo "SELECT title, kontaqt,invCode FROM teqn WHERE grantID = $grantID AND werID = $werID AND active = 0 GROUP BY title,kontaqt";
        $query = $this->mySQL->query("SELECT title, kontaqt,invCode FROM teqn WHERE grantID = $grantID AND werID = $werID GROUP BY title,kontaqt");
        while ($row = $query->fetch()) {
            $this->fomrtitle[] = $row;
        }
        return $this->fomrtitle;
    }

    function invent($id)
    {
        $query = $this->mySQL->query("SELECT * FROM invetar WHERE catid = $id");
        while ($row = $query->fetch()) {
            $this->inv[] = $row;
        }
        return $this->inv;
    }

}

?>