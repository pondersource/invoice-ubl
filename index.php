<?php

include 'vendor/autoload.php';
 // Tax scheme
 $taxScheme = (new \Pondersource\Invoice\Party\TaxScheme())
 ->setId('VAT');
  // Client contact node
  $clientContact = (new \Pondersource\Invoice\Account\Contact())
   ->setName('Client name')
   ->setTelephone('908-99-74-74');


$country = (new \Pondersource\Invoice\Account\Country())
            ->setIdentificationCode('NL');

         
        // Full address
$address = (new \Pondersource\Invoice\Account\PostalAddress())
                ->setStreetName('Lisk Center Utreht')
                ->setAddionalStreetName('De Burren')
                ->setCityName('Utreht')
                ->setPostalZone('3521')
                ->setCountry($country);


$financialInstitutionBranch = (new \Pondersource\Invoice\Financial\FinancialInstitutionBranch())
                ->setId('RABONL2U');
         

$payeeFinancialAccount = (new \Pondersource\Invoice\Financial\PayeeFinancialAccount())
               ->setFinancialInstitutionBranch($financialInstitutionBranch)
                ->setName('Customer Account Holder')
                ->setId('NL00RABO0000000000');
              

$paymentMeans = (new  \Pondersource\Invoice\Payment\PaymentMeans())
                ->setPayeeFinancialAccount($payeeFinancialAccount)
                ->setPaymentMeansCode(31, [])
                ->setPaymentId('our invoice 1234');

 // Supplier company node
 $supplierLegalEntity = (new \Pondersource\Invoice\Legal\LegalEntity())     // $doc = new DOMDocument();
        // $doc->load($path);
 ->setRegistrationNumber('PonderSource')
 ->setCompanyId('NL123456789');


$supplierPartyTaxScheme = (new \Pondersource\Invoice\Party\PartyTaxScheme())
 ->setTaxScheme($taxScheme)
 ->setCompanyId('NL123456789');

$supplierCompany = (new \Pondersource\Invoice\Party\Party())
 ->setEndPointId('7300010000001', '0007')
 ->setPartyIdentificationId('99887766')
 ->setName('PonderSource')
 ->setLegalEntity($supplierLegalEntity)
 ->setPartyTaxScheme($supplierPartyTaxScheme)
 ->setPostalAddress($address);



// Client company node
$clientLegalEntity = (new \Pondersource\Invoice\Legal\LegalEntity())
 ->setRegistrationNumber('Client Company Name')
 ->setCompanyId('Client Company Registration');



$clientPartyTaxScheme = (new \Pondersource\Invoice\Party\PartyTaxScheme())
 ->setTaxScheme($taxScheme)
 ->setCompanyId('BE123456789');



$clientCompany = (new \Pondersource\Invoice\Party\Party())
->setPartyIdentificationId('9988217')
->setEndPointId('7300010000002', '0002')
 ->setName('Client Company Name')
 ->setLegalEntity($clientLegalEntity)
 ->setPartyTaxScheme($clientPartyTaxScheme)
 ->setPostalAddress($address)
 ->setContact($clientContact);

$legalMonetaryTotal = (new \Pondersource\Invoice\Legal\LegalMonetaryTotal())
 ->setPayableAmount(10 + 2.1)
 ->setAllowanceTotalAmount(0)
 ->setTaxInclusiveAmount(10 + 2.1)
 ->setLineExtensionAmount(10)
 ->setTaxExclusiveAmount(10);

 
 $classifiedTaxCategory = (new \Pondersource\Invoice\Tax\ClassifiedTaxCategory())
 ->setId('S')
 ->setPercent(21.00)
 ->setTaxScheme($taxScheme);

  // Product
  $productItem = (new \Pondersource\Invoice\Item())
  ->setName('Product Name')
  ->setClassifiedTaxCategory($classifiedTaxCategory)
  ->setDescription('Product Description');

// Price
 $price = (new \Pondersource\Invoice\Payment\Price())
       ->setBaseQuantity(1)
       ->setUnitCode(\Pondersource\Invoice\Payment\UnitCode::UNIT)
       ->setPriceAmount(10);
     
// Invoice Line tax totals
$lineTaxTotal = (new Pondersource\Invoice\Tax\TaxTotal())
            ->setTaxAmount(2.1);
           

// InvoicePeriod
$invoicePeriod = (new Pondersource\Invoice\Invoice\InvoicePeriod())
->setStartDate(new \DateTime());

// Invoice Line(s)
$invoiceLine = (new Pondersource\Invoice\Invoice\InvoiceLine())
->setId(0)
->setItem($productItem)
->setPrice($price)
->setInvoicePeriod($invoicePeriod)
->setLineExtensionAmount(10)
->setInvoicedQuantity(1);



$invoiceLines = [$invoiceLine];

$taxCategory = (new \Pondersource\Invoice\Tax\TaxCategory())
            ->setId('S', [])
            ->setPercent(21.00)
            ->setTaxScheme($taxScheme);
            
$allowanceCharge = (new \Pondersource\Invoice\AllowanceCharge())
->setChargeIndicator(true)
->setAllowanceReason('Insurance')
->setAmount(10)
->setTaxCategory($taxCategory);

 $taxSubTotal = (new \Pondersource\Invoice\Tax\TaxSubTotal())
            ->setTaxableAmount(10)
            ->setTaxAmount(2.1)
            ->setTaxCategory($taxCategory);

$taxTotal = (new \Pondersource\Invoice\Tax\TaxTotal())
            ->setTaxSubtotal($taxSubTotal)
            ->setTaxAmount(2.1);

         
   // Payment Terms
$paymentTerms = (new \Pondersource\Invoice\Payment\PaymentTerms())
   ->setNote('30 days net');
  
// Delivery
$deliveryLocation = (new \Pondersource\Invoice\Account\PostalAddress())
->setStreetName('Delivery street 2')
->setAddionalStreetName('Building 56')
->setCityName('Utreht')
->setPostalZone('3521')
->setCountry($country);


$delivery = (new \Pondersource\Invoice\Account\Delivery())
  ->setActualDeliveryDate(new \DateTime())
  ->setDeliveryLocation($deliveryLocation);
  

$orderReference = (new \Pondersource\Invoice\Payment\OrderReference())
  ->setId('5009567')
  ->setSalesOrderId('tRST-tKhM');
  
   // Invoice object
   $invoice = (new  \Pondersource\Invoice\Invoice\Invoice())
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


  $generateInvoice = new \Pondersource\Invoice\Invoice\GenerateInvoice();
  $outputXMLString = $generateInvoice->invoice($invoice);

  //Deserialize UBL Invoice
  $des = new Pondersource\Invoice\DeserializeInvoice;
  $res = $des->deserializeXML($outputXMLString);


  $dom = new \DOMDocument;
  $dom->loadXML($outputXMLString);
  //$sign = new Signature;
  //$sign->GenerateKeyPair(OPENSSL_KEYTYPE_RSA);
  //$signed_dom = $sign->createSignedXml($dom);
  //$signed_dom->save('EN16931Test.xml');
  $dom->save('EN16931Test.xml');
  // Use webservice at peppol.helger.com to verify the result
  $wsdl = "http://peppol.helger.com/wsdvs?wsdl=1";
  $client = new \SoapClient($wsdl);
  $response = $client->validate(['XML' => $outputXMLString, 'VESID' => 'eu.cen.en16931:ubl:1.3.7']);
  echo json_encode($response);
