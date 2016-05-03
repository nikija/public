---
title: Rates
ordering: 2
---

## Setting the Best Available Rate

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

### Rate Restrictions

You have the possibility to set rate restrictions, which will affect the availability of the rate. You can set restrictions that require minimum length of stay, set close out dates or set minimum days it should be booked in advance.

- New Length Restriction: If you wish to set a minimum or maximum length of a booking, here you can select the amount of days for which you would like to apply this. For example, if you set a minimum length of stay as 3 nights, it will only offer this rate to people who select 3 nights or longer. It is important that you select "Only For Current Rate," otherwise it will apply this rule to all rates.
- New Earliness Restriction: You can create rates that are only available up to X nights before arrival. So, for example, you can set this as 21 days, and in that case, the rate will only be bookable 21 days and more in advance. It is important that you select "Only For Current Rate" otherwise it will apply this rule to all rates.
- New Date Restriction: If you would like to create a specific period of time when you would not like the rate to be bookable or when you would like to create a specific period of time when you would only like to offer this special rate.

## Setting Dependent Rates (Floating Rates)

Once you have set up your "Best Available Rate" in the system, you can create rates that float off this BAR rate at discounted percentages. One such example is a “Non-Refundable Rate,” which, for example, you can set at a 10% discount from the BAR rate. The system will automatically calculate the discount for all room types, saving a lot of work for revenue and reservations managers.

Some examples of rates that can float:
- Non-Refundable Rate
- Advance Purchase Rates: For example, if you wish to give a discount for guests who book 21 days in advance. You must ensure that you set a "New Earliness Restriction" (see above).
- Long Stay Rates: For example, if a customer books 7 days or longer, they would receive a 15% discount. You must ensure that you set a "Length Restriction" (see above).

### Build a dependable Non-Refundable Rate

1. In the **Stay** screen, select the "New Rate" button to start creating a new rate.
2. **Base Rate**: Select the rate from which you would like to float a discounted rate. Be very careful with this field. Once you have created a rate floating off another rate, you cannot change it (and you would have to delete it completely and rebuild it if you did need to change it). It is recommended to float the rate off the BAR rate.
3. **Voucher Rate**: If you would like to offer this rate only to specific travel agents or companies or with a special booking code (for the booking engine), you need to select this box. However if you would like the rate to be publicly available, then do not tick the box.
4. **Name**: Name this field correctly with its full name, as this is the rate that is visible to the customer directly in the Mews Distributor.
5. **Short Name**: Create a short name for all rates, as this will display better in report columns.
6. **Payment Conditions**: Here there are 2 options, and it is of the upmost importance that you select the correct one. “On Site” will lock the exchange rate only on the day of arrival, as the payment is expected during the guest’s stay. “In Advance” will lock the exchange rate on the day of booking, as this is a pre-paid rate, which will be charged on the day of booking.
7. Create the rate, and in the next screen, you need to "Enable" it by ticking the box and setting the discount in either a percentage or absolute amount (in the set currency).
8. **Options**: See the full explanation of the different options in the BAR explanation.

### Setting Independent Rates (Travel Agent / Corporate Rates)

You can set up rates that are not floating off the BAR (or any other rate). These need to be set manually. Typical examples of this are Wholesale Rates or Contracted Corporate Rates.

1. In the **Stay** screen, select the "New Rate" button to start creating a new rate
2. **Base Rate**: Do not select any base rate, as this will allow you to manage the rates manually.
3. **Voucher Rate**: If you are creating a rate that is only applicable for certain companies or travel agencies, then select this button.
4. **Payment Type**: Here there are 2 options, and it is of the upmost importance that you select the correct one. “On Site” will lock the exchange rate only on the day of arrival, as the payment is expected during the guest’s stay. “In Advance” will lock the exchange rate on the day of booking, as this is a pre-paid rate, which will be charged on the day of booking.
5. Once you create the rate, in the next screen you need to "Enable" it by ticking the box and setting the discount in either a percentage or absolute amount (in the set currency).
6. **Options**: See the full explanation of the different options in the BAR explanation.
7. **Pricing**: Once you have enabled the rate, select the pricing tab. Here you can complete the pricing for the entire contracted period of this travel agent or company.

Once you have created the voucher rate, you will need to connect the rate to the specific company/travel agent for whom the rate should be made available. Do this in the "New Booking" screen once the company is selected.

1. Return to the **Stay** overview in the settings where you can see all the rates.
2. Select the button "**New Voucher**"
3. **Name the Voucher/Code**: It is recommended that you give the voucher a name that is logical, so that in the reservation report, you can quickly identify the rate.
4. **Company/Travel Agent**: Select the company or travel agent to whom you would like to attach the rate.
5. **Assigned Rates**: You will see a list of all voucher rates, and you will need to select the rates which you would like to make bookable for that specific company/agent.
6. Once you have created the connection between the rate and company or travel agent, press OK, and the connection will be functional. You can now create a new booking, and when you select the dates and the respective company/travel agent name, the system will offer the specific rates.
7. If you have the **Mews Distributor** (Booking Engine), you are also able to create vouchers, which can be provided to a customer booking directly on your hotel website. Select "New Voucher,” and complete the code you wish to use and the period during which the voucher should be bookable. Once saved, you are able to provide this code to your clients for direct bookings.
