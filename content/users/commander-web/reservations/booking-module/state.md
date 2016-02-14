---
title: State
ordering: 1
---

In the State screen you are able to manage the status of the reservation. The system knows the following statuses:

- **Optional**: The booking is not yet confirmed but is blocking space on the timeline and availability. No revenue, however, is yet recorded in revenue reports. If options are cancelled, no cancellation fees will be incurred. All optional bookings have a release date assigned, and on the date of release, it will highlight the bookings in the reservation overview/report to decide whether to extend the option or release. Note that the system will not automatically release bookings.
- **Confirmed**: Bookings that are confirmed will display on the timeline and have revenue assigned. If cancelled they may be liable for cancellation fees, depending on the rate type selected.
- **Cancelled**: If a booking is cancelled, it will be removed from the timeline, and cancellation conditions will decide whether it should incur charges. It will open the availability (via sales efforts) for that one room to be booked.
- **Checked-out**: All bookings that have completed their stay will have the status "Checked-Out". Once a booking is checked-out, you can no longer check it back in.
- **Checked-in**: A booking that is currently in-house will be considered "Checked-In"

### Customer Balance

At the top of the State screen, you can see the customer balances of all customers assigned to the group and selected (by the tick box next to bookings). You can select "Payments" to add preauthorization or prepayments to the booking. Alternatively you can enter the "Billing" screen where you can take payments or settle bills. If the "billing" button is blue, that means that there is action required, as there are still open bills that require to be closed. So even if the balance is set to 0, and the button is blue, that means that the bill is not yet closed. If you are handling a group booking and have selected multiple bookings in the group, you will see the Customer Balance of all participants, allowing you to quickly see the balance of the whole group.

###Room Assignment

You will see all the bookings that are in the group and selected. Here you can quickly see the housekeeping status of the room currently assigned, and you can either assign another inspected room or inspect the room directly in the system (if you have the ok from your housekeeper). It only displays rooms in the same category, organized by room number, and it will not allow you to assign a room that has another "locked" reservation on it.
If the "Room Criteria" have been set up, you can instantly see the key features of the different rooms, next to the room number to help reception assign the correct room to the right customer.

Similar to the Customer Balance if you have a group booking and you select multiple bookings you can do the room assignment for multiple rooms at the same time.

###Confirm

If a booking is on OPTIONAL state, you can confirm bookings directly from this screen. It will change the status to "Confirmed" and post the revenue on the customer bill. Next to the confirmation box you are also able to send a confirmation to another person who is not assigned to the booking. Type the e-mail in the box and he/she will receive the confirmation e-mail with a summary of all the bookings that are selected.

###Check-in

Once you have assigned an inspected room, you can select the button “Check-In.” Note that the check-in button will only appear if you have selected a booking(s) that is on arrival today. It will check in all bookings that were selected, allowing you to check-in multiple bookings at the same time. If a booking is due to arrive today, there is also a "print" button next to it, allowing you to instantly print the registration card of the guest, if your country still requires physical signatures on the registration cards.

###Check-out

On the day of departure for the booking(s) selected, a new button will appear called "Check-Out.” The system will only allow you to check-out a guest for whom all open bills and unsettled items have been paid with a balance on zero. Should you wish to check-out a customer with an open balance (as he may pay it later), select the "Check-Out with Open Bill" and fill in the reason. This room will then be transferred to the Guest Ledger report in red, where the payment will need to be resolved as soon as possible.

### Cancellation

If you wish to cancel a booking, you are asked to provide a reason from a selection of reasons. It is important to select the correct reason, so that management can analyse the reasons and see if there is a key reason for cancellation, to try and prevent this. You can also describe it in the open-text-field. See below a list of the cancellation reasons with a short description if needed:

 - BookedElsewhere: if the guest has booked another hotel or destination
 - CancelledByAgent: if the agent calls and does not provide a further reason
 - ConfirmationMissed: if the customer has an optional booking, but did not confirm on the release date
 - ForceMajeure: if the guest had to cancel his stay due to a force majeure event, such as earthquakes, floods, etc.
 - GuestComplaint: if the guest complains, and wants to cancel their order
 - InputError: if the booking was input by error
 - InvalidPayment: if the payment details provided by the guest were not valid
 - NoShow: if the guest did not show up for his accommodation
 - Other: If none of these reasons describe the reason, then specify it further in the open-text-field
 - PriceTooHigh: if the guest cancels his stay due to the high price
 - ServiceNotAvailable: if you are for example fully booked and you have to cancel the booking, this is because the "service is not available"

Secondly, you need to decide whether you would like to charge cancellation fees or not. The system knows the cancellation conditions on each rate type, and it will charge them accordingly, for example:

--> Fully Flexible / BAR: If you set a rate with a cancellation condition to allow cancellations up to 24 hours prior to arrival (24 hours prior to the official check-in time set in the system) and you cancel a booking within the 24 hours, it will automatically post the cancellation charge (at 0% VAT) and remove the stay charges.

--> You should only close bills on the day of check-out, because if you close a bill before check-out and try to shorten the reservation or cancel it, the system will attempt to correct the charges on the closed bill (as they were posted at the wrong VAT level). This may result in new charges (cancellation charges) being posted on the bill.

--> If you try to cancel a bill "Without Fee” but have already closed the bill, then the system will post refunds automatically on the bill.
