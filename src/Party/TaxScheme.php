<?php

namespace Pondersource\Invoice\Party;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;
use Pondersource\Invoice\Schema;
use Sabre\Xml\Reader;
use Sabre\Xml\XmlDeserializable;

class TaxScheme implements XmlSerializable, XmlDeserializable
{
    private $id;
    /**
     * For Seller Vat Identifier get
     * Example value: VAT
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     *Set ID
     */
    public function setId(?string $id): TaxScheme
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Serialize XML Tax Scheme
     */
    public function xmlSerialize(Writer $writer)
    {
        $writer->write([
          Schema::CBC . 'ID' => $this->id
        ]);
    }

    /**
     * Deserialize XML TaxScheme
     */
    static function xmlDeserialize(Reader $reader)
    {
        $taxScheme = new self();

        $keyValue = Sabre\Xml\Element\KeyValue::xmlDeserialize($reader);

        if (isset($keyValue[Schema::CBC . 'ID'])) {
            $taxScheme->id = $keyValue[Schema::CBC . 'ID'];
        }
        return $taxScheme;
    }
}
