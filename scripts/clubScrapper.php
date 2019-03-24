<?php

require_once 'vendor/autoload.php';

use ClubMapper\Lib\DataInjector;
use ClubMapper\Lib\Club;

use PHPHtmlParser\Dom;

$dom = new Dom();
$dom->loadFromFile('clubs.html');

/** @var Dom\HtmlNode $clubsContainer */
$clubsContainer = $dom->find('.view-clubs')[0];

/** @var Dom\HtmlNode[]|Dom\Collection $clubNodes */
$clubNodes = $clubsContainer->find('table.views-table tr');

$dataInjector = new DataInjector();

foreach ($clubNodes as $clubNode) {
    $club = new Club();

    /** @var Dom\HtmlNode[] $clubSections */
    $clubSections = $clubNode->find('td');
    $club->setName($clubSections[0]->find('a')[0]->innerHtml());
    $club->setAddress(
        [
            $clubSections[1]->find('div.name-block')[0]->firstChild()->innerHtml(),
            fetchAddressPartFromBlock($clubSections[1], 'div.thoroughfare'),
            fetchAddressPartFromBlock($clubSections[1], 'div.premise'),
            fetchAddressPartFromBlock($clubSections[1], 'div.locality'),
            fetchAddressPartFromBlock($clubSections[1], 'div.locality-block div.state'),
            fetchAddressPartFromBlock($clubSections[1], 'div.postal-code'),
        ]
    );

    $dataInjector->addClub($club);
}

echo $dataInjector->printGeolocationFinder();

function fetchAddressPartFromBlock(Dom\HtmlNode $domBlock, $keyName)
{
    $subPart = $domBlock->find('' . $keyName);

    if ($subPart instanceof Dom\Collection && $subPart->count() > 0) {
        return $subPart[0]->innerHtml();
    }

    return '';
}



//echo get_class($clubsContainer);
//echo "\n" . count($clubsContainer);

