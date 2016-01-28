---
title: Reports
ordering: 4
---

##Key Reports

Almost every report in Mews have date selection and/or time selection.
Dates only: when there is a date selection only and you select the end date (for example 30th April) this will include the full end date as selected
Dates & Times: when there is both a date and a time selection on the report,be careful as often users forget to include the last day. For example if you try to run a report for April, you need to select
 - Start date: 01 April at 00:00:00
 - End date: 1 May at 00:00:00 (not the 30th April 00:00:00 as this will not include the last day)

<a name="Reservation-Report"></a>
###Reservation Report

The reservation report provides all needed information about all the bookings at the hotel. The report has a large number of filters that allows for personalization of the report. As always the report can be exported into excel, offering more columns with more detailed information.

Below is an explanation of a few of the key filters and their purposes.

- **Include Tax**: the report standarly runs with Net Rates, but if you would like to include tax into the rates simply tick this box and run the report.
- **Load Balances**: Should you require the overview of all guests in-house and their outstanding balances, selecting this box prior to loading will load the total bill balance of all of the guests. Note that as it will need to check all guest bills, this will slow down the running of the report somewhat.
- **Mode**: You can filter the report by "detailed" reservations. It will show each individual reservation, and you can review the individual details of these bookings. Alternatively you can select only the "Totals," and the report will only give the totals of the selection made. It will not display the individual bookings in this section.
- **Group By**:
 - Business Segment: it will run the report by the business segmentation that is set up at the hotel level.
 - Confirmation State: if you would be interested to see whether booking in the report are Optional or Confirmed.
 - Creation Date: this will show the results of the report organized by the creation date of the bookings.
 - Credit Card: to quickly show whether guest profiles have a Adyen/Braintree card attached or not, this helps identify reservations where the credit card failed, so that your reservations department can follow up on alternative payment methods.
 - Customer Category: if you would like to sort the report by Customer Category. The customer category can be set up in the Customer Profile in the "Internals" section. Should you need to add or amend the customer categories, contact your Mews representative.
 - Customer Nationality: if you want to analyse the origin of your customers.
 - Mother Company: when you set up your partner companies, you can assign also "mother companies", which represent the "head office" this helps you to quickly pull out statistics for multiple companies in 1 line.
 - Group: to pull out all the different groups that have bookings in a selected period.
 - Travel Agency: It will break the report down by all different travel agents that have booked the hotel in the selected period.
 - Partner Company: If you have assigned companies to bookings, it will break down the report by the partner companies.
 - Rate: If you would like to analyse the performance of specific rate types, you can select this filter.
 - Voucher: If you have the Mews Distributor, you can filter the report by the different voucher codes used by customers to analyse the performance of these codes.
 - Room Type: To analyse the performance of specific room types, you can see exactly how many bookings are made for each individual room type.
 - Origin: To generate a specific overview of the source of business (from booking engine, channel, and manual).
- **Filter**: You can filter the report by the following filters.
 - Created: By the creation date of the booking.
 - Arrival: By the arrival date of the booking.
 - Departure: By the departure date of the booking.
 - In House: To review all bookings in house during a specific period. Note that the "in house" overview includes 2 tables, the top-most table shows all bookings that are precisely in the interval. The second table shows all bookings that touch the interval, so if some of those bookings arrived prior to the selected or departed after, they are also included.
 - Optional: To review all optional bookings.
 - Cancelled: To review all cancelled bookings by the **stay date**
 - Cancelled on: To review all cancelled bookings by the date **on which they were cancelled**
 - Confirmed on: to review when bookings were changed from Optional to Confirmed. This filter also includes all bookings that were booked as Confirmed.

Below is a description of a few of the Columns and their definitions.

