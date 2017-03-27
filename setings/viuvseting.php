<?php
class viuvset
{
    public $viufile, $data = array(), $load = array(), $urlbase, $post=array(), $url=array();

    function __construct($dir)
    {
        if(isset($dir) && !empty($dir)) {
            require_once 'controlers/' . $dir . '_Controler.php';
            $class = new $dir;
        }else{
            require_once 'controlers/home_Controler.php';
            $class = new home();
        }
        foreach ($class->load as $item){
            require_once 'models/' . $item . '_model.php';
        }

    }

    function controler($dir="home", $func="index", $getresurs, $post)
    {
        @$dir::$func($getresurs, $post);
        //eval ("$class->$func()");
        //call_user_func_array($func, array());
        //$class->$func.'()';
    }

    function viu($viu, $data)
    {
        $this->viufile = $viu;
        $this->data[] = $data;
    }

    function load($load)
    {
        $this->load[] = $load;
    }

    function baseurl($url)
    {
        $this->urlbase = $url;
    }

    function post($post)
    {
        $this->post[]=$post;
    }

    function url($url)
    {
        $this->url[]=$url;
    }
}

?>