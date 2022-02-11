<?php

namespace Pondersource\Invoice;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;
use Pondersource\Invoice\Tax\ClassifiedTaxCategory;
use Pondersource\Invoice\Schema;
use Sabre\Xml\Reader;
use Sabre\Xml\XmlDeserializable;


class Item implements XmlSerializable, XmlDeserializable
{
    private $name;
    private $description;
    private $buyersItemIdentification;
    private $sellersItemIdentification;
    private $classifiedTaxCategory;

    /**
     *  Item name
     */
    public function getItem(): ?string
    {
        return $this->name;
    }

    /**
     * Set item name
     */
    public function setName(?string $name): Item
    {
        $this->name = $name;
        return $this;
    }

    /**
     *  Item description
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }
    
    /**
     * Set description
     */
    public function setDescription(?string $description): Item
    {
        $this->description = $description;
        return $this;
    }

    /**
     * get byer item identification
     */
    public function getBuyersItemIdentification(): ?string
    {
        return $this->buyersItemIdentification;
    }

     /**
     * set byer item identification
     */
    public function setBuyersItemIdentification(?string $buyersItemIdentification): Item
    {
        $this->buyersItemIdentification = $this->buyersItemIdentification;
        return $this;
    }

     /**
     * get sellers item identification
     */
    public function getSellersItemIdentification(): ?string
    {
        return $this->sellersItemIdentification;
    }

     /**
     * set sellers item identification
     */
    public function setSellersItemIdentification(?string $sellersItemIdentification): Item
    {
        $this->sellersItemIdentification = $sellersItemIdentification;
        return $this;
    }

    /**
     * Classified Tax Category get
     */
    public function getClassifiedTaxCategory(): ?ClassifiedTaxCategory
    {
        return $this->classifiedTaxCategory;
    }

    /**
     * Set classified tax category
     */
    public function setClassifiedTaxCategory(?ClassifiedTaxCategory $classifiedTaxCategory): Item
    {
        $this->classifiedTaxCategory = $classifiedTaxCategory;
        return $this;
    }

    /**
     * Item Serialization
     */
    public function xmlSerialize(Writer $writer)
    {
        $writer->write([
            Schema::CBC . 'Description' => $this->description,
            Schema::CBC . 'Name' => $this->name
        ]);

        if (!empty($this->getBuyersItemIdentification)) {
            $writer->write([
                Schema::CAC . 'BuyersItemIdentification' => [
                    Schema::CBC . 'ID' => $this->buyersItemIdentification
                ]
            ]);
        }

        if (!empty($this->getSellersItemIdentification())) {
            $writer->write([
                Schema::CAC . 'SellersItemIdentification' => [
                    Schema::CBC . 'ID' => $this->sellersItemIdentification
                ]
            ]);
        }
        if (!empty($this->getClassifiedTaxCategory())) {
            $writer->write([
                Schema::CAC . 'ClassifiedTaxCategory' => $this->getClassifiedTaxCategory()
            ]);
        }
    }

     /**
     * Deserialize Item
     */
    static function xmlDeserialize(Reader $reader)
    {
        $item = new self();
        $keyValue =  Sabre\Xml\Element\KeyValue::xmlDeserialize($reader);
        if (isset($keyValue[Schema::CBC . 'Description'])) {
            $item->description = $keyValue[Schema::CBC . 'Description'];
        }

        if (isset($keyValue[Schema::CBC . 'Name'])) {
            $item->name = $keyValue[Schema::CBC . 'Name'];
        }

        if (isset($keyValue[Schema::CAC . 'BuyersItemIdentification' . [ Schema::CBC . 'ID']])) {
            $item->buyersItemIdentification = $keyValue[Schema::CAC . 'BuyersItemIdentification' . [ Schema::CBC . 'ID']];
        }

        if (isset($keyValue[Schema::CAC . 'SellersItemIdentification' . [ Schema::CBC . 'ID']])) {
            $item->sellersItemIdentification = $keyValue[Schema::CAC . 'SellersItemIdentification' . [ Schema::CBC . 'ID']];
        }

        if (isset($keyValue[Schema::CAC . 'ClassifiedTaxCategory'])) {
            $item->classifiedTaxCategory = $keyValue[Schema::CAC . 'ClassifiedTaxCategory'];
        }

        return $item;
    }
}