- **Number**: This is the reservation number generated by the system and assigned to the booking. All guest confirmations are sent with this number, which can be searched directly in the search box.
- **Reservation Status**: This is displayed in an icon, in order to save space on the screen. The system has the following statuses:
 - Confirmed: The booking is a confirmed booking with a future arrival date.
 - Checked-in: The booking is currently in the hotel.
 - Checked-out: The booking is checked-out, and the customer is no longer in the hotel.
 - Holding: The reservation is not yet confirmed and still on optional status. When you hover over the question mark icon the release date will be displayed. Note that the system does not automatically release options. Instead, it highlights the bookings in the reservation overview/report once they have met or have passed the deadline.
- **Rate** and **Total Cost**: Note that the rate and total cost in this report are showing the rate inclusive of VAT and the products included in the rate (breakfast, city tax, halfboard, etc.).

Note that if you export the report into excel, the following additional columns are added to the report:
- Customer E-mail address
- Balance (of their bill)
- Creation date and the exact time
- Release date: if you have booked an optional booking
- Requested Room Type and Room Category: this allows you to compare whether the room type that was booked, also corresponds with the room type that was finally used to accommodate the guest.
- Reservations and Customer Notes

<a name="Reservation-Overview-Report"></a>
###Reservation Overview Report

The Reservation Overview Report is a quick snapshot of all bookings on Arrival, Departure, In House and Optional Bookings. It always shows the most up-to-date status of the remaining arrivals and departures to ensure that the front office at any time is able to check which guests are still requiring action.

If you select 1 day only, it will give a detailed overview of all the individual bookings. If you select multiple dates, you will get a chart view, highlighting all arrivals/departures/stayovers, which will help you plan shifts in housekeeping and front office.

At the top of the report you will see a link to print the registration cards that are arriving on this specific date. If you print registration cards from this report, we will prefill besides the customer details, also the arrival, departure, room number and travel agent.
Note: if there is no companion assigned to a booking, the registration card will print empty. So always ensure you have a guest assigned to the booking.

All bookings show:
- Button to take you directly to the “Manage Booking” screen
- Link to the booking on the timeline
- Link to the Customer Profile
- Link to the Housekeeping screen where you can change the cleaning status of this specific room
- Quick Link to print registration card of this booking
- Reservation and Customer Notes on the booking
- All companions on the booking

<a name="Customer-Statistics-Report"></a>
###Customer Statistics Report

The customer statistic report displays the countries where the hotel guests originate from and the amount of nights they have spent at the hotel. This information is important for the statistic offices, but may also be of interest in setting sales strategies for the hotel.

<a name="Guest-In-House-Report"></a>
###Guest In House Report

The Guest In House Report displays all guests in house at the time of running the report. The report is ordered by room numbers, starting at the lowest number and going upwards. For each room the report displays all the registered guests in the room and the products that are included (such as breakfast, halfboard, etc.). You can print the report with just this basic information, which can be used in the breakfast room to check the guest names against the room numbers.

**Credit Check** In addition to the above-mentioned items, it also shows the level of preauthorization taken by the reception on this account and a credit column. The credit column takes the preauthorization and subtracts all the unsettled bill items. If there is a negative balance, the number gets highlighted in red, as it requires action by reception in order to gain more credit on the account.

To contact the guests (with regards to the credit) you will find an additional column with the e-mail addresses of the customers.

<a name="Foreign-Police-Report"></a>
###Foreign Police Report

In some countries, it is still important to report all guest information to the foreign police daily. In order to collect this information, it is important to complete the Foreign Police Report daily with all the arrival guests. The report shows the percentage of completion on the dashboard and at the top of the report.

The report requires the following fields to be completed in order to achieve 100% completion:
- Customer
- Room
- Arrival
- Departure
- Customer Type
- Nationality
- Birth date
- Age
- Address
- Passport/ID number

If the Foreign Police allow it in the local country, Mews Systems is able to send the report extract automatically. The system will first send the report completion percentage to a manager 1 day after the arrival of guests, so that the hotel will have another 24 hours to finish mistakes and ensure 100% completion. After 24 hours the system sends the report automatically to the police.

<a name="Guest-Ledger-Report"></a>
###Guest Ledger Report

