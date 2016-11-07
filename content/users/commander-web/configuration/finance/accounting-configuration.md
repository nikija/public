---
title: Accounting Configuration
---

## Bill Closing

You are provided with 3 options.

 - "Always Allowed" will allow you to close bills at any time, even if the items on the bill have not yet been consumed (for example a future stay).
 - "Only with Consumed Items" will allow you to only close bills that have consumed items on them, so if there is a future stay or transfer planned and pre-paid, it will not allow you to close this bill until the day of check-out. This setting is extremely restrictive to front desk, and we do not recommend using it.
 - "Only with Consumed Items in Half Day Window": this is probably the best setting to be used. Reason for this is that, the moment a bill is closed, you cannot always made changes to the booking, as items that are affected by the change are already on a closed bill. So if you do not allow bill closing until the day of departure, you ensure that you can still make changes to the booking until the day of departure.
 
## Bill Header

Complete this field with all official hotel details: address, official hotel name, VAT, bank details, etc. This will be used for Bills/Proformas/Invoices.
Unfortunately we cannot modify the design of the bill in any way, we have chosen this design to be valid across all hotels worldwide. When we start making exceptions it will increase the risk of bugs/misprinting, therefore we prefer to use 1 universal template. However, using the HTML format, you can have it personalized in this way.

## Invoice Due Interval

Set this field to the number of days, after which an invoice should standardly get settled. For example if you issue and invoice and it should be settled within 30 days, set it to 30. 

When the team is creating a new invoice it will in this case always select "30 days" unless you manually specify a different date.

## Accounting Revenue & Payment Mapping Table

### VAT

The Mews Commander supports several accounting system exports. Some of those exports require mapping of all the products, payments and also the VAT Rates.

The VAT Rate fields are open text fields, where the hotel can put their mapping codes, as dictated by the Accounting Software with which the accountant works.

### Payments

You will see every possible payment type that is available in the system in this selection. Should your accounting system (or internal accounting procedures) work with different accounting categories, we suggest to firstly create the "Accounting Categories" for each payment type, with their specific accounting codes. 

Secondly return to this Accounting Configuration Screen, and select for each payment type the correct Payment Accounting Category. Once each payment is correctly mapped, it will automatically pick up this mapping in the different Accounting Integrations.

It works in the same way as when you fill in the Accounting Categories for different products, services, room types, rates, etc. in regards of display in the Accounting Report.


