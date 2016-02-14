---
title: Foreign Police Integrations
---

- These integrations serve to automatically report the guests of the hotel to the proper Foreign Police department.
- The integration cooperates with a Customer Profiles report in Mews Commander.
- The report can't contain any red cell to have succesfully filled all informations needed for the integration, the more red on the report, the more informations needs to be filled in.
- The generated report file can be obtained by selecting `Export report file` button.
- The report file can be resend by selecting `Save report file` button.
- Based on integration type, the supported report types are `Daily` and/or `Monthly`.
- There is a backgroud job that runs every hour and at 9 hours of hotel's local time it sends report the following way:
   - [*Daily*] Generates notification for hotel managers to **chec**k report for guests that arrived **yesterday**.
   - [*Daily*] **Sends** report for guests that arrived **2 days ago** to police.
   - [*Monthly*] If it is second day in the month, sends report for **previous** month.

### Email addresses

- `Sender email` is email address that will appear as email sender.
- `Receiver email` is email address that will receive the generated report.
- `Manager email` is email address that will receive the notification email to check the report.

*Note:* `Receiver email` and `Manager email` fields can contain either one email address or multiple addresses separated by `;` or by `,`. In case of multiple addresses, email will be sent to all addresses.
