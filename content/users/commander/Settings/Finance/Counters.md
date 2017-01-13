---
title: Counters
---
Every bill and invoice (as well as individual reservations and other services) needs to have unique number (identifier). There are three separate kinds of counters in Mews (listed below). If nothing is set up, the system automatically picks up numerical series starting with the number **1**. However, the accountants or internal operations may reuqire customized formatting.

### Bill Counters
- **Is Default:** This field indicates whether the counter is pre-selected by default when closing a bill. This is applicable when you operate with more than one bill counter. If so, you have the option to select the appropriate counter accordingly. **Default** counter always the one that was in the system automatically.
- **Value:** This field displays the current state of the counter.
- **Name:** When you operate with multiple counters, you can name each of them in a way that your team understands which counter is used for what when closing the bill.
- **Number Format:** If this field remains blank, the counter starts with the number 1 and then continues up to XXX. However, some properties might need to specify e.g. the year when the document was issued or some other identifier. In that case, you would type in what you wish to be static part of the line of numbering followed by **{0:00000}**. The number of zeros determines how many digits will the counter have. Once it reaches the last number of the series, the counter will start from the scratch. Therefore, you should consider this based on the amount of bills and invoices your property issues.<br/>
 - *Examples:* **2017{0:00000}** would srart with *201700001* and finish with *201799999* whereas **ABC{0:0000}** would start with *ABC0001* and finish with *ABC9999*.
- **Title:** This field determines what is being displayed on the actual bill. If it remains blank, it puts *Bill* followed by the counter (as per Counter Format) for bills and **Invoice** for invoices. Howevrr, you can specify it based on your needs. This will also be displayed in the Bills and Invoices Report.
- **Bill Type Code:** This is a specific field for fiscalization in Greece.

### Proforma Counters
Some hotels need to have specific counters also for Proforma Invoices. 

### Service Order Counters
As mentioned earlier, you can define also the counter for the reservations and since reservations are effectively *Stay Services* this counter is shared amongst all the posted services in the system. However, for the services it has the biggest impact since the counter here equals the confirmation number. The formatting will work the same way as for bill counters. 


#### Good to know
- It is possible that in your previous PMS you already followed certain numerical series and you would like to continue. When creating new bill counter, you can define the startin value of the counter.
- You can reset or delete your counter. Resetting can come handy e.g. when the New Year comes. Please note that you cannot delete the default counter.
- Watch our [video](https://vimeo.com/197306953) regarding counters which will help you to better understand how to set them up properly.
