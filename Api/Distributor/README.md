# Distributor API (v1)

The Distributor API allows external applications (generally known as booking widgets) to get information about offered rooms and products for given hotel, to check availability of those rooms and finally to create new reservations.

First of all, please have a look at [MEWS API Guidelines](https://github.com/MewsSystems/public/tree/master/Api) which describe general usage guidelines of MEWS APIs.

## Contents

- [Operations](#operations)
    - [Get Hotel Info](#get-hotel-info)
    - [Validate Voucher](#validate-voucher)
    - [Get Availability](#get-availability)
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
    "Languages": [
        {
            "Code": "en-US",
            "Name": "English"
        }
    ],
    "Currencies": [
        {
            "Code": "EUR",
            "Symbol": "€",
            "SymbolIsBehindValue": true,
            "ValueFormat": "#,##0.00 €;-#,##0.00 €"
        }
    ],
    "RoomCategories": [
        {
            "Id": "4037c0ec-a59d-43f1-9d97-d6c984764e8c",
            "Name": {
                "en-US": "Room"
            },
            "Description": {
                "en-US": "Very cozy room with nice bed."
            },
            "ImageIds": [
                "271f3d83-4ea2-4006-baec-065092d11b00"
            ]
        }
    ],
    "Products": [
        {
            "Id": "22923798-1abd-4bad-83cc-87e82f50d1d6",
            "Name": {
                "en-US": "Breakfast"
            },
            "Description": {
                "en-US": "Continental breakfast served in the morning."
            },
            "IncludedByDefault": false,
            "AlwaysIncluded": false
        }
    ],
    "PaymentGateway": null
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Languages` | array of [Language](#language) | required | Languages supported by the hotel. |
| `Currencies` | array of [Currency](#currency) | required | Currencies accepted by hotel. |
| `RoomCategories` | array of [RoomCategory](#roomcategory) | required | All room categories offered by hotel. |
| `Products` | array of [Product](#product) | required | All products orderable with rooms. |
| `PaymentGateway` | one of [PaymentGateway](#paymentgateway) types | optional | Info about payment gateway used by the hotel. |

##### Language

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Code` | string | required | Code of the language in the ISO format. |
| `Name` | string | required | Lozalized name of the language. |

##### Currency

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Code` | string | required | Code of the currency in the ISO format. |
| `Symbol` | string | required | Symbol of the currency. |
| `ValueFormat` | string | required | Format of a currency value (for both positive and negative values, including symbol). |
| `SymbolIsBehindValue` | boolean | required | Indicates whether the symbol stands behind a value in standard formatting. |

##### RoomCategory

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Id` | string | required | Unique identifier of the room category. |
| `Name` | [LocalizedText](#localizedtext) | required | Name of the room category localized into all supported languages. |
| `Description` | [LocalizedText](#localizedtext) | required | Description of the room category localized into all supported languages. |
| `ImageIds` | array of strings | required | Unique identifiers of images attached with the room category. |

##### Product

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Id` | string | required | Unique identifier of the product. |
| `Name` | [LocalizedText](#localizedtext) | required | Name of the product localized into all supported languages. |
| `Description` | [LocalizedText](#localizedtext) | required | Description of the product localized into all supported languages. |
| `IncludedByDefault` | boolean | required | Indicates whether the product should be added to order by default. |
| `AlwaysIncluded` | boolean | required | Indicates whether the product is always included (= cannot be removed). |

##### Payment Gateway

If the hotel does not use any payment gateway, the value is null. If it does, then it is currently one of 3 types of payment gateways. And for each different gateway, different object is returned. The main purpose of a payment gateway is to securely obtain credit card of the customer before a reservation is created. You can decide not to support any of them and just ignore it, in which case reservations are created with note about missing credit card.

###### Mews Payments

| Property | Type | | Description |
| --- | --- | --- | --- |
| `PaymentGatewayType` | string | required | Type of the payment gateway, `MewsPayments` in this case. |

Mews Payments gateway is hosted on our website. After a reservation is created, the customer should be redirected to:

```
https://mews.li/distributor/payment/{reservationGroupId}/{customerId}/?shouldRedirect=true
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

##### LocalizedText

A localized text is an object of texts localized into languages supported by hotel, indexed by language codes.

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
    "VoucherCode": "Discount2042",
    "InformativeCurrencyCode": "CZK"
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `HotelId` | string | required | Unique identifier of hotel. |
| `StartUtc` | string | required | Reservation start date (arrival date) in ISO 8601 format. |
| `EndUtc` | string | required | Reservation end date (departure date) in ISO 8601 format. |
| `ProductIds` | array of string | optional | Ids of products which should be included into pricing calculations. |
| `VoucherCode` | string | optional | Voucher code enabling special rate offerings. |
| `InformativeCurrencyCode` | string | optional | One of the currencies accepted by hotel, in which the pricing will be provided as well (besides the pricing currency). It is considered informative because the value is calculated using hotel conversion rates from the pricing currency. And the value may actually change if the exchange rate changes. |

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
            "RoomOccupancies": [
                {
                    "NormalBedCount": 2,
                    "ExtraBedCount": 1,
                    "AdultCount": 1,
                    "ChildCount": 0,
                    "AvailableRoomCount": 5,
                    "Pricing": [
                        {
                            "RateId": "c1d48c54-9382-4ceb-a820-772bf370573d",
                            "Price": {
                                "Total": {
                                    "CurrencyCode": "USD",
                                    "Value": 200,
                                    "Tax": 0.1,
                                    "TaxValue": 20
                                },
                                "AveragePerNight": {
                                    "CurrencyCode": "USD",
                                    "Value": 100,
                                    "Tax": 0.1,
                                    "TaxValue": 10
                                }
                            },
                            "MaxPrice": { },
                            "InformativePrice": { },
                            "MaxInformativePrice": { }
                        }
                    ]
                },
                {
                    "NormalBedCount": 2,
                    "ExtraBedCount": 1,
                    "AdultCount": 2,
                    "ChildCount": 0,
                    "AvailableRoomCount": 5,
                    "Pricing": [
                        {
                            "RateId": "c1d48c54-9382-4ceb-a820-772bf370573d",
                            "Price": {
                                "Total": {
                                    "CurrencyCode": "USD",
                                    "Value": 250,
                                    "Tax": 0.1,
                                    "TaxValue": 25
                                },
                                "AveragePerNight": {
                                    "CurrencyCode": "USD",
                                    "Value": 125,
                                    "Tax": 0.1,
                                    "TaxValue": 12.5
                                }
                            },
                            "MaxPrice": { },
                            "InformativePrice": { },
                            "MaxInformativePrice": { }
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
| `Rates` | array of [Rate](#rate) | required | List of information about all available rates. |
| `RoomCategoryAvailabilites` | array of [RoomCategoryAvailability](#roomcategoryavailability) | required | Availabilities of each room category. If a room category is not available, it is not included. |

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
| `RoomOccupancyAvailabilities` | array of [RoomOccupancyAvailability](#roomoccupancyavailability) | required | Availabilities of rooms in the cateogry by the room occupancy. |

##### RoomOccupancyAvailability

| Property | Type | | Description |
| --- | --- | --- | --- |
| `NormalBedCount` | int | required | Count of normal beds. |
| `ExtraBedCount` | int | required | Count of extra beds. |
| `AdultCount` | int | required | Count of adults. |
| `ChildCount` | int | required | Count of childs. |
| `AvailableRoomCount` | int | required | Count of the available rooms. |
| `Pricing` | array of [Pricing](#pricing) | required | Pricing information. |

##### Pricing

| Property | Type | | Description |
| --- | --- | --- | --- |
| `RateId` | string | required | Unique identifier of a rate. |
| `Price` | [RoomPrice](#roomprice) | required | Price of the room. |
| `MaxPrice` | [RoomPrice](#roomprice) | required | Max price of the room with the same parameters and conditions. Can be displayed as a value before discount. |
| `InformativeCurrencyPrice` | [RoomPrice](#roomprice) | optional | Price of the room in the informative currency. |
| `MaxInformativeCurrencyPrice` | [RoomPrice](#roomprice) | optional | Max price of the room in the informative currency. |

##### RoomPrice

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Total` | [CurrencyValue](#currencyvalue) | required | Total price of the room for whole reservation. |
| `AveragePerNight` | [CurrencyValue](#currencyvalue) | required | Average night price. |

##### CurrencyValue

| Property | Type | | Description |
| --- | --- | --- | --- |
| `CurrencyCode` | string | required | Currency code. |
| `Value` | decimal | required | Value. |
| `Tax` | int | optional | Tax rate (between 0.0 and 1.0). |
| `TaxValue` | decimal | optional | Value of the tax. |

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
        "CountryCode": ""
    },
    "ReservationOrders": [{
        "RoomCategoryId": "4037c0ec-a59d-43f1-9d97-d6c984764e8c",
        "StartUtc": "2015-01-01T00:00:00Z",
        "EndUtc": "2015-01-03T00:00:00Z",
        "RateId": "c1d48c54-9382-4ceb-a820-772bf370573d",
        "AdultCount": 3,
        "ChildCount": 0,
        "ProductIds": ["d0e88da5-ae64-411c-b773-60ed68954f64"],
        "Notes": ""
    }],
    "CreditCardData": {
        "PaymentGatewayData": "...",
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
        "Rate": {},
        "Cost": {},
        "Number": ""
    }],
    "TotalCost": {}
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `ReservationGroupId` | string | required | Unique identifier of reservation group. |
| `CustomerId` | string | required | Unique identifier of customer who created reservation group. |
| `Reservations` | array of [Reservation](#reservation) | required | List of reservations in group. |

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
| `HotelId` | string | required | Unique identifier of hotel. |
| `ReservationGroupId` | string | required | Unique identifier of reservation group. |

#### Response

Same as in [Create Reservation Group](#create-reservation-group).

### Get Braintree Client Token

Braintree requires a special client token generated for each transaction. In case you use Braintree as payment gateway, you need to obtain it to before processing payment. 

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

## Environments

#### Test Environment

TODO, fbcebd3d-0ff6-4545-b5cf-c7933d11a3a0

#### Production Environment

- **Platform Address** - `https://www.mews.li/api/distributor/v1`
- **Hotel Id** - Depends on the hotel, should be provided to you by the hotel administrator.
