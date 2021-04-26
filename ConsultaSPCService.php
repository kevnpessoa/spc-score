<?php

class ConsultaSPCService
{
    protected $user = '';
    protected $password = '';
    protected $url = 'http://webservice.consulta.spcjava.spcbrasil.org/';
    protected $wsdl = 'treinawsdl.xml';
    protected $codigoProduto = '12'; //'175';
    protected $documento = '';

    public function __construct($documento)
    {
        $this->documento = $documento;
    }

    public function prepareClient()
    {
        $client = new SoapClient($this->wsdl, 
            array(
                //'location' => $this->url, 
                "trace" => 1, //"exceptions" => 1,
                "login" => $this->user, "password" => $this->password
            ) 
        );

        return $client;
    }

    public function consultaScore($horizonteScore = "3", $tipoPessoa = "F")
    {
        $protocolo = $this->consulta();
        $params = new stdClass();
        $params->{'numero-protocolo'} = $protocolo->protocolo->numero;
        $params->{'numero-documento'} = $this->documento;
        $params->{'codigo-produto-principal'} = $this->codigoProduto;
        $params->{'horizonte-score'} = $horizonteScore;
        $params->{'tipo-pessoa'} = $tipoPessoa;

        $result = $this->prepareClient()->consultaScore($params);
        
        return $result;
    }

    public function consulta($tipoPessoa = "F")
    {
        $params = new stdClass();
        $params->{'documento-consumidor'} = $this->documento;
        $params->{'codigo-produto'} = $this->codigoProduto;
        $params->{'tipo-consumidor'} = $tipoPessoa;

        $result = $this->prepareClient()->consultar($params);
        return $result;
    }
    
    public function listaProdutos()
    {
        $result = $this->prepareClient()->listarProdutos();
        return $result;
    }

}