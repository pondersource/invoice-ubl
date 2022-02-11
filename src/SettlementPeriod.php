
<?php

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;
use Ishifoev\Invoice\Schema;
use DateTime;
use InvalidArgumentException;
use Sabre\Xml\Reader;
use Sabre\Xml\XmlDeserializable;

class SettlementPeriod implements XmlSerializable, XmlDeserializable
{
    private $startDate;
    private $endDate;

    /**
     * @return DateTime
     */
    public function getStartDate(): ?DateTime
    {
        return $this->startDate;
    }

    /**
     * @param DateTime $startDate
     * @return SettlementPeriod
     */
    public function setStartDate(DateTime $startDate): SettlementPeriod
    {
        $this->startDate = $startDate;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getEndDate(): ?DateTime
    {
        return $this->endDate;
    }

    /**
     * @param DateTime $endDate
     * @return SettlementPeriod
     */
    public function setEndDate(DateTime $endDate): SettlementPeriod
    {
        $this->endDate = $endDate;
        return $this;
    }

    /**
     * The validate function that is called during xml writing to valid the data of the object.
     *
     * @throws InvalidArgumentException An error with information about required data that is missing to write the XML
     * @return void
     */
    public function validate()
    {
        if ($this->startDate === null) {
            throw new InvalidArgumentException('Missing startDate');
        }
        if ($this->endDate === null) {
            throw new InvalidArgumentException('Missing endDate');
        }
    }

    /**
     * The xmlSerialize method is called during xml writing.
     *
     * @param Writer $writer
     * @return void
     */
    public function xmlSerialize(Writer $writer)
    {
        $this->validate();

        $writer->write([
            Schema::CBC . 'StartDate' => $this->startDate->format('Y-m-d'),
            Schema::CBC . 'EndDate' => $this->endDate->format('Y-m-d'),
        ]);

        $writer->write([
            [
                'name' => Schema::CBC . 'DurationMeasure',
                'value' => $this->endDate->diff($this->startDate)->format('%d'),
                'attributes' => [
                    'unitCode' => UnitCode::DAY
                ]
            ]
        ]);
    }

    /**
     * Deserialize Settlement Period
     */
    static function xmlDeserialize(Reader $reader)
    {
        $settlementPeriod = new self();

        $keyValue =  Sabre\Xml\Element\KeyValue::xmlDeserialize($reader);

        if (isset($keyValue[Schema::CBC . 'StartDate'])) {
            $finansettlementPeriodcial->startDate = $keyValue[Schema::CBC . 'StartDate'];
        }
        if (isset($keyValue[Schema::CBC . 'EndDate'])) {
            $finansettlementPeriodcial->endDate = $keyValue[Schema::CBC . 'EndDate'];
        }
        return $settlementPeriod;
    }
}
