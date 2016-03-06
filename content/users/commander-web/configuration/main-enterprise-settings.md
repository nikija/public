---
title: Main Enterprise Settings
ordering: 1
---

When you select settings in the menu bar at the top of the screen, and select your hotel name, this will take you to the main settings menu. Only employees with ADMIN rights have this button in their top menu, and these rights should be handed out very sparingly, as anyone with access to the configuration of the hotel can change any and all settings having a major impact of hotel functioning. We generally recommend not to give rights to this section to more than 2-3 persons in the hotel.

Below we will walk through a number of the main settings. Note that if functions do not require any description (in our opinion) we have not detailed them below, should you be missing any critical feature description, kindly inform us at support@mewssystems.com and we will be sure to update the guide.

## General Settings

- **Identifier**: the code you see after the "identifier" field is your Unique Hotel ID. If you have a webdeveloper integrate the booking engine into your website, he will need this ID.
- **Name and Short Name**: Set the name of your hotel. This is the official hotel name (not the official company name). The short name is important for internal use only, so that it allows us to abbreviate it in reports and allows more columns on a page.
- **Description**: There is currently no direct function assigned to this, so there is no need to complete this field.
- **Unique Name**: Please always complete this field, which we used as part of the link we e-mail guests with their login to the online dashboard. Complete the field with the name of the hotel, preferably without spaces in lower case. (eg. waldorf-astoria)
- **E-mail**: Complete this field with the e-mail address from which you would like to communicate with guests.
- **Contact details**: Complete these fields with hotel telephone number, website address and physical address details, as this is important for the different types of communication sent through the system. Its best if you find your address using the provided Google Address bar, so that it will also pick up your Longitude and Lattitude, allowing us to place your hotel on a map with its exact coordinates.
- **Timezone**: you will not be able your Timezone, but its critically important that the correct timezone is selected, if you notice this is not the correct timezone, kindly contact Mews Support at support@mewssystems.com

## Globalization

- **Legal Environment**: each hotel that is built has to be assigned to a legal environment, which sets the main taxation and accounting rules for the hotel within Mews. If you notice that the wrong legal environment is selected for your hotels, kindly contact support to correct this.
- **Default Currency**: each hotel has to be set up with a default currency. This currently is the fallback currency, in case no currency is selected by the hotel. Hotels cannot change this currency, and if you need it amended, please contact support.
- **Currency Rate Update**: Mews can automatically change your currencies from different online sources, this prevents manual work by accountants, and ensures you always offer guestst the most fair rate. You can chose to either update it "never", which means you will set the rates manually, and the system will never update it automatically. ALternatively you can set it to update daily, monthly or yearly.
- **Currency Rate Source**: Here you can select from which source you would like to pick up the exchange rates.
- **Accepted Currencies**: We allow the handling of multiple currencies, which allows you to accept money in a variety of currencies. Should you find that your preferred currency is not available in the menu of offered currencies, please contact Mews so that we can add this currency.
- **Default Language**: The default language is important, as this is the primary language in the system that is used for users, but also for customer is no other language is selected. So all guest communication will be primarily set in that language, unless otherwise specified in the guest profile.
- **Supported Language**: This selection is not to set your personal language, but more to select in which language you want guest communication to be sent. Note that if you select languages, other than English, the hotel is responsible for the translations of the Confirmation E-mails, Registration Cards, Rate descriptions, Room Descriptions, Products and any other text that is guest-facing.

## Options

