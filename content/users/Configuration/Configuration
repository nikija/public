---
title: Configuration
ordering: 5
---

##Configuration

###Major Differences Versus Traditional Systems
####No Night Audit
One of the major changes we made is remove the night audit from the system, this has a few implications:
- **Accommodation charges**: these are traditionally posted during the night audit. Mews posts these charges at the time the booking is created/confirmed. So all future revenue is already recorded, but because its in the future, you can still amend it, change rates, cancel items, cancel bookings, etc.
- **No Shows**: you can set up an "editable history window" during which you can cancel or check-in no-shows or walk-ins after midnight. Once the editable history window expires, you will no longer be allowed to make changes to bookings, so its important that reception is aware, and these is a procedure in place for the handling of no-shows.
- **Reports**: traditionally as part of the night audit, the system spews out report after report. Mews however allows reports to be printed at any time, and they have a time filter on the report, so that you could run it between exact time periods. But in our philosofy the day changes at midnight, and revenue should fall in the day when its actually consumed, not when the PMS dictates it (due to night audit processes)

####Bills are linked to Guests not Rooms
In traditional PMS systems, bills are always linked to the rooms, in which guests are booked. So if you need to open a bill for a guest who is not staying in the hotel, you would have to open a thing called "paymaster" which is a dummy-room to which you can link the charged.
Mews however has linked all billing to Guest Profiles. So as long as there is a Guest Profile in the system, you are able to post charges against it, irrespective of whether or not there is a booking attached. Should you however post charges against a profile that does not have any booking linked to that profile, the Guest Profile will appear as "to be resolved" in the Guest Ledger. This will help you identify potential problematic accounts.

<a name="Main-Settings"></a>
###Main Settings

When you select settings in the menu bar at the top of the screen, and select your hotel name, this will take you to the main settings menu.

####General Settings
- **Identifier**: the code you see after the "identifier" field is your Unique Hotel ID. If you have a webdeveloper integrate the booking engine into your website, he will need this ID.
- **Name and Short Name**: Set the name of your hotel. This is the official hotel name (not the official company name). The short name is important for internal use only, so that it allows us to abbreviate it in reports and allows more columns on a page.
- **Description**: There is currently no direct function assigned to this, so there is no need to complete this field.
- **Unique Name**: Please always complete this field, which we used as part of the link we e-mail guests with their login to the online dashboard. Complete the field with the name of the hotel, preferably without spaces in lower case. (eg. waldorf-astoria)
- **E-mail**: Complete this field with the e-mail address from which you would like to communicate with guests.
- **Contact details**: Complete these fields with hotel telephone number, website address and physical address details, as this is important for the different types of communication sent through the system. Its best if you find your address using the provided Google Address bar, so that it will also pick up your Longitude and Lattitude, allowing us to place your hotel on a map with its exact coordinates.
- **Timezone**: you will not be able your Timezone, but its critically important that the correct timezone is selected, if you notice this is not the correct timezone, kindly contact Mews Support.

####Globalization
- **Supported Language**: This selection is not to set your personal language, but more to select in which language you want guest communication to be sent. Note that if you select languages, other than English, the hotel is responsible for the translations of the Confirmation E-mails, Registration Cards, Rate descriptions, Room Descriptions, Products and any other text that is guest-facing.

####Accounting
- **Accepted Currencies**: We allow the handling of multiple currencies, which allows you to accept money in a variety of currencies. You can set rates based on an automatic daily, monthly or yearly rate (note this is only available for countries in the EU currently). You can also select from which source you would like to take the exchange rate. The options are provided in the "Currency Rate Source" menu.
A hotel may also select to manage rates manually. In order to manage the exchange rate manually, you need to select "Never" in the Currency Rate Update menu and select "Exchange Rates" in the settings tab in the top-bar menu.
- **Bill Number Format**: Should you wish to have your bills/invoices to start with a prefix number, this is the field where you can set this value. Note that Bills&Invoices (currently) share the same line of numbering. In order to set up for example a starting number 2015 in front of your bills, you have to follow it by a placeholder, to let the system know how to format it. So it would be 2015{0:0000}
- **Invoice Number Format & Proforma Number Format**: please disregard these fields, as they are only applicable for a few hotels in Czech Republic.
- **Bill Header & Bill Footer**: Complete these fields with all official hotel details: address, official hotel name, VAT, bank details, etc. This will be used for Bills/Proformas/Invoices. Note that we print both Header and Footer at the top fo the bill, which is due to the design we have used, so the Footer will not be printed at the bottom of the page.
Unfortunately we cannot modify the design of the bill in any way, we have chosen this design to be valid across all hotels worldwide. When we start making exceptions it will increase the risk of bugs/misprinting, therefore we prefer to use 1 universal template.
- **Bill Closing**: You are provided with 3 options.
 - "Always Allowed" will allow you to close bills at any time, even if the items on the bill have not yet been consumed (for example a future stay).
 - "Only with Consumed Items" will allow you to only close bills that have consumed items on them, so if there is a future stay or transfer planned and pre-paid, it will not allow you to close this bill until the day of check-out. This setting is extremely restrictive to front desk, and we do not recommend using it.
 - "Only with Consumed Items in Half Day Window": this is probably the best setting to be used. Reason for this is that, the moment a bill is closed, you cannot always made changes to the booking, as items that are affected by the change are already on a closed bill. So if you do not allow bill closing until the day of departure, you ensure that you can still make changes to the booking until the day of departure.
