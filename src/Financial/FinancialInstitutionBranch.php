<?php

namespace Pondersource\Invoice\Financial;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;
use Pondersource\Invoice\Schema;
use Sabre\Xml\Reader;
use Sabre\Xml\XmlDeserializable;

class FinancialInstitutionBranch implements XmlSerializable, XmlDeserializable
{
    private $id;

    /**
     * Payment service provider identifier
     *  Example value: 9999
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Set provider identifier
     */
    public function setId(?string $id): FinancialInstitutionBranch
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Serialize XML FinancialInstitutionBranch
     */
    public function xmlSerialize(Writer $writer)
    {
        $writer->write([
           Schema::CBC . 'ID' => $this->id
        ]);
    }

     /**
     * Deserialize XML FinancialInstitutionBranch
     */
    static function xmlDeserialize(Reader $reader)
    {
        $financial = new self();

        $keyValue =  Sabre\Xml\Element\KeyValue::xmlDeserialize($reader);

        if (isset($keyValue[Schema::CBC . 'ID'])) {
            $financial->id = $keyValue[Schema::CBC . 'ID'];
        }
        return $financial;
    }
}
