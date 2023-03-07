<?php

namespace Pondersource\Invoice\Legal;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;
use Pondersource\Invoice\Schema;
use Sabre\Xml\Reader;
use Sabre\Xml\XmlDeserializable;

class LegalEntity implements XmlSerializable, XmlDeserializable
{
    private $registrationName;
    private $companyId;
    private $companyIdAttributes;
    private $companyLegalForm;

    /**
     * Seller name
     */
    public function getRegistrationName(): ?string
    {
        return $this->registrationName;
    }

    /**
     * Set seller name;
     */
    public function setRegistrationName(?string $registrationName): LegalEntity
    {
        $this->registrationName = $registrationName;
        return $this;
    }

    /**
     * Seller legal registration identifier
     */
    public function getCompanyId(): ?string
    {
        return $this->companyId;
    }

    /**
     * set Company ID
     */
    public function setCompanyId(?string $companyId, $attributes = null): LegalEntity
    {
        $this->companyId = $companyId;
        if (isset($attributes)) {
            $this->$companyIdAttributes = $attributes;
        }
        return $this;
    }

    /**
     * Company form legal
     */
    public function getCompanyLegalForm(): ?string
    {
        return $this->companyLegalForm;
    }

    /**
     * Set company form legal
     */
    public function setCompanyLegal(?string $companyLegalForm): LegalEntity
    {
        $this->companyLegalForm = $companyLegalForm;
        return $this;
    }

    /**
     * Serialize Legal Entity
     */
    public function xmlSerialize(Writer $writer)
    {
        $writer->write([
            Schema::CBC . 'RegistrationName' => $this->registrationName
        ]);

        if ($this->companyId !== null) {
            $writer->write([
                'name' => Schema::CBC . 'CompanyID',
                'value' => $this->companyId,
                'attributes' => $this->companyIdAttributes
            ]);
        }
    }

    /**
     * Deserialize Legal Entity
     */
    static function xmlDeserialize(Reader $reader)
    {
        $legalEntity = new self();

        $keyValue = Sabre\Xml\Element\KeyValue::xmlDeserialize($reader);

        if (isset($keyValue[Schema::CBC . 'RegistrationName'])) {
            $legalEntity->registrationName = $keyValue[Schema::CBC . 'RegistrationName'];
        }

        if (isset($keyValue[Schema::CBC . 'CompanyID'])) {
            $legalEntity->companyId = $keyValue[Schema::CBC . 'CompanyID'];
        }
        
        return $legalEntity;
    }
}