- **Editable History**: The downside to not having a night audit, is that no-shows have to be resolved in some way before you run accounting reports, as the No-Show Accommodation Revenue needs to be converted into a Cancellation Revenue (we post revenue at the time of booking, so the system already posted the Accommodation Revenue at the time of booking). In general the system does not allow you to change historic bookings, as this has taken place, and the revenues/costs should be locked and unchangeable, so that the accountant can rely on the reports he/she receives. A hotel may decide to allow a period during which you can still make changes to bookings, move rooms and cancel bookings. We recommend not making this period last longer than 24 hours, but this is entirely up to the hotel's discretion. Do not give the accounting reports to the accountant until this period has elapsed, otherwise the accounting reports might still change.
To set up the field, you have to calculate from the Official Arrival Time of the hotel (for example 15:00), until the time you would like to allow employees to handle no-shows. So if you would like the editable history window to close at 8AM in the morning, you set it to 17 hours (from 15:00 until 08:00 the next day, total = 17 hours).
Note: often users will get error messages such as "you cannot make this change as the items on this reservation are on a closed bill", to still be able to fix errors such as this one, you could open up the Editable History Window, but make sure you inform the accountant when you do so, as it will impact his/her reports, as you are changing historic revenues.
- **Enabled External Payment Types**: we standardly equip your payment screen with Credit Card and Cash payment types. If you want to accept any additional payment types to settle guest bills, you can chose any of the following options:
 - BACS Payment (UK) - this is a bank transfer type that is used in the UK only.
 - Bad Debts - often if you have accounts open for long periods of time, the accounting department needs to write these off, so you could use this payment type to close accounts that are considered as "bad debt".
 - Barter - if you barter your hotel services against services of your customers. Closing bills to this payment type still allows you to track the revenue (rather than simply rebating it).
 - Complimentary - If your accountant wants to track the revenue of bookings that were provided on a "complimentary basis" this is one way to track it. Some accountants prefer to set the rate of the booking to 0, rather than generate articial revenue figures, other accountants would rebate the revenues, and another type of accountant prefers to close the bills to payment type "complimentary". This decision is entirely up to your accounting department.
 - Exchange Rate Difference - Our system has automated calculations of situations where exchange rate differences occur. Therefore we do not render it necessary to swich on this payment type, however some accountants still prefer to have this payment type, in order to close bills that could have exchange rate differences. Note: exchange rate differences occur in countries where the sales currency is different from the accounting currency (such as Czech Republic).
 - Exchange Rounding Difference: if you have a difference on a bill, often a minute amount, which is mostly due to the rounding of items, to close a bill with a 1 or 2 cent difference, you could use this payment type. This is very rate, and sometimes its easier to simply use "cash" rather than confuse the operations team with yet another payment type.
 - Invoice - We suggest not to switch on this external payment type, and rather provide the "Invoicing Tool" provided by the system, which allows invoice payment tracking. If you use this payment type, we will simply close a bill, with a payment against "invoice" however we will not ask for future due date, and the bill will still come out with the header "Bill".
 - Reseller Payment - This option is used in a similar manner to the Barter option, described earlier. Its up to your accountant to use this option.
 - Unspecified - if you receive payments in any other manner than the above described ways, you could use "unspecified". We often suggest using this if you have recently migrated from an old system to Mews, and the imported bookings were already paid, and thus you want to record this (rather than recording them double as CC payments).
 - Wire Transfer - This is another way of saying "Bank Transfer".

####Options
- **Closing Bill as Invoice**: This option allows you to close bills directly to invoices from the payment screen. As mentioned before in the "external payments this is the preferred method of closing invoices. When you close a Bill as Invoice, we will change the naming of the Bill to "Invoice", print the Due Date and leave the payment as "To be Paid".
- **Customer Invoice Module Enabled**: we recommend against using this module, as its a complete standalone invoicing module, which we wil ldiscontinue using in the near future. So any invoices created through this tool will no longer be supported in the future.
- **Invoice Payment Tracking Enabled**: if you have enabled the "Closing Bill as Invoice" option (above), then we would also recommend selecting this option, as it allows you to tack, in the "Bills and Invoices Report" they payments of outstanding invoices and their respective due dates.
- **Optional Credit Card Payment Details**: If you select this option in the settings, the system will not require the hotel to complete the receipt identifier details when posting manual credit card payments. This is preferred by some hotels in order to speed up check-out/in. Note this is only applicable for payments that are made on an external terminal and input manually in the system with a receipt from the terminal. If you make a payment via our Payment Gateway (Adyen/Braintree) we automatically record all details.
- **Send Confirmation E-mail Pre Checked**: If you select this option, when a new booking is input manually by one of the users via the "New Reservations Screen", the selection to send the Confirmation E-mail to the guest is pre-set to "send". If you do not tick it, the system will not automatically send confirmation e-mails to your guests, unless you specifically select this option during the booking process.

