<?php

namespace ClubMapper\Lib;


class DataInjector
{
    /**
     * @var Club[]
     */
    protected $clubs = [];

    public function addClub(Club $club)
    {
        array_unshift($this->clubs, $club);
    }

    public function printGeolocationFinder()
    {
        $return = "";
        foreach ($this->clubs as $club) {
            $return .= '"' . $club->getName(). '"';
            $return .= ',"' .
                implode( ',', $club->getAddress()).
                '"';

            $return .= "\n";
        }

        return $return;
    }
}