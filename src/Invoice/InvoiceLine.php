<?php

namespace Pondersource\Invoice\Invoice;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;
use Pondersource\Invoice\Payment\UnitCode;
use Pondersource\Invoice\Item;
use Pondersource\Invoice\Payment\Price;
use Pondersource\Invoice\Invoice\InvoicePeriod;
use Pondersource\Invoice\Schema;
use Pondersource\Invoice\Invoice\GenerateInvoice;
use Pondersource\Invoice\Tax\TaxTotal;
use Sabre\Xml\Reader;
use Sabre\Xml\XmlDeserializable;

class InvoiceLine implements XmlSerializable, XmlDeserializable
{
    private $id;
    private $invoicedQuantity;
    private $lineExtensionAmount;
    private $unitCode = UnitCode::UNIT;
    private $taxTotal;
    private $invoicePeriod;
    private $note;
    private $item;
    private $price;
    private $accountingCostCode;
    private $accountingCost;

    /**
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return InvoiceLine
     */
    public function setId(?string $id): InvoiceLine
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return float
     */
    public function getInvoicedQuantity(): ?float
    {
        return $this->invoicedQuantity;
    }

    /**
     * @param float $invoicedQuantity
     * @return InvoiceLine
     */
    public function setInvoicedQuantity(?float $invoicedQuantity): InvoiceLine
    {
        $this->invoicedQuantity = $invoicedQuantity;
        return $this;
    }

    /**
     * @return float
     */
    public function getLineExtensionAmount(): ?float
    {
        return $this->lineExtensionAmount;
    }

    /**
     * @param float $lineExtensionAmount
     * @return InvoiceLine
     */
    public function setLineExtensionAmount(?float $lineExtensionAmount): InvoiceLine
    {
        $this->lineExtensionAmount = $lineExtensionAmount;
        return $this;
    }

    /**
     * @return TaxTotal
     */
    public function getTaxTotal(): ?TaxTotal
    {
        return $this->taxTotal;
    }

    /**
     * @param TaxTotal $taxTotal
     * @return InvoiceLine
     */
    public function setTaxTotal(?TaxTotal $taxTotal): InvoiceLine
    {
        $this->taxTotal = $taxTotal;
        return $this;
    }

    /**
     * @return string
     */
    public function getNote(): ?string
    {
        return $this->note;
    }

    /**
     * @param string $note
     * @return InvoiceLine
     */
    public function setNote(?string $note): InvoiceLine
    {
        $this->note = $note;
        return $this;
    }

    /**
     * @return InvoicePeriod
     */
    public function getInvoicePeriod(): ?InvoicePeriod
    {
        return $this->invoicePeriod;
    }

    /**
     * @param InvoicePeriod $invoicePeriod
     * @return InvoiceLine
     */
    public function setInvoicePeriod(?InvoicePeriod $invoicePeriod)
    {
        $this->invoicePeriod = $invoicePeriod;
        return $this;
    }

    /**
     * @return Item
     */
    public function getItem(): ?Item
    {
        return $this->item;
    }

    /**
     * @param Item $item
     * @return InvoiceLine
     */
    public function setItem(Item $item): InvoiceLine
    {
        $this->item = $item;
        return $this;
    }

    /**
     * @return Price
     */
    public function getPrice(): ?Price
    {
        return $this->price;
    }

    /**
     * @param Price $price
     * @return InvoiceLine
     */
    public function setPrice(?Price $price): InvoiceLine
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return string
     */
    public function getUnitCode(): ?string
    {
        return $this->unitCode;
    }

