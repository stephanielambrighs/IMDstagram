<?php
class Search
{
    private $emailTarget;

    /**
     * Get the value of emailTarget
     */
    public function getEmailTarget()
    {
        return $this->emailTarget;
    }

    /**
     * Set the value of emailTarget
     *
     * @return  self
     */
    public function setEmailTarget($emailTarget)
    {
        $this->emailTarget = $emailTarget;

        return $this;
    }
}