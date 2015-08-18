<?php

namespace Adkarta\Traveldoc;

use WS\WSASoap;

class SoapClient extends \SoapClient
{

    public function __doRequest($request, $location, $saction, $version, $one_way = null)
    {
        $dom = new \DOMDocument();
        $dom->loadXML($request);

        $wsa = new WSASoap($dom);
        $wsa->addAction($saction);
        $wsa->addTo($location);
        $wsa->addMessageID();
        $wsa->addReplyTo();

        $request = $wsa->saveXML();

        return parent::__doRequest($request, $location, $saction, $version, $one_way);
    }

}