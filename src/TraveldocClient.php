<?php

namespace Adkarta\Traveldoc;

use Adkarta\Traveldoc\SoapClient as SoapClient;
use Adkarta\Traveldoc\Session;

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

    public function getSession()
    {
        $session = new Session();
        $session->UserName = $this->config['username'];
        $session->Password = $this->config['password'];
        $session->ClientName = $this->config['client_name'];
        $session->ConfigurationName = $this->config['configuration_name'];

        $out = $this->soap_client->GetSession($session);
        $SessionGUID = $out->GetSessionResult;
        return $SessionGUID;
    }

    public function checkPassenger($passenger)
    {
        return $this->soap_client->CheckPassenger($passenger);
    }

    public function getDocumentTypes($session)
    {
        $documentType = new \stdClass();
        $documentType->SessionGUID = $session;

        return $this->soap_client->GetDocumentTypes($documentType);
    }



}
