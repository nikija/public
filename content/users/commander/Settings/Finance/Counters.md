---
title: Counters
---
Every bill and invoice (as well as individual reservations) needs to have unique number (identifier). There are three separate kinds of counters in Mews (listed below). If nothing is set up, the system automatically picks up numerical series starting with the number **1**. However, the accountants or internal operations may reuqire customized formatting.

### Bill Counters
- **Is Default:** This field indicates whether the counter is pre-selected by default when closing a bill. This is applicable when you operate with more than one bill counter. If so, you have the option to select the appropriate counter accordingly. **Default** counter always the one that was in the system automatically.
- **Value:** This field displays the current state of the counter.
- **Name:** When you operate with multiple counters, you can name each of them in a way that your team understands which counter is used for what when closing the bill.
- **Number Format:** If this field remains blank, the counter starts with the number 1 and then continues up to XXX. However, some properties might need to specify e.g. the year when the document was issued or some other identifier. In that case, you would type in what you wish to be static part of the line of numbering followed by **{0:00000}**. The number of zeros determines how many digits will the counter have. Once it reaches the last number of the series, the counter will start from the scratch. Therefore, you should consider this based on the amount of bills and invoices your property issues.<br/>
 - *Examples:* **2017{0:00000}** would srart with *201700001* and finish with *201799999* whereas **ABC{0:0000}** would start with *ABC0001* and finish with *ABC9999*.
- **Title:** This field determines what is being displayed on the actual bill. If it remains blank, it puts *Bill* followed by the counter (as per Counter Format) for bills and **Invoice** for invoices. Howevrr, you can specify it based on your needs. This will also be displayed in the Bills and Invoices Report.
- **Bill Type Code:**

### Proforma Counters

### Service Order Counters


[status.mews.li](http://status.mews.li)