####Reception
- **Departure Time**: this field needs to denote your official departure time. The timeline is built on a 24hr basis, so bookings will appear on the timeline with their exact departure time, unless you manually change a booking to have a different departure time.
- **Arrival Time**: this field needs to denote your official arrival time. The timeline is built on a 24hr basis, so bookings will appear on the timeline with their exact arrival time, unless you manually change a booking to have a different arrival time.
- **Registration Card Text**: this HTML field can be used to input 2-3 sentences which can be added as T&C's to your registration card. Note there is limited space on the registration card, so when you are updating it, we would recommend to print the registration card while testing, to ensure part of the text is not cut off.
The size of the registration card is A5, so that you could pre-print the back of the card with your conditions.
We do not allow for modifications of the registration card, except for the Custom Text field. This allows us to ensure a consistent printing quality, and ensure pre-printed fields are filled correctly for every hotel.
- **LetShare URL**: if you have the Event Management System called "LetShare" integrated in your hotel, you could paste a link to this system here, so that we create a direct link on your dashboard, that allows switching between both systems seamlessly.

####Cleaning
- **Cleaning Interval**: this is the mimimum time required between room allocations, to allow housekeeping to clean a room.
For example if your guest asks for a late check-out until 14h00, and you have a booking arriving (with an offical arrival time of 14h30 in its booking) at 14h30 (and the cleaning interval is set to 1 hour) in that case, the system will try to allocate the new arrival to another room, as housekeeping will not have sufficient time to clean the room.
So in essence, this is helping improve your housekeeping planning.

####Distributor
- **Booking URL**: If the hotel is using the Mews Distributor on its homepage, complete this field with the URL of the hotel where the widget will be implemented. So that once the booking is completed, it will redirect the user back to the homescreen.
- **Booking Terms and Conditions URL**: For hotels who use the Mews Navigator on their website, in this field you can specify the terms and conditions of the hotel, which will display in the booking widget. It is critical to fill this field in with all of the hotel pricing and cancellation policies, as this is a key requirement of your payment provider (Adyen/Braintree) in order to get accepted by their compliance team.
Mews will automatically add its Data and Privacy Policies to your hotel policies, to explain guests about how their data will be stored and protected in the system.

- **Logo**: Upload a hotel logo in high quality JPEG. This logo will be printed on bills and other guest documents. It will also be loaded onto the dashboard.
- **Sign in Image**: upload the best photo you have of the hotel. This photo will be used as the background photo during the Online Registration/Check-in in the Mews Navigator.

####Import Customers
If you would like to import Company Profiles and Guest Bookings into Mews from your previous system, we have built a custom import module.

Download the excel template from this link. Once you open the Excel template you will see 2 tabs:
1. Companies: if you want to import Company Profiles, you can fill in the first tab with as many details you have of the companies. All columns are explained in the notes field in row 1 on each field. The minimum requirement is a Company Name, withouth which we cannot create an profile (logically)
2. Customers: if you want to create Customer Profiles, you can fill in all fields up to Internal Guest Notes. Importing a file with data completed in all fields up to the Internal Guest Notes, will result in an import and creation of Guest Profiles with all fields pre-filled. Note that as you are starting with a clean system, so be selective about the data that you import, in order not to pollute the system with data that is not up to date.
**Reservations Import** if you complete any columns in tab 2 from Arrival Date forward, we will also create the accompanying bookings, and link them to the Customer Profiles you just created.

**NOTE**: when filling in the file, you **MUST** follow the formatting as described in the notes field of each column. If there is any error the import will fail, and we will ask you to update it.

<a name="Exchange-Rates"></a>
###Exchange Rates

The Mews Commander supports multiple currencies, however rates need to be set in 1 base accounting currency. If you decide to set the exchange rate manually, you can do this in the "Exchange Rate" submenu. We recommend hotels change their exchange rate minimum 1 time yearly.

The Mews Commander works with a multi-currency environment, meaning that you can follow a different sales currency (or multiple sales currencies) that will at some point be converted to the local currency. If you regularly change the exchange rate, it will be more common that exchange rate differences occur. Mews Commander has automated the calculateion of exchange rate differences, and will post these automatically on bills, rather than relying on the Front Desk staff to post these manually.