- **Closing Bill as Invoice**: This option allows you to close bills directly to invoices from the payment screen. As mentioned before in the "external payments this is the preferred method of closing invoices. When you close a Bill as Invoice, we will change the naming of the Bill to "Invoice", print the Due Date and leave the payment as "To be Paid".
- **Customer Invoice Module Enabled**: we recommend against using this module, as its a complete standalone invoicing module, which we wil ldiscontinue using in the near future. So any invoices created through this tool will no longer be supported in the future.
- **Charge Cancellation Fee by Default**: if you tick this option, we will always pre-tick the "charge cancellation fees" tickbox in the State Tab of the Booking Module, so that when you cancel a booking we will by default charge the cancellation fee.
- **Invoice Payment Tracking Enabled**: if you have enabled the "Closing Bill as Invoice" option (above), then we would also recommend selecting this option, as it allows you to tack, in the "Bills and Invoices Report" they payments of outstanding invoices and their respective due dates.
- **Optional Credit Card Payment Details**: If you select this option in the settings, the system will not require the hotel to complete the receipt identifier details when posting manual credit card payments. This is preferred by some hotels in order to speed up check-out/in. Note this is only applicable for payments that are made on an external terminal and input manually in the system with a receipt from the terminal. If you make a payment via our Payment Gateway (Adyen/Braintree) we automatically record all details.
- **Print Registration Cards On A5 Paper Format**: some hotels have pre-printed the back of an A5 paper with the hotel T&C's, if you use A5 paper, instead of A4, then switch on this option.
- **Send Backup Reports Enables**: every night we send backup reports to the main e-mail provided in the general settings. These reports include the following reports, which we feel contain the most critical hotel information in case you have an internet outage, or Mews has any downtime:

Each night at 2am, we will send the following reports to the main e-mail of the hotel (the address in the general settings of Mews). The reports will be sent in Excel format, so that you can work with the data more easily. Please instruct your team not to delete this e-mail, but store it safely.

 - Room Status Report - for housekeeping
 - Guest In House Report - From this report you can, check the names of all guests in house, by room number, and whether they have any products included in their stay. It also shows the balance of the bill, and the level of preauthorisations taken on the account.
 - Reservations Report (all in house bookings for today with loaded balances)
 - Guest Ledger: We send the Guest Ledger, so that you can see the balances of all guests in house, but also any open “to be resolved” bills and the items that are on those bills. So in case the guest would not be willing to late-charged when the system comes back online, you can compile a bill from these items.

- **Send Confirmation E-mail By Default**: If you select this option, when a new booking is input manually by one of the users via the "New Reservations Screen", the selection to send the Confirmation E-mail to the guest is pre-set to "send". If you do not tick it, the system will not automatically send confirmation e-mails to your guests, unless you specifically select this option during the booking process.

### Tax Precision
Some accountants in hotels prefer very specific precision of their numbers in reports. For example if a number is 2,342453 without having the tax precision set, we will try to keep this number as complete as possible. However if you set the tax precision to 2, it will cut the number off at 2,34 in all reports and calculations. Once this setting is switched on, all postings from that point forward will follow this tax precision, and they cannot be reverted. So be careful with this setting to be sure this is what you would like to achieve.

### Editable History

The downside to not having a night audit, is that no-shows have to be resolved in some way before you run accounting reports, as the No-Show Accommodation Revenue needs to be converted into a Cancellation Revenue (we post revenue at the time of booking, so the system already posted the Accommodation Revenue at the time of booking). In general the system does not allow you to change historic bookings, as this has taken place, and the revenues/costs should be locked and unchangeable, so that the accountant can rely on the reports he/she receives. A hotel may decide to allow a period during which you can still make changes to bookings, move rooms and cancel bookings. We recommend not making this period last longer than 24 hours, but this is entirely up to the hotel's discretion. Do not give the accounting reports to the accountant until this period has elapsed, otherwise the accounting reports might still change.

To set up the field, you have to calculate from the Official Arrival Time of the hotel (for example 15:00), until the time you would like to allow employees to handle no-shows. So if you would like the editable history window to close at 8AM in the morning, you set it to 17 hours (from 15:00 until 08:00 the next day, total = 17 hours).

