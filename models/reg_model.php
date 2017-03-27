<?php

class reg extends dataase
{
    public $perscode = array(), $user = array(), $userinfo = array(), $usergrant = array(), $grantviu = array(), $sheufr = array(), $shetan = array(), $woredit = array(), $catviu = array(), $grname = array(), $grwername = array(), $fomrtitle = array();

    function userreg($user, $gvar, $email, $pnumb, $moxmarebeli, $paroli, $pc, $dampers)
    {
        /* $sql = "INSERT INTO users(user,passvord,perscode,persnumber,email,name,fname,sakpir) VALUES (:user,:passvord,:perscode,:persnumber,:email,:name,:fname,:sakpir)";
         $stmt = $this->mySQL->prepare($sql);
         $stmt->bindParam(':user', $moxmarebeli, PDO::PARAM_STR);
         $stmt->bindParam(':passvord', $paroli, PDO::PARAM_STR);
         $stmt->bindParam(':perscode', $pc, PDO::PARAM_STR);
         $stmt->bindParam(':persnumber', $pnumb, PDO::PARAM_STR);
         $stmt->bindParam(':email', $email, PDO::PARAM_STR);
         $stmt->bindParam(':name', $user, PDO::PARAM_STR);
         $stmt->bindParam(':fname', $gvar, PDO::PARAM_STR);
         $stmt->bindParam(':sakpir', $dampers, PDO::PARAM_STR);
         $stmt->execute();echo $sql;*/

        $sql1 = "INSERT INTO users(user,passvord,perscode,persnumber,email,name,fname,sakpir) VALUES ('$moxmarebeli','$paroli',$pc,$pnumb,'$email','$user','$gvar','$dampers')";
        $stmt1 = $this->mySQL->query($sql1);
    }

    function addworker($wname, $wernumber, $grantmonac)
    {
        // echo $wname."/".$wernumber."/".$grantmonac;
        $sql = "INSERT INTO worker(workerName,workerUser,workerID) VALUES (:workerName,:workerUser,:workerID)";
        $stmt = $this->mySQL->prepare($sql);
        $stmt->bindParam(':workerName', $wname, PDO::PARAM_STR);
        $stmt->bindParam(':workerUser', $wernumber, PDO::PARAM_STR);
        $stmt->bindParam(':workerID', $grantmonac, PDO::PARAM_STR);
        $stmt->execute();
    }

    function updworker($wname, $wernumber, $id)
    {
        $sql = "UPDATE worker SET workerName=:workerName,workerUser=:workerUser WHERE id = $id";
        $stmt = $this->mySQL->prepare($sql);
        $stmt->bindParam(':workerName', $wname, PDO::PARAM_STR);
        $stmt->bindParam(':workerUser', $wernumber, PDO::PARAM_STR);

        $stmt->execute();
    }

    function dellworker($id)
    {
        $sql = "DELETE FROM  worker WHERE id = $id";
        $stmt = $this->mySQL->prepare($sql);
        $stmt->execute();
    }

    function shemuser($pnumb)
    {
        $raodqueri = mssql_query("SELECT PersCode FROM dbo.Persone WHERE dbo.Persone.Password = '$pnumb'");
        $raodrov = mssql_fetch_array($raodqueri);
        $this->perscode[] = $raodrov;
        return $this->perscode;
    }

    function login($user, $pass)
    {

        $query = $this->mySQL->prepare("SELECT * FROM users WHERE user = '$user' AND passvord = '$pass'");
        $query->execute();
        $this->user[] = $query->fetchAll();
        return $this->user;
    }

    function workerviu()
    {
        $query = $this->mySQL->query("SELECT * FROM worker WHERE dasr = 0");
        while ($row = $query->fetch()) {
            $this->grantviu[] = $row;
        }

        return $this->grantviu;
    }

    function workedit($id)
    {
        $query = $this->mySQL->query("SELECT * FROM worker WHERE id = $id");
        while ($row = $query->fetch()) {
            $this->woredit[] = $row;
        }

        return $this->woredit;
    }

