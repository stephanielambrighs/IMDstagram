<?php
include_once(__DIR__ . "/Db.php");

class Search
{
    private $search;

    /**
     * Get the value of search
     */ 
    public function getSearch()
    {
        return $this->search;
    }

    /**
     * Set the value of search
     *
     * @return  self
     */ 
    public function setSearch($search)
    {
        $this->search = $search;

        return $this;
    }

    public function search($search){
        $search = $this->getSearch();
        $statement = $conn->prepare("select * LIKE :searchQuery") or die("could not searc");
        $statement->bindValue(':searchQuery', $searchQuery);
        $count = mysql_num_rows($query);
        if($count == 0){
            $output = "There are no search results";
        }else{
            while($row = mysql_fetch_array($query)){
                $username = $row['username'];
                $output.="<div>".$username."".$post."</div>";
            }
        }
    }
    
}