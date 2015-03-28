# Distributor API (v1)

The Distributor API allows external applications to get information about offered rooms and products for given hotel, to check availability of those rooms for given dates interval and finally to create reservations for those selected.

## Contents

- [Overview](#overview)
    - [Requests](#requests)
    - [Responses](#responses)
    - [Payment Gateways](#responses)
- [API Calls](#api-calls)
    - [Get Hotel Info](#get-hotel-info)
    - [Validate Voucher](#validate-voucher)
    - [Get Availability](#get-availability)
    - [Create Reservation Group](#create-reservation-group)
    - [Get Reservation Group](#get-reservation-group)
    - [Get Braintree Client Token](#get-braintree-client-token)
- [Environments](#environments)
    - [Test Environment](#test-environment)
    - [Production Environment](#production-environment)
- [Use Case](#use-case)

## Overview

### Requests

In order to use the API, the client needs to know the **API base address** and an **hotel id**. Base address depends on the used environment, for further information see section [Environments](#environments). Hotel id can be obtained in Commander from url of hotel's detail page (under Settings > "Your hotel's name" ). The url is `https://mews.li/Employees/Hotel/Detail/{hotelId}` and guid is the last part of it, i.e. 64ab5cc6-ef1f-4b1d-a421-1b5833645ce4. 
The API accepts only HTTP POST requests with `Content-Type` set to `application/json`.

### Responses

The API responds with `Content-Type` set to `application/json` and JSON content. In case of success, the HTTP status code is 200 and the content contains result according to the call. In case of error, there are multiple HTTP status codes for different types of errors:

- **400 Bad Request** - Error caused by the client, e.g. in case of malformed request.
- **403 Forbidden** - Server error that should be reported to the user of the client app. E.g. when creating a reservation that exceeds hotel's availability.
- **500 Internal Server Error** - Unexpectced error of the server.

In case of any error, the returned JSON object describes the error and has the following properties:

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Message` | string | required | Description of the error. |
| `Details` | string | optional | Additional details about the error (server stack trace, inner exceptions). Only available on development environment. |

### Payment Gateways

There are currently 3 payment gateways supported by Distributor API. None of them charges customer upon creating reservation, they only serves as secure way to collect information about their credit card. You can decide to use none of them, in which case reservation are created with note about missing credit card.

#### Mews Payment

Mews Payment is hosted on our website. The url to which redirect is created like this:

```
https://mews.li/distributor/payment/{reservationGroupId}/{customerId}/?shouldRedirect=true
```

Both parameters are obtained as result of [Create Reservation Group](#create-reservation-group) API call.

#### Braintree

#### Adyen

## API Calls

### Get Hotel Info

Initial call used to obtain all static data about hotel.

#### Request `<ApiBase>/hotels/getById`

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
    "RoomCategories": [{
        "Id": "4037c0ec-a59d-43f1-9d97-d6c984764e8c",
        "Name": {
            "en-US": "Room",
            ...
        },
        "Description": {
            "en-US": "Very cozy room with nice bed.",
            ...
        },
        "ImageIds": ["271f3d83-4ea2-4006-baec-065092d11b00", ...]
    },
    ...
    ],
    "Products": [{
        "Id": "22923798-1abd-4bad-83cc-87e82f50d1d6",
        "Name": {
            "en-US": "Breakfast",
            ...
        },
        "Description": {
            "en-US": "Continental breakfast served in the morning.",
            ...
        },
        "IncludedByDefault": false,
        "AlwaysIncluded": false
    }],
    "Currencies": [{
        "Code": "USD",
        "Symbol": "$",
        "ValueFormat": "...",
        "SymbolIsBehindValue": false,
    }],
    "Languages": [{
        "Code": "en-US",
        "Name": "English"
    }],
    "PaymentGateway": {
        ...
    }
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `RoomCategories` | array of [RoomCategory](#room-category) | required | All room categories offered by hotel. |
| `Products` | array of [Product](#product) | required | All products orderable with rooms. |
| `Currencies` | array of [Currency](#currency) | required | Currencies accepted by hotel. |
| `Languages` | array of [Language](#language) | required | Languages in which are texts provided by hotel translated. |
| `PaymentGateway` | one of [PaymentGateway](#payment-gateway) types | optional | Info about used payment gateway if any set. |

##### RoomCategory

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Id` | string | required | Unique identifier of the room category. |
| `Name` | [LocalizedText](#localized-text) | required | Name of the room category localized into all supported languages. |
| `Description` | [LocalizedText](#localized-text) | required | Description of the room category localized into all supported languages. |
| `ImageIds` | array of strings | required | Unique identifiers of images attached with the room category. |

##### Product

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Id` | string | required | Unique identifier of the product. |
| `Name` | [LocalizedText](#localized-text) | required | Name of the product localized into all supported languages. |
| `Description` | [LocalizedText](#localized-text) | required | Description of the product localized into all supported languages. |
| `IncludedByDefault` | boolean | required | Indicates whether the product should be added to order by default. |
| `AlwaysIncluded` | boolean | required | Indicates whether the product can be removed from order. |

##### Currency

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Code` | string | required | Code of the currency in the ISO format. |
| `Symbol` | string | required | Symbol for a value in the currency. |
| `ValueFormat` | string | required | ... |
| `SymbolIsBehindValue` | boolean | required | Indicates whether the currency symbol stands behind a value in standard formatting. |

##### Language

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Code` | string | required | Code of the language in the ISO format. |
| `Name` | string | required | Lozalized name of the language. |

##### Paymengt Gateway

There are currently 3 types of payment gateways and for each different informations are send.

###### Mews Payment

| Property | Type | | Description |
| --- | --- | --- | --- |
| `PaymentGatewayType` | string | required | Value is "MewsPayment". |

###### Braintree

| Property | Type | | Description |
| --- | --- | --- | --- |
| `PaymentGatewayType` | string | required | Value is "Braintree". |
| `MerchantId` | string | required | Braintree MerchantId. |
| `ClientKey` | string | required | Braintree ClientKey. |

###### Adyen

| Property | Type | | Description |
| --- | --- | --- | --- |
| `PaymentGatewayType` | string | required | Value is "Adyen". |
| `PublicKey` | string | required | Adyen PublicKey. |

##### Localized Text

A localized text is an object of texts localized into languages supported by hotel, indexed by appropriate language codes.

### Validate Voucher

Used for validating voucher codes.

#### Request `<ApiBase>/voucher/validate`

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
| `IsValid` | boolean | required | Indicates whether is the voucher code valid. |

### Get Availability

Gives availabilities and pricings for given dates interval with product prices included for each room category. Categorized by applicable rates and person counts from 1 to full room. If room category is not available, it is left out from response. 

#### Request `<ApiBase>/availability/get`

```json
{
    "HotelId": "8dbb4b86-e6c5-4282-a996-e823afeef343",
    "StartUtc": "2015-01-01T00:00:00Z",
    "EndUtc": "2015-01-03T00:00:00Z",
    "ProductIds": ["d0e88da5-ae64-411c-b773-60ed68954f64", ...],
    "VoucherCode": "Discount2042",
    "InformativeCurrencyCode": "CZK"
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `HotelId` | string | required | Unique identifier of hotel. |
| `StartUtc` | string | required | Start date of the interval in ISO 8601 format. |
| `EndUtc` | string | required | End date of the interval in ISO 8601 format. |
| `ProductIds` | array of string | optional | Ids of products which should be included into pricing calculations. |
| `VoucherCode` | string | optional | Code of voucher for showing special rates. |
| `InformativeCurrencyCode` | string | optional | Code of one of hotel's accepted currencies in ISO format for including prices in that currency, based on hotel's conversion rate. |

#### Response

```json
{
    "Rates": [{
        "Id": "c1d48c54-9382-4ceb-a820-772bf370573d",
        "Name": {
            "en-US": "Rate",
            ...
        },
        "Description": {
            "en-US": "Best rate available.",
            ...
        },
    },
    ...
    ],
    "RoomCategoryAvailabilities": [{
        "RoomCategoryId": "4037c0ec-a59d-43f1-9d97-d6c984764e8c",
        RoomOccupancies: [{
            "NormalBedCount": 2,
            "ExtraBedCount": 1,
            "AdultCount": 1,
            "ChildCount": 0,
            "AvailableRoomCount": 5,
            "Pricing": [{
                "RateId": "c1d48c54-9382-4ceb-a820-772bf370573d",
                "Price": {
                    "Total": {
                        "Value": 200,
                        "Tax": 20,
                        "TaxRatio": 0.1,
                        "CurrencyCode": "USD"
                    },
                    "AveragePerNight": {
                        "Value": 100,
                        "Tax": 10,
                        "TaxRatio": 0.1,
                        "CurrencyCode": "USD"
                    }
                },
                "MaxPrice": ...
                "InformativePrice": ...
                "MaxInformativePrice": ...
            },
            ...
            ]
        },
        {
            "NormalBedCount": 2,
            "ExtraBedCount": 1,
            "AdultCount": 2,
            "ChildCount": 0,
            "AvailableRoomCount": 5,
            "Pricing": [{
                "RateId": "c1d48c54-9382-4ceb-a820-772bf370573d",
                "Price": {
                    "Total": {
                        "Value": 250,
                        "Tax": 25,
                        "TaxRatio": 0.1,
                        "CurrencyCode": "USD"
                    },
                    "AveragePerNight": {
                        "Value": 125,
                        "Tax": 12.5,
                        "TaxRatio": 0.1,
                        "CurrencyCode": "USD"
                    }
                },
                "MaxPrice": ...
                "InformativePrice": ...
                "MaxInformativePrice": ...
            },
            ...
            ]
        },
        ]
    },
    ...
    ]
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Rates` | array of [Rate](#rate) | required | List of informations about all showed rates. |
| `RoomCategoryAvailabilites` | array of [RoomCategoryAvailability](#roomcategoryavailability) | required | List of availability of each room category. If a room category is not available, it is not included. |

##### Rate

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Id` | string | required | |
| `Name` | [LocalizedText](#localized-text) | required | |
| `Description` | [LocalizedText](#localized-text) | required | |

##### Room Category Availability

| Property | Type | | Description |
| --- | --- | --- | --- |
| `RoomCategoryId` | string | required | |
| `RoomOccupancies` | array of [RoomOccupancy](#room-occupancy) | required | |

##### Room Occupancy

| Property | Type | | Description |
| --- | --- | --- | --- |
| `NormalBedCount` | int | required | |
| `ExtraBedCount` | int | required | |
| `AdultCount` | int | required | |
| `ChildCount` | int | required | |
| `AvailableRoomCount` | int | required | |
| `Pricing` | array of [Pricing](#pricing) | required | |

##### Pricing

| Property | Type | | Description |
| --- | --- | --- | --- |
| `RateId` | string | required | |
| `Price` | [RoomPrice](#roomprice) | required | |
| `MaxPrice` | [RoomPrice](#roomprice) | required | |
| `InformativeCurrencyPrice` | [RoomPrice](#roomprice) | required | |
| `MaxInformativeCurrencyPrice` | [RoomPrice](#roomprice) | required | |

##### RoomPrice

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Total` | [CurrencyValue](#currencyvalue) | required | |
| `AveragePerNight` | [CurrencyValue](#currencyvalue) | required | |

##### CurrencyValue

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Value` | int | required | |
| `CurrencyCode` | string | required | |
| `TaxRatio` | double | optional | |
| `Tax` | int | optional | |

### Create Reservation Group
#### Request `<ApiBase>/reservationGroup/create`

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
        "CountryCode": ""
    },
    "ReservationOrders": [{
        "RoomCategoryId": "4037c0ec-a59d-43f1-9d97-d6c984764e8c",
        "StartUtc": "2015-01-01T00:00:00Z",
        "EndUtc": "2015-01-03T00:00:00Z",
        "RateId": "c1d48c54-9382-4ceb-a820-772bf370573d",
        "AdultCount": 3,
        "ChildCount": 0,
        "ProductIds": ["d0e88da5-ae64-411c-b773-60ed68954f64", ...],
        "Notes": ""
    },
    ...
    ],
    "CreditCardData": {
        "PaymentGatewayData": "..."
        "ObfuscatedCreditCardNumber": "..."
    }
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `HotelId` | string | required | Unique identifier of hotel. |
| `Customer` | [Customer](#customer) | required | |
| `ReservationOrders` | array of [Reservation](#reservation) | required | |
| `CreditCardData` | array of [CreditCardData](#creditcarddata) | required | |

##### Customer

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Email` | string | required | |
| `FirstName` | string | required | |
| `LastName` | string | required | |
| `Telephone` | string | optional | |
| `AddressLine1` | string | optional | |
| `AddressLine2` | string | optional | |
| `City` | string | optional | |
| `PostalCode` | string | optional | |
| `StateCode` | string | optional | |
| `CountryCode` | string | optional | |

##### Reservation

| Property | Type | | Description |
| --- | --- | --- | --- |
| `RoomCategoryId` | string | required | |
| `StartUtc` | string | required | |
| `EndUtc` | string | required | |
| `RateId` | string | required | |
| `AdultCount` | string | required | |
| `ChildCount` | string | required | |
| `ProductIds` | array of string | optional | |
| `Notes` | string | optional | |

##### CreditCardData

| Property | Type | | Description |
| --- | --- | --- | --- |
| `PaymentGatewayData` | string | optional | |
| `ObfuscatedCreditCardNumber` | string | optional | |

#### Response

```json
{
    "ReservationGroupId": "f6fa7e62-eb22-4176-bc49-e521d0524dee",
    "CustomerId": "7ac6ca0d-7c08-4ab1-8da8-9b44979d8855",
    "Reservations": [{
        "Id": "",
        "Rate": ...,
        "Cost": ...,
        "Number": "",
        ...
    }],
    "TotalCost": ...
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `ReservationGroupId` | string | required | Unique identifier of reservation group. |
| `CustomerId` | string | required | Unique identifier of customer who created reservation group. |
| `Reservations` | array of [Reservation](#reservation) | required | List of reservations in group. |

### Get Reservation Group

#### Request `<ApiBase>/payments/getBraintreeClientToken`

```json
{
    "HotelId": "8dbb4b86-e6c5-4282-a996-e823afeef343",
    "ReservationGroupId": "f6fa7e62-eb22-4176-bc49-e521d0524dee"
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `HotelId` | string | required | Unique identifier of hotel. |
| `ReservationGroupId` | string | required | Unique identifier of reservation group. |

#### Response

Same as in [Create Reservation Group](#create-reservation-group).

### Get Braintree Client Token

Braintree requires a special client token generated for each transaction. In case you use Braintree as payment gateway, you need to obtain it to before processing payment. 

#### Request `<ApiBase>/hotels/getById`

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
    "BraintreeClientToken": "..."
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `BraintreeClientToken` | string | required | Braintree client token generated on server. |

## Environments

#### Production Environment

- **API Base Address** - `https://www.mews.li/api/distributor/v1`
