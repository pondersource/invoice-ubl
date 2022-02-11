<?php

namespace Pondersource\Invoice\Tests;

use PHPUnit\Framework\TestCase;

/**
 * Test an UBL2.1 invoice document
 */
class SimpleInvoiceTest extends TestCase {
    private $schema = 'http://docs.oasis-open.org/ubl/os-UBL-2.1/xsd/maindoc/UBL-Invoice-2.1.xsd';

    /**
     * @test
     */
    public function testIfXMLIsValid()
    {
        //Address Country
        $country = (new  \Pondersource\Invoice\Account\Country())
        ->setIdentificationCode('NL');

        //Full Address
        $address = (new  \Pondersource\Invoice\Account\PostalAddress())
                ->setStreetName('Lisk Center Utreht')
                ->setAddionalStreetName('De Burren')
                ->setCityName('Utreht')
                ->setPostalZone('3521')
                ->setCountry($country);

        // Supplier company node
        $supplierCompany = (new  \Pondersource\Invoice\Party\Party())
        ->setName('Supplier Company Name')
        ->setPhysicalLocation($address)
        ->setPostalAddress($address);
           
        // Client contact node
        $clientContact = (new  \Pondersource\Invoice\Account\Contact())
            ->setName('Client name')
            ->setTelephone('908-99-74-74');

            // Client company node
        $clientCompany = (new  \Pondersource\Invoice\Party\Party())
            ->setName('My client')
            ->setPostalAddress($address)
            ->setContact($clientContact);
            $legalMonetaryTotal = (new  \Pondersource\Invoice\Legal\LegalMonetaryTotal())
            ->setPayableAmount(10 + 2)
            ->setAllowanceTotalAmount(0);

        // Tax scheme
        $taxScheme = (new  \Pondersource\Invoice\Party\TaxScheme())
            ->setId(0);

        // Product
        $productItem = (new  \Pondersource\Invoice\Item())
            ->setName('Product Name')
            ->setDescription('Product Description')
            ->setSellersItemIdentification('SELLERID');

        // Price
        $price = (new  \Pondersource\Invoice\Payment\Price())
            ->setBaseQuantity(1)
            ->setUnitCode(\Pondersource\Invoice\Payment\UnitCode::UNIT)
            ->setPriceAmount(10);

        // Invoice Line tax totals
        $lineTaxTotal = (new  \Pondersource\Invoice\Tax\TaxTotal())
            ->setTaxAmount(2.1);

        // InvoicePeriod
        $invoicePeriod = (new  \Pondersource\Invoice\Invoice\InvoicePeriod())
            ->setStartDate(new \DateTime());
        
        $invoiceLines = [];

        $invoiceLines[] = (new  \Pondersource\Invoice\Invoice\InvoiceLine())
        ->setId(0)
        ->setItem($productItem)
        ->setInvoicePeriod($invoicePeriod)
        ->setPrice($price)
        ->setAccountingCost('Product 123')
        ->setTaxTotal($lineTaxTotal)
        ->setInvoicedQuantity(1);

        $invoiceLines[] = (new  \Pondersource\Invoice\Invoice\InvoiceLine())
            ->setId(0)
            ->setItem($productItem)
            ->setInvoicePeriod($invoicePeriod)
            ->setPrice($price)
            ->setAccountingCostCode('Product 123')
            ->setTaxTotal($lineTaxTotal)
            ->setInvoicedQuantity(1);

        // Total Taxes
        $taxCategory = (new  \Pondersource\Invoice\Tax\TaxCategory())
            ->setId(0)
            ->setName('VAT21%')
            ->setPercent(.21)
            ->setTaxScheme($taxScheme);

        $taxSubTotal = (new \Pondersource\Invoice\Tax\TaxSubTotal())
            ->setTaxableAmount(10)
            ->setTaxAmount(2.1)
            ->setTaxCategory($taxCategory);


        $taxTotal = (new  \Pondersource\Invoice\Tax\TaxTotal())
            ->setTaxSubtotal($taxSubTotal)
            ->setTaxAmount(2.1);

          // Invoice object
          $invoice = (new  \Pondersource\Invoice\Invoice\Invoice())
          ->setId(1234)
          ->setCopyIndicator(false)
          ->setIssueDate(new \DateTime())
          ->setAccountingSupplierParty($supplierCompany)
          ->setAccountingCustomerParty($clientCompany)
          ->setSupplierAssignedAccountID('10001')
          ->setInvoiceLines($invoiceLines)
          ->setLegalMonetaryTotal($legalMonetaryTotal)
          ->setTaxTotal($taxTotal);

            $generateInvoice = new  \Pondersource\Invoice\Invoice\GenerateInvoice();
            $outputXMLString = $generateInvoice->invoice($invoice);

            $dom = new \DOMDocument;
            $dom->loadXML($outputXMLString);

            $dom->save('./tests/SimpleInvoiceTest.xml');

            $this->assertEquals(true, $dom->schemaValidate($this->schema));
    }
}