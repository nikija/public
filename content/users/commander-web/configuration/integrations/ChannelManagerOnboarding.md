## Webhotelier

1. WebHotelier needs to provide Mews with credentials of the hotel (it will look like this): 
Hotel Code: XZYXYZX
Username: XZYXYZX
Password: ND97ACA6481E5227E541121E1B2C7FEA27KLJ5B2B1

2. Set up the integration of the hotel and download the mapping
3. Use this tool to convert it to more readable text https://jsonformatter.curiousconcept.com/
4. Set it up (each room type has its own rate)
5. Send Inventory push for one day, in order to check if it works (WebHotelier doesn't do testing) and then you are good to send one year


## TravelClick
1. Obtain the mapping table from TravelClick
2. Agree on "live" date
3. Complete the mapping in Mews for Create reservations, Upload Availability, Upload Prices, Synchronise operations.
Note: as TravelClick connected with CRS setup has sent and received room types. The one that are received are the same however they are not synchronised.
4. As TravelClick does not have testing environment, test and switch happens on the same date. 
Switch happens with presence of all 3 parties: hotel, TraveClick and Mews via Skype or email. Once property confirms in written to both TravelClick and Mews that Rates, Restrictions and Availability are correct, property gets connected.

## Siteminder
1. Complete the mapping based on received from SiteMinder mapping table.
2. Confirm testing and switch date
3. "Test" date - day when we do the push of the rates and availability for short period of time, test of new reservation, modification, cancellation. PMS connection gets disabled until the "switch" date. Property needs to be available too, to verify if data is correct in SiteMinder and confirm that testing was successful.
4. "Switch" day. Happens one or several day later of testing. Switch happens with presence of all 3 parties: hotel, SiteMinder and Mews via Skype or email. Once property confirms in written to both SiteMinder and Mews that Rates, Restrictions and Availability are correct, property gets connected.


## Availpro 
Hotel, Mews & Availpro agree in written form that all rooms & rates match in both systems before we start the integration.

1. Complete the mapping based on sent by Availpro mapping table
2. Availpro needs to activate the integration from their end prior to the testing (this was often forgotten)
3. Both parties set a testing day (create, modify, cancel a reservation)
4. Availpro does not manage Products, these have to be set up on Mews' side
5. "Switch" day. Switch happens with presence of all 3 parties: hotel, Availpro and Mews via Skype or email. Once property confirms in written to both Availpro and Mews that Rates, Restrictions and Availability are correct, property gets connected.
Note: In case of RLO (Rate level occupancy), Availpro can set up prices for different pax numbers. This derivation is set up in AVP and then sent to Mews.

## Cubilis  
Hotel has to confirm that setup between Cubilis & Mews, has been completed.
1. Obtain Cubilis login credentials
2. Download Cubilis mapping
3. Complete the mapping of rooms and rates
* Map products (charge per night, never 'once') - note that Cubilis manages products on their end as well
4. Cubilis Queue: remove reservations prior to the live date & add future reservations
5. Send inventory: per month, so 12x the same action. (integration should be still disabled).
6. Enable integration
* Disable integration as soon as the first 10 reservations have been downloaded
* Check if the reservation came in with the correct details
* Re-enable integration - reservations will continue streaming in
