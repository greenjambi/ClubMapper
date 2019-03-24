<?php

namespace ClubMapper\Lib;

class Club
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string[]
     */
    protected $address;

    /**
     * @var string
     */
    protected $website;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Club
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string[] $address
     * @return Club
     */
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * @param string $website
     * @return Club
     */
    public function setWebsite($website)
    {
        $this->website = $website;
        return $this;
    }
}