The Guest Ledger Report is an overview of all guest profiles with unpaid/unsettled balances on their accounts. A number of these guests still have future bookings, and thus are not seen as problematic. However if the account does not have any future bookings, but an outstanding unsettled amount, the account will be highlighted in red at the top of the report, showing the need for action.

**Date & Time Selection**: the selection of date/time, allows you to go back in time, and see the actual situation of the open balances at that time. This is important for accounting departments who run an end-of-month closure, and need to balance their books based on the opening balance and closeing balance of the Guest Ledger.

####4 Modes of the Guest Ledger

1. Customers: The overview is split up by all customers who have open balances on their accounts.
2. Accounting Categories: The overview is split according to the set accounting categories at the hotels to get a better understanding of the mix of revenue that is due.
3. Services: The overview is split according to the set services at the hotels to get a better understanding of the mix of revenue that is due.
4. Consumption Date: This filter breaks the report down from the oldest charge until the newest charge to get a better understanding of the expiration of bills and outstanding items.

####The Columns of the Guest Ledger

- **Consumed but not Billed - Revenue**: This column reflects the revenue items that have been consumed by customers, but are still on open bills of guests. These guests are not necessarily in-house, they could already have departed from the hotel (for example minibar items that are charged late to guest accounts).
- **Consumed but not Billed - Payments**: All payments that are posted in the system have an instant consumptions date/time. All items in this column are (similar to the revenue) on open bills of guests and require settlement.
- **Billed but not Consumed - Revenue**: This column reflects items that have not yet been consumed (such as a non-refundable accommodation night for a guest who is due to stay next month), but the hotel has already closed the bill prior to arrival. We recommend against closing bills prior to the departure date, as you are no longer able to change details of the booking once the bill is closed.
- **Billed but not Consumed - Payments**: This column should usually show 0, as all payments posted in the system have instant consumption, so this column should always remain 0.
- **Deposit Ledger**: giving an overview of all pre-payments, against which no consumed revenue has been posted yet, and thus is considered a "deposit".
- **Guest Ledger**: an overview of all Consumed Revenue for which payment has yet to be received.
- **General Ledger**: a final tally of both the Deposit and the Guest Ledgers, showing a total amount of revenue that is not covered by deposits in the system.

<a name="Financial-Transaction-Report"></a>
###Financial Transactions Report

The Financial Transactions Report gives an overview of all the payments and rebates made in the selected time period. The report is split in the following sections:

**Payments**

- Cash Payments: An overview of all cash payments taken in the selected time period. Note that not all payments are necessarily on closed bills, as some payments may be taken as deposits prior to the closure of the bill.
- Credit Card Payments Terminal: You can quickly identify all payments taken by the type of credit card and its receipt identifier. There is a filter at the top where you can select whether you would like to filter by credit card type. When it states "Terminal" this refers to external credit card terminals which are used for posting payments, once such a manual transaction is taken, the employee will need to manually post this transaction in the system as a "Terminal Payment".
- Credit Card Payments Gateway: if you have integrated a payment solution such as Adyen or Braintree, this section shows all transactions of payments that were taken directly through the system. Next to each transaction you can see the unique identifier provided by the payment integration and also whether the transaction has been "settled" (the bank has processed the payment) or unsettled (the bank is still processing the payment).
- External Payments: An overview of all external payments made. This could include bank transfers, exchange rate differences or invoice payments.
- New Complimentary Payment: This is the complimentary hotel account which shows where transactions may be closed that were offered to clients on complimentary basis.
- Exchange Rate Difference: The overview of payments in which there was an exchange rate difference between the time an item was posted and paid.

**Rebates**
As part of the report, you see a column, which is highlighting the "rebates", which is important to track for accounting, who needs to approve all rebates given. There is a great filter at the top of the report, where you can quickly filter out the rebates only.

Note: It is recommended that each person posting payments, prints the report at the end of his shift by filtering his/her name. They need to ensure they have the proper backup, receipts and bill copies for each single payment taken. These should be crosschecked and countersigned by another team member. Once complete, we recommend these be handed over to the accounting department.

