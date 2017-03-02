---
title: Stripe
---

## Onboarding

This whole process needs to be done from global admin, as this is Merchant integration.

1. Create Merchant integration with `Stripe` Payment gateway in the hotel.
2. Keep it **Disabled**.
3. Create `StripePaymentGatewayAccount` for each currency hotel wants to support.
   - [Here](https://stripe.com/docs/connect/required-verification-information) you can check all supported currencies in the selected country.
4. Keep it **Disabled**.
5. Fill in all informations including all owners of the account.
    - The link above states minimum required fields per country, but it can happen that Stripe will want more information for the account as the time goes, so it is recommended to obtaing and fill in as much information as possible at the begining.
    - You can obtain IP address from hotel (if they don't know how to get it) if you send them this link `https://www.google.com/search?q=what%20is%20my%20ip` and as them to give you the four numbers in `XXX.XXX.XXX.XXX` format.
6. When you have all `StripePaymentGatewayAccount`s created and filled in, you can enable them one by one.
   - Enabling `StripePaymentGatewayAccount` registerss the account in Stipe. Sripe verifies the account data and in case of an issue with privided data, Mews Support will receive an email with what to fix.
   - You should **not continue** until all `StripePaymentGatewayAccount`s are verifed by Stripe.
   - TODO: How long does it take and what if it succeeds? How can we know?
7. Now you can select `Default Currency` on the Merchant integration and enable the integration.
   - Prior to enabling the integration, make sure the Stripe `Merchant Subsctiption` commissions are set up correctly.

## Settlement

Stripe settles money same way as **direct** integration. Each `StripePaymentGatewayAccount` represents hotel's bank account. The money flow is simple

- Employee creates a Stripe payment.
- Mews sends the payment to Stripe with already computed Mews commission.
- Stripe charges the customer bank account the full amount of the payment.
- Twice a week Stripe settles all charged payments (without Mews commissions) to the hotel bank account directly in batches.
   - Mews receives a notification about this process and marks the settled payments from batch as `Settled` which can be tracked in FTR.
- Mews receives its commission from payments in the batch (without stripe commission) on Mews bank account.
