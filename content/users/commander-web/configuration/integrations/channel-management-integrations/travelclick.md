---
title: TravelClick
---

- TravelClick integration supports **Create reservations**, **Upload Availability**, **Upload Prices**, **Synchronize** operations.
- TravelClick supports PUSH reservation delivery only, which means that reservations are pushed to MEWS via our API. The periodical reseration download is not supported.
- TravelClick processes the data with availability and prices from Mews asynchronously. Which means, that the job with the upload will always succeed, because TravelClick does not send the response with validation result (success/warning/error) unlike other Channel Managers do. The esponse with validation result is delivered to our API and is visible only on LogEntries - which means that a developer must assist with obtaining the result of the availability/prices upload in order to verify its true result. It is linked to a `EchoToken` attribute in the message uploaded in Mews (visible on Mews Jobs).
- Enhancement - the item that has price. It should be mapped against our Stay products (e.g. breakfast).
- Services (TravelClick's definition) - the item that does not have price.(e.g. Extra Pillows). These services are displayed under Reservation Notes. There is no need to map it.
