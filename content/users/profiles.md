---
title: Profiles
ordering: 2
---

##Customer Profiles

The Mews Commander supports 3 types of customer profiles:

- Customer Profile
- Company Profile
- Travel Agent Profile

 <a name="Customer-Profile"></a>
###Customer Profile

The customer profile is the personal profile of a guest within Mews. The profile is split up in the following 9 sub-sections:

- **Dashboard**: An overview of future bookings linked to this guest. Clicking on any of the bookings will direct you automatically to the reservation screen where you can review and manage the details. Should the person be assigned as a companion to a booking, you will also see these bookings on his/her dashboard.
You will also see an overview of all closed bills linked to the customer profile, and all orders that were made by the customer.
- **Profile**: Personal contact, address and passport details of the customer. If you press the "Print" button on this screen, it will allow you to print a customer registration card for the customer with all his prefilled details completed. Additionally if you have multiple profiles of the same customer, you can select the other customer in the "Merge" search field. When you select “Merge,” it will show you both profiles. Select the profile with the most complete details, and it will merge the other profile into the one you selected. This ensures that you keep the system clean.
This tab also includes a great "merging" option, which allows you to merge 2 customer profiles into 1, if you have by accident created an duplicate. Type the name of the customer profile you are trying to merge, then click "merge" and it will show you both profiles, select the one you would like to keep, and it will merge the details of the other one into that profile.
- **Internals**: Should your guests have specific comments that users of the system need to be aware of, you can customize different categories such as “VIP”, “Returning Customer” or “Previous Complaint.” You can also leave specific comments, which are then automatically linked to all future bookings of this guest. If you set up different profile categories, this will highlight the different profiles by underlining the profile name with a coloured line, giving the receptionist a subtle hint that he/she needs to review the profile comments. Should you require more categories, please contact your Mews representative. Should you have your POS connected to the PMS, then the button "Always Externally Chargeable" will enable payments to this account, even if you do not have a checked-in booking.
**Blacklisted** if you would like to blacklist a customer, then you can select this tickbox on the guest profile. It will prevent him/her from making a new booking either directly through the Mews Distributor or directly in the Mews Commander.
**Guest Profile Notes**: if you update the Guest Profile notes, these will print on the different reports (Reservations Report, Reservations Overview, Guest In House) ensuring all team members of the hotel see the comments of the guest each time they arrive.
- **Payments**: From this screen you can select different payment types and manage prepayments and preauthorization. Mews does not store full credit card data. For data security reasons, we store only the last 4 digits of guest ‘s cards and the card type. You also get an overview of the preauthorization taken against which card. Using the last 4 digits will allow you to identify the correct card in order to match it to the guest’s card and use the preauthorization. This will ensure the protection of your customer’s sensitive data.
- **Billing**: This screen shows all unpaid items on the guest profile that require settlement. The receptionists can select items and move them into the customer, company or travel agent bill, depending on who is required to settle the account. From this screen you may also assign the charges to another customer.

 <a name="Integrated-Payment-Solutions"></a>
####Integrated Payment Solutions
In order to innovate the way payments are taken within the PMS, we have done integrations with Braintree and Adyen. These companies are allowing storage of guest cards directly in the Mews Commander, once a card is stored in the system, this allows direct charging from the PMS, without requiring external credit card machines.

  https://vimeo.com/135146064

**Storing a Credit Card**
- To store a new online chargeable credit card, visit the "Payments" screen on the guest profile.
- Select the "New Credit Card" screen. The screen will open and have 2 main sections, the left is the section for online cards (Braintree & Adyen) and the right hand side is for cards that are being charged via an external terminal.
- Once you have stored a credit card, you will see a "Payment Gateway ID" which higlights that he card has been verified by the bank, and has now become chargeable through the system

**Taking a Preauthorization**
- To take a preauthorization, select the button, and a new screen will open asking how much money to preauthorize.
- Once you have taken the preauthorization, you will be taken back to the "Payments" screen on the guest profile. Next to the transaction you can either
 - Charge Preauthorization: if you would like to charge the preauthorization fully or partially (and release the remainder to the guest account automatically) you can select this option.
 - Delete: if you would like to release the preauthorization, select "delete" and we will communicate to the bank to release the transaction. Note that it may take up to 2 business days for Adyen to release the transaction.

**Taking a New Credit Card Deposit**
- If you would like to take a credit card payment, select the button "New Credit Card Deposit" and you can instantly fill in the amount and charge the card. The payment will be directly posted on the open guest bill.

https://vimeo.com/132029560

 <a name="E-mail-Addresses"></a>
####E-mail addresses

Key to guest profiles is the Guest E-mail address. This is the unique identifier for a customer, and it is used to identify duplicate profiles. Should a new booking be made with the same e-mail address through any channel, it will automatically merge bookings under 1 profile, to ensure you capture all customer history and future bookings in a central location.

You can also send a confirmation e-mail to a person who might not be the owner of the booking (for example a secretary or family member). When you are creating a new booking, there is a field that asks for a customer confirmation e-mail address. When you complete this, it will send a one-time confirmation to the contact person.

For the system to work in the most optimal way, its important to always try to obtain e-mail addresses of customers, so that we can invite them into the online check-in, and in the future also for the online check-out. If we do not have the guest e-mail, we are unfortunately not able to offer them these great services.

 <a name="Company-Profile"></a>
###Company Profile

In order to book company rates, track company bookings and statistics, and allow for company invoicing, you need to create and attach a company profile to bookings.

To create a new company profile, in the top menu, select the Profile icon and then select “Companies.” This will take you to a list of existing companies. It will also allow you to select “New Company,” which will create a new profile requiring completion of details.

Should a company have multiple branches, you will need to create the head-office as a new company. In the profiles of the branch offices, you can easily assign the head-office as “Mother Company,” which tracks the full statistics of the company under 1 main profile.

 <a name="Travel-Agent-Profile"></a>
###Travel Agent Profile

In order to book travel agent rates, track travel agent bookings and statistics, and allow for travel agent invoicing, you need to create and attach a travel agent profile to bookings.

To create the new travel agent profile, select the Profile icon and then select “Travel Agency Contracts.” This will take you to a list of travel agents who have been set up for your hotel. You can select any travel agent and update any additional details you may have such as IATA, contact person, address or notes with regards to the agency.

You can also create a new travel agent contract by selecting the button. Once this field opens, you will be asked to update the different details. One important field is the bill assignment field. If you manage this field correctly, when new bookings are made it will automatically assign the booking at the correct rate to the correct bill.

Note that most OTA (Online Travel Agents) already have profiles in Mews, and if you work with a Channel Manager, you need to select the profile from the listed TA profiles, rather than creating a new profile. The benefit of this is that the TA Profile is already mapped against all of the connected OTA's.

- **Customer Always**: When a new booking is created for this travel agent, it will leave the stay charge in the customer field, as the guest will be responsible for paying his bill himself.
- **Customer Always without Commission**: This option will discount the rate by the commission but still place the charge on the bill of the customer, who is due to pay for this charge.
- **Travel Agency Always**: This option will move the stay charge to the Travel Agent bill, so that the travel agent, rather than the customer, will have to pay for the rate.
- **Travel Agency Always without Commission**: This option will move the charge to the travel agent’s bill and will subtract the commission.
- **Travel Agency Only if Prepaid**: This option will move the bill to the travel agent only if it was pre-paid. If it was a BAR rate or another non-prepaid rate, it will leave the charge on the guest bill to be paid upon departure.
