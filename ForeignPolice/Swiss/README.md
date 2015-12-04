# Mews - Integration with Swiss Foreign Police

## Content

- [Introducton](#introduction)
- [Set up](#set-up)
- [Customer Profiles Report](#report-customer-profiles)
   - [Incomplete report](#incomplete-reports)
- [How it all works](#how-all-works)

<a name="introduction"></a>
## Introduction

This user manual provides an insight into how an automatic generation of `Daily` and `Monthly` guest reports works in Mews and how to use it properly. The `Daily` report contains guests that have arrived that day to a hotel. A `Monthly` report contains the summary of arrivals/spent nights based on the nationality of the hotel's guests. 

<a name="set-up"></a>
## Set up

- Provide at least one email address which will be the sender of the automatic reports (e.g. `manager@hotel.com`).
- Provide at least one email address to whom the notification to check Daily Customer Profile reports will be sent to (e.g. `reception@hotel.com`.

<a name="report-customer-profiles"></a>
## Report Customer Profiles
Report Customer Profiles is accessible directly from *Dashboard* and it shows a list of customers that have arrived (or are In House) in the specified period - all based on the report's parameters. The proper filter for both reports is when one has selected to see "Arrivals" and selects the day/month period for `Daily`/`Monthly` reports.

![Report Customer Profiles](../Images/Report.png)
This is a sample screen shot of the report. It shows that there are 2 guests in the room `201` - `Jane Smith` and `Jason Statham`, in the room `407` there is `Mena Suvari` and another unassigned guest (the reservation is for 2 guests). 

The report states also:

- The profile of `Jane Smith` is 100 %complete - *that is why the field is white*.
- On profiles of `Jason Statham` a `Mena Suvari` *adress* and *passport number* are **missing** - *that is why those fields are red*.
- A companion of `Mena Suvari` is unassigned - *that is why the whole blank line is red*.

All missing (red) data should be filled in during the check-in process. If something is still missing after check-in, it should be filled before the report is generated - see [How it all works](#how-all-works). The aim is to have the report 100% complete - fully white.

*Note:* It is possible to download a report (that would be sent) or send the report directly via email for a selected day. In case a `Daily` report is generated and a larger period than one day is selected, the report is generated for the first day (Start) only.

<a name="incomplete-reports"></a>
### Incomplete report

[Customer Profiles](#report-customer-profiles) report will usually have missing errors (the total view will be "a bit red") even after all reservations are checked in, so it should be made as "white" as possible. If a guest profile is missing some information (e.g. first name, nationality, date fo birth, passport number, ...) it should be looked up on the registration card, which the guest should have completed during check-in, and filled in the missing data based on the registration card. If the registration card is incomplete as well, it means that the reception didn't insist on the information during the check-in process. The guest should be approached then. And more importantly the reception should be notified to require the whole registration card completed during check-in.

A bit more difficult (at least for Mews newbies) is to solve the problem with unassigned guest (room `407` case). What could happen:

1. The second guest won't arrive.
2. The second guest has arrived, but his profile hasn't been created.
4. Both guests have arrived, both profiles exist and are mentioned in the reservation detail, yet the main guest on the reservation is missing from the report.

#### Solution

1. Update the reservation to be only for 1 person (and apply a charge if necessary).
2. Create a new profile for the other guest and assign it to the reservation.
3. First just note that there is a difference between an *Owner* and an actual *Guest*. A *Guest* is someone who will stay in one reservation. The *Owner* of the reservation is the person who has created the reservation (and may not arrive at all) or in case of a multiple reservation group Mews doesn't know in which room the Owner will stay (a person can't stay in 2 different rooms), see the following screenshot:

![Group Modul](../Images/GroupModule.png)
The screenshot shows how to solve the room `407` case. `Nicolas Cage` is an *Owner* of the reservation (red elipsis). It is required to click on the `>` arrow (red rectangle) to assign him to the reservation. It is up to reception durign check-in to assign the *Owner* to some reservation (make him a *Guest*).

<a name="how-all-works"></a>
## How it all works

Once everything is set up, automating the reporting can begin. There is an operation that runs in Mews in the background and every day at 9 am it:

- Send a notification email to check a report for **yesterday**.
- Send a `Daily` report via email of every customer that arrived on the **day before yesterday**.
- Send a `Monthly` report (if it is *2nd* day of month) for the **previous** month that contain:
	- report of spent nights grouped by nationality of guests
	- report of arrivals grouped by nationality of guests