<a name="Guide-Cashier"></a>
###Cashier
####Setting up the Cashiers
To set up the cashier for your hotel, there are 2 options:

1. The hotel may decide that all receptionists share 1 float of money. You can then assign multiple receptionists to 1 cashier in the system.
2. All receptionists may have their own float of money.  You can then only assign 1 receptionist to a cashier in the system.

To set up the cashier, select in the settings the "Cashier" button.
Once you are in the settings, you can select to create a new cashier. It will prompt you to allocate a name to the cashier, which could either be the name of the receptionist or just a generic name if you are sharing the cashier.

You can select which currencies you would like to allow the user to accept.

All of the users in the system display below the name, and you can tick the users that you would like to give access to the cashier. Once these users are ticked and saved in the system, they will immediately see a new icon on their screen allowing them to use the cashier.

Within these settings you can also tick the box "Currency Exchange.” This option will activate the currency exchange for your hotel. You can set up the currency exchange with the fair rate, with a percentage commission, or with a fixed commission.

**Note**: every user who accepts money, **MUST** be assigned to a cashier. If a user who is not assigned a cashier, accepts money, and posts this on a guest bill, the money bill not be communicated to the cashier, and you will end up with an unbalanced cashier.

####Opening your Cashier
Once your cashier is set up, it will open with a 0 Opening balance.

Usually you start your shift with a minimum opening balance, so that you have some change in your cash desk to pay back to customers who do not pay their bill with an exact amount. To set the opening balance at the beginning of the system, select "New Transaction" and post the amount of money received in the "Value Received" field with a note, describing this is the initial balance setup.
Once you have set up your initial balance correctly, you can start using the cashier, taking in money, paying out, directly from guest bills or in the cashier.

Note: if you are posting cash which is linked to revenue, you must post this on the Guest Profile Billing Screen, so that the system required firstly for revenue to be posted, which is then balanced against cash. If you post cash directly in the cashier, we will not post "revenue" against it, so its considered a simply cash exchange, which does not impact accounting report.
- Example 1: if you send a team member to a shot to buy bananas, you would do a paid out directly from the cashier, and the receipt will need to be included in the shift-drop as "cash". In this case only a payment is posted in the cashier, not impacting accounting reports.
- Example 2: if a customer pays for a minibar item in cash, you have to go to his Guest Profile, first post the minibar item, and then post the cash. So that both revenue and payment are posted.

####Closing your Cashier
- At the end of the shift, you need to count the money you have in your physical cash drawer.
- Select the "Close Shift" button in the cashier
- The system will ask you to which "base value" you would like to return the cashier once you close the shift. This value needs to be the base value of the money you would like to remain in the desk, for the next shift to start with (so for example 200 Euro in change). So if you put 200 Euro in that field, the system will calculate:
"End Value of Cashier" minus "Base Value" = "Shift Drop Amount", and it will post this amount on a report, which you need to then give to your accountant (together with the money)

Once the shift is closed, the Opening Balance will start with 200 Euro (in this example).

<a name="Services-and-Stay-Services"></a>
###Services and Stay Services
In order to create chargeable services, you will need to set up each service and its sub-services in this section. The screen is divided in 2 sections:

1. **Services**: These are general services the hotels sells, such as the minibar, transfers, food&beverage, etc. and can be posted also manually from the Guest Profile - Billing Screen. At the same time if you want to create services for the Navigator, you will need to set them up in this section.
2. **Stay Services**: This is where accommodation rates, cancellation conditions and rate management is done. This is also the section where you set up products that can be packaged with the accommodation, such as breakfast, city tax, etc.

###Services
To create a new service, press the "New Service" button.

To create services, you have to follow the following logic, as the system of services is set up in 3 layers, and you must follow these layers for the services to work in the Navigator

