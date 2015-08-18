<?php

namespace Adkarta\Traveldoc;

use WS\WSASoap;

class TraveldocClient extends \SoapClient
{

    protected $config;

    protected $soap_version = SOAP_1_2;

    protected $soap_client;

    public function __construct($config = array(), $wsdl = "http://stage.traveldoc-airasia.com/Integrated/4.2/Service.svc?wsdl")
    {
        $this->config = $config;

        if ($this->soap_client == null) {
            $this->soap_client = new \SoapClient($wsdl, array('soap_version' => SOAP_1_2));
        }

        parent::__construct($wsdl, array('soap_version' => SOAP_1_2));
    }

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

    public function test()
    {
        return "test ok";
    }

    public function geta()
    {
        return $this->soap_client;
    }

}

?>