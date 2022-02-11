<?php

namespace Pondersource\Invoice\Payment;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;
use Pondersource\Invoice\Schema;
use Sabre\Xml\Reader;
use Sabre\Xml\XmlDeserializable;

class PaymentTerms implements XmlSerializable, XmlDeserializable
{
    private $note;

    /**
     *  Payment terms
     */
    public function getNote(): ?string
    {
        return $this->note;
    }

    /**
     * set note
     */
    public function setNote(?string $note): PaymentTerms
    {
        $this->note = $note;
        return $this;
    }
    /**
     * Serialize Payment Terms
     */
    public function xmlSerialize(Writer $writer)
    {
        if ($this->note !== null) {
            $writer->write([ Schema::CBC . 'Note' => $this->note ]);
        }
    }

    /**
     * Deserialize Payment Terms
     */
    static function xmlDeserialize(Reader $reader)
    {
        $paymentTerms = new self();
         
        $keyValue = Sabre\Xml\Element\KeyValue::xmlDeserialize($reader);
        if (isset($keyValue[Schema::CBC . 'Note'])) {
            $paymentTerms->note = $keyValue[Schema::CBC . 'Note'];
        }
        return $paymentTerms;
    }
}
