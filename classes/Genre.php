<?php 


class Genre {
    public $id;
    public $name;

    function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    // function __construct()
    // {
    //     // $this->id = $id;
    //     // $this->name = $name;
    // }

    public function getId()
    {
            return $this->id;
    }

    public function getName()
    {
            return $this->name;
    }
}


?>
