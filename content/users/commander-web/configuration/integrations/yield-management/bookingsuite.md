---
title: BookingSuite
---

You need BookingSuite hotel id (a number) and mapping between BookingSuite rooms and hotel rooms.
When BookingSuite people contact you about setting it up on our side they often say just hotel id and don't communicate the mapping. You have to check with them or check with hotel (hotel is beter since BookingSuite does not know about our room types).
BookingSuite integration has following parameters:

- Is Enabled - whether this integration works or is ignored
- Hotel Id - mandatory, id under which it sends data to BookingSuite
- Enable Export - whether integration should send data to BookingSuite
- Export Historic Data - when you setup a new hotel, this allows sending old data. Without this BookingSuite would get data only about reservation which happen after the integration is set up. This setting will disable itself once old data are sent. This field is also used to reset BookingSuite data. E.g. when hotel changes the mappings of rooms we need to resend all historic data so BookingSuite can recalculate recommendations.
- Import Recommendations - whether we want to get recommendations from BookingSuite. This option can be enabled later
- Import Competitior Prices - whether we want to get competitor prices from BookingSuite (those recommendations are shown instead of standard scraper recommendations)
- Mapping for Base Price - which hotel room is the base rate in hotel. This is used to correctly show base recommendation and competitor prices
- List of mappings between Mews Room Categories and BookingSuite room types. There has to be mapping for each of our room types otherwise we would send incorrect hotel occupation.

With this you:

1. In hotel integrations click New BookingSuite integration
2. Enter BookingSuite Hotel Id, click Enable Export, Export Historic Data. Don't enable Imports yet because it takes BookingSuite some time to set up and calculate and it would cause errors.
3. Save data
4. Add BookingSuite mappings for all our rooms.
5. Select Mapping for Base Price and save again
6. When BookingSuite confirms it, enable imports.
