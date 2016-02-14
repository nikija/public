---
title: Cubilis
---

- Cubilis integration supports **Create reservations**, **Download reservations peridically**, **Upload Availability**, **Upload Prices**, **Synchronize** operations.
- To create a new hotel, contact Cubilis on `support@stardekk.be`.
- Cubilis will create credentials and activate the connection. The new credentials will be sent to `matt@mewssystems.com` and `ondra@mewssystems.com`.
- The connection is then activated on our side - simply by creating/enabling the integration to Cubilis. You can activate the connection on your side. On this page: `http://cubilis.eu/plugins/pms/ReservationQueue.aspx` it is possible to remove some reservations from the queue.
  - Step 1: Delete all reservations "with start date before" and select the date of the hotel conversion to Mews. --> Select "Remove from queue"
  - Step 2: Once the old bookings are removed, select all reservations "with start date later than" and select the date of the hotel conversion to Mews. --> Select "Add to queue" and the bookings should start coming into Mews over the next few hours.
- Every hotel will be provided with their own username and password that needs to be set in the integration before any communication starts.
- To obtain mapping you have to enable the integration and allow the **Download mapping** operation. Then trigger the **Download mapping** action and go to the job log for mapping details.
- All codes are numbers, the Default (Standard) rate has code 0.
