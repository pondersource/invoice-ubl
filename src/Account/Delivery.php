<?php

namespace Pondersource\Invoice\Account;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;
use Pondersource\Invoice\Schema;
use DateTime as DateTime;
use Pondersource\Invoice\Account\PostalAddress;
use Sabre\Xml\Reader;
use Sabre\Xml\XmlDeserializable;

class Delivery implements XmlSerializable, XmlDeserializable
{
    private $actualDeliveryDate;
    private $deliveryLocation;
    private $deliveryParty;

    /**
     * get actual delivery party
     */
    public function getActualDeliveryDate(): ?DateTime
    {
        return $this->actualDeliveryDate;
    }

    /**
     * Set actual delivery date
     */
    public function setActualDeliveryDate(DateTime $actualDeliveryDate): Delivery
    {
        $this->actualDeliveryDate = $actualDeliveryDate;
        return $this;
    }

    /**
     * get Delivery Location
     */
    public function getDeliveryLocation(): ?PostalAddress
    {
        return $this->deliveryLocation;
    }

    /**
     * Set delivery location
     */
    public function setDeliveryLocation(?PostalAddress $deliveryLocation): Delivery
    {
        $this->deliveryLocation = $deliveryLocation;
        return $this;
    }

    /**
     * get Delivery Party
     */
    public function getDeliveryParty()
    {
        return $this->deliveryParty;
    }

    /**
     * set delivery party
     */
    public function setDeliveryParty($deliveryParty): Delivery
    {
        $this->deliveryParty = $deliveryParty;
        return $this;
    }

    /**
     * Serialize Delivery
     */
    public function xmlSerialize(Writer $writer)
    {
        if ($this->actualDeliveryDate !== null) {
            $writer->write([
                Schema::CBC . 'ActualDeliveryDate' => $this->actualDeliveryDate->format('Y-m-d')
            ]);
        }
        if ($this->deliveryLocation !== null) {
            $writer->write([
                Schema::CAC . 'DeliveryLocation' => [ Schema::CAC . 'Address' => $this->deliveryLocation ]
            ]);
        }

        if ($this->deliveryParty !== null) {
            $writer->write([
                Schema::CAC . 'DeliveryParty' => $this->deliveryParty
            ]);
        }
    }

    /**
     * Deserialize Delivery
     */
    static function xmlDeserialize(Reader $reader)
    {
        $delivery = new self();

        $keyValue =  Sabre\Xml\Element\KeyValue::xmlDeserialize($reader);

        if (isset($keyValue[Schema::CBC . 'ActualDeliveryDate'])) {
            $delivery->actualDeliveryDate = $keyValue[Schema::CBC . 'ActualDeliveryDate'];
        }

        if (isset($keyValue[Schema::CAC . 'DeliveryLocation' ])) {
            $delivery->deliveryLocation = $keyValue[Schema::CAC . 'DeliveryLocation'];
        }

        if (isset($keyValue[Schema::CAC . 'DeliveryParty' ])) {
            $delivery->deliveryParty = $keyValue[Schema::CAC . 'DeliveryParty'];
        }
        return $delivery;
    }
}
