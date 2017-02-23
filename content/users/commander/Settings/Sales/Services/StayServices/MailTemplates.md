---
title: Mail templates
---  

Mews offers you multiple options how to keep in touch with the customers and how to customize the information that your clients are provided with.

Using the HTML you can set up the following emails:

### After end email
This email is sent out to the customers who just proceeded with their check-out. This email should be sort of a `Thank you email` offering the guest possibility to leave a review of your property (e.g. Tripadvisor).

### Cancellation email


### Confirmation email
This email is sent out when the customer creates the reservation using the Distributor or when the reservation is created manually through the New Reservation Screen.

Confirmation email should always include the button for on-line check-in. We also advise this email to include possible upsell possibilities as well recommendations, etc.

In the New Reservation Screen, you have the possibility to either not send the email (when not desired) or to send it to a custom email.

### Release date reminder

### Quotation email

### Placeholders

What is Placeholder? It is an "empty" part of the text that is explicitly given and in the email itself it is replaced by the specific information from the system.
This is important e.g. for personalization of the emails by automatically adding the names of the guests or e.g. information about the booking.

What placeholders do we use?

Confirmation email
{TitlePrefix} - Mr., Mrs., Ms.
{FirstName} – owner's of the booking First name (if this is empty, it takes {Name})
{LastName} – owner's last name
{Name} – full name
{DetailsHtml} – booking details
{SignInLink} – check-in online button
{EnterpriseName} – name of the hotel
{EnterpriseEmail} – email of the hotel
{EnterpriseTelephone} – telephone of the hotel

End email
{TitlePrefix}
{FirstName}
{LastName}
{Name}
{EnterpriseName}
{EnterpriseEmail}
{EnterpriseTelephone}

Quotation email
{TitlePrefix}
{FirstName}
{LastName}
{Name}
{EnterpriseName}
{EnterpriseEmail}
{EnterpriseTelephone}
{DetailsHtml}
{Released} - the date and time of the release of the optional reservation

Before release email
{TitlePrefix}
{FirstName}
{LastName}
{Name}
{EnterpriseName}
{EnterpriseEmail}
{EnterpriseTelephone}
{DetailsHtml}
{Released}
