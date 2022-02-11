<?php

namespace Pondersource\Invoice\Financial;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;
use Pondersource\Invoice\Schema;
use Sabre\Xml\Reader;
use Sabre\Xml\XmlDeserializable;


class PayeeFinancialAccount implements XmlSerializable, XmlDeserializable
{
    private $id;
    private $name;
    private $financialInstitutionBranch;


    /**
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return PayeeFinancialAccount
     */
    public function setId(?string $id): PayeeFinancialAccount
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return PayeeFinancialAccount
     */
    public function setName(?string $name): PayeeFinancialAccount
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return FinancialInstitutionBranch
     */
    public function getFinancialInstitutionBranch(): ?FinancialInstitutionBranch
    {
        return $this->financialInstitutionBranch;
    }

    /**
     * @param FinancialInstitutionBranch $financialInstitutionBranch
     * @return PayeeFinancialAccount
     */
    public function setFinancialInstitutionBranch(?FinancialInstitutionBranch $financialInstitutionBranch): PayeeFinancialAccount
    {
        $this->financialInstitutionBranch = $financialInstitutionBranch;
        return $this;
    }

    public function xmlSerialize(Writer $writer)
    {
        $writer->write([
            'name' => Schema::CBC . 'ID',
            'value' => $this->id,
            'attributes' => [
                //'schemeID' => 'IBAN'
            ]
        ]);

        if ($this->getName() !== null) {
            $writer->write([
                Schema::CBC . 'Name' => $this->getName()
            ]);
        }

        if ($this->getFinancialInstitutionBranch() !== null) {
            $writer->write([
                Schema::CAC . 'FinancialInstitutionBranch' => $this->getFinancialInstitutionBranch()
            ]);
        }
    }

    /**
     * Deserialize Payee Financial Account
     */
    static function xmlDeserialize(Reader $reader)
    {
        $payeeFinancial = new self();

        $keyValue =  Sabre\Xml\Element\KeyValue::xmlDeserialize($reader);

        if (isset($keyValue[Schema::CBC . 'ID'])) {
            $financial->id = $keyValue[Schema::CBC . 'ID'];
        }

        if (isset($keyValue[Schema::CBC . 'Name'])) {
            $financial->name = $keyValue[Schema::CBC . 'Name'];
        }

        if (isset($keyValue[Schema::CAC . 'FinancialInstitutionBranch'])) {
            $financial->financialInstitutionBranch = $keyValue[Schema::CAC . 'FinancialInstitutionBranch'];
        }

        return $payeeFinancial;
    }
}
