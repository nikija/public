---
title: Point Of Sales Integrations
---

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
