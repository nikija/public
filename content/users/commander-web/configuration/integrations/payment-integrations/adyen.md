---
title: Adyen
---

## Process

1. We get credentials for test account (on [https://ca-test.adyen.com/ca/ca/login.shtml]).
2. Follow the setup below and setup this account on a hotel on test/demo.
3. Run a couple of transactions (create gateway payments, refund some, ...). Something aroung 5 transactions is enough
	- There are test credit cards which should be used, e.g. 4111 1111 1111 1111 with expiry date 06/2016 . List of all test credit cards is here: [https://www.adyen.com/home/support/knowledgebase/implementation-articles]
4. Contact Adyen and let them know that we have entered the transactions and they should check if it is fine.
5. Often much later, we get credentials for live environment
6. Follow the setup below and setup this account on production environment.
7. Try adding a credit card to confirm it works fine, then delete it

## Requirements for web user

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

## Setup in Adyen

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

### Setup account
	- Go to "Settings" > "Merchant Settings"
	- Set Capture Delay to Manual(Select merchant account, Settings -> Merchant Settings)

### Notifications
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

### Send Test Transactions

	- When you set up a "test" account, you will need to run several test transactions through the system. This is one of the key requirements for Adyen to allow a test account to go live. Do this with a number of different types of cards. See below some test cards that can be used.
	- VISA Card 5100 0811 1222 3332   Exp: 06/2016
	- MC Card 5100 2900 2900 2909   Exp: 06/2016
	- Card 5577 0000 5577 0004  Exp: 06/2016
	- Card 4988 4388 4388 4305  Exp: 06/2016
	- Card 4111 1111 1111 1111  Exp: 06/2016
	- Once you have completed the transactions, write to support@adyen.com to inform them and check it.
	- Once confirmed, the hotel needs to click on the "Go Live" button to go to the next step.

**NOTE**: often when you try the test transactions, the system will throw an error. This is because the Adyen employee who set up the user rights (as per above) did not do it correctly. If this is the case, go back to Adyen and ask them to check the user settings yet again. Then re-do the configuration, and it should work.
