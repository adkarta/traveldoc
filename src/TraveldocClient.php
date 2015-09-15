<?php

namespace Adkarta\Traveldoc;

use Adkarta\Traveldoc\SoapClient as SoapClient;

class TraveldocClient 
{

    protected $config;

    protected $soap_version = SOAP_1_2;

    protected $soap_client;

    public function __construct($config = array(), $wsdl = "http://stage.traveldoc-airasia.com/Integrated/4.2/Service.svc?wsdl")
    {
        
        $this->config = $config;

        if ($this->soap_client == null) {
            $this->soap_client = @new SoapClient($wsdl, array('soap_version' => SOAP_1_2));
        }

    }

    public function getSession($sessionMessage)
    {
        $out = $this->soap_client->GetSession($sessionMessage);
        $SessionGUID = $out->GetSessionResult;
        return $SessionGUID;
    }

}
