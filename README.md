## UBL Invoice

A library for creating a valid UBL files in PHP like standard EN16931.l A key objective of the European standard on eInvoicing (EN) is to make it possible for sellers to send invoices to many customers by using a single eInvoicing format and thus not having to adjust their sending and/or receiving to connect with individual trading parties.

### Requirements

* PHP 7.2
* composer

## Installation 

````
composer require pondersource/invoice-ubl

````

````
composer install
````

### Check pass all test case for Invoices standard
````
vendor/bin/phpunit
````

### Usage for show classes in Invoice that you will generate

```php
include 'vendor/autoload.php';
 // Tax scheme
 $taxScheme = (new \Ishifoev\Invoice\Party\TaxScheme())
 ->setId('VAT');


  // Client contact node
  $clientContact = (new \Ishifoev\Invoice\Account\Contact())
   ->setName('Client name')
   ->setTelephone('908-99-74-74');


$country = (new \Ishifoev\Invoice\Account\Country())
            ->setIdentificationCode('NL');

         
        // Full address
$address = (new \Ishifoev\Invoice\Account\PostalAddress())
                ->setStreetName('Lisk Center Utreht')
                ->setAddionalStreetName('De Burren')
                ->setCityName('Utreht')
                ->setPostalZone('3521')
                ->setCountry($country);


$financialInstitutionBranch = (new \Ishifoev\Invoice\Financial\FinancialInstitutionBranch())
                ->setId('RABONL2U');
         

$payeeFinancialAccount = (new \Ishifoev\Invoice\Financial\PayeeFinancialAccount())
               ->setFinancialInstitutionBranch($financialInstitutionBranch)
                ->setName('Customer Account Holder')
                ->setId('NL00RABO0000000000');
              

$paymentMeans = (new  \Ishifoev\Invoice\Payment\PaymentMeans())
                ->setPayeeFinancialAccount($payeeFinancialAccount)
                ->setPaymentMeansCode(31, [])
                ->setPaymentId('our invoice 1234');

 // Supplier company node
 $supplierLegalEntity = (new \Ishifoev\Invoice\Legal\LegalEntity())		// $doc = new DOMDocument();
		// $doc->load($path);
 ->setRegistrationNumber('PonderSource')
 ->setCompanyId('NL123456789');


$supplierPartyTaxScheme = (new \Ishifoev\Invoice\Party\PartyTaxScheme())
 ->setTaxScheme($taxScheme)
 ->setCompanyId('NL123456789');

$supplierCompany = (new \Ishifoev\Invoice\Party\Party())
 ->setEndPointId('7300010000001', '0007')
 ->setPartyIdentificationId('99887766')
 ->setName('PonderSource')
 ->setLegalEntity($supplierLegalEntity)
 ->setPartyTaxScheme($supplierPartyTaxScheme)
 ->setPostalAddress($address);



// Client company node
$clientLegalEntity = (new \Ishifoev\Invoice\Legal\LegalEntity())
 ->setRegistrationNumber('Client Company Name')
 ->setCompanyId('Client Company Registration');



$clientPartyTaxScheme = (new \Ishifoev\Invoice\Party\PartyTaxScheme())
 ->setTaxScheme($taxScheme)
 ->setCompanyId('BE123456789');



$clientCompany = (new \Ishifoev\Invoice\Party\Party())
->setPartyIdentificationId('9988217')
->setEndPointId('7300010000002', '0002')
 ->setName('Client Company Name')
 ->setLegalEntity($clientLegalEntity)
 ->setPartyTaxScheme($clientPartyTaxScheme)
 ->setPostalAddress($address)
 ->setContact($clientContact);

$legalMonetaryTotal = (new \Ishifoev\Invoice\Legal\LegalMonetaryTotal())
 ->setPayableAmount(10 + 2.1)
 ->setAllowanceTotalAmount(0)
 ->setTaxInclusiveAmount(10 + 2.1)
 ->setLineExtensionAmount(10)
 ->setTaxExclusiveAmount(10);

 
 $classifiedTaxCategory = (new \Ishifoev\Invoice\Tax\ClassifiedTaxCategory())
 ->setId('S')
 ->setPercent(21.00)
 ->setTaxScheme($taxScheme);

  // Product
  $productItem = (new \Ishifoev\Invoice\Item())
  ->setName('Product Name')
  ->setClassifiedTaxCategory($classifiedTaxCategory)
  ->setDescription('Product Description');

// Price
 $price = (new \Ishifoev\Invoice\Payment\Price())
       ->setBaseQuantity(1)
       ->setUnitCode(\Ishifoev\Invoice\Payment\UnitCode::UNIT)
       ->setPriceAmount(10);
     
// Invoice Line tax totals
$lineTaxTotal = (new Ishifoev\Invoice\Tax\TaxTotal())
            ->setTaxAmount(2.1);
           

// InvoicePeriod
$invoicePeriod = (new Ishifoev\Invoice\Invoice\InvoicePeriod())
->setStartDate(new \DateTime());

// Invoice Line(s)
$invoiceLine = (new Ishifoev\Invoice\Invoice\InvoiceLine())
->setId(0)
->setItem($productItem)
->setPrice($price)
->setInvoicePeriod($invoicePeriod)
->setLineExtensionAmount(10)
->setInvoicedQuantity(1);



$invoiceLines = [$invoiceLine];

$taxCategory = (new \Ishifoev\Invoice\Tax\TaxCategory())
            ->setId('S', [])
            ->setPercent(21.00)
            ->setTaxScheme($taxScheme);
            
$allowanceCharge = (new \Ishifoev\Invoice\AllowanceCharge())
->setChargeIndicator(true)
->setAllowanceReason('Insurance')
->setAmount(10)
->setTaxCategory($taxCategory);

 $taxSubTotal = (new \Ishifoev\Invoice\Tax\TaxSubTotal())
            ->setTaxableAmount(10)
            ->setTaxAmount(2.1)
            ->setTaxCategory($taxCategory);

$taxTotal = (new \Ishifoev\Invoice\Tax\TaxTotal())
            ->setTaxSubtotal($taxSubTotal)
            ->setTaxAmount(2.1);

         
   // Payment Terms
$paymentTerms = (new \Ishifoev\Invoice\Payment\PaymentTerms())
   ->setNote('30 days net');
  
// Delivery
$deliveryLocation = (new \Ishifoev\Invoice\Account\PostalAddress())
->setStreetName('Delivery street 2')
->setAddionalStreetName('Building 56')
->setCityName('Utreht')
->setPostalZone('3521')
->setCountry($country);


$delivery = (new \Ishifoev\Invoice\Account\Delivery())
  ->setActualDeliveryDate(new \DateTime())
  ->setDeliveryLocation($deliveryLocation);
  

$orderReference = (new \Ishifoev\Invoice\Payment\OrderReference())
  ->setId('5009567')
  ->setSalesOrderId('tRST-tKhM');
  
   // Invoice object
   $invoice = (new  \Ishifoev\Invoice\Invoice\Invoice())
   ->setProfileID('urn:fdc:peppol.eu:2017')
   ->setCustomazationID('urn:cen.eu:en16931:2017')
   ->setId(1234)
   ->setIssueDate(new \DateTime())
   ->setNote('invoice note')
   ->setAccountingCostCode('4217:2323:2323')
   ->setDelivery($delivery)
   ->setAccountingSupplierParty($supplierCompany)
   ->setAccountingCustomerParty($clientCompany)
   ->setInvoiceLines($invoiceLines)
   ->setLegalMonetaryTotal($legalMonetaryTotal)
   ->setPaymentTerms($paymentTerms)
   //->setAllowanceCharges($allowanceCharge)
   ->setInvoicePeriod($invoicePeriod)
   ->setPaymentMeans($paymentMeans)
   ->setByerReference('BUYER_REF')
   ->setOrderReference($orderReference)
   ->setTaxTotal($taxTotal);


  $generateInvoice = new \Ishifoev\Invoice\Invoice\GenerateInvoice();
  $outputXMLString = $generateInvoice->invoice($invoice);
  $dom = new \DOMDocument;
  $dom->loadXML($outputXMLString);
  $dom->save('EN16931Test.xml');

```

