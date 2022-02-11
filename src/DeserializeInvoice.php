<?php

namespace Pondersource\Invoice;

use Sabre\Xml\Service;

class DeserializeInvoice
{
  //Use Deserialization
    public function deserializeXML($outputXMLString)
    {
        $service = new Service();

        $service->elementMap = [
          '{urn:oasis:names:specification:ubl:schema:xsd:Invoice-2}Invoice' => function (\Sabre\Xml\Reader $reader) {
              return \Sabre\Xml\Deserializer\keyValue($reader, 'urn:oasis:names:specification:ubl:schema:xsd:Invoice-2');
          },
          '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}InvoicePeriod' => function (\Sabre\Xml\Reader $reader) {
            return \Sabre\Xml\Deserializer\keyValue($reader, '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}InvoicePeriod');
          },
         '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}OrderReference' => function (\Sabre\Xml\Reader $reader) {
            return \Sabre\Xml\Deserializer\keyValue($reader, '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}OrderReference');
         },
          '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}AccountingSupplierParty' => function (\Sabre\Xml\Reader $reader) {
            return \Sabre\Xml\Deserializer\keyValue($reader, '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}AccountingSupplierParty');
          },
          '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}Party' => function (\Sabre\Xml\Reader $reader) {
            return \Sabre\Xml\Deserializer\keyValue($reader, '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}Party');
          },
          '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}PartyIdentification' => function (\Sabre\Xml\Reader $reader) {
            return \Sabre\Xml\Deserializer\keyValue($reader, '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}PartyIdentification');
          },
          '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}PartyName' => function (\Sabre\Xml\Reader $reader) {
            return \Sabre\Xml\Deserializer\keyValue($reader, '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}PartyName');
          },
          '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}PostalAddress' => function (\Sabre\Xml\Reader $reader) {
            return \Sabre\Xml\Deserializer\keyValue($reader, '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}PostalAddress');
          },
          '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}Country' => function (\Sabre\Xml\Reader $reader) {
            return \Sabre\Xml\Deserializer\keyValue($reader, '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}Country');
          },
          '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}PartyTaxScheme' => function (\Sabre\Xml\Reader $reader) {
            return \Sabre\Xml\Deserializer\keyValue($reader, '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}PartyTaxScheme');
          },
          '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}TaxScheme' => function (\Sabre\Xml\Reader $reader) {
            return \Sabre\Xml\Deserializer\keyValue($reader, '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}TaxScheme');
          },
          '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}PartyLegalEntity' => function (\Sabre\Xml\Reader $reader) {
            return \Sabre\Xml\Deserializer\keyValue($reader, '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}PartyLegalEntity');
          },
          '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}AccountingCustomerParty' => function (\Sabre\Xml\Reader $reader) {
            return \Sabre\Xml\Deserializer\keyValue($reader, '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}AccountingCustomerParty');
          },
          '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}Contact' => function (\Sabre\Xml\Reader $reader) {
            return \Sabre\Xml\Deserializer\keyValue($reader, '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}Contact');
          },
          '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}Delivery' => function (\Sabre\Xml\Reader $reader) {
            return \Sabre\Xml\Deserializer\keyValue($reader, '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}Delivery');
          },
          '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}DeliveryLocation' => function (\Sabre\Xml\Reader $reader) {
            return \Sabre\Xml\Deserializer\keyValue($reader, '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}DeliveryLocation');
          },
          '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}Address' => function (\Sabre\Xml\Reader $reader) {
            return \Sabre\Xml\Deserializer\keyValue($reader, '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}Address');
          },
          '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}Country' => function (\Sabre\Xml\Reader $reader) {
            return \Sabre\Xml\Deserializer\keyValue($reader, '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}Country');
          },
          '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}PaymentMeans' => function (\Sabre\Xml\Reader $reader) {
            return \Sabre\Xml\Deserializer\keyValue($reader, '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}PaymentMeans');
          },
          '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}PayeeFinancialAccount' => function (\Sabre\Xml\Reader $reader) {
            return \Sabre\Xml\Deserializer\keyValue($reader, '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}PayeeFinancialAccount');
          },
          '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}FinancialInstitutionBranch' => function (\Sabre\Xml\Reader $reader) {
            return \Sabre\Xml\Deserializer\keyValue($reader, '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}FinancialInstitutionBranch');
          },
          '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}PaymentTerms' => function (\Sabre\Xml\Reader $reader) {
            return \Sabre\Xml\Deserializer\keyValue($reader, '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}PaymentTerms');
          },
          '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}TaxTotal' => function (\Sabre\Xml\Reader $reader) {
            return \Sabre\Xml\Deserializer\keyValue($reader, '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}TaxTotal');
          },
          '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}TaxSubtotal' => function (\Sabre\Xml\Reader $reader) {
            return \Sabre\Xml\Deserializer\keyValue($reader, '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}TaxSubtotal');
          },
          '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}TaxCategory' => function (\Sabre\Xml\Reader $reader) {
            return \Sabre\Xml\Deserializer\keyValue($reader, '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}TaxCategory');
          },
          '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}LegalMonetaryTotal' => function (\Sabre\Xml\Reader $reader) {
            return \Sabre\Xml\Deserializer\keyValue($reader, '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}LegalMonetaryTotal');
          },
          '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}InvoiceLine' => function (\Sabre\Xml\Reader $reader) {
            return \Sabre\Xml\Deserializer\keyValue($reader, '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}InvoiceLine');
          },
          '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}Item' => function (\Sabre\Xml\Reader $reader) {
            return \Sabre\Xml\Deserializer\keyValue($reader, '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}Item');
          },
         
          '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}ClassifiedTaxCategory' => function (\Sabre\Xml\Reader $reader) {
            return \Sabre\Xml\Deserializer\keyValue($reader, '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}ClassifiedTaxCategory');
          },
          '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}Price' => function (\Sabre\Xml\Reader $reader) {
            return \Sabre\Xml\Deserializer\keyValue($reader, '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}Price');
          },
        ];
      
        $result = json_encode($service->parse($outputXMLString));
      
        $patterns = array();
        $patterns[0] = '/{urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2}/';
        $patterns[1] = '/{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}/';
        $res = preg_replace($patterns, "", $result);
        $outputXML = json_decode($res);
        return $outputXML;
    }
}