Level 1: Service Category (For example "Room Service)
  Level 2: Product Category (For example "Starters" or "Main Courses")
    Level 3: Products (For example: "Coca Cola Light"
If you follow this logic, the services will be built according to the structure of the system, and they will display beautifully in the Navigator, but also on the billing screen in the Mews Commander.

When setting a "New Service" it will provide the user with a multitude of options:

- **Name**: Select the name of the service, as you would like it to display on guest bills.
- **Description**: This field is important when you want to sell the product on the Navigator, as this is the description that is displayed to your guests.
- **Ordering**: This will allow ordering of the items in the menu. Items with the lowest ordering number will display first, items with higher ordering numbers will appear later in the selection.
- **Currency**: A service can be set up in different currencies. Note that if you set the main product in a currency (i.e. Minibar) then all the items that fall within this product category (Coca Cola, beer, etc.) are priced in the same currency.
- **Amount**: The price of the product.
- **Tax Rate**: Set the correct tax rate for the product. If you are unsure, it is recommended to check this with your accountant/financial department.
- **E-mail**: if you would like a confirmation of the order to be sent to guests, this field is the e-mail field from which the confirmation e-mail will be sent. So the guest will respond to that e-mail if he/she has any questions with regards to the service.

####Options
- **Bill Packaged**: if you want items which are posted as part of this Service to be packaged, select this option, and then on each item that you would like to package, you select again "package" and it will merge these items together on guest bills (but not in internal reports)
- **Has Expanded Bill Items**: if you want to display all sub products ordered, on guest bills, as individual items. If you tick this, it will print each product as 1 line item on the bill, if you untick this option, the bill will display 1 line with a summary header only and a total amount. Again, in your internal reporting all products will still be split out separately.
- **Has Overridable Price**: if you would like to allow your reception to override the standard price set for this service and its sub-products, when they manually post items against this service.
- **Has Overridable Tax**: this will allow your reception to change the VAT level on a product posting. We would recommend against using this, as often the reception team is not aware which VAT is used on which product, and this needs to be set up as black-and-white as possible to avoid errors.
- **Is Directly Orderable By Customer**: if you select this, it makes the prodcut available on the Navigator for sale.
- **Is Externally Chargeable**: if you select this, and have a connected POS system, the Point Of Sales system can charge items against this service.
- **Is Retrospectively Orderable**: this option is important if you want to allow reception to post this item manually on bills, if you do not tick this, the product does not become available for manual postings.
- **New Order Is Processed**: this option is important to have ticked if the item is used by reception to post items manually on bills. If you do not tick this option, once the service is posted, you will be asked to manually "process the order" creating additional unnecessary work. This is only important for order from the Navigator, which require an employee to pick up the order and process it.
- **Orderable only with products**: if you select this option, it will not be possible for someone in the team (or a guest on the Navigator) to order the Service, without having selected any of its sub-products. (Its like ordering Room Service, without selecting the menu items that you have, so there is nothing to deliver)  
- **Order Generates E-mail**: if you have set up a Responsible Employee, and you select this option, the employee who is set up as responsible  will be receiving e-mail confirmation once the product is ordered.
- **Order Generates Notification**: if you have set up a Responsible Employee, and you select this option, the employee who is set up as responsible will be receiving dashboard notifications directly in the Mews Commander every time the service is ordered.
- **Order Has End**: this option is ONLY applicable for Accommodation, which must have a start and end date. Ignore this setting for any other services.
- **Order Has Start**: this option is applicable to services that have a start date. This is especially important for products in the Navigator, that are being ordered by the guest, and the reception needs to be informed of the start date/time of the serivce. So for example if the guest ordered a City Tour, Spa Treatment or Taxi, the reception will need to know at what time this service is requested. Ticking it, makes the time field a "obligatory field" not allowing anyone to order the service without setting the time/date first.
- **Order Requires Completed Notes**: some products, when posted require notes to be filled in. This is again mostly applicable for products from the Navigator. For example if a guest orders a taxi, we require him to specify the location/details of his pickup, thus it makes sense to make the "notes" field obligatory.

####Responsibility
In this field you can select the Employee who is responsible for this service. So when in the aforementioned options, you have selected that you want to receive notifications or e-mails, the system will send these to the responsible person automatically upon the ordering of the product.

####E-mail
**Order E-mail**: If you would like to send your customer an e-mail at the time of the order of the Service, you can type the e-mail in HTML in this field. Once the product is ordered by the customer (via Navigator or directly in the Commander), the system will trigger to send an e-mail to the guest. Of course we can only send confirmation e-mail to guests who have a valid e-mail address in their Guest Profile.

**End E-mail**: for some services, such as Accommodation, you may want to send an e-mail as a follow up once the service ends, to ask them how the service was enjoyed, or ask for feedback. Note that we can only send an end-email for services that have an end-date. At this moment, we only recommend setting this for Accommodation Services.

####Accounting
All products can be assigned Accounting Categories, which are the revenue buckets to which the product is being processed. There are 4 categories for which accounting categories are requestes:
- **Accounting Category**: this is the most important field to complete, as this is the accounting category for normal posting of the products
- **Cancellation Fee Accounting Category**: this is only applicable to products that have an automatic cancellation fee set up. Currently only Accommodation can have a cancellation fee set up automatically. So ignore this field for all other services.
- **Refund Accounting Category**: this is only applicable to products that have an automatic refund possibility set up. Currently only Accommodation can have a refunds set up automatically. So ignore this field for all other services.
- **Positive & Negative Deposit Accounting Category**: again, this is only applicable for Accommodation, and only in countries where the "deposit" functionality is used such as in Czech Republic and Germany (where VAT is paid at the time of deposits). So ignore this field for all other services.

####Promotions
Currently only the option "After Check-in" has live functionality in the Navigator. If you tick this option, in the Navigator, once you complete your online check-in, we will promote that service to the customer. This will help promote services such as a taxi pickup from the airport.

####Image
All Services / Product Categories / Products have the possibility to upload an image. If you are setting up the Navigator we highly recommend setting up photos for all 3 sections, because it will really personalize the Navigator to your hotel, rather than just showing generic images for different services.








<a name="Creating-Products"></a>
###Creating Product Categories and Products

<a name="Product-Category"></a>
####Product Category

Within the “Product,” you can create a "New Product Category" or a "New Product.” To give an example:

1. Service: Minibar
2. Product Category: Food
3. Product: Mars Bar

**Product Category**: When you create a new category, you have the following options:

- Name & Description: Should your hotel have the Mews Navigator, then the description field is important as this will appear on the Navigator.
- Parent Category: If you would like to make a sub-division in the categories.
Once you have created the category, you can create products inside the category by pressing "New Product"

<a name="Guide-Product"></a>
####Product

When setting the “Product,” there are a few options:

- **Consumed Before Night**: This product has been “consumed” (read: posted) prior to midnight of the accommodation posting. For example, this could be a halfboard package where a customer has dinner before the accommodation.
- **Always Included**: If this option is selected, it will be an obligatory product that is packaged with the rate. For example, this could be the case if a hotel only sells rooms inclusive of breakfast.
- **Included By Default**: This option is only applicable if you have the Mews Distributor implemented. If this option is selected, the product will be included by default but can be removed from the rate-package. This could be the case if you mostly sell rooms inclusive of breakfast, so you pre-tick the breakfast, but if a customer books, they can remove the tick from this box to exclude breakfast.
- **Cost Included In Night**: This feature will allow you to absorb a product (such as breakfast) into the night cost. It will not display this item (that is being absorbed) on the bill of the guest.
- **Include When**: Here you can determine whether you would like the product to be included when it is a specific type of customer (for example a "Leisure" or "Business" customer). An example of this could be a city tax, which is charged as part of the price.
- **Product Charging**: “Once” would charge the item only once during a stay. “Per Room Night” would charge the product each room night, independent of how many people are staying in the room. “Per Bed Night” charges the product per person per night.
- **Channel Manager ID**: This is only applicable if the channel manager supports the product and sells both inclusive and exclusive options of this product online.

<a name="Stay-Services"></a>
###Stay Services

<a name="Basic-Settings"></a>
####Basic Stay Settings

This section explains how to set the hotel rates and cancellation conditions, how to set up package items to rates, and how to create voucher codes.

**Basic Rate Settings** - The initial screen with rate conditions, are the conditions that apply to all rates. Most of the fields are the same in the "Services" settings with the following exceptions:

- **Reservation Max Length**: A hotel may want to set the maximum length of a reservation, so if you have a request that is longer than the max period, it will not offer availability.
- **Reservation Default Type**: Select either “Leisure” or “Business,” which will affect whether all new bookings automatically come in as Leisure or Business. After the bookings have downloaded or have been created in the system under the default stay type, you can manually change the purpose of the stay. Countries may have different city tax regulations, and this may be dependent on the reservation type.
- **Packages**: On this screen you can also add products. If you would like to package products as part of the rate, this is the screen to do so. Select "Add Product," and you will be able to create items such as breakfast, cleaning fee, city tax, halfboard, etc. The settings of these products are described in the aforementioned **Product** section.

**Rate and Vouchers**: Each standard setup of a hotel is done with a basic rate, which is considered the BAR rate, off which the other rates may or may not float. This section is split into another 2 sub-categories.

- **Rates**: An overview of all the different rates that have been set. Here you can quickly identify whether a rate is a voucher rate (only bookable with a voucher code, travel agent or company profile attached) and whether the rate is enabled.
- **Vouchers**: This is an overview of all the vouchers that have been set up. Each voucher can only be assigned to either a company or a travel agent. Also, it is important that when creating the voucher, you select the rates that you would like to apply to this voucher. (All voucher rates are displayed in the selection field). Lastly, you can create a number of voucher codes, which can be used directly in the Mews Distributor or Commander when booking a room.

<a name="Setting-BAR"></a>
####Setting the Best Available Rate

- **Name**: Name this field correctly with its full name, as this is the rate that is visible to the customer directly in the Mews Distributor.
- **Short Name**: Create a short name for all the rates, as this will display better in report columns.
- **Ordering**: This put a numerical order into the list of rates in the earlier "Rates" section.
- **Payment Conditions**: Here there are 2 options, and it is of the upmost importance that you select the correct one. “On Site” will lock the exchange rate only on the day of arrival, as the payment is expected during the guest’s stay. “In Advance” will lock the exchange rate on the day of booking, as this is a pre-paid rate, which will be charged on the day of booking.
- **Pricing**: Once you have set above settings, select the pricing tab where you will be able to set up the prices for this rate. First, set the "Base Price,” which is the base from which all other room types float. Ensure that you select the correct currency in the base rate, as this will affect the sales currency of the hotel. Once you have set the base rate, it will update all future dates with this rate. The base rate is the sales rate, inclusive of VAT, but exclusive of products (such as breakfast).
- **Empty Bed Adjustment**: Rooms are sold inclusive of VAT and are assumed to be for the base number of people the room can accommodate in regular beds (not taking into account extra beds). If the hotel differentiates its pricing if you , for example, go from double, to single, you can fill in the value with which the rate should drop. Note that in order to lower the rate you have to fill in a negative value (for example: -10)
- **Extra Bed Adjustment**: Same as above. The room is assumed to be sold a full capacity of beds, however if you have the possibility to place 1 or more extra beds, in this field you can put the value with how much you would like to charge an extra bed.
- **Room Type Adjustments**: Once you have set the base rate, you can chose the base room (usually the lowest room category) from which you would like to set the rate adjustments for the other rooms. Directly next to the room in the "Value" column, you can select the room adjustment and by which value you would like to increase the rate for that room type.
- **Relative Adjustments**: If you change the base price on a specific date, it will increase or decrease all rooms on that date in relation to the base price. So, if you increase the base price by 20 Euros, it will increase all rooms by 20 Euros. This is what we call a relative rate adjustment, which keeps the relations between rates stable.
- **Override Adjustment**: You can also decide to put an override adjustment on 1 specific room type, if occupancy of that room is exceptionally high, and you want to raise the rate on that room only. You can click directly on the rate in the room type to set the override. Note that if you set an override adjustment on a room type, it will ignore any further "Relative Adjustments,” until you delete the "override adjustment".
- **Options**: Once you have set the rates for the upcoming months/years, you need to complete the options. This field handles cancellation conditions and rate restrictions.

<a name="Cancellation-Conditions"></a>
#####**Cancellation Conditions**

The system calculates which cancellation conditions should be charged to guests based on the time of the cancellation. Let’s say you have a rate with a cancellation policy of 24 hours prior to arrival. The system knows that your check-in time is 15:00, so if you cancel the reservation at 14:59 the day prior, it knows not to charge any fee. If it were one minute later, however, it would correctly post cancellation fees.

- To set a new cancellation condition, select the button "New Cancellation Policy" in the "Options" section of rates. You can select for the specific rate type how many days prior the guest is allowed to cancel free of charge. If the guest cannot cancel, then leave this field black.
- Cancellation Fee Fixed: If you want to charge a fixed cancellation fee, put the amount in this field.
- Cancellation Fee Percentage: If you want to charge a percentage, complete the field here.
- Cancellation Fee Maximum Nights: This is an important field that requires careful attention. If you complete it with the number “1”, it will charge 1 night cancellation fee (adjusted by the cancellation fee percentage). If you complete it with “0”, it will not charge any cancellation fee. If you leave the field blank, it will charge the reservation fully, adjusted by the cancellation percentage.

<a name="Rate-Restrictions"></a>
#####Rate Restrictions

You have the possibility to set rate restrictions, which will affect the availability of the rate. You can set restrictions that require minimum length of stay, set close out dates or set minimum days it should be booked in advance.

- New Length Restriction: If you wish to set a minimum or maximum length of a booking, here you can select the amount of days for which you would like to apply this. For example, if you set a minimum length of stay as 3 nights, it will only offer this rate to people who select 3 nights or longer. It is important that you select "Only For Current Rate," otherwise it will apply this rule to all rates.
- New Earliness Restriction: You can create rates that are only available up to X nights before arrival. So, for example, you can set this as 21 days, and in that case, the rate will only be bookable 21 days and more in advance. It is important that you select "Only For Current Rate" otherwise it will apply this rule to all rates.
- New Amount Restriction: In order to prevent you accidentally selling rates that are too low, you can set a minimum amount, and the system will not allow you to lower any rate below this point.
- New Date Restriction: If you would like to create a specific period of time when you would not like the rate to be bookable or when you would like to create a specific period of time when you would only like to offer this special rate.

<a name="Setting-Dependent-Rates"></a>
####Setting Dependent Rates (Floating Rates)

Once you have set up your "Best Available Rate" in the system, you can create rates that float off this BAR rate at discounted percentages. One such example is a “Non-Refundable Rate,” which, for example, you can set at a 10% discount from the BAR rate. The system will automatically calculate the discount for all room types, saving a lot of work for revenue and reservations managers.

Some examples of rates that can float:
- Non-Refundable Rate
- Advance Purchase Rates: For example, if you wish to give a discount for guests who book 21 days in advance. You must ensure that you set a "New Earliness Restriction" (see above).
- Long Stay Rates: For example, if a customer books 7 days or longer, they would receive a 15% discount. You must ensure that you set a "Length Restriction" (see above).

To set up a new **Non-Refundable Rate**

1. In the **Stay** screen, select the "New Rate" button to start creating a new rate.
2. **Base Rate**: Select the rate from which you would like to float a discounted rate. Be very careful with this field. Once you have created a rate floating off another rate, you cannot change it (and you would have to delete it completely and rebuild it if you did need to change it). It is recommended to float the rate off the BAR rate.
3. **Voucher Rate**: If you would like to offer this rate only to specific travel agents or companies or with a special booking code (for the booking engine), you need to select this box. However if you would like the rate to be publicly available, then do not tick the box.
4. **Name**: Name this field correctly with its full name, as this is the rate that is visible to the customer directly in the Mews Distributor.
5. **Short Name**: Create a short name for all rates, as this will display better in report columns.
6. **Payment Conditions**: Here there are 2 options, and it is of the upmost importance that you select the correct one. “On Site” will lock the exchange rate only on the day of arrival, as the payment is expected during the guest’s stay. “In Advance” will lock the exchange rate on the day of booking, as this is a pre-paid rate, which will be charged on the day of booking.
7. Create the rate, and in the next screen, you need to "Enable" it by ticking the box and setting the discount in either a percentage or absolute amount (in the set currency).
8. **Options**: See the full explanation of the different options in the BAR explanation.

<a name="Setting-Independent-Rates"></a>
####Setting Independent Rates (Travel Agent / Corporate Rates)

You can set up rates that are not floating off the BAR (or any other rate). These need to be set manually. Typical examples of this are Wholesale Rates or Contracted Corporate Rates.

1. In the **Stay** screen, select the "New Rate" button to start creating a new rate
2. **Base Rate**: Do not select any base rate, as this will allow you to manage the rates manually.
3. **Voucher Rate**: If you are creating a rate that is only applicable for certain companies or travel agencies, then select this button.
4. **Payment Type**: Here there are 2 options, and it is of the upmost importance that you select the correct one. “On Site” will lock the exchange rate only on the day of arrival, as the payment is expected during the guest’s stay. “In Advance” will lock the exchange rate on the day of booking, as this is a pre-paid rate, which will be charged on the day of booking.
5. Once you create the rate, in the next screen you need to "Enable" it by ticking the box and setting the discount in either a percentage or absolute amount (in the set currency).
6. **Options**: See the full explanation of the different options in the BAR explanation.
7. **Pricing**: Once you have enabled the rate, select the pricing tab. Here you can complete the pricing for the entire contracted period of this travel agent or company.

https://vimeo.com/135136599

Once you have created the voucher rate, you will need to connect the rate to the specific company/travel agent for whom the rate should be made available. Do this in the "New Booking" screen once the company is selected.

1. Return to the **Stay** overview in the settings where you can see all the rates.
2. Select the button "**New Voucher**"
3. **Name the Voucher/Code**: It is recommended that you give the voucher a name that is logical, so that in the reservation report, you can quickly identify the rate.
4. **Company/Travel Agent**: Select the company or travel agent to whom you would like to attach the rate.
5. **Assigned Rates**: You will see a list of all voucher rates, and you will need to select the rates which you would like to make bookable for that specific company/agent.
6. Once you have created the connection between the rate and company or travel agent, press OK, and the connection will be functional. You can now create a new booking, and when you select the dates and the respective company/travel agent name, the system will offer the specific rates.
7. If you have the **Mews Distributor** (Booking Engine), you are also able to create vouchers, which can be provided to a customer booking directly on your hotel website. Select "New Voucher,” and complete the code you wish to use and the period during which the voucher should be bookable. Once saved, you are able to provide this code to your clients for direct bookings.

<a name="Cultures-Tax-Number-Settings"></a>
###Cultures, Taxation and Number Settings

<a name="Number-Precision"></a>
####Number Precision
Currently, the precision of costs in the system (e.g. night cost, minibar item cost) is dependent on the currencies in which the items are priced. And the precision is the smallest unit of that currency - 1 CZK, 0.01 EUR, 0.01 USD etc. So it's not possible to set price of something to 1.2 CZK, 1.234 CZK or 1.234 EUR. Thanks to that, the bills don't have to contain a "rounding" item (halerove zaokrouhleni) because the sum is always payable using the currency.

It's possible to set up custom precision of VAT calculation, which means that even though the items are always rounded to whole crowns, the NET and VAT calculated can be more precise.

In order to set this precision, contact your Mews representative.

<a name="Cultural-Settings"></a>
####Cultural Settings
In czech culture (can be set in your profile) the decimal places are separated by comma "," and thousands can be optionally separated by spaces (e.g. "1 234 567,89"). In english US culture, there is decimal point "." and thousands can be optionally separated by commas "," (e.g. "1,234,567.89").
