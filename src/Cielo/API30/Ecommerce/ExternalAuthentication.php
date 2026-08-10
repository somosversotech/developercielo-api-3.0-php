<?php

namespace Cielo\API30\Ecommerce;

/**
 * Class ExternalAuthentication
 *
 * Dados da autenticação 3DS 2.x executada fora do fluxo de autorização — o modelo de
 * "autenticação externa" da Cielo. O 3DS Server autentica o portador no checkout e devolve
 * ECI, CAVV, XID, versão do protocolo e o identificador da requisição, que precisam ser
 * enviados junto da autorização para que a transferência de responsabilidade valha.
 *
 * @package Cielo\API30\Ecommerce
 */
class ExternalAuthentication implements CieloSerializable
{
    private $cavv;

    private $xid;

    private $eci;

    private $version;

    private $referenceId;

    /**
     * ExternalAuthentication constructor.
     *
     * @param string|null $cavv        Assinatura da autenticação
     * @param string|null $xid         Identificador da transação na autenticação
     * @param string|null $eci         Indicador do resultado, interpretado por bandeira
     * @param string|null $version     Versão do protocolo 3DS
     * @param string|null $referenceId Identificador da requisição de autenticação
     */
    public function __construct($cavv = null, $xid = null, $eci = null, $version = null, $referenceId = null)
    {
        $this->cavv        = $cavv;
        $this->xid         = $xid;
        $this->eci         = $eci;
        $this->version     = $version;
        $this->referenceId = $referenceId;
    }

    /**
     * @param \stdClass $data
     *
     * @return $this
     */
    public function populate(\stdClass $data)
    {
        $this->cavv    = isset($data->Cavv) ? $data->Cavv : null;
        $this->xid     = isset($data->Xid) ? $data->Xid : null;
        $this->eci     = isset($data->Eci) ? $data->Eci : null;
        $this->version = isset($data->Version) ? $data->Version : null;

        // A Cielo documenta ReferenceID; ReferenceId aparece em respostas de algumas versões.
        if (isset($data->ReferenceID)) {
            $this->referenceId = $data->ReferenceID;
        } else {
            $this->referenceId = isset($data->ReferenceId) ? $data->ReferenceId : null;
        }

        return $this;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    /**
     * @return string|null
     */
    public function getCavv()
    {
        return $this->cavv;
    }

    /**
     * @param string|null $cavv
     *
     * @return $this
     */
    public function setCavv($cavv)
    {
        $this->cavv = $cavv;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getXid()
    {
        return $this->xid;
    }

    /**
     * @param string|null $xid
     *
     * @return $this
     */
    public function setXid($xid)
    {
        $this->xid = $xid;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEci()
    {
        return $this->eci;
    }

    /**
     * @param string|null $eci
     *
     * @return $this
     */
    public function setEci($eci)
    {
        $this->eci = $eci;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param string|null $version
     *
     * @return $this
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getReferenceId()
    {
        return $this->referenceId;
    }

    /**
     * @param string|null $referenceId
     *
     * @return $this
     */
    public function setReferenceId($referenceId)
    {
        $this->referenceId = $referenceId;

        return $this;
    }
}
