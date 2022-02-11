<?php

namespace Pondersource\Invoice\Account;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;
use Pondersource\Invoice\Schema;
use Sabre\Xml\Reader;
use Sabre\Xml\XmlDeserializable;

class Country implements XmlSerializable, XmlDeserializable
{
    private $identificationCode;

    private $countryCodes = [
        'listID' => 'UN/ECE 4461',
        'listName' => 'Country Code',
        'listURI' => 'http://docs.oasis-open.org/ubl/os-UBL-2.0-update/cl/gc/default/CountryIdentificationCode-2.0.gc'
    ];

    /**
     * Get Country Code
     */
    public function getIdentificationCode(): ?string
    {
        return $this->identificationCode;
    }

    /**
     * Set Country Code
     */
    public function setIdentificationCode(?string $identificationCode): Country
    {
        $this->identificationCode = $identificationCode;
        return $this;
    }

    /**
     * XML Serialize for Country
     */
    public function xmlSerialize(Writer $writer)
    {
        $writer->write([
            Schema::CBC . 'IdentificationCode' => $this->identificationCode
        ]);
    }

    /**
     * XML Deserialize for Country
     */
    static function xmlDeserialize(Reader $reader)
    {
        $country = new self();
        $keyValue =  Sabre\Xml\Element\KeyValue::xmlDeserialize($reader);

        if (isset($keyValue[Schema::CBC .'IdentificationCode'])) {
            $country->identificationCode = $keyValue[Schema::CBC .'IdentificationCode'];
        }
        return $country;
    }
}
