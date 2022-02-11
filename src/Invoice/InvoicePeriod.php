<?php

namespace Pondersource\Invoice\Invoice;

use InvalidArgumentException as InvalidArgumentException;
use DateTime as DateTime;
use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;
use Pondersource\Invoice\Schema;
use Sabre\Xml\Reader;
use Sabre\Xml\XmlDeserializable;

class InvoicePeriod implements XmlSerializable, XmlDeserializable
{
    private $startDate;
    private $endDate;

    /**
     *  Invoice line period start date
     */
    public function getStartDate(): ?Datetime
    {
        return $this->startDate;
    }

    /**
     * Set start Date
     */
    public function setStartDate(?Datetime $startDate): InvoicePeriod
    {
        $this->startDate = $startDate;
        return $this;
    }

    /**
     *  Invoice line period end date
     */
    public function getEndDate(): ?Datetime
    {
        return $this->endDate;
    }
 
     /**
      * Set start Date
      */
    public function setEndDate(?Datetime $endDate): InvoicePeriod
    {
        $this->endDate = $endDate;
        return $this;
    }

     /**
      * validation date
      */
    public function validate()
    {
        if ($this->startDate === null && $this->endDate === null) {
            throw new InvalidArgumentException('Missing start date and end date');
        }
    }

      /**
       * Invoice Period serialize
       */
    public function xmlSerialize(Writer $writer)
    {
        $this->validate();

        if ($this->startDate !== null) {
            $writer->write([ Schema::CBC . 'StartDate' => $this->startDate->format('Y-m-d') ]);
        }

        if ($this->endDate !== null) {
            $writer->write([ Schema::CBC . 'EndDate' => $this->endDate->format('Y-m-d') ]);
        }
    }

    /**
     * Deserialize Invoice Period
     */
    static function xmlDeserialize(Reader $reader)
    {
        $invoicePeriod = new self();

        $keyValue = Sabre\Xml\Element\KeyValue::xmlDeserialize($reader);

        if (isset($keyValue[Schema::CBC . 'StartDate'])) {
            $invoicePeriod->startDate = $keyValue[Schema::CBC . 'StartDate'];
        }

        if (isset($keyValue[Schema::CBC . 'EndDate'])) {
            $invoicePeriod->endDate = $keyValue[Schema::CBC . 'EndDate'];
        }
        
        return $invoicePeriod;
    }
}
