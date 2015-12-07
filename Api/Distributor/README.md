# Distributor API (v1)

The Distributor API allows external applications (generally known as booking widgets) to get information about offered rooms and products for given hotel, to check availability of those rooms and finally to create new reservations.

First of all, please have a look at [MEWS API Guidelines](https://github.com/MewsSystems/public/tree/master/Api) which describe general usage guidelines of MEWS APIs.

## Contents

- [Operations](#operations)
    - [Get Hotel Info](#get-hotel-info)
    - [Validate Voucher](#validate-voucher)
    - [Get Availability](#get-availability)
    - [Get Reservations Pricing](#get-reservations-pricing)
    - [Get Braintree Client Token](#get-braintree-client-token)
    - [Create Reservation Group](#create-reservation-group)
    - [Get Reservation Group](#get-reservation-group)
- [Environments](#environments)
    - [Test Environment](#test-environment)
    - [Production Environment](#production-environment)

## Operations

### Get Hotel Info

Initial call used to obtain all static data about hotel relevant for a booking widget.

#### Request `[PlatformAddress]/api/distributor/v1/hotels/get`

```json
{
    "HotelId": "8dbb4b86-e6c5-4282-a996-e823afeef343",
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `HotelId` | string | required | Unique identifier of hotel. |

#### Response

```json
{
    "Countries": [
        {
            "Code": "US",
            "Name": "United States"
        }
    ],
    "Currencies": [
        {
            "Code": "EUR",
            "DecimalPlaces": 2,
            "Symbol": "€",
            "SymbolIsBehindValue": false,
            "ValueFormat": "€#,##0.00;- €#,##0.00"
        }
    ],
    "DefaultCurrencyCode": "EUR",
    "DefaultLanguageCode": "en-US",
    "DefaultRateCurrencyCode": "CZK",
    "IanaTimeZoneIdentifier": "Europe/Prague",
    "ImageId": "1627aea5-8e0a-4371-9022-9b504344e724",
    "IntroImageId": "1627aea5-8e0a-4371-9022-9b504344e724",
    "Languages":[
        {
            "Code": "en-US",
            "DefaultCulture":{
                "CurrencyDecimalSeparator": ".",
                "CurrencyGroupSeparator": "."
            },
            "Name": "English (United States)"
        }
    ],
    "Name":{
        "en-US": "Sample Hotel"
    },
    "PaymentGateway": null,
    "Products": [
        {
            "AlwaysIncluded": true,
            "Description": {
                "en-US": "Continental breakfast served in the morning."
            },
            "Id": "1627aea5-8e0a-4371-9022-9b504344e724",
            "ImageId": "1627aea5-8e0a-4371-9022-9b504344e724",
            "IncludedByDefault": true,
            "Name":{
                "en-US": "Breakfast"
            },
            "Prices":{
                "EUR": 5,
                "CZK": 150
            }
        }
    ],
    "RoomCategories":[
        {
            "Description": {
                 "en-US": "Very cozy room with nice bed."
            },
            "ExtraBedCount": 1,
            "Id": "1627aea5-8e0a-4371-9022-9b504344e724",
            "ImageIds": [
                "1627aea5-8e0a-4371-9022-9b504344e724"
            ],
            "Name": {
                "en-US": "Room"
            },
            "NormalBedCount": 2,
            "SpaceType": "Room"
        }
    ],
    "TermsAndConditionsUrl": "https://website.com/terms-and-conditions.html"
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Countries` | array of [Country](#country) | required | Countries supported by hotel. |
| `Currencies` | array of [Currency](#currency) | required | Currencies accepted by hotel. |
| `DefaultCurrencyCode` | string | required | Code of hotel's default currency. |
| `DefaultLanguageCode` | string | required | Code of hotel's default language. |
| `DefaultRateCurrencyCode` | string | required | Code of currency of hotel's default rate. |
| `IanaTimezoneIdentifier` | string | required | Iana identifier of hotel's time zone |
| `ImageId` | string | optional | Unique identifier of hotel's logo image. |
| `IntroImageId` | string | optional | Unique identifier of hotel's intro image (usable as background image). |
| `Languages` | array of [Language](#language) | required | Languages supported by the hotel. |
| `Name` | [LocalizedText](#localizedtext) | required | Name of the hotel. |
| `PaymentGateway` | one of [PaymentGateway](#paymentgateway) types | optional | Info about payment gateway used by the hotel. |
| `Products` | array of [Product](#product) | required | All products orderable with rooms. |
| `RoomCategories` | array of [RoomCategory](#roomcategory) | required | All room categories offered by hotel. |
| `TermsAndConditionsUrl` | string | optional | URL of hotel's terms and conditions. |

##### Country

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Code` | string | required | ISO 3166-1 Aplha-2 code of the country. |
| `Name` | string | required | Name of the country. |

##### Currency

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Code` | string | required | Code of the currency in the ISO format. |
| `Symbol` | string | required | Symbol of the currency. |
| `ValueFormat` | string | required | Format of a currency value (for both positive and negative values, including symbol). |
| `DecimalPlaces` | number | required | Number of decimal places used with the currency value. |
| `SymbolIsBehindValue` | boolean | required | Indicates whether the symbol stands behind a value in standard formatting. |

##### Language

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Code` | string | required | Code of the language in the ISO format. |
| `Name` | string | required | Name of the language. |
| `DefaultCulture` | [DefaultCulture](#defaultcuture) | required | Specifics of a default culture for the language. |

###### DefaultCulture

| Property | Type | | Description |
| --- | --- | --- | --- |
| `CurrencyDecimalSeparator` | string | required | Symbol used to separate decimal places in the currency value format. |
| `CurrencyGroupSeparator` | string | required | Symbol used to separate thousands in the currency value format. |

##### LocalizedText

A localized text is an object of the property values localized into languages supported by hotel, indexed by language codes.

##### Payment Gateway

If the hotel does not use any payment gateway, the value is null. If it does, then it is currently one of 3 types of payment gateways. And for each different gateway, different object is returned. The main purpose of a payment gateway is to securely obtain credit card of the customer before a reservation is created. You can decide not to support any of them and just ignore it, in which case reservations are created with note about missing credit card.

###### Mews Payments

| Property | Type | | Description |
| --- | --- | --- | --- |
| `PaymentGatewayType` | string | required | Type of the payment gateway, `MewsPayments` in this case. |

Mews Payments gateway is hosted on our website. After a reservation is created, the customer should be redirected to:

```
[PlatformAddress]/distributor/payment/{reservationGroupId}/{customerId}/?shouldRedirect=true
```

Both parameters are obtained as a result of [Create Reservation Group](#create-reservation-group) operation. The customer will fill the credit card information there and after that will be redirected back.

###### Braintree

| Property | Type | | Description |
| --- | --- | --- | --- |
| `PaymentGatewayType` | string | required | Type of the payment gateway, `Braintree` in this case. |
| `MerchantId` | string | required | Braintree MerchantId. |
| `ClientKey` | string | required | Braintree ClientKey. |

The client app should use the provided information together with Braintree library to obtain credit card information, encode it and send it when creating a reservation.

###### Adyen

| Property | Type | | Description |
| --- | --- | --- | --- |
| `PaymentGatewayType` | string | required | Type of the payment gateway, `Adyen` in this case. |
| `PublicKey` | string | required | Adyen PublicKey. |

The client app should use the provided information together with Adyen library to obtain credit card information, encode it and send it when creating a reservation.

##### Product

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Id` | string | required | Unique identifier of the product. |
| `Name` | [LocalizedText](#localizedtext) | required | Name of the product localized into all supported languages. |
| `Description` | [LocalizedText](#localizedtext) | required | Description of the product localized into all supported languages. |
| `ImageId` | string | optional | Unique identifier of the product's image. |
| `IncludedByDefault` | boolean | required | Indicates whether the product should be added to order by default. |
| `AlwaysIncluded` | boolean | required | Indicates whether the product is always included (= cannot be removed). |
| `Prices` | array of [CurrencyValues](#currencyvalues) | required | Price of the product. |

##### CurrencyValues

A currency value is an object of the entity prices in every currency supported by hotel, indexed by currency codes.

##### RoomCategory

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Id` | string | required | Unique identifier of the room category. |
| `Name` | [LocalizedText](#localizedtext) | required | Name of the room category localized into all supported languages. |
| `Description` | [LocalizedText](#localizedtext) | required | Description of the room category localized into all supported languages. |
| `ImageIds` | array of strings | required | Unique identifiers of images attached with the room category. |
| `NormalBedCount` | number | required | Number of normal beds in the room category. |
| `ExtraBedCount` | number | required | Number of extra beds possible in the room category. |
| `SpaceType` | string | required | Type of the room category - "Room" or "Bed". |

### Validate Voucher

Can be used to deterimne whether a voucher code is valid.

#### Request `[PlatformAddress]/api/distributor/v1/vouchers/validate`

```json
{
    "HotelId": "8dbb4b86-e6c5-4282-a996-e823afeef343",
    "VoucherCode": "Discount2042"
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `HotelId` | string | required | Unique identifier of hotel. |
| `VoucherCode` | string | required | Code of voucher to validate, case sensitive. |

#### Response

```json
{
    "IsValid": false
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `IsValid` | boolean | required | Indicates whether the voucher code is valid. |

### Get Availability

Gives availabilities and pricings for given date interval with product prices included for each room category. Categorized by applicable rates and person counts from 1 to full room. If room category is not available, it is left out from response.

#### Request `[PlatformAddress]/api/distributor/v1/hotels/getAvailability`

```json
{
    "HotelId": "8dbb4b86-e6c5-4282-a996-e823afeef343",
    "StartUtc": "2015-01-01T00:00:00Z",
    "EndUtc": "2015-01-03T00:00:00Z",
    "ProductIds": [
        "d0e88da5-ae64-411c-b773-60ed68954f64"
    ],
    "VoucherCode": "Discount2042"
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `HotelId` | string | required | Unique identifier of hotel. |
| `StartUtc` | string | required | Reservation start date (arrival date) in ISO 8601 format. |
| `EndUtc` | string | required | Reservation end date (departure date) in ISO 8601 format. |
| `ProductIds` | array of string | optional | Ids of products which should be included into pricing calculations. |
| `VoucherCode` | string | optional | Voucher code enabling special rate offerings. |

#### Response

```json
{
    "Rates": [
        {
            "Id": "c1d48c54-9382-4ceb-a820-772bf370573d",
            "Name": {
                "en-US": "Rate"
            },
            "Description": {
                "en-US": "Best rate available."
            },
        }
    ],
    "RoomCategoryAvailabilities": [
        {
            "RoomCategoryId": "4037c0ec-a59d-43f1-9d97-d6c984764e8c",
            "AvailableRoomCount": 5,
            "RoomOccupancyAvailabilities": [
                {
                    "AdultCount": 1,
                    "ChildCount": 0,
                    "Pricing": [
                        {
                            "RateId": "c1d48c54-9382-4ceb-a820-772bf370573d",
                            "Price": { },
                            "MaxPrice": { },
                        }
                    ]
                },
                {
                    "AdultCount": 2,
                    "ChildCount": 0,
                    "Pricing": [
                        {
                            "RateId": "c1d48c54-9382-4ceb-a820-772bf370573d",
                            "Price": {
                                "Total": { },
                                "AveragePerNight": { }
                            },
                            "MaxPrice": {
                                "Total": { },
                                "AveragePerNight": { }
                            },
                        }
                    ]
                }
            ]
        }
    ]
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Rates` | array of [Rate](#rate) | required | Information about all available rates. |
| `RoomCategoryAvailabilites` | array of [RoomCategoryAvailability](#roomcategoryavailability) | required | Availabilities of room categories. If a room category is not available, it is not included. |

##### Rate

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Id` | string | required | Unique identifier of the rate. |
| `Name` | [LocalizedText](#localizedtext) | required | Name of the rate localized into all supported languages. |
| `Description` | [LocalizedText](#localizedtext) | required | Description of the rate localized into all supported languages. |

##### RoomCategoryAvailability

| Property | Type | | Description |
| --- | --- | --- | --- |
| `RoomCategoryId` | string | required | Unique identifier of the room category. |
| `RoomOccupancyAvailabilities` | array of [RoomOccupancyAvailability](#roomoccupancyavailability) | required | Availabilities of rooms in the category by the room occupancy. |
| `AvailableRoomCount` | number | required | Number of available rooms from the room category. |

##### RoomOccupancyAvailability

| Property | Type | | Description |
| --- | --- | --- | --- |
| `AdultCount` | number | required | Number of adults for the associated pricing. |
| `ChildCount` | number | required | Number of childs for the associated pricing. |
| `Pricing` | array of [Pricing](#pricing) | required | Pricing information. |

##### Pricing

| Property | Type | | Description |
| --- | --- | --- | --- |
| `RateId` | string | required | Unique identifier of a rate. |
| `Price` | [RoomPrice](#roomprice) | required | Price of the room. |
| `MaxPrice` | [RoomPrice](#roomprice) | required | Max price of the room with the same parameters and conditions among other rates. Can be understood (and possibly displayed) as the value before discount. |

##### RoomPrice

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Total` | [CurrencyValues](#currencyvalues) | required | Total price of the room for whole reservation. |
| `AveragePerNight` | [CurrencyValues](#currencyvalues) | required | Average price per night. |

### Get Reservations Pricing

Gives a pricing information for the given configuration.

#### Request `[PlatformAddress]/api/distributor/v1/reservations/getPricing`

```json
{
  	"HotelId": "8dbb4b86-e6c5-4282-a996-e823afeef343",
  	"AdultCount": 2,
  	"ChildCount": 0,
    "StartUtc": "2015-01-01T00:00:00Z",
    "EndUtc": "2015-01-03T00:00:00Z",
    "ProductIds": [
        "d0e88da5-ae64-411c-b773-60ed68954f64"
    ],
  	"RoomCategoryId": "1627aea5-8e0a-4371-9022-9b504344e724",
  	"VoucherCode":   "Discount2042"
}
```
| Property | Type | | Description |
| --- | --- | --- | --- |
| `HotelId` | string | required | Unique identifier of the hotel. |
| `AdultCount` | number | required | Number of adults. |
| `ChildCount` | number | required | Number of children. |
| `StartUtc` | string | required | Start date of the reservation (arrival date). |
| `EndUtc` | string | required | End date of the reservation (departure date). |
| `ProductIds` | array of string | optional | Identifiers of the requested products. |
| `RoomCategoryId` | string | required | Identifier of the requested room category. |
| `VoucherCode` | string | optional | A voucher code. |

#### Response

```json
{
    "RatePrices": [
        {
  		      "MaxPrice": {
  			         "AveragePerNight": {},
  			         "Total": {}
  			    },
        		"Price" :{
  			         "AveragePerNight": {},
  			         "Total": {}
  			    },
  		      "RateId": "1627aea5-8e0a-4371-9022-9b504344e724"
  	   }
    ]
}
```
| Property | Type | | Description |
| --- | --- | --- | --- |
| `RatePrices` | array of [Pricing](#pricing) | required | Pricing information. |

### Get Braintree Client Token

Braintree requires a special client token to be generated for each transaction. In case the hotel uses Braintree as a payment gateway, you need to obtain it to before processing payment.

#### Request `[PlatformAddress]/api/distributor/v1/payments/getBraintreeClientToken`

```json
{
    "HotelId": "8dbb4b86-e6c5-4282-a996-e823afeef343",
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `HotelId` | string | required | Unique identifier of hotel. |

#### Response

```json
{
    "ClientToken": "..."
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `ClientToken` | string | required | Braintree client token generated on server. |

### Create Reservation Group

#### Request `[PlatformAddress]/api/distributor/v1/reservationGroups/create`

```json
{
    "HotelId": "8dbb4b86-e6c5-4282-a996-e823afeef343",
    "Customer": {
        "Email": "hiro@snow.com",
        "FirstName": "Hiro",
        "LastName": "Protagonist",
        "Telephone": "",
        "AddressLine1": "",
        "AddressLine2": "",
        "City": "",
        "PostalCode": "",
        "StateCode": "",
        "NationalityCode": ""
    },
    "Reservations": [
        {
            "RoomCategoryId": "4037c0ec-a59d-43f1-9d97-d6c984764e8c",
            "StartUtc": "2015-01-01T00:00:00Z",
            "EndUtc": "2015-01-03T00:00:00Z",
            "RateId": "c1d48c54-9382-4ceb-a820-772bf370573d",
            "AdultCount": 3,
            "ChildCount": 0,
            "ProductIds": [
                "d0e88da5-ae64-411c-b773-60ed68954f64"
            ],
            "Notes": "Quiet room please."
        }
    ],
    "CreditCardData": {
        "PaymentGatewayData": "...",
        "ObfuscatedCreditCardNumber": "411111******1111"
    },
    "VoucherCode": "Discount2042"
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `HotelId` | string | required | Unique identifier of the hotel. |
| `Customer` | [Customer](#customer) | required | Information about customer who creates the order. |
| `Reservations` | array of [Reservation](#reservation) | required | The reservations to be ordered. |
| `CreditCardData` | [CreditCardData](#creditcarddata) | optional | Credit card data, depends on hotel payment gateway. |
| `VoucherCode` | string | optional | A voucher code. |

##### Customer

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Email` | string | required | Email of the customer. |
| `FirstName` | string | required | First name of the customer. |
| `LastName` | string | required | Last name of the customer. |
| `Telephone` | string | optional | Telephone number of the customer. |
| `AddressLine1` | string | optional | First line of the address. |
| `AddressLine2` | string | optional | Second line of the address. |
| `City` | string | optional | City. |
| `PostalCode` | string | optional | Postal code of the address. |
| `StateCode` | string | optional | ISO 3166-2 code of the state, e.g. `US-AL`.  |
| `NationalityCode` | string | optional | ISO 3166-1 Aplha-2 code of the customer's nation country, e.g. `US`.  |

##### Reservation

| Property | Type | | Description |
| --- | --- | --- | --- |
| `RoomCategoryId` | string | required | Identifier of the requested room category. |
| `StartUtc` | string | required | Start date of the reservation (arrival date). |
| `EndUtc` | string | required | End date of the reservation (departure date). |
| `RateId` | string | required | Identifier of the chosen rate. |
| `AdultCount` | number | required | Number of adults. |
| `ChildCount` | number | required | Number of children. |
| `ProductIds` | array of string | optional | Identifiers of the requested products. |
| `Notes` | string | optional | Additional notes. |

##### CreditCardData

| Property | Type | | Description |
| --- | --- | --- | --- |
| `PaymentGatewayData` | string | optional | Encoded credit card data obtained from the payment gateway specific library. |
| `ObfuscatedCreditCardNumber` | string | optional | Obfuscated credit card number, e.g. `411111******1111`. |

#### Response

```json
{
    "ReservationGroupId": "f6fa7e62-eb22-4176-bc49-e521d0524dee",
    "CustomerId": "7ac6ca0d-7c08-4ab1-8da8-9b44979d8855",
    "Reservations": [
        {
            "Id": "123456ec-a59d-43f1-9d97-d6c984764e8c",
            "RoomCategoryId": "4037c0ec-a59d-43f1-9d97-d6c984764e8c",
            "StartUtc": "2015-01-01T00:00:00Z",
            "EndUtc": "2015-01-03T00:00:00Z",
            "RateId": "c1d48c54-9382-4ceb-a820-772bf370573d",
            "Rate": {
                "Id": "c1d48c54-9382-4ceb-a820-772bf370573d",
                "Name": {
                    "en-US": "Rate"
                },
                "Description": {
                    "en-US": "Best rate available."
                },
            },
            "AdultCount": 3,
            "ChildCount": 0,
            "ProductIds": [
                "d0e88da5-ae64-411c-b773-60ed68954f64"
            ],
            "Notes": "Quiet room please.",
            "Cost": { },
            "Number": "1234"
        }
    ],
    "TotalCost": { }
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `ReservationGroupId` | string | required | Unique identifier of the created reservation group. |
| `CustomerId` | string | required | Unique identifier of customer who created reservation group. |
| `Reservations` | array of [Reservation](#reservation) | required | The created reservations in group. |
| `TotalCost` | [CurrencyValues](#currencyvalues) | required | Total cost of the whole group. |

### Get Reservation Group

#### Request `[PlatformAddress]/api/distributor/v1/reservationGroups/get`

```json
{
    "HotelId": "8dbb4b86-e6c5-4282-a996-e823afeef343",
    "ReservationGroupId": "f6fa7e62-eb22-4176-bc49-e521d0524dee"
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `HotelId` | string | required | Unique identifier of the hotel. |
| `ReservationGroupId` | string | required | Unique identifier of the reservation group. |

#### Response

Same as in [Create Reservation Group](#create-reservation-group).

## Environments

### Test Environment

This environment is meant to be used during implementation of the client applications. We have prepared one hotel where you can fetch availability and create reservation. You can use the following information to access it:

- **Platform Address** - `https://demo.mews.li`
- **Hotel Id** - `3edbe1b4-6739-40b7-81b3-d369d9469c48`

You will also have access into the system so it is possible for you to check whether the reservations sent to the API are correctly posted to the system. To sign into the system, use the following credentials:

- **Address** - `https://demo.mews.li`
- **Email** - `distributor-api@mews.li`
- **Password** - `distributor-api`

### Production Environment

- **Platform Address** - `https://www.mews.li`
- **Hotel Id** - Depends on the hotel, should be provided to you by the hotel administrator.
