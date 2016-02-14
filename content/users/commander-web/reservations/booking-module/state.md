---
title: State
ordering: 1
---
## General Features

### Customer Balance

At the top of the State screen, you can see the customer balances of all customers assigned to the group and selected (by the tick box next to bookings). You can select "Payments" to add preauthorization or prepayments to the booking. Alternatively you can enter the "Billing" screen where you can take payments or settle bills. If the "billing" button is blue, that means that there is action required, as there are still open bills that require to be closed. So even if the balance is set to 0, and the button is blue, that means that the bill is not yet closed. If you are handling a group booking and have selected multiple bookings in the group, you will see the Customer Balance of all participants, allowing you to quickly see the balance of the whole group.

### Room Assignment

You will see all the bookings that are in the group and selected. Here you can quickly see the housekeeping status of the room currently assigned, and you can either assign another inspected room or inspect the room directly in the system (if you have the ok from your housekeeper). It only displays rooms in the same category, organized by room number, and it will not allow you to assign a room that has another "locked" reservation on it.
If the "Room Criteria" have been set up, you can instantly see the key features of the different rooms, next to the room number to help reception assign the correct room to the right customer.

Similar to the Customer Balance if you have a group booking and you select multiple bookings you can do the room assignment for multiple rooms at the same time.

### Reservation Statuses

In the State screen you are able to manage the status of the reservation. The system knows the following statuses:

- **Optional**: The booking is not yet confirmed but is blocking space on the timeline and availability. No revenue, however, is yet recorded in revenue reports. If options are cancelled, no cancellation fees will be incurred. All optional bookings have a release date assigned, and on the date of release, it will highlight the bookings in the reservation overview/report to decide whether to extend the option or release. Note that the system will not automatically release bookings.
- **Confirmed**: Bookings that are confirmed will display on the timeline and have revenue assigned. If cancelled they may be liable for cancellation fees, depending on the rate type selected.
- **Cancelled**: If a booking is cancelled, it will be removed from the timeline, and cancellation conditions will decide whether it should incur charges. It will open the availability (via sales efforts) for that one room to be booked.
- **Checked-out**: All bookings that have completed their stay will have the status "Checked-Out". Once a booking is checked-out, you can no longer check it back in.
- **Checked-in**: A booking that is currently in-house will be considered "Checked-In"

#### Confirm

If a booking is on OPTIONAL state, you can confirm bookings directly from this screen. It will change the status to "Confirmed" and post the revenue on the customer bill. Next to the confirmation box you are also able to send a confirmation to another person who is not assigned to the booking. Type the e-mail in the box and he/she will receive the confirmation e-mail with a summary of all the bookings that are selected.

#### Check-in

Once you have assigned an inspected room, you can select the button “Check-In.” Note that the check-in button will only appear if you have selected a booking(s) that is on arrival today. It will check in all bookings that were selected, allowing you to check-in multiple bookings at the same time. If a booking is due to arrive today, there is also a "print" button next to it, allowing you to instantly print the registration card of the guest, if your country still requires physical signatures on the registration cards.

#### Check-out

On the day of departure for the booking(s) selected, a new button will appear called "Check-Out.” The system will only allow you to check-out a guest for whom all open bills and unsettled items have been paid with a balance on zero. Should you wish to check-out a customer with an open balance (as he may pay it later), select the "Check-Out with Open Bill" and fill in the reason. This room will then be transferred to the Guest Ledger report in red, where the payment will need to be resolved as soon as possible.

#### Cancellation

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

## How to Check-in a Booking

To check-in, the first step is identifying the room to be checked in. There are a few methods to quickly find a booking:

- The quickest is to type the guest name/e-mail/confirmation in the search box at the top menu. Once you select the customer, you will be redirected to the Customer Dashboard where you get an overview of all future bookings of this client.
- You can select a booking directly on the timeline. The booking details will appear from the right. Please select “Manage” to open the “Manage Booking’ screen.
- From the reservation overview or reservation report, you can find a booking based on a different filter. The bookings are selectable, and once you open the booking, press “Manage Booking.”

Once you have identified the booking, select the “Check In” button on the booking screen. This button only appears on the day of arrival. It will open the "Booking Management" screen in the tab "State" where you can perform the following steps.

1. Verify all booking details with the customer, which includes the arrival and departure date, room-type, rate and number of people. Also inform the guest whether the booking was prepaid or not. Once verified, check with the guest how he/she would like to guarantee payment for the booking and any possible incidental charges.
2. Take preauthorization or deposit from the guest for the amount agreed. Once the money has been accepted, process this in the system by selecting either the “Preauthorization” or “Deposit” button, which will allow you to post the amount directly in the system.
3. Check that the pre-assigned room is inspected. If it is not, check if there is another room of the same type that is available and inspected. This can be spotted quickly from the dropdown menu. If no room is available ensure you assign an available (dirty or clean) room and contact housekeeping to get the room cleaned.
4. Once an inspected room is assigned, you can press “Check-in,” and the room is checked in. It will be locked, so that it cannot be moved in the system.

Checking in a continuing reservation can be quite challenging.
- First, you will want to ensure that the same room number has been allocated for the continuing booking, so that the guest will not be required to move. Ensure that this is done at the booking stage, as it may be harder to move bookings around on the day of arrival. Always lock your booking, so that no one can move the room.
- Check-out the current booking. The booking that is currently checked-in will have to be checked out. You can check it out by ticking the box "Check Out with Open Balance,” and it will leave the charges unpaid on the guest profile.
- Lastly, you can check in the new reservation, and once this is done, you will see that all the charges from the first booking are automatically transferred to this bill.

## How to Check-out a Booking

To check-out, the first step is identifying the booking to be checked out. There are a few methods to quickly find a booking:

- The quickest way is to type the guest name/e-mail/confirmation/room number/e-mail in the search box at the top menu. Once you select the customer you will be redirected to the Customer Dashboard where you get an overview of all future bookings of this client.
- You can select a booking directly on the timeline. The booking details will appear from the right. Please select “Manage” to open the “Manage Booking” screen.
- From the reservation overview or reservation report, you can find a booking based on a different filter. The bookings are selectable, and once you open the booking, press “Manage Booking.”

Once you have identified the booking, select the “Check Out” button on the booking screen. This button only appears on the booking on the day of departure.

### Review Customer Balance

If the balance is zero, you can immediately check-out the reservation by clicking the “Check Out” button, and the customer is ready to leave. If the balance is not zero, click on the billing button, and you will be taken to the payment screen. To understand how to settle the balance, please refer to the section “Payment Screen” in this manual. Once the balance is settled, you can return to the check-out screen and check the room out.

Note if you need to check out a guest even though they have not yet settled the bill (for example for a continueing booking) this is possible, Next to the "Check-out" button, simply click "Check-out with Open Bill", provide a reason, and the reservation will be checekd out. The bill will appear in the Guest Ledger, so that you can follow up on the payment.

Once the room is checked-out in the system, it will automatically turn "dirty" in the system so that housekeeping is informed that it requires cleaning.
