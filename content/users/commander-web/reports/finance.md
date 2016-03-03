---
title: Finance
---

This section covers a variety of Financial Reports which are critical for accountants and managers in order to track financial transactions made, and summarizing them into userful and interactive overviews. Note that all reports can be exported straight from Mews to Excel, which helps if you build Macros or imports against accounting systems.

Note that reports may occasionally change format over time, which might affect Macros or Import files, be sure to double check these for correctness once every so often.

Most Financial Reports run in 2 modes:

### Consumed

This takes into account all services that were physicially consumed in the selected period. 

For example, if you have a 3 night stay, each night will be considered 1 consumed night, so if you run a report for 1 night interval, it will show 1 night consumed revenu.

Payments are always considered "consumed" at the time of posting.

### Billed

This setting rates into account all services that were on a closed bill during the selected interval.

For example, if you have a 3 night stay, and on the last day you close the bill. If you run the report for the interval of the last day, it will show 3 billed room nights. If you run it for any of the first 2 nights, it will show 0 consumed nights.

## Which to use?

This is a VERY important question your accountant needs to answer at the time of implementation. If a hotel decides to use the Consumed Mode, the Payments and Revenues will never match up, as both have different consumption period. If the hotel decides to use the Billed mode, then Payments and Revenues always match.

What is the most correct? We believe that "Consumed" mode is the most correct report, as it allows you to pay taxes based on the actual situation, whereas if you follow "Billed" mode, a bill could contain items from a previous or future month. However in the end either of the solutions will result in the same VAT payments.

