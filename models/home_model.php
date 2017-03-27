<?php

class test_model extends dataase
{
    public $rows;

    public function test_viu()
    {

        $raodqueri = mssql_query("SELECT dbo.Faculty.FaName
FROM (dbo.Faculty INNER JOIN dbo.Groups ON dbo.Faculty.FaCode = dbo.Groups.Facode) 
INNER JOIN (dbo.Worker INNER JOIN dbo.Persone ON dbo.Worker.PersCode = dbo.Persone.PersCode) ON dbo.Groups.Grcode = dbo.Worker.Grcode
WHERE (((dbo.Persone.Status)<3) AND ((dbo.Worker.Activ)<19) AND (dbo.Worker.Contract=0 Or dbo.Worker.Contract=24 Or dbo.Worker.Contract=20))
GROUP BY dbo.Faculty.FaName, dbo.Faculty.FaCode
HAVING (((dbo.Faculty.FaCode)<17))
ORDER BY dbo.Faculty.FaCode;");
        $raodrov = mssql_fetch_array($raodqueri);
        var_dump($raodrov);

        $stmt = $this->mySQL->prepare("SELECT * FROM `product`");
        $stmt->execute();
        $this->rows = $stmt->fetchAll();
        return $this->rows;
    }
}