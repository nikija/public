---
title: Webhotelier
---

- WebHotelier integration supports **Create reservations**, **Ping notifications**, **Download reservations peridically**, **Upload Availability**, **Upload Prices**, **Synchronize** operations.
- Prefferably use **Ping notification** over **Download reservations peridically** operation.
- WebHotelier provides each hotel with its own credentials. Once you have set up the credentials,
 - select the enabled operations: "download mappings"
 - then enable the connection.
 - select the option "download mappings" and select ok.
 - the mappings have been delivered to the MEWS ADMIN (so Sysco will have to write an e-mail to Mews to get the mappings shared). When you open the mappings you see that they are missing formatting, you can use this link to give it better formatting: https://jsonformatter.curiousconcept.com/
- The Webhotelier mapping of rates works slightly different from other channel managers. Each rate has a unique code for each room type that is mapped. So when setting up a New Channel Manager Rate, select the correct rate type, and put the unique code, and save it. Secondly only add the room type to which this rate is applicable.
- Once you have connected Webhotelier, you can only send them inventory updated up to 180 days in 1 push. If you include any date that is more than 180 days out, the job will fail.
