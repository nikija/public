---
title: Channel Management Integrations
---

## Channel Manager Integrations

Channel Manager Integration connects Mews Commander with external Channel Manager - an aggregator of booking engines all over the world. The main function of the connection between the Channel Manager and Mews Commander is to upload the availability and prices (Mews Commander -> Channel Manager -> OTAs) and to download reservations (OTAs -> Channel Manager -> Mews Commander).

The update of availability and prices works in two different modes

- **Full update** when information for all connected room types and rates is sent (can be triggered manually).
- **Delta update** when only difference from last delta update is sent (can't be triggered manually).

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

### How to manage a Channel Manager Integration

#### Adding a new room type

If hotels want to add a new room type to be sychronized with channel manager:

1. They need to obtain from the channel manager the mapping code for the room type and the rate codes the room type is connected to.
2. The room type mapping code should be set to the mapping property of the room type.
3. The room should be added to the list of connected room types on each channel manager rate (on the integration detail) the room type should be connected to.

#### Removing a room type

If hotel doesn't want to synchronize a room type anymore, follow these steps:

1. Remove the room type connection from all channel manager rates that connect the room type.
2. Remove the mapping code from the room type setting.

### Operations

Every operation can be triggered either manually (from the integration screen) or by a background job that triggers the opertion on the integration (if the integration has the operation enabled). There are all operations that the integration might support:

- **Create reservations** - allows Mews Commander to create reservation from a direct input (either manual or via API).
- **Ping notification** - allows Channel Manager to ping Mews Commander, the reaction is to ask for reservations (saves traffic).
- **Download Mappings** - Mews Commader will ask for mapping information of the hotel. Result will be in a job logs.
- **Download reservations periodically** - Mews Commander requests the Channel Manager for all pending reservations. After processing the reservations, Mews Commander confirms the reservations.
- **Upload Availability** - Mews Commander allows to send update of availability.
- **Upload Rate Prices** - Mews Commander allows to send prices and rate restrictions.
- **Sychronization** - usually runs once a day and combines reservation download and full-update for the maximal allowed period in advance.

### Actions

To trigger operations on the integration manually, go to the integration detail page (where the setting is). On the bottom there is a form which enables to trigger some operations manually. *Note that the operations run via jobs where only global admin has access*. To check the status of operations, log in as a global admin in an incognito tab and check jobs (the sign of an lightning).

- **Download Mappings** - will create a background job that downloads hotel mapping from Channel Manager.
- **Download Reservation** - will create a background job that downloads pending reservations from Channel Manager.
- **Send Inventory** - will create a background job that uploads full update (availability and/or prices) for the specified period in the Channel Manager.
- **Synchronization** - will create a background job that triggers synchronization with the the Channel Manager.
- **Create reservation** - will create reservation based on data from `Input` field. *Note that reservation will not be confirmed to Channel Manager*.  

## Troubleshooting

### Invalid mapping
- When you receive an email with invalid mapping, it is crucial to fix the mapping as soon as possible. Because Mews **disabled** the integration, which means that until the mapping is fixed, no reservation will be downloaded and no availability/rate will be updated.


### Rates synchronization issues
- If you receive a notification email that says something like rate update is not allowed, becaue updated rates are dependent (linked, derived, ...), you usually receive the rate code, so it is easy.
- In case this happens on AvailPro, you are not notified by an email, but by an angry customer, that complains that rates are not updated correctly. If synchronization doesn't help, you need to contact AvailPro, because they have mess in rate set up. There is some hidden rate dependency, and AvailPro needs to find it and give you the rate code.
- With the dependent rate code, you need to communicate with Channel Manager and Hotel to ask where the rate needs to be supplied from - either from Mews or from Channel Manager and adjust mapping accordingly.

### Reservations are not downloaded
If hotel complains about reservation(s) not being downloaded, there could be a lot of reasons. Some of them:
- The integration is disabled. or the `Download Reservations periodically` or `Ping Notificiation` or `Create Reservation` method is disabled (depends on channel manager which operation is used to obtain reservations).
   - In this case enable the integraton/operation and wait for the job to get it (if operation is `Download Reservations periodically`. Otherwise ask channel manager to resend the reservation.
- The resevation was downloaded, but hotel assigned it to another guest (hotel just can't find it by the original guest name) or updated it somehow. Just try to find it by channel manager code.
- The reservation wasn't sent to Mews (accoring to logs), but in Channel Manager is marked as delivered. In this case contact channel manager to get you the exact time of reservation download and confirmation number we send them as part of confirmation.
   - If they send you the data, check the logs again to see what happend.
   - If they don't have the data, means they didn't deliver the reservation an the problem is in channel manager.
   - In both cases the solution is to resend it from channel manager again.
