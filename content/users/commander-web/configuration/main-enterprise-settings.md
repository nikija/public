---
title: Main Enterprise Settings
ordering: 1
---

When you select settings in the menu bar at the top of the screen, and select your hotel name, this will take you to the main settings menu.

## General Settings

- **Identifier**: the code you see after the "identifier" field is your Unique Hotel ID. If you have a webdeveloper integrate the booking engine into your website, he will need this ID.
- **Name and Short Name**: Set the name of your hotel. This is the official hotel name (not the official company name). The short name is important for internal use only, so that it allows us to abbreviate it in reports and allows more columns on a page.
- **Description**: There is currently no direct function assigned to this, so there is no need to complete this field.
- **Unique Name**: Please always complete this field, which we used as part of the link we e-mail guests with their login to the online dashboard. Complete the field with the name of the hotel, preferably without spaces in lower case. (eg. waldorf-astoria)
- **E-mail**: Complete this field with the e-mail address from which you would like to communicate with guests.
- **Contact details**: Complete these fields with hotel telephone number, website address and physical address details, as this is important for the different types of communication sent through the system. Its best if you find your address using the provided Google Address bar, so that it will also pick up your Longitude and Lattitude, allowing us to place your hotel on a map with its exact coordinates.
- **Timezone**: you will not be able your Timezone, but its critically important that the correct timezone is selected, if you notice this is not the correct timezone, kindly contact Mews Support.

## Globalization

- **Supported Language**: This selection is not to set your personal language, but more to select in which language you want guest communication to be sent. Note that if you select languages, other than English, the hotel is responsible for the translations of the Confirmation E-mails, Registration Cards, Rate descriptions, Room Descriptions, Products and any other text that is guest-facing.
- **Accepted Currencies**: We allow the handling of multiple currencies, which allows you to accept money in a variety of currencies. You can set rates based on an automatic daily, monthly or yearly rate (note this is only available for countries in the EU currently). You can also select from which source you would like to take the exchange rate. The options are provided in the "Currency Rate Source" menu.
A hotel may also select to manage rates manually. In order to manage the exchange rate manually, you need to select "Never" in the Currency Rate Update menu and select "Exchange Rates" in the settings tab in the top-bar menu.

## Options

- **Closing Bill as Invoice**: This option allows you to close bills directly to invoices from the payment screen. As mentioned before in the "external payments this is the preferred method of closing invoices. When you close a Bill as Invoice, we will change the naming of the Bill to "Invoice", print the Due Date and leave the payment as "To be Paid".
- **Customer Invoice Module Enabled**: we recommend against using this module, as its a complete standalone invoicing module, which we wil ldiscontinue using in the near future. So any invoices created through this tool will no longer be supported in the future.
- **Invoice Payment Tracking Enabled**: if you have enabled the "Closing Bill as Invoice" option (above), then we would also recommend selecting this option, as it allows you to tack, in the "Bills and Invoices Report" they payments of outstanding invoices and their respective due dates.
- **Optional Credit Card Payment Details**: If you select this option in the settings, the system will not require the hotel to complete the receipt identifier details when posting manual credit card payments. This is preferred by some hotels in order to speed up check-out/in. Note this is only applicable for payments that are made on an external terminal and input manually in the system with a receipt from the terminal. If you make a payment via our Payment Gateway (Adyen/Braintree) we automatically record all details.
- **Send Confirmation E-mail Pre Checked**: If you select this option, when a new booking is input manually by one of the users via the "New Reservations Screen", the selection to send the Confirmation E-mail to the guest is pre-set to "send". If you do not tick it, the system will not automatically send confirmation e-mails to your guests, unless you specifically select this option during the booking process.

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