    /**
     * @param string $unitCode
     * @return InvoiceLine
     */
    public function setUnitCode(?string $unitCode): InvoiceLine
    {
        $this->unitCode = $unitCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getAccountingCostCode(): ?string
    {
        return $this->accountingCostCode;
    }

    /**
     * @param string $accountingCostCode
     * @return InvoiceLine
     */
    public function setAccountingCostCode(?string $accountingCostCode): InvoiceLine
    {
        $this->accountingCostCode = $accountingCostCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getAccountingCost(): ?string
    {
        return $this->accountingCost;
    }

    /**
     * @param string $accountingCost
     * @return InvoiceLine
     */
    public function setAccountingCost(?string $accountingCost): InvoiceLine
    {
        $this->accountingCost = $accountingCost;
        return $this;
    }

    /**
     * The xmlSerialize method is called during xml writing.
     * @param Writer $writer
     * @return void
     */
    public function xmlSerialize(Writer $writer)
    {
        $writer->write([
            Schema::CBC . 'ID' => $this->id
        ]);

        if (!empty($this->getNote())) {
            $writer->write([
                Schema::CBC . 'Note' => $this->getNote()
            ]);
        }

        $writer->write([
            [
                'name' => Schema::CBC . 'InvoicedQuantity',
                'value' => number_format($this->invoicedQuantity, 2, '.', ''),
                'attributes' => [
                    'unitCode' => $this->unitCode
                ]
            ],
            [
                'name' => Schema::CBC . 'LineExtensionAmount',
                'value' => number_format($this->lineExtensionAmount, 2, '.', ''),
                'attributes' => [
                    'currencyID' => GenerateInvoice::$currencyID
                ]
            ]
        ]);
        if ($this->accountingCostCode !== null) {
            $writer->write([
                Schema::CBC . 'AccountingCostCode' => $this->accountingCostCode
            ]);
        }
        if ($this->accountingCost !== null) {
            $writer->write([
                Schema::CBC . 'AccountingCost' => $this->accountingCost
            ]);
        }
        if ($this->invoicePeriod !== null) {
            $writer->write([
                Schema::CAC . 'InvoicePeriod' => $this->invoicePeriod
            ]);
        }
        if ($this->taxTotal !== null) {
            $writer->write([
                Schema::CAC . 'TaxTotal' => $this->taxTotal
            ]);
        }
        $writer->write([
            Schema::CAC . 'Item' => $this->item,
        ]);

        if ($this->price !== null) {
            $writer->write([
                Schema::CAC . 'Price' => $this->price
            ]);
        } else {
            $writer->write([
                Schema::CAC . 'TaxScheme' => null,
            ]);
        }
    }

    /**
     * Deserialize Invoice Line
     */
    static function xmlDeserialize(Reader $reader)
    {
        $invoiceLine = new self();
        
        $keyValue = Sabre\Xml\Element\KeyValue::xmlDeserialize($reader);

        if (isset($keyValue[Schema::CBC . 'ID'])) {
            $invoiceLine->id = $keyValue[Schema::CBC . 'ID'];
        }

        if (isset($keyValue[Schema::CBC . 'Note'])) {
            $invoiceLine->note = $keyValue[Schema::CBC . 'Note'];
        }

        if (isset($keyValue[Schema::CBC . 'InvoicedQuantity']) && isset($keyValue[Schema::CBC . 'LineExtensionAmount'])) {
            $invoiceLine->invoicedQuantity = $keyValue[Schema::CBC . 'InvoicedQuantity'];
            $invoiceLine->lineExtensionAmount = $keyValue[Schema::CBC . 'LineExtensionAmount'];
        }

        if (isset($keyValue[Schema::CBC .'AccountingCostCode'])) {
            $invoiceLine->accountingCostCode = $keyValue[Schema::CBC . 'AccountingCostCode'];
        }

        if (isset($keyValue[Schema::CBC .'AccountingCost'])) {
            $invoiceLine->accountingCost = $keyValue[Schema::CBC . 'AccountingCost'];
        }

        if (isset($keyValue[Schema::CAC . 'InvoicePeriod'])) {
            $invoiceLine->invoicePeriod = $keyValue[Schema::CAC . 'InvoicePeriod'];
        }

        if (isset($keyValue[Schema::CAC . 'TaxTotal'])) {
            $invoiceLine->taxTotal = $keyValue[Schema::CAC . 'TaxTotal'];
        }

        if (isset($keyValue[Schema::CAC . 'Item'])) {
            $invoiceLine->item = $keyValue[Schema::CAC . 'Item'];
        }

        if (isset($keyValue[Schema::CAC . 'Price'])) {
            $invoiceLine->price = $keyValue[Schema::CAC . 'Price'];
        }

        return $invoiceLine;
    }
}