<a name="Accounting-Report"></a>
###Accounting Report

The Accounting Report provides a full overview of all the revenues posted, divided by revenue group, in order to analyse the income. See below a short breakdown of all the possible filtering options:

**Modes**
- Grouped: see all revenues grouped
- Detailed: see each individual revenue item as an individual item

**Type**
- Billed: This filter will show all the billed revenue that has been processed in the selected time period. So if a bill was closed in that period, it will be included.
- Consumed: This filter will show all the consumed revenue that has been processed in the selected time period. So if an item was consumed in that period, it will be included. These could be items that are still on open bills.

**Group By**
- Accounting Category: if your accountant has set up Accounting Categories, this filter will group the different services/products within their selected accounting categories.
- Bill: if you want to see a breakdown by customer/bill
- Service: this will breakdown the report by the services that have been posted, with the individual products as sub parts of each service.
- VAT Rate: if you would like to see the report filtered by the different VAT rates.

Most accounting systems are able to import the Accounting Report Excel Extract into their system, to help track and record revenue and open invoices. When you select "Export to Excel" accountants can easily see all the revenue according to the filters selected, make necessary corrections, and then import it directly into the accounting program used.

<a name="Bills-and-Invoices-Report"></a>
###Bills & Invoices Report

The Bills and Invoices Report is a chronological overview of all bills ordered by bill numbers (lowest to highest). This will help find a bill after departure, should you need to reprint or review it. If you have a bill number, at the top of the screen there is a search box, which helps identify bills quicker. Alternatively you can select a specific period during which the bill was closed to narrow down the search.

The top of the report shows the "Invoices".
When a bill is closed to "invoice" the issuer is able to set a payment date, so that you can track whether an invoice was settled or not. When it is overdue, it will get an orange-tag highlighting that payment is late.
If you would like to see the balances of all bills/invoices, select the "load values" at the top of the report, and it will add a column with all balances. You could then filter it down further, if you would like to see the unpaid balances of 1 specific travel agent or company.

<a name="Manager-Report"></a>
###Manager Report

The Manager Report is the master summary used by management to analyse the performance of the day before, month-to-date and year-to-date performances of the hotel.

The report opens up with all revenues excluding taxes. If you wish to include the taxes, tick the box "Include Tax," and run the report again.

First, it will provide an overview of the available number of rooms/beds, out of order rooms and the occupancy.
Note that if a room is placed out of order, it will deduct this from the available number of rooms in order to calculate the occupancy percentage correctly.

Secondly, it breaks down the room revenue (exclusive of products such as breakfast, halfboard, etc.). This data will be used to calculate the following sub-data:
- Room Revenue Per Available Room (REVPAR) = The total room revenue divided by the total number of available rooms (total rooms minus OOO rooms).
- Room Revenue Per Available Bed (REVPAB) = The total room revenue divided by the total number of available beds (total beds minus OOO beds).
- Average Daily Rate = The total room revenue divided by the total number of occupied rooms.
- Room Revenue Per Person = The total room revenue divided by the total number of guests staying overnight.

Below the room revenue, you will also see a breakdown of the Cancellations, Refunds, other package items and all other services/accounting categories split per service with the revenue generated in that category.

Below the Total Revenues, you will also see all the Occupancy and Room Revenue numbers split per room type.

Note: if you have set up Accounting Categories, it will pull the report according to the accounting categories. If you do not have these set up, it will run according to the Services set up at the hotel.

<a name="Posting-Journal"></a>
###Posting Journal

The posting journal is an overview of all products that are posted in a selected time period. This is a great way for the accountant to check item-by-item is the postings are done correctly. Its also a great report to review all "rebates" done by employees in the hotel and the reasons that were provided.

<a name="Action-Log"></a>
###Action Log

The Action Log is an overview of all major events/actions/changes made to bookings and profiles in the system.

