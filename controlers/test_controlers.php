<?php

require_once 'models/test_model.php';

class test_controler extends {


    function gsamo_controler(){
        $testModel = new test_model();
        $testModel->test_viu();
        return $testModel->rows;
    }
}