    function categroi()
    {
        $query = $this->mySQL->query("SELECT * FROM categori");
        while ($row = $query->fetch()) {
            $this->catviu[] = $row;
        }

        return $this->catviu;
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

    function autentif($pc)
    {

        $raodqueri = mssql_query("SELECT
		pr.Fname,
	pr.Sname,
	pr.Pname,
	cp.Post,
	sc.Sename,
	gr.Grname,
	pr.PersCode
FROM
	Persone AS pr
LEFT JOIN Worker AS wr ON pr.PersCode = wr.PersCode
LEFT JOIN C_Post AS cp ON wr.PostCode = cp.PostCode
LEFT JOIN Groups AS gr ON wr.Grcode = gr.Grcode
LEFT JOIN Sector AS sc ON gr.Secode = sc.Secode
WHERE
	pr.PersCode = '$pc'");
        $raodrov = mssql_fetch_array($raodqueri);
        $this->userinfo[] = $raodrov;
        return $this->userinfo;
    }

    function sheuft($pc)
    {
        $raodqueri = mssql_query("SELECT
dbo.Persone.PersCode,
dbo.Sector.Secode,
dbo.C_Post.PostCode,
dbo.Groups.Grcode
FROM 
dbo.Anketa
INNER JOIN dbo.Worker ON dbo.Worker.PersCode = dbo.Anketa.PersCode
INNER JOIN dbo.Persone ON dbo.Persone.PersCode = dbo.Worker.PersCode
INNER JOIN dbo.C_Post ON dbo.Worker.PostCode = dbo.C_Post.PostCode
INNER JOIN dbo.Groups ON dbo.Worker.Grcode = dbo.Groups.Grcode
INNER JOIN dbo.Sector ON dbo.Groups.Secode = dbo.Sector.Secode
WHERE dbo.Groups.Grcode = 003130
ANd dbo.C_Post.PostCode = 215
AND dbo.Worker.Activ != 0
AND	dbo.Persone.PersCode = $pc");
        $raodrov = mssql_fetch_array($raodqueri);
        $this->sheufr[] = $raodrov;
        return $this->sheufr;
    }

    function shesytan($pc)
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
AND	dbo.Persone.PersCode = $pc");
        $raodrov = mssql_fetch_array($raodqueri);
        $this->shetan[] = $raodrov;
        return $this->shetan;
    }
public $sheittan = array();
    function itshes($pc)
    {
        $queri = mssql_query("
    SELECT
dbo.Persone.Sname,
dbo.Persone.Fname,
dbo.Groups.Grname,
dbo.C_Post.Post,
dbo.Sector.Sename,
dbo.Persone.PersCode

FROM
dbo.Persone 
INNER JOIN dbo.Worker ON dbo.Persone.PersCode = dbo.Worker.PersCode 
INNER JOIN dbo.C_Post ON dbo.Worker.PostCode = dbo.C_Post.PostCode 
INNER JOIN dbo.Groups ON dbo.Worker.Grcode = dbo.Groups.Grcode
INNER JOIN dbo.Sector ON dbo.Groups.Secode = dbo.Sector.Secode
WHERE
dbo.Sector.Secode = 0034
AND dbo.Groups.Grcode = 003440
AND dbo.Worker.Contract = 0
AND dbo.Worker.Activ < 20
AND	dbo.Persone.PersCode = $pc
    ");
        $raodrov = mssql_fetch_array($queri);
        $this->sheittan[] = $raodrov;
        return $this->sheittan;
    }

    public $sqlittan=array();
    function sqlittan($pc)
    {
        $query = $this->mySQL->query("SELECT perscode FROM ittan WHERE perscode = '$pc' AND active = 0");
        while ($row = $query->fetch()) {
            $this->sqlittan[] = $row;
        }
        return $this->sqlittan;
    }


    function grant($pc)
    {
        $raodqueri = mssql_query("SELECT
ng.GrantName,
cgm.description,
cgm.memberid,
ng.GrantID,
dbo.Persone.Sname,
dbo.Persone.Fname,
ng.GrantN
FROM
dbo.WorkerGrant AS wog
LEFT JOIN dbo.NGrants AS ng ON wog.GrantID = ng.GrantID
LEFT JOIN dbo.C_GrantMember AS cgm ON cgm.memberid = wog.memberid
LEFT JOIN dbo.Persone ON wog.PersCode = dbo.Persone.PersCode
WHERE
wog.PersCode = '$pc'");
        while ($raodrov = mssql_fetch_array($raodqueri)) {
            $this->usergrant[] = $raodrov;
        }
        return $this->usergrant;
    }

    function worved($grantID, $werID)
    {
        //echo "SELECT editinp,active FROM teqn WHERE grantID = $grantID AND werID = $werID ";
        $query = $this->mySQL->query("SELECT editinp,active FROM teqn WHERE grantID = $grantID AND werID = $werID ");
        while ($row = $query->fetch()) {
            $this->fomrtitle[] = $row;
        }
        return $this->fomrtitle;
    }
}

?>