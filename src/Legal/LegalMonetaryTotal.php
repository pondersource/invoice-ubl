<?php

namespace Pondersource\Invoice\Legal;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;
use Pondersource\Invoice\Schema;
use Pondersource\Invoice\Invoice\GenerateInvoice;
use Sabre\Xml\Reader;
use Sabre\Xml\XmlDeserializable;

class LegalMonetaryTotal implements XmlSerializable, XmlDeserializable
{
    private $lineExtensionAmount;
    private $taxExclusiveAmount;
    private $taxInclusiveAmount;
    private $allowanceTotalAmount = 0;
    private $payableAmount;

    /**
     * @return float
     */
    public function getLineExtensionAmount(): ?float
    {
        return $this->lineExtensionAmount;
    }

    /**
     * @param float $lineExtensionAmount
     * @return LegalMonetaryTotal
     */
    public function setLineExtensionAmount(?float $lineExtensionAmount): LegalMonetaryTotal
    {
        $this->lineExtensionAmount = $lineExtensionAmount;
        return $this;
    }

    /**
     * @return float
     */
    public function getTaxExclusiveAmount(): ?float
    {
        return $this->taxExclusiveAmount;
    }

    /**
     * @param float $taxExclusiveAmount
     * @return LegalMonetaryTotal
     */
    public function setTaxExclusiveAmount(?float $taxExclusiveAmount): LegalMonetaryTotal
    {
        $this->taxExclusiveAmount = $taxExclusiveAmount;
        return $this;
    }

    /**
     * @return float
     */
    public function getTaxInclusiveAmount(): ?float
    {
        return $this->taxInclusiveAmount;
    }

    /**
     * @param float $taxInclusiveAmount
     * @return LegalMonetaryTotal
     */
    public function setTaxInclusiveAmount(?float $taxInclusiveAmount): LegalMonetaryTotal
    {
        $this->taxInclusiveAmount = $taxInclusiveAmount;
        return $this;
    }

    /**
     * @return float
     */
    public function getAllowanceTotalAmount(): ?float
    {
        return $this->allowanceTotalAmount;
    }

    /**
     * @param float $allowanceTotalAmount
     * @return LegalMonetaryTotal
     */
    public function setAllowanceTotalAmount(?float $allowanceTotalAmount): LegalMonetaryTotal
    {
        $this->allowanceTotalAmount = $allowanceTotalAmount;
        return $this;
    }

    /**
     * @return float
     */
    public function getPayableAmount(): ?float
    {
        return $this->payableAmount;
    }

    /**
     * @param float $payableAmount
     * @return LegalMonetaryTotal
     */
    public function setPayableAmount(?float $payableAmount): LegalMonetaryTotal
    {
        $this->payableAmount = $payableAmount;
        return $this;
    }

    /**
     * The xmlSerialize method is called during xml writing.
     *
     * @param Writer $writer
     * @return void
     */
    public function xmlSerialize(Writer $writer)
    {
        $writer->write([
            [
                'name' => Schema::CBC . 'LineExtensionAmount',
                'value' => number_format($this->lineExtensionAmount, 2, '.', ''),
                'attributes' => [
                    'currencyID' => GenerateInvoice::$currencyID
                ]

            ],
            [
                'name' => Schema::CBC . 'TaxExclusiveAmount',
                'value' => number_format($this->taxExclusiveAmount, 2, '.', ''),
                'attributes' => [
                    'currencyID' => GenerateInvoice::$currencyID
                ]

            ],
            [
                'name' => Schema::CBC . 'TaxInclusiveAmount',
                'value' => number_format($this->taxInclusiveAmount, 2, '.', ''),
                'attributes' => [
                    'currencyID' => GenerateInvoice::$currencyID
                ]

            ],
            [
                'name' => Schema::CBC . 'AllowanceTotalAmount',
                'value' => number_format($this->allowanceTotalAmount, 2, '.', ''),
                'attributes' => [
                    'currencyID' => GenerateInvoice::$currencyID
                ]

            ],
            [
                'name' => Schema::CBC . 'PayableAmount',
                'value' => number_format($this->payableAmount, 2, '.', ''),
                'attributes' => [
                    'currencyID' => GenerateInvoice::$currencyID
                ]
            ],
        ]);
    }

    /**
     * Deserialize LegalMonetaryTotal
     */
    static function xmlDeserialize(Reader $reader)
    {
        $legalMonetaryTotal = new self();

        $keyValue = Sabre\Xml\Element\KeyValue::xmlDeserialize($reader);

        if (isset($keyValue[Schema::CBC . 'LineExtensionAmount'])) {
            $legalMonetaryTotal->lineExtensionAmount = $keyValue[Schema::CBC . 'LineExtensionAmount'];
        }

        if (isset($keyValue[Schema::CBC . 'TaxExclusiveAmount'])) {
            $legalMonetaryTotal->taxExclusiveAmount = $keyValue[Schema::CBC . 'TaxExclusiveAmount'];
        }

        if (isset($keyValue[Schema::CBC . 'TaxInclusiveAmount'])) {
            $legalMonetaryTotal->taxInclusiveAmount = $keyValue[Schema::CBC . 'TaxInclusiveAmount'];
        }

        if (isset($keyValue[Schema::CBC . 'AllowanceTotalAmount'])) {
            $legalMonetaryTotal->allowanceTotalAmount = $keyValue[Schema::CBC . 'AllowanceTotalAmount'];
        }

        if (isset($keyValue[Schema::CBC . 'PayableAmount'])) {
            $legalMonetaryTotal->payableAmount = $keyValue[Schema::CBC . 'PayableAmount'];
        }

        return $legalMonetaryTotal;
    }
}
