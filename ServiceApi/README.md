# Service API Documentation
This document provides a documentation for an API that serves as a communication gateway to Mews System for charging customers. The API can be used by any external service - POS - to charge customers on their open hotel bills. 

## Contents

- [API overview](#api-overview)
	- [Method overview](#method-overview)
		- [`GetCustomersByRoom`](#get-customers-by-room)
		- [`GetCustomersByName`](#get-customers-by-name)
		- [`Charge`](#charge-method)
	- [Objects overview](#objects-overview)
		- [`ChargedCost`](#charged-cost)
		- [`ChargedCostItem`](#charged-cost-item)
		- [`CustomerData`](#customer-data)
		- [`ChargingResult`](#charging-result)
- [Development environment](#development-environment)
- [Use case](#use-case)

<a name="api-overview"></a>
## API overview
Provided API implements `Mews.Api.Services.IServiceApi`. This API interface defines the following methods:

<a name="method-overview"></a> 
### Method overview

<a name="get-customers-by-room"></a> 
#### `GetCustomersByRoom`

This method finds and returns a list of all customers that currently stay in the given room. Every returned customer contains information whether they can be charged on their hotel bill or not.

Parameter | Type | Description
--------- | :--: | -----------
`serviceAccesToken` | `string` | Token that allows POS system to use the API method. 
`roomNumber` | `string` | Number of the room the customer stays in.
`chargedCost` | [`ChargedCost`](#charged-cost) | Cost that should be charged to the customer.
**returns** | [`List<CustomerData>`](#customer-data) | Method returns list of data for every matched customer.

<a name="get-customers-by-name"></a> 
#### `GetCustomersByName`

This method allows to find customers by name. The provided name could be a full name or just a last name. Since the name provided by customer can be misunderstood or misspelled while inserting into the POS, the mechanism of matching customer by name allows minor differences between provided name and the customer's actual name (e.g. when "smth" is provided all customers whose last name is "Smith" and "Smooth" would be matched).

Method returns a lists of all customers that currently stay in the hotel and have matching names. The list of customers is split by room, that should help to easily identify which customer is in the facility in case multiple customers (with very similar name) stay in the hotel. Every returned customer contains information whether they can be charged on their hotel bill or not.

Parameter | Type | Description
--------- | :--: | -----------
`serviceAccesToken` | `string` | Token that allows POS system to use the API method. 
`name` | `string` | Customer name - can be full name or just last name.
`chargedCost` | [`ChargedCost`](#charged-cost) | Cost that should be charged to the customer.
**returns** | [`Dictionary<string, List<CustomerData>>`](#customer-data) | Returns `Dictionary` of found customers grouped by room they stay in. The key of the `Dictionary` is room number and value is `List` of [`CustomerData`](#customer-data) for every customer that stays in that room.

<a name="charge-method"></a> 
#### `Charge`

Once the customer is found, by calling [`GetCustomersByRoom`](#get-customers-by-room) or [`GetCustomersByName`](#get-customers-by-name), this method allows POS to charge the customer for the consumed products.

Method will return a result that states that all charged products have been succesfully charged in Mews system.

Parameter | Type | Description
--------- | :--: | -----------
`serviceAccesToken` | `string` | Token that allows POS system to use the API method. 
`customerId` | `Guid` | `Id` of the customer that is charged. The Id is obtained within [`CustomerData`](#customer-data).
`chargedCost` | [`ChargedCost`](#charged-cost) | Cost that will be charged to customer.
`note` | `string` | Additional notes for the order.
**returns** | [`ChargingResult`](#charging-result) | Returns result that contains `Id` of product charged in Mews for every [`ChargedCostItem`](#charged-cost-item) of provided [`ChargedCost`](#charged-cost).

<a name="objects-overview"></a> 
### Objects overview
The API uses the following objects:

<a name="charged-cost"></a> 
#### `ChargedCost`

Property | Type | Description
--------- | :--: | -----------
`CurrencyCode`| `string` | ISO-4217 currency code, e.g. "CZK", "EUR", "USD". 
`Items` | [`List<ChargedCostItem>`](#charged-cost-item) | List of products charged to customer.

<a name="charged-cost-item"></a> 
#### `ChargedCostItem`

Property | Type | Description
--------- | :--: | -----------
`Amount`| `decimal` | Product cost with the tax included. 
`Tax` | `decimal` | Tax rate (0.15 for 15% tax rate).

<a name="customer-data"></a> 
#### `CustomerData`

Property | Type | Description
--------- | :--: | -----------
`Id`| `Guid` | Id of the customer.
`FullName` | `string` | Full name of the customer.
`RoomNumber` | `string` | Number of room where the customer currently stays.
`IsChargeable` | `bool` | Indicates whether the customer is allowed to be charged the provided [`ChargedCost`](#charged-cost), e.g. whether they have enough credit in the hotel.
`ChargeableAmount` | `decimal` | Allowed chargeable amount. The value is just an infomation for the POS employee to notify the customer that they don't have sufficient credit on their account at the hotel. However it is still possible to charge the customer even if the total charged cost exceeds the `ChargeableAmount`. Whether to charge the customer or not should be mainly decided based on `IsChargeable` property. 
`ChargeableAmountCurrencyCode` | `string` | ISO-4217 currency code of chargeable amount, e.g. "CZK", "EUR", "USD".
`Notes` | `string` | Additional notes, e.g. reason why the customer is not chargeable.

<a name="charging-result"></a> 
#### `ChargingResult`

Property | Type | Description
--------- | :--: | -----------
`OrderIds`| `List<Guid>` | `Id` of order created in Mews for every [`ChargedCostItem`](#charged-cost-item) of provided [`ChargedCost`](#charged-cost).

<a name="development-environment"></a> 
## Development environment
There is a hotel prepared for developing and testing: 

- API Address is `https://mews-test.azurewebsites.net/Api/ServiceApi.svc`.
- Acces token is `61F027FA10E7998B35F1FF2F9D6734ED264412D3CFD29CCD8F55`.
- In room **503** there is a customer **Angelina Joile** (can be found by name or room number).

Once the POS integration is tested, the adress of the production API and a proper access token will be sent by Mews.

<a name="use-case"></a> 
## Use case
A simple example: There is a restaurant that is used by hotel customers. When a customer wants to pay in this restaurant he asks for the bill. They can pay by cash or credit card directly within the restaurant, then the API is not used at all. 

Or he could say "My name is Smith, I am staying in the hotel in room 123." or write this data on the bill. In this case the restaurant employee should check on the POS, whether there is a guest named Smith and whether they indeed stay in room 123. The POS asks Mews via the API about the customer and Mews returns a list of all customers in room 123, or all customers with provided name (depends whether [`GetCustomersByRoom`](#get-customers-by-room) or [`GetCustomersByName`](#get-customers-by-name) method was called). 

If no data returns, no such customer is staying at the hotel. If a customer is matched, a list of [`CustomerData`](#customer-data) is returned - one item per customer. Every [`CustomerData`](#customer-data) specifies whether the corresponding customer has an open bill in the hotel and whether the customer had sufficient credit to be charged the specified amount. 

If everything is OK, restaurant employee can charge the customer's hotel bill (via the [`Charge`](#charge-method) method) and should notify the customer that the bill is closed and added to his hotel account. If no chargeable customer is found, then the guest should be invited to pay in the restaurant.