Note: often users will get error messages such as "you cannot make this change as the items on this reservation are on a closed bill", to still be able to fix errors such as this one, you could open up the Editable History Window, but make sure you inform the accountant when you do so, as it will impact his/her reports, as you are changing historic revenues.

### Enabled External Payment Types

We standardly equip your payment screen with Credit Card and Cash payment types. If you want to accept any additional payment types to settle guest bills, you can chose any of the following options:

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

## Reception

- **Departure Time**: this field needs to denote your official departure time. The timeline is built on a 24hr basis, so bookings will appear on the timeline with their exact departure time, unless you manually change a booking to have a different departure time.
- **Arrival Time**: this field needs to denote your official arrival time. The timeline is built on a 24hr basis, so bookings will appear on the timeline with their exact arrival time, unless you manually change a booking to have a different arrival time.
- **Registration Card Text**: this HTML field can be used to input 2-3 sentences which can be added as T&C's to your registration card. Note there is limited space on the registration card, so when you are updating it, we would recommend to print the registration card while testing, to ensure part of the text is not cut off.
The size of the registration card is A5, so that you could pre-print the back of the card with your conditions.
We do not allow for modifications of the registration card, except for the Custom Text field. This allows us to ensure a consistent printing quality, and ensure pre-printed fields are filled correctly for every hotel.
- **LetShare URL**: if you have the Event Management System called "LetShare" integrated in your hotel, you could paste a link to this system here, so that we create a direct link on your dashboard, that allows switching between both systems seamlessly.

## Cleaning

- **Cleaning Interval**: this is the mimimum time required between room allocations, to allow housekeeping to clean a room.
For example if your guest asks for a late check-out until 14h00, and you have a booking arriving (with an offical arrival time of 14h30 in its booking) at 14h30 (and the cleaning interval is set to 1 hour) in that case, the system will try to allocate the new arrival to another room, as housekeeping will not have sufficient time to clean the room.
So in essence, this is helping improve your housekeeping planning.

## Distributor

- **Booking URL**: If the hotel is using the Mews Distributor on its homepage, complete this field with the URL of the hotel where the widget will be implemented. So that once the booking is completed, it will redirect the user back to the homescreen.
- **Booking Terms and Conditions URL**: For hotels who use the Mews Navigator on their website, in this field you can specify the terms and conditions of the hotel, which will display in the booking widget. It is critical to fill this field in with all of the hotel pricing and cancellation policies, as this is a key requirement of your payment provider (Adyen/Braintree) in order to get accepted by their compliance team.
Mews will automatically add its Data and Privacy Policies to your hotel policies, to explain guests about how their data will be stored and protected in the system.

- **Logo**: Upload a hotel logo in high quality JPEG. This logo will be printed on bills and other guest documents. It will also be loaded onto the dashboard.
- **Sign in Image**: upload the best photo you have of the hotel. This photo will be used as the background photo during the Online Registration/Check-in in the Mews Navigator.

## Import Customers

If you would like to import Company Profiles and Guest Bookings into Mews from your previous system, we have built a custom import module.

Download the excel template from this link. Once you open the Excel template you will see 2 tabs:
1. Companies: if you want to import Company Profiles, you can fill in the first tab with as many details you have of the companies. All columns are explained in the notes field in row 1 on each field. The minimum requirement is a Company Name, withouth which we cannot create an profile (logically)
2. Customers: if you want to create Customer Profiles, you can fill in all fields up to Internal Guest Notes. Importing a file with data completed in all fields up to the Internal Guest Notes, will result in an import and creation of Guest Profiles with all fields pre-filled. Note that as you are starting with a clean system, so be selective about the data that you import, in order not to pollute the system with data that is not up to date.
**Reservations Import** if you complete any columns in tab 2 from Arrival Date forward, we will also create the accompanying bookings, and link them to the Customer Profiles you just created.

**NOTE**: when filling in the file, you **MUST** follow the formatting as described in the notes field of each column. If there is any error the import will fail, and we will ask you to update it.
