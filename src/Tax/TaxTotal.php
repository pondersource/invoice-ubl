<?php

namespace Pondersource\Invoice\Tax;

use InvalidArgumentException as InvalidArgumentException;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;
use Pondersource\Invoice\Schema;
use Pondersource\Invoice\Invoice\GenerateInvoice;
use Sabre\Xml\Reader;
use Sabre\Xml\XmlDeserializable;


class TaxTotal implements XmlSerializable, XmlDeserializable
{
    private $taxAmount;
    private $taxSubTotals = [];

    /**
     * Invoice total VAT amount, Invoice total VAT amount in accounting currency
     */
    public function getTaxAmount(): ?float
    {
        return $this->taxAmount;
    }

    /**
     * Set tax amount
     */
    public function setTaxAmount(?float $taxAmount): TaxTotal
    {
        $this->taxAmount = $taxAmount;
        return $this;
    }

    /**
     *  VAT BREAKDOWN
     */
    public function getTaxSubtotal(): array
    {
        return $this->taxSubTotals;
    }

    /**
     * Set tax subtotal
     */
    public function setTaxSubtotal(TaxSubTotal $taxSubTotals): TaxTotal
    {
        $this->taxSubTotals[] = $taxSubTotals;
        return $this;
    }

    /**
     * validation for tax amount
     */
    public function validate()
    {
        if ($this->taxAmount === null) {
            throw new InvalidArgumentException('Missing taxtotal tax amount');
        }
    }

    /**
     * Serialize TaxtTotal
     */
    public function xmlSerialize(Writer $writer): void
    {
        $writer->write([
            'name' => Schema::CBC . 'TaxAmount',
            'value' => number_format($this->taxAmount, 2, '.', ''),
            'attributes' => [
                'currencyID' => GenerateInvoice::$currencyID
            ]
        ]);

        foreach ($this->taxSubTotals as $taxSubTotal) {
            $writer->write([ Schema::CAC . 'TaxSubtotal' => $taxSubTotal]);
        }
    }

    /**
     * Deserilize TaxTotal
     */
    static function xmlDeserialize(Reader $reader)
    {
        $taxTotal = new self();

        $keyValue = Sabre\Xml\Element\KeyValue::xmlDeserialize($reader);

        if (isset($keyValue[Schema::CBC . 'TaxAmount'])) {
            $taxTotal->taxAmount = $keyValue[Schema::CBC . 'TaxAmount'];
        }

        if (isset($keyValue[Schema::CAC . 'TaxSubtotal'])) {
            $taxTotal->taxSubTotal = $keyValue[Schema::CAC . 'TaxSubtotal'];
        }
        return $taxTotal;
    }
}
