<?php 


class Genre {
    public $name;

    function __construct($name)
    {
        $this->name = $name;
    }

    function get_name() {
        return $this->name;
    }
}


?>