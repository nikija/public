---
title: Integrations
ordering: 7
---

- [How to create any integration](#how-to-create)
- [Channel Manager Integrations](#channel-manager-integrations)
    - [How to create a Channel Manager Integration](#how-to-create-channel-manager-integration)
    - [How to map a Channel Manager Rates](#how-to-map-channel-manager-rates)
    	- [Map Channel Manager Products](#how-to-map-channel-manager-products)
    - [How to manage a Channel Manager Integration](#how-to-manage-channel-manager-integration)
    	- [Adding a new room type](#adding-a-new-room-type-to-channel-manager-reservation)
    	- [Removing a room type](#removing-a-room-type-from-channel-manager-reservation)
    - [Operations](#channel-manager-integration-operations)
    - [Actions](#channel-manager-integration-actions)
    - [Concrete Integrations] (#concrete-integrations)
    	- [AvailPro](#availpro)
    	- [Booking.com](#booking-com)
    	- [Cubilis](#cubilis)
    	- [SiteMinder](#siteminder)
    	- [TravelClick](#travelclick)
    	- [TravelLine](#travelline)
    	- [WebHotelier](#webhotelier)
    - [Trouble Shooting] (#troubleshooting)
        - [Invalid Mapping] (#troubleshooting-invalid-mapping)
        - [Rate Are Not Synchronized] (#troubleshooting-rate-sync-issues)
        - [Reservation wasn't downloaded] (#troubleshooting-reservation-was-not-downloaded)
- [Payment Gateway Integrations](#payment-gateway-integrations)
    - [Adyen](#adyen)
    - [BrainTree](#braintree)
- [Foreign Police Integrations](#foreign-police-integrations)
    - [Czech](#czech-foreign-police-integration)
    - [Swiss](#swiss-foreign-police-integration)
- [PriceMatch](#pricematch)
- [VingCard](#vingcard)
- [Point Of Sales Systems](#point-of-sales-systems)
- [Translations](#translations)

<a name="how-to-create"></a>
## How to create an intgration

1. Go to settings page of the enterprise.
2. Click Enterprise Integrations link.
3. Create an integration of proper type.
4. Fill the integration's data.
5. Enable the integration.

<a name="channel-manager-integrations"></a>
## Channel Manager Integrations

Channel Manager Integration connects Mews Commander with external Channel Manager - an aggregator of booking engines all over the world. The main function of the connection between the Channel Manager and Mews Commander is to upload the availability and prices (Mews Commander -> Channel Manager -> OTAs) and to download reservations (OTAs -> Channel Manager -> Mews Commander).

The update of availability and prices works in two different modes

- **Full update** when information for all connected room types and rates is sent (can be triggered manually).
- **Delta update** when only difference from last delta update is sent (can't be triggered manually).

<a name="how-to-create-channel-manager-integration"></a>
### How to create a Channel Manager Integration

This is a general manual for creating any Channel Manager integration. If any concrete integration needs different approach, the aproach is described in the section of the concrete integration.

1. Obtain a mapping codes for `Room Types`, `Rates` and `Products` and hotel's credentials.
2. Fill in the codes of `Room Types` and `Products` into proper row of `Channel Manager Id` property on settigns page.
3. Create the integration (see [How to create integration](#how-to-create)). **DO NOT ENABLE IT YET**.
4. Fill in the `Channel Manager Id` of the hotel and `Information email` (an email of the hotel (usually reception) to which notifications will be sent) and other data.
5. Create `Channel Manager Rate`s (Make sure that none of the rates in Channel Manager are derived from another rate).
	- Create new `Channel Manager Rate` by selecting an existing Mews rate and assigning proper mapping code.
	- Create `Channel Manager Room Type` for each mews room type that is connected with the rate. *Note that the `Room Type`s should have a mapping code already assigned*. If you don't see some of the room types in the drop-down list it means the code wasn't set up in the room type description (the same applies for Products).
	- Create `Channel Manager Product` for each product **that is always included in the rate** (*Note that the `Product`s should have a mapping code already assigned*). See [Map Channel Manager Products](#how-to-map-channel-manager-products) for more details.
	- If the price will be supplied from Mews, leave `IsSynchronzied` ticked.
	- If the price will be calculated on Channel Manager, untick the `IsSynchronzied` (the reservation download will assign the rate properly).
6. Enable the integration
7. Enable the `Upload prices` and/or `Upload availability` operations and trigger **Send inventory** action manually for only a couple of days.
	- If the operation runs finishes with error or warning, it is probably because of mapping codes are set up incorectly. Check the mapping and run again. It may have failed because the connection is not activated yet on the side od Channel Manager - in this case you have to concact their support to enable the connection.
	- If the operation succeeds, you continue.
8. Trigger the **Synchronize** action
9. Enable **Download resevations periodically** operation and trigger the **Download reservation** action.
10. Check that all reservations were downloaded and confirmed successfully. If not, deal with the errors somehow, until all reservations are downloaded and confirmed.
12. Enable the proper set of operations.
11. DONE.

<a name="how-to-map-channel-manager-rates"></a>
### How to map a Channel Manager Rates

There is several possobilities how a rate can be connected to channel manager via Channel Manager rate:

1. The rate exists in Mews and Channel Manager
	- the usual situation.
2. The rate exist only in Channel Manager
	- This helps when there is a special rate setting on channel manager that can't be achieved in Mews.
	- The Channel Manager rate must be connected to rate in mews (regardless whether the Mews rate is already mapped to a different channal manager rate).

Anyway the set up steps are:

- Create a new Channel Manager rate.
- Select proper Mews rate.
- Assign a proper mapping code.
- Set `IsSynchronzied` according to rate specification.

<a name="how-to-map-channel-manager-products"></a>
#### Map Channel Manager Products

From mapping you will obtain a code for each individual prouct or service, that is offered via CHM. Those codes need to be mapped in the product detail. If there is no code for any product specified in the CHM mapping, it usually means that the CHM just resends the code of the product from the OTA to Mews without change, so the OTA code nneds to be mapped instead. **That is why the mapping field can hold multiple codes for multiple OTAs separated by `;` or by `,`.** Those codes need to be obtained from each OTA - hotel should ask for it and finish the mapping.

*Useful fact:* The code for breakfast on Booking.com is usually `1`, so mapping the brakfast with code `1` will apply to Booking.com reservations.

Providing such mapping will ensure, that all ordered services/products will be properly added to the reservation, when ordered by guest.

**Creating `Channel Manager Product` for `Channel Manager Rate` means:**

- The product is always included in the rate.
- The cost of the product is added to the cost of the rate when the price is sent to CHM.
- The product is always added to the reservation eventhough the product/service was not ordered by guest.

<a name="how-to-manage-channel-manager-integration"></a>
### How to manage a Channel Manager Integration

<a name="adding-a-new-room-type-to-channel-manager-reservation"></a>
#### Adding a new room type

If hotels want to add a new room type to be sychronized with channel manager:

1. They need to obtain from the channel manager the mapping code for the room type and the rate codes the room type is connected to.
2. The room type mapping code should be set to the mapping property of the room type.
3. The room should be added to the list of connected room types on each channel manager rate (on the integration detail) the room type should be connected to.

<a name="removing-a-room-type-from-channel-manager-reservation"></a>
#### Removing a room type

If hotel doesn't want to synchronize a room type anymore, follow these steps:

1. Remove the room type connection from all channel manager rates that connect the room type.
2. Remove the mapping code from the room type setting.

<a name="channel-manager-integration-operations"></a>
### Operations

Every operation can be triggered either manually (from the integration screen) or by a background job that triggers the opertion on the integration (if the integration has the operation enabled). There are all operations that the integration might support:

- **Create reservations** - allows Mews Commander to create reservation from a direct input (either manual or via API).
- **Ping notification** - allows Channel Manager to ping Mews Commander, the reaction is to ask for reservations (saves traffic).
- **Download Mappings** - Mews Commader will ask for mapping information of the hotel. Result will be in a job logs.
- **Download reservations periodically** - Mews Commander requests the Channel Manager for all pending reservations. After processing the reservations, Mews Commander confirms the reservations.
- **Upload Availability** - Mews Commander allows to send update of availability.
- **Upload Rate Prices** - Mews Commander allows to send prices and rate restrictions.
- **Sychronization** - usually runs once a day and combines reservation download and full-update for the maximal allowed period in advance.

<a name="channel-manager-integration-actions"></a>
### Actions

To trigger operations on the integration manually, go to the integration detail page (where the setting is). On the bottom there is a form which enables to trigger some operations manually. *Note that the operations run via jobs where only global admin has access*. To check the status of operations, log in as a global admin in an incognito tab and check jobs (the sign of an lightning).

- **Download Mappings** - will create a background job that downloads hotel mapping from Channel Manager.
- **Download Reservation** - will create a background job that downloads pending reservations from Channel Manager.
- **Send Inventory** - will create a background job that uploads full update (availability and/or prices) for the specified period in the Channel Manager.
- **Synchronization** - will create a background job that triggers synchronization with the the Channel Manager.
- **Create reservation** - will create reservation based on data from `Input` field. *Note that reservation will not be confirmed to Channel Manager*.  

<a name="concrete-integrations"></a>
### Concrete Integrations

<a name="availpro"></a>
#### AvailPro

- AvailPro integration supports **Create reservations**, **Download reservations peridically**, **Upload Availability**, **Upload Prices**, **Synchronize** operations.
- Credential are common for each hotel.
- The mapping table is sent via email to us.
- The room type code and the product code are 5 digit numbers.
- The rate code is a text code.

<a name="booking-com"></a>
#### Booking.com

- Booking.com integration supports **Create reservations**, **Ping notification**, **Download reservations peridically**, **Upload Availability**, **Upload Prices**, **Synchronize** operations.
- Prefferably use **Ping notification** over **Download reservations peridically** operation.
- Credentials are common for each hotel.

<a name="cubilis"></a>
#### Cubilis

- Cubilis integration supports **Create reservations**, **Download reservations peridically**, **Upload Availability**, **Upload Prices**, **Synchronize** operations.
- To create a new hotel, contact Cubilis on `support@stardekk.be`.
- Cubilis will create credentials and activate the connection. The new credentials will be sent to `matt@mewssystems.com` and `ondra@mewssystems.com`.
- The connection is then activated on our side - simply by creating/enabling the integration to Cubilis. You can activate the connection on your side. On this page: `http://cubilis.eu/plugins/pms/ReservationQueue.aspx` it is possible to remove some reservations from the queue.
  - Step 1: Delete all reservations "with start date before" and select the date of the hotel conversion to Mews. --> Select "Remove from queue"
  - Step 2: Once the old bookings are removed, select all reservations "with start date later than" and select the date of the hotel conversion to Mews. --> Select "Add to queue" and the bookings should start coming into Mews over the next few hours.
- Every hotel will be provided with their own username and password that needs to be set in the integration before any communication starts.
- To obtain mapping you have to enable the integration and allow the **Download mapping** operation. Then trigger the **Download mapping** action and go to the job log for mapping details.
- All codes are numbers, the Default (Standard) rate has code 0.

<a name="siteminder"></a>
#### SiteMinder

- SiteMinder integration supports **Create reservations**, **Download reservations peridically**, **Upload Availability**, **Upload Prices**, **Synchronize** operations.
- SiteMinder has 2 different sets of credentials, to correct set up just provide `UserName` field with provided value:
   - `MewsSystemsAPAC` - for Australia and oceania based hotels
   - `MewsSystemsEMEA` - for Europe based hotels (not sure about America)
   - basically if one value doesn't work, the second should as there is no third option.

<a name="travelclick"></a>
#### TravelClick

- TravelClick integration supports **Create reservations**, **Upload Availability**, **Upload Prices**, **Synchronize** operations.
- TravelClick supports PUSH reservation delivery only, which means that reservations are pushed to MEWS via our API. The periodical reseration download is not supported.
- TravelClick processes the data with availability and prices from Mews asynchronously. Which means, that the job with the upload will always succeed, because TravelClick does not send the response with validation result (success/warning/error) unlike other Channel Managers do. The esponse with validation result is delivered to our API and is visible only on LogEntries - which means that a developer must assist with obtaining the result of the availability/prices upload in order to verify its true result. It is linked to a `EchoToken` attribute in the message uploaded in Mews (visible on Mews Jobs).
- Enhancement - the item that has price. It should be mapped against our Stay products (e.g. breakfast).
- Services (TravelClick's definition) - the item that does not have price.(e.g. Extra Pillows). These services are displayed under Reservation Notes. There is no need to map it.

<a name="travelline"></a>
#### TravelLine
- TravelLine integration supports **Cancel notification**, **Create reservations**, **Download reservations peridically**, **Upload Availability**, **Upload Prices**, **Synchronize operations**.

<a name="webHotelier"></a>
#### WebHotelier

- WebHotelier integration supports **Create reservations**, **Ping notifications**, **Download reservations peridically**, **Upload Availability**, **Upload Prices**, **Synchronize** operations.
- Prefferably use **Ping notification** over **Download reservations peridically** operation.
- WebHotelier provides each hotel with its own credentials. Once you have set up the credentials,
 - select the enabled operations: "download mappings"
 - then enable the connection.
 - select the option "download mappings" and select ok.
 - the mappings have been delivered to the MEWS ADMIN (so Sysco will have to write an e-mail to Mews to get the mappings shared). When you open the mappings you see that they are missing formatting, you can use this link to give it better formatting: https://jsonformatter.curiousconcept.com/
- The Webhotelier mapping of rates works slightly different from other channel managers. Each rate has a unique code for each room type that is mapped. So when setting up a New Channel Manager Rate, select the correct rate type, and put the unique code, and save it. Secondly only add the room type to which this rate is applicable.
- Once you have connected Webhotelier, you can only send them inventory updated up to 180 days in 1 push. If you include any date that is more than 180 days out, the job will fail.

<a name="troubleshooting"></a>
### Troubleshooting

<a name="troubleshooting-invalid-mapping"></a>
#### Invalid mapping
- When you receive an email with invalid mapping, it is crucial to fix the mapping as soon as possible. Because Mews **disabled** the integration, which means that until the mapping is fixed, no reservation will be downloaded and no availability/rate will be updated.

<a name="troubleshooting-rate-sync-issues"></a>
#### Rates synchronization issues
- If you receive a notification email that says something like rate update is not allowed, becaue updated rates are dependent (linked, derived, ...), you usually receive the rate code, so it is easy.
- In case this happens on AvailPro, you are not notified by an email, but by an angry customer, that complains that rates are not updated correctly. If synchronization doesn't help, you need to contact AvailPro, because they have mess in rate set up. There is some hidden rate dependency, and AvailPro needs to find it and give you the rate code.
- With the dependent rate code, you need to communicate with Channel Manager and Hotel to ask where the rate needs to be supplied from - either from Mews or from Channel Manager and adjust mapping accordingly.

<a name="troubleshooting-reservation-was-not-downloaded"></a>
#### Reservations are not downloaded
If hotel complains about reservation(s) not being downloaded, there could be a lot of reasons. Some of them:
- The integration is disabled. or the `Download Reservations periodically` or `Ping Notificiation` or `Create Reservation` method is disabled (depends on channel manager which operation is used to obtain reservations).
   - In this case enable the integraton/operation and wait for the job to get it (if operation is `Download Reservations periodically`. Otherwise ask channel manager to resend the reservation.
- The resevation was downloaded, but hotel assigned it to another guest (hotel just can't find it by the original guest name) or updated it somehow. Just try to find it by channel manager code.
- The reservation wasn't sent to Mews (accoring to logs), but in Channel Manager is marked as delivered. In this case contact channel manager to get you the exact time of reservation download and confirmation number we send them as part of confirmation.
   - If they send you the data, check the logs again to see what happend.
   - If they don't have the data, means they didn't deliver the reservation an the problem is in channel manager.
   - In both cases the solution is to resend it from channel manager again.

<a name="payment-gateway-integrations"></a>
## Payment Gateway Integrations

To create new payment gateway simply follows see [the base steps](#how-to-create). It is important to fill in the integration details as well as the `Merchant Accounts` which link currencies to specific accounts.

<a name="adyen"></a>
### Adyen
#### Process
1. We get credentials for test account (on [https://ca-test.adyen.com/ca/ca/login.shtml]).
2. Follow the setup below and setup this account on a hotel on test/demo.
3. Run a couple of transactions (create gateway payments, refund some, ...). Something aroung 5 transactions is enough
	- There are test credit cards which should be used, e.g. 4111 1111 1111 1111 with expiry date 06/2016 . List of all test credit cards is here: [https://www.adyen.com/home/support/knowledgebase/implementation-articles]
4. Contact Adyen and let them know that we have entered the transactions and they should check if it is fine.
5. Often much later, we get credentials for live environment
6. Follow the setup below and setup this account on production environment.
7. Try adding a credit card to confirm it works fine, then delete it

#### Requirements for web user
Without those permissions, our integration won't work (on test or live). See below how to find this user.

(Please make sure all of the below roles are set up - you will usually have to ask Adyen to enable these permissions, and make sure that all of them are set up, as they may not set up everything at the first time of asking. Without every single one of these roles being set up, the integration won't work properly (best idea is to copy and paste these below permissions):

- API Clientside Encryption Payments role
- General API Payments role
- iDeal Recurring
- Merchant PAL Webservice role
- Merchant Recurring role
- Zero Auth (if hotel wants to be able to charge credit cards which are not chargeable at the moment they are created, e.g. virtual)

Also, the account needs to have Client Side Encryption Key generated (see below)
![Adyen screen](Images/Adyen%20setup.png)
Make sure that the "API Clientside Encryption Payments role" is active otherwise you won't be able to integrate!

#### Setup in Adyen
- Log in to https://ca-live.adyen.com/ca/ca/login.shtml with the credentials provided by the hotel or Adyen.
- Select the account within Adyen, which you would like to set up in Mews.
- Select "Settings" and then select `users`. *Note that in order to access this area, the user who gave you the login, must have given you admin rights*.
- Once you are in the "users", select to see the `system` user in the dropdown selection box. Select on the user to open the details (ws@company.*)
- Copy / generate `Client Side Public Key` (check with adyen if it is enabled).
- Copy `username` for system user.
- Generate new password and copy it *and save the dialogue with the new password* (without this, it will still have the old password you don't know).
- Paste the provided details from Adyen user configuration into the Mews Adyen integration. *Note in Adyen, you may have to generate a new password, and also generate the `Client Encryption` Key*.
	- Copy `Client Side Encryption Key` in Adyen into `Public Key` in Mews
	- Copy `Username` in Adyen into `Username` in Mews
	- Copy `Password` in Adyen into `Password` in Mews
- Add new `Merchant Account`s for every account in Adyen.
	- Fill in the Settlement currency and account name (same as in Adyen - you will find it under "Accounts" as "Account Code")
	- After saving, it contains Notification Url which should be later copied to Adyen notification settings (see below)

- **Setup account**
	- Go to "Settings" > "Merchant Settings"
	- Set Capture Delay to Manual(Select merchant account, Settings -> Merchant Settings)

- **Notifications**
	- Select account -> Settings -> Server Communication -> Standard Notification
	- Set URL to: Notification URL that you found in Merchant Account settings in Mews (as previously mentioned)
	- Check "Active" box
	- Set Service Version = 1
	- Set Method to HTTP POST
	- Uncheck "Populate SOAP Action headers"
	- Set UserName = "adyenNotification" (on test/demo use: "adtenNotification")
	- Set Password = "h5BZsfg3mdNvSSFh" (on test/demo use: "password")
	- Click Test, should show list of messages with code 200
	- Save

 - **Send Test Transactions**
	- When you set up a "test" account, you will need to run several test transactions through the system. This is one of the key requirements for Adyen to allow a test account to go live. Do this with a number of different types of cards. See below some test cards that can be used.
	- VISA Card 5100 0811 1222 3332   Exp: 06/2016
	- MC Card 5100 2900 2900 2909   Exp: 06/2016
	- Card 5577 0000 5577 0004  Exp: 06/2016
	- Card 4988 4388 4388 4305  Exp: 06/2016
	- Card 4111 1111 1111 1111  Exp: 06/2016
	- Once you have completed the transactions, write to support@adyen.com to inform them and check it.
	- Once confirmed, the hotel needs to click on the "Go Live" button to go to the next step.

**NOTE**: often when you try the test transactions, the system will throw an error. This is because the Adyen employee who set up the user rights (as per above) did not do it correctly. If this is the case, go back to Adyen and ask them to check the user settings yet again. Then re-do the configuration, and it should work.

<a name="Braintree"></a>
### BrainTree

- To set up you need following informations `Merchant Id`, `Public Key`, `Private key`, `Client Key` and names of accounts and currencies they are held in.
- Either request the information from hotel or gain and admin access to Braintree.

- In the BrainTree:
	- Account - My User -> Api Keys to get `Merchant Id`, `Public Key`, `Private key` and `Client Key`.
	- Settings -> Processing -> Merchant Accounts (bottom) to get `Merchant Account ID`s and corresponding currencies.

<a name="foreign-police-integrations"></a>
## Foreign Police Integrations

- Theese integrations serves to automatically report the guests of the hotel to the proper Foreign Police department.
- The integration cooperates with a Customer Profiles report in Mews Commander.
- The report can't contain any red cell to have succesfully filled all informations needed for the integration, the more red on the report, the more informations needs to be filled in.
- The generated report file can be obtained by selecting `Export report file` button.
- The report file can be resend by selecting `Save report file` button.
- Based on integration type, the supported report types are `Daily` and/or `Monthly`.
- There is a backgroud job that runs every hour and at 9 hours of hotel's local time it sends report the following way:
   - [*Daily*] Generates notification for hotel managers to **chec**k report for guests that arrived **yesterday**.
   - [*Daily*] **Sends** report for guests that arrived **2 days ago** to police.
   - [*Monthly*] If it is second day in the month, sends report for **previous** month.

### Email addresses

- `Sender email` is email address that will appear as email sender.
- `Receiver email` is email address that will receive the generated report.
- `Manager email` is email address that will receive the notification email to check the report.

*Note:* `Receiver email` and `Manager email` fields can contain either one email address or multiple addresses separated by `;` or by `,`. In case of multiple addresses, email will be sent to all addresses.

<a name="czech-foreign-police-integration"></a>
### Czech

- Supports only `Daily` report.
- [Police Manual](http://e-uby.wz.cz/INFORMACE.htm)
- [Manual for hotels](https://github.com/MewsSystems/public/tree/master/ForeignPolice/Czech)
- Requires hotels to sign up with their local authorities for a digital signature (= certificate file) for an email address which will send the reports to the police (recommended: `Sender email`).
- The certificate file needs to be uploaded as an integration as well as hotel's IDUB codes.
- The Policie CR email is `ubytovani@pcr.cz` and **must** be in the `Receiver email` field **together** with the digitally signed hotel's email address.

<a name="swiss-foreign-police-integration"></a>
### Swiss

- [Manual for hotels](https://github.com/MewsSystems/public/tree/master/ForeignPolice/Swiss)
- No special set-up but the emails and codes are provided by the hotel.
- Supports both `Daily` and `Monthly` reports.
- `Monthly` report contains 2 different files
   - Report is similar to "Spent nights by guest's country".
   - Report that sums arrivals grouped by guest's country.

<a name="pricematch"></a>
## PriceMatch

You need PriceMatch hotel id (a number) and mapping between PriceMatch rooms and hotel rooms.
When PriceMatch people contact you about setting it up on our side they often say just hotel id and don't communicate the mapping. You have to check with them or check with hotel (hotel is beter since PriceMatch does not know about our room types).
PriceMatch integration has following parameters:

- Is Enabled - whether this integration works or is ignored
- Hotel Id - mandatory, id under which it sends data to PriceMatch
- Enable Export - whether integration should send data to PriceMatch
- Export Historic Data - when you setup a new hotel, this allows sending old data. Without this PriceMatch would get data only about reservation which happen after the integration is set up. This setting will disable itself once old data are sent. This field is also used to reset PriceMatch data. E.g. when hotel changes the mappings of rooms we need to resend all historic data so PriceMatch can recalculate recommendations.
- Import Recommendations - whether we want to get recommendations from PriceMatch. This option can be enabled later
- Import Competitior Prices - whether we want to get competitor prices from PriceMatch (those recommendations are shown instead of standard scraper recommendations)
- Mapping for Base Price - which hotel room is the base rate in hotel. This is used to correctly show base recommendation and competitor prices
- List of mappings between Mews Room Categories and PriceMatch room types. There has to be mapping for each of our room types otherwise we would send incorrect hotel occupation.

With this you:

1. In hotel integrations click New PriceMatch integration
2. Enter PriceMatch Hotel Id, click Enable Export, Export Historic Data. Don't enable Imports yet because it takes PriceMatch some time to set up and calculate and it would cause errors.
3. Save data
4. Add PriceMatch mappings for all our rooms.
5. Select Mapping for Base Price and save again
6. When PriceMatch confirms it, enable imports.

<a name="vingcard"></a>
## VingCard

VingCard integration lets you issue key cutting commands. In order to use this integration, it needs to be correctly set up in Commander. Make sure the VingCard integration is enabled and enter the following information:

- Source Address - Unless you have multiple VingCard server instances running on a single system, enter `01`
- User Type - In VingCard server software, this is called `Keycard Types`, e.g. `Single Room`. You can view the list of keycard types by launching the VingCard server app, entering the System Setup, click on the Keycard Types button, in the action box, select Change Existing Keycard Type - this enables the dropdown button beneath the box, where you can view existing types. The type needs to exactly match the name of the keycard type in VingCard, case sensitive.
- User Group - User group, e.g. `Regular Guest`. You can view the list of user groups by launching the VingCard server app, entering the System Setup, click on the User Groups button, in the action box, select Change Existing User Group - this enables the dropdown button beneath the box, where you can view existing groups. The type needs to exactly match the name of the user group in VingCard, case sensitive.
- Vision Server IP Address - IP address of the machine the server is installed on. Instructions for this are system-specific and differ on various Windows versions.
- Vision Server Port Number - Unless you've changed this, enter `3015`.
- Vision Server License Number - Enter the license number for your VingCard server installation.
- Devices - Enter all your devices here. To find out the destination address, open the VingCard server software, enter System Setup → System Parameters → PMS - TCP/IP → Address Mapping. This will display a window with a table of device-to-address mappings. In Commander, click on New Device, enter the name of the device (it doesn't have to match the name in VingCard this time) and for Destination Address, enter the value that is in the PMS Address column.
- Key Cutters (Rooms) - You need to define a mapping between rooms in Commander and the rooms in VingCard. Start by pressing the New Key Cutter Mapping button in Commander. For `Key System Room ID`, enter the room name that is displayed in VingCard and then select a corresponding room from the menu below.

<a name="point-of-sales-systems"></a>
### Point Of Sales Systems

- Create a "New Service" in Mews, one for each restaurant/outlet that you would like to connect. When creating this service, make sure that you enable the following options:
 - Has Expandable Bill Items (if you want to see each individual item as a line-item)
 - Have Overridable price
 - Is Externally Chargeable
 - Is Retrospectively Orderable
 - New Order is Processed
- Once you have created the service successfully, in the section "options" of that service, you will find the "access token". Provide this access token to the POS company, and ask them to set up the integration from their side.

Via the connection with the POS you have the following possibilities
- Charge guests who are checked-in, you should be able to search for guests by name or room number, and close the bill to their account.
- Charge guest profiles without a reservation, only if in their "internals" section of the profile you have selected the option "is externally chargeable".

It is currently not possible to cancel a bill from the POS in the PMS. If you have closed a bill by accident in the POS to the wrong customer, you will have to manually cancel it in the PMS

<a name="Translations"></a>
### Translations
We have translation files for Distributor/Navigator/Commander. You can download the latest file you would like to translate from this link: https://github.com/MewsSystems/mews/tree/develop/src/Mews.Server.Localization/Values

1. To download the file, rightclick on the "Raw" button, and save the file as .resjson (instead of the .txt)
2. Once you have downloaded the file, open the link: https://www.mews.li/Commander/Translate/Index
3. Upload the file in the tool, and select "Submit"
4. The tool will highlight the lines that stil require translation. Once you are finished with the translation, select the "download" button at the bottom of the file.
5. Send the translated file to jirka@mewssystems.com who will double check it, and upload it to Github.
