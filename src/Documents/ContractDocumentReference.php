<?php

namespace Pondersource\Invoice\Documents;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;
use Pondersource\Invoice\Schema;
use Sabre\Xml\Reader;
use Sabre\Xml\XmlDeserializable;

class ContractDocumentReference implements XmlSerializable, XmlDeserializable
{
    private $id;

    /**
     * Get The identification of a contract.
     * Example value: 123Contractref
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Set id
     */
    public function setId(?string $id): ContractDocumentReference
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Xml Serialize Contract Document Reference
     */
    public function xmlSerialize(Writer $writer)
    {
        if ($this->id !== null) {
            $writer->write([
              Schema::CBC . 'ID' => $this->id
            ]);
        }
    }

     /**
     * Deserialize ContactDocumentReference
     */
    static function xmlDeserialize(Reader $reader)
    {
        $contactDocRef = new self();

        $keyValue =  Sabre\Xml\Element\KeyValue::xmlDeserialize($reader);

        if (isset($keyValue[Schema::CBC . 'ID'])) {
            $contactDocRef->id = $keyValue[Schema::CBC . 'ID'];
        }
        return $contactDocRef;
    }
}