1. Worker: If you are investigating a specific person and his actions in the system, you can select the user in the selection field, and it will identify all system-events in the requested time period.
2. Event Type: In the Action Type you can narrow down the search to "Reservation Changes", "Service Orders" or "Price Adjustments.”
3. Reservation Change Type: If you selected "Reservation Changes" in the previous field, you can narrow down here the specific reservation changes you would like to review in more detail.

<a name="Spent-Nights-Report"></a>
###Spent Nights Report

The Spent Nights Report is an overview of how many guests stayed at the hotel on a specific date. This may be important for statistical purposes. You will be able to filter the report also by different sub-reports, depending on your country. For example, if you are in Prague, you can filter by "Prague City Tax", and the report will only show "leisure guests" in the required age group so that the hotel can use this to settle the monthly city tax.

<a name="Activity-Report"></a>
###Activity Report

The activity report is a great tool to analyse the operations of the hotel. Its a graphical display, by day-of-week and by the hours in those days, to help analyse where you have operational busy hotspots. We track check-in/out, housekeeping and booking creation.

When you select a specific activity, you also get an overview by employee of who are the most active
s in your team.

<a name="Occupancy-Report"></a>
###Occupancy Report

The Occupancy Report is a schematic overview of all room types, the number of rooms in each category and the business-on-the-books for each room-type per day. The overview offers insights into Occupancy, Average Daily Rate and Rooms Booked.

The report opens up with net rates (exclusive of VAT and exclusive of products such as breakfast). To include the VAT, tick the box at the top and run the report again. The report standardly opens a month period starting from today with end date 1 month later. You can run the report for any length of time. Note that the “Total” column will add up the business for the entire period, not per month.

When you export the report into Excel, it breaks down the results by room type, and all numbers are split in separate columns allowing easy manipulation and review of the numbers.

Through the usage of colour, you are quickly able to spot busy dates, which have a darker colour or overbookings, which are highlighted in red.

Below the occupancy charge, you will also see a chart that highlights the total available rooms per category per date.

<a name="Availability-Report"></a>
###Availability Report

The Availability Report is a schematic overview of all room types, the number of rooms in each category, and the rooms booked on each date by room type. Similar to the occupancy report it uses colors (dark=busys & light=quiet) to higlight when you have a lot of room booked.

When you have the Mews Distributor or the Channel Manager connected, these take the availability directly from this report. So if you would like to set overbooking or block rooms from sales, this is the best location to do so. To change the number of rooms for sale on 1 specific date/room type, click on the number, and it will give you the option to block or overbook. You also have the option to amend a larger period in 1 change.

Below the room availability, you also see the BAR rate that is sold for that room type on that day. From the filters at the top of the report you can select which Rate you would ike to see. To set up the default rate (the rate with which the report always opens first), ensure that in the rate settings of each individual rate, there is an "ordering" the rate with the lowest order number will display first in the report.

If you work at a hostel, at the top of the report, you have a quick switch to quickly view "beds" or "rooms".

<a name="Batch-Check-out"></a>
###Batch Check-out
If you operate a hotel with hundreds of rooms/beds, with a lot of group business, or if you work at a hostel. This report is very helpful in quickly identifying all people who are on departure today.

When you open the report, it shows 1 charts
1. All guests will 0 balance on their bills - you can instantly select "Check-out" and it will check out all guests at the same time, in 1 go.
2. Guests with balances: you will need to take payment for the outstanding amounts, before you are allowed to check these guests out.

<a name="Rate-Inclusion-Report"></a>
###Rate Inclusion Overview Report

The Rate Inclusion Overview is a chronological overview of the different package products that are included in the rate. This could be breakfast, halfboard, city tax, extra beds, etc. The report always shows the total number of customers in-house on a specific day and how many products were sold in each category.

For example, if the column "Breakfast" shows: 61/75, this means that 61 guests out of the total of 75 guests on that day have breakfast included in their rate.

This report can be used by the kitchen/restaurant to plan ahead for the amount of breakfast/lunches/dinners that are pre-booked. Alternatively housekeeping can use it to track the amount of extra beds that are booked.