### Output generate XML file EN16931.xml

```xml
<?xml version="1.0"?>
<Invoice xmlns="urn:oasis:names:specification:ubl:schema:xsd:Invoice-2" xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2" xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2">
 <cbc:UBLVersionID>2.1</cbc:UBLVersionID>
 <cbc:CustomizationID>urn:cen.eu:en16931:2017</cbc:CustomizationID>
 <cbc:ProfileID>urn:fdc:peppol.eu:2017</cbc:ProfileID>
 <cbc:ID>1234</cbc:ID>
 <cbc:IssueDate>2022-01-17</cbc:IssueDate>
 <cbc:InvoiceTypeCode>380</cbc:InvoiceTypeCode>
 <cbc:Note>invoice note</cbc:Note>
 <cbc:DocumentCurrencyCode>EUR</cbc:DocumentCurrencyCode>
 <cbc:AccountingCost>4217:2323:2323</cbc:AccountingCost>
 <cbc:BuyerReference>BUYER_REF</cbc:BuyerReference>
 <cac:InvoicePeriod>
  <cbc:StartDate>2022-01-17</cbc:StartDate>
 </cac:InvoicePeriod>
 <cac:OrderReference>
  <cbc:ID>5009567</cbc:ID>
  <cbc:SalesOrderID>tRST-tKhM</cbc:SalesOrderID>
 </cac:OrderReference>
 <cac:AccountingSupplierParty>
  <cac:Party>
   <cbc:EndpointID schemeID="0007">7300010000001</cbc:EndpointID>
   <cac:PartyIdentification>
    <cbc:ID>99887766</cbc:ID>
   </cac:PartyIdentification>
   <cac:PartyName>
    <cbc:Name>PonderSource</cbc:Name>
   </cac:PartyName>
   <cac:PostalAddress>
    <cbc:StreetName>Lisk Center Utreht</cbc:StreetName>
    <cbc:AdditionalStreetName>De Burren</cbc:AdditionalStreetName>
    <cbc:CityName>Utreht</cbc:CityName>
    <cbc:PostalZone>3521</cbc:PostalZone>
    <cac:Country>
     <cbc:IdentificationCode>NL</cbc:IdentificationCode>
    </cac:Country>
   </cac:PostalAddress>
   <cac:PartyTaxScheme>
    <cbc:CompanyID>NL123456789</cbc:CompanyID>
    <cac:TaxScheme>
     <cbc:ID>VAT</cbc:ID>
    </cac:TaxScheme>
   </cac:PartyTaxScheme>
   <cac:PartyLegalEntity>
    <cbc:RegistrationName>PonderSource</cbc:RegistrationName>
    <cbc:CompanyID>NL123456789</cbc:CompanyID>
   </cac:PartyLegalEntity>
  </cac:Party>
 </cac:AccountingSupplierParty>
 <cac:AccountingCustomerParty>
  <cac:Party>
   <cbc:EndpointID schemeID="0002">7300010000002</cbc:EndpointID>
   <cac:PartyIdentification>
    <cbc:ID>9988217</cbc:ID>
   </cac:PartyIdentification>
   <cac:PartyName>
    <cbc:Name>Client Company Name</cbc:Name>
   </cac:PartyName>
   <cac:PostalAddress>
    <cbc:StreetName>Lisk Center Utreht</cbc:StreetName>
    <cbc:AdditionalStreetName>De Burren</cbc:AdditionalStreetName>
    <cbc:CityName>Utreht</cbc:CityName>
    <cbc:PostalZone>3521</cbc:PostalZone>
    <cac:Country>
     <cbc:IdentificationCode>NL</cbc:IdentificationCode>
    </cac:Country>
   </cac:PostalAddress>
   <cac:PartyTaxScheme>
    <cbc:CompanyID>BE123456789</cbc:CompanyID>
    <cac:TaxScheme>
     <cbc:ID>VAT</cbc:ID>
    </cac:TaxScheme>
   </cac:PartyTaxScheme>
   <cac:PartyLegalEntity>
    <cbc:RegistrationName>Client Company Name</cbc:RegistrationName>
    <cbc:CompanyID>Client Company Registration</cbc:CompanyID>
   </cac:PartyLegalEntity>
   <cac:Contact>
    <cbc:Name>Client name</cbc:Name>
    <cbc:Telephone>908-99-74-74</cbc:Telephone>
   </cac:Contact>
  </cac:Party>
 </cac:AccountingCustomerParty>
 <cac:Delivery>
  <cbc:ActualDeliveryDate>2022-01-17</cbc:ActualDeliveryDate>
  <cac:DeliveryLocation>
   <cac:Address>
    <cbc:StreetName>Delivery street 2</cbc:StreetName>
    <cbc:AdditionalStreetName>Building 56</cbc:AdditionalStreetName>
    <cbc:CityName>Utreht</cbc:CityName>
    <cbc:PostalZone>3521</cbc:PostalZone>
    <cac:Country>
     <cbc:IdentificationCode>NL</cbc:IdentificationCode>
    </cac:Country>
   </cac:Address>
  </cac:DeliveryLocation>
 </cac:Delivery>
 <cac:PaymentMeans>
  <cbc:PaymentMeansCode>31</cbc:PaymentMeansCode>
  <cbc:PaymentID>our invoice 1234</cbc:PaymentID>
  <cac:PayeeFinancialAccount>
   <cbc:ID>NL00RABO0000000000</cbc:ID>
   <cbc:Name>Customer Account Holder</cbc:Name>
   <cac:FinancialInstitutionBranch>
    <cbc:ID>RABONL2U</cbc:ID>
   </cac:FinancialInstitutionBranch>
  </cac:PayeeFinancialAccount>
 </cac:PaymentMeans>
 <cac:PaymentTerms>
  <cbc:Note>30 days net</cbc:Note>
 </cac:PaymentTerms>
 <cac:TaxTotal>
  <cbc:TaxAmount currencyID="EUR">2.10</cbc:TaxAmount>
  <cac:TaxSubtotal>
   <cbc:TaxableAmount currencyID="EUR">10.00</cbc:TaxableAmount>
   <cbc:TaxAmount currencyID="EUR">2.10</cbc:TaxAmount>
   <cac:TaxCategory>
    <cbc:ID>S</cbc:ID>
    <cbc:Percent>21.00</cbc:Percent>
    <cac:TaxScheme>
     <cbc:ID>VAT</cbc:ID>
    </cac:TaxScheme>
   </cac:TaxCategory>
  </cac:TaxSubtotal>
 </cac:TaxTotal>
 <cac:LegalMonetaryTotal>
  <cbc:LineExtensionAmount currencyID="EUR">10.00</cbc:LineExtensionAmount>
  <cbc:TaxExclusiveAmount currencyID="EUR">10.00</cbc:TaxExclusiveAmount>
  <cbc:TaxInclusiveAmount currencyID="EUR">12.10</cbc:TaxInclusiveAmount>
  <cbc:AllowanceTotalAmount currencyID="EUR">0.00</cbc:AllowanceTotalAmount>
  <cbc:PayableAmount currencyID="EUR">12.10</cbc:PayableAmount>
 </cac:LegalMonetaryTotal>
 <cac:InvoiceLine>
  <cbc:ID>0</cbc:ID>
  <cbc:InvoicedQuantity unitCode="C62">1.00</cbc:InvoicedQuantity>
  <cbc:LineExtensionAmount currencyID="EUR">10.00</cbc:LineExtensionAmount>
  <cac:InvoicePeriod>
   <cbc:StartDate>2022-01-17</cbc:StartDate>
  </cac:InvoicePeriod>
  <cac:Item>
   <cbc:Description>Product Description</cbc:Description>
   <cbc:Name>Product Name</cbc:Name>
   <cac:ClassifiedTaxCategory>
    <cbc:ID>S</cbc:ID>
    <cbc:Percent>21.00</cbc:Percent>
    <cac:TaxScheme>
     <cbc:ID>VAT</cbc:ID>
    </cac:TaxScheme>
   </cac:ClassifiedTaxCategory>
  </cac:Item>
  <cac:Price>
   <cbc:PriceAmount currencyID="EUR">10.00</cbc:PriceAmount>
   <cbc:BaseQuantity unitCode="C62">1.00</cbc:BaseQuantity>
  </cac:Price>
 </cac:InvoiceLine>
</Invoice>


```
