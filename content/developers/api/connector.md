---
title: Connector API (v1)
---

The Connector API allows external applications to mediate communication between devices that or accessible over local network on the hotel site and the MEWS. There may be several types of connector clients. For example a client that would fetch device commands from the MEWS, execute them on physical devices that are locally accessible and send the command results back to MEWS. Or different client can retrieve some information from MEWS and forward the data to some other system (e.g. heating system, lock system).

First of all, please have a look at [API Guidelines](../api.html) which describe general usage guidelines of MEWS APIs.

## Contents

- [Authorization](#authorization)
- [Operations](#operations)
    - [Sign in](#sign-in)
    - [Get All Spaces](#get-all-spaces)
    - [Get All Reservations](#get-all-reservations)
    - [Start Reservation](#start-reservation)
    - [Process Reservation](#process-reservation)
    - [Cancel Reservation](#cancel-reservation)
    - [Get Customer Balance](#get-customer-balance)
    - [Get Customers Open Items](#get-customers-open-items)
    - [Update Customer](#update-customer)
    - [Add Credit Card Payment](#add-credit-card-payment)
    - [Add Task](#add-task)
    - [Get All Commands](#get-all-commands)
    - [Update Command](#update-command)
    - [Devices](#devices)
- [Environments](#environments)
    - [Demo Environment](#demo-environment)
    - [Production Environment](#production-environment)

## Authorization

All operations of the API require `AccessToken` to be present in the request. In production environment, the `Token` will be provided to you by the hotel admin. For development purposes, consult the  [Demo Environment](#demo-environment) section.

The API also supports more advanced scenario with session management, which makes it simple to ensure that only one client is active at a time. That is particulary useful if the client communicates with a physical device that does not support parallel connections/communication. For more information, see the [Sign in](#sign-in) operation.

## Operations

### Sign in

Signs in the client application to MEWS using a token that you would normally use as the `AccessToken` in all operations as described in [Authorization](#authorization) section. Returns a new `AccessToken` that should be passed to all other operations. Note that the returned `AccessToken` has limited validity - only until next successful sign in operation. After that, the `AccessToken` returned by the first sign in operation is no longer valid. As a consequence, there is always at most one client with valid `AccessToken`, i.e. the client that signed in last.

#### Request `[PlatformAddress]/api/connector/v1/app/signIn`

```json
{
    "ConnectorToken": "C66EF7B239D24632943D115EDE9CB810-EA00F8FD8294692C940F6B5A8F9453D"
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `ConnectorToken` | string | required | Unique token identifying the client application. Can be obtained from MEWS from enterprise settings. |

#### Response

```json
{
    "AccessToken": "210F2620DDAE4A988D26DEB3A5B75B2F-77EB7EA147D2EAB4863054EB85FFACE",
    "Enterprise": 
    {
        "Id": "222b5d8a-0492-4271-9941-cd6d89b81d43",
        "Name": "Test Hotel"
    }
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `AccessToken` | string | required | An access token representing the client application session. |
| `Enterprise` | [Enterprise](#enterprise) | required | Enterprise whose data the connector client handles. |


##### Enterprise

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Id` | string | required | Unique identifier of the enterprise. |
| `Name` | string | required | Name of the enterprise. |

### Get All Spaces

Returns all spaces of an enterprise associated with the connector integration.

#### Request `[PlatformAddress]/api/connector/v1/spaces/getAll`g

```json
{
    "AccessToken": "C66EF7B239D24632943D115EDE9CB810-EA00F8FD8294692C940F6B5A8F9453D"
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `AccessToken` | string | required | Access token of the client application. |

#### Response

```json
{
    "Spaces": [
        {
            "Id": "5ee074b1-6c86-48e8-915f-c7aa4702086f",
            "Type": "Room",
            "Number": "101",
            "ParentSpaceId": null,
            "CategoryId": "aaed6e21-1c1f-4644-9872-e53f96a21bf9",
            "State": "Dirty"
        },
        {
            "Id": "c32386aa-1cd2-414a-a823-489325842fbe",
            "Type": "Room",
            "Number": "102",
            "ParentSpaceId": null,
            "CategoryId": "aaed6e21-1c1f-4644-9872-e53f96a21bf9",
            "State": "Clean"
        }
    ],
    "SpaceCategories": [
        {
            "Id": "aaed6e21-1c1f-4644-9872-e53f96a21bf9",
            "Name": "Best Room",
            "ShortName": "BR"
        }
    ]
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Spaces` | array of [Space](#space) | required | The spaces of the enterprise. |
| `SpaceCategories` | array of [Space Category](#space-category) | required | Categories of spaces in the enterprise. |

##### Space

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Id` | string | required | Unique identifier of the space. |
| `Type` | string | required | Type of the space. For example `Room`, `Dorm` or `Bed`. Other types might be added in the future. |
| `Number` | string | required | Number of the space (e.g. room number). |
| `ParentSpaceId` | string | optional | Identifier of the parent space (e.g. room of a bed). |
| `CategoryId` | string | required | Identifier of the cateogory assigned to the space. |
| `State` | string [Space State](#space-state) | required | State of the room. |

##### Space State

- `Dirty`
- `Clean`
- `Inspected`
- `OutOfService`
- `OutOfOrder`

##### Space Category

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Id` | string | required | Unique identifier of the category. |
| `Name` | string | required | Name of the category. |
| `ShortName` | string | optional | Short name (e.g. code) of the category. |

### Get All Reservations

Returns all reservations that collide with the specified interval.

#### Request `[PlatformAddress]/api/connector/v1/reservations/getAll`

```json
{
    "AccessToken": "C66EF7B239D24632943D115EDE9CB810-EA00F8FD8294692C940F6B5A8F9453D",
    "StartUtc": "2016-01-01T00:00:00Z",
    "EndUtc": "2016-01-07T00:00:00Z"
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `AccessToken` | string | required | Access token of the client application. |
| `StartUtc` | string | required | Start of the interval in UTC timezone in ISO 8601 format. |
| `EndUtc` | string | required | End of the interval in UTC timezone in ISO 8601 format. |
| `States` | array of string [Reservation State](#reservation-state) | optional | States the reservations should be in. If not specified, reservations in `Confirmed`, `Started` or `Processed` states are returned. |

#### Response

```json
{
    "ReservationGroups": [
        {
            "Id": "c704dff3-7811-4af7-a3a0-7b2b0635ac59",
            "Name": "13-12-Smith-F712"
        }
    ],
    "Reservations": [
        {
            "AdultCount": 2,
            "AssignedSpaceId": "20e00c32-d561-4008-8609-82d8aa525714",
            "BusinessSegmentId": null,
            "ChannelManagerId": null,
            "ChannelNumber": null,
            "ChildCount": 0,
            "Companions": [
                {
                    "Address": {
                        "City": null,
                        "CountryCode": null,
                        "Line1": null,
                        "Line2": null,
                        "PostalCode": null
                    },
                    "BirthDateUtc": null,
                    "CategoryId": null,
                    "Email": null,
                    "FirstName": "John",
                    "Gender": null,
                    "Id": "35d4b117-4e60-44a3-9580-c582117eff98",
                    "LastName": "Smith",
                    "NationalityCode": "US",
                    "Phone": "00420123456789",
                    "Title": null
                }
            ],
            "CompanyId": null,
            "CreatedUtc": "2016-02-20T14:58:02Z",
            "Customer": {
                "Address": {
                    "City": null,
                    "CountryCode": null,
                    "Line1": null,
                    "Line2": null,
                    "PostalCode": null
                },
                "BirthDateUtc": null,
                "CategoryId": null,
                "Email": null,
                "FirstName": "John",
                "Gender": null,
                "Id": "35d4b117-4e60-44a3-9580-c582117eff98",
                "LastName": "Smith",
                "NationalityCode": "US",
                "Phone": "00420123456789",
                "Title": null
            },
            "EndUtc": "2016-02-22T11:00:00Z",
            "GroupId": "94843f6f-3be3-481b-a1c7-06458774c3df",
            "Id": "bfee2c44-1f84-4326-a862-5289598f6e2d",
            "Number": "52",
            "RateId": "ed4b660b-19d0-434b-9360-a4de2ea42eda",
            "RequestedCategoryId": "773d5e42-de1e-43a0-9ce6-f940faf2303f",
            "StartUtc": "2016-02-20T13:00:00Z",
            "State": "Processed",
            "TravelAgencyId": null,
            "UpdatedUtc": "2016-02-20T14:58:02Z"
        }
    ]
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Reservations` | array of [Reservation](#reservation) | required | The reservations that collide with the specified interval. |
| `ReservationGroups` | array of [ReservationGroup](#reservationgroup) | required | Reservation groups that the reservations are members of. |

##### Reservation

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Id` | string | required | Unique identifier of the reservation. |
| `GroupId` | string | required | Unique identifier of the reservation group. |
| `Number` | string | required | Confirmation number of the reservation. |
| `ChannelNumber` | string | optional | Confirmation number of the reservation within a channel in case the reservation originates there (e.g. Booking.com confirmation number). |
| `ChannelManagerId` | string | optional | Identifier of the reservation within a channel manager in case the reservation came through it (e.g. Siteminder identifier). |
| `State` | string [Reservation State](#reservation-state) | required | State of the reservation. |
| `CreatedUtc` | string | required | Creation date and time of the reservation in UTC timezone in ISO 8601 format. |
| `UpdatedUtc` | string | required | Last update date and time of the reservation in UTC timezone in ISO 8601 format. |
| `StartUtc` | string | required | Start of the reservation (arrival) in UTC timezone in ISO 8601 format. |
| `EndUtc` | string | required | End of the reservation (departure) in UTC timezone in ISO 8601 format. |
| `RequestedCategoryId` | string | required | Identifier of the requested space category. |
| `AssignedSpaceId` | string | optional | Identifier of the assigned space. |
| `BusinessSegmentId` | string | optional | Identifier of the reservation business segment. |
| `CompanyId` | string | optional | Identifier of the company on behalf of which the reservation was made. |
| `TravelAgencyId` | string | optional | Identifier of the travel agency that mediated the reservation. |
| `RateId` | string | required | Identifier of the reservation rate. |
| `AdultCount` | number | required | Count of adults the reservation was booked for. |
| `ChildCount` | number | required | Count of children the reservation was booked for. |
| `Customer` | [Customer](#customer) | required | Owner of the reservation. |
| `Companions` | array of [Customer](#customer) | required | Customers that will occupy the space. |

##### Reservation State

- `Enquired` - Confirmed neither by the customer or enterprise.
- `Requested` - Confirmed by the customer but not by the enterprise (waitlist).
- `Optional` - Confirmed by enterprise but not by the guest (the enterprise is holding space for the guest).
- `Confirmed` - Confirmed by both parties, before check-in.
- `Started` - Checked in.
- `Processed` - Checked out.
- `Canceled` - Canceled, not active anymore.

##### Customer

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Id` | string | required | Unique identifier of the customer. |
| `FirstName` | string | optional | First name of the customer. |
| `LastName` | string | required | Last name of the customer. |
| `Title` | string [Title](#title) | optional | Title prefix of the customer. |
| `Gender` | string [Gender](#gender) | optional | Gender of the customer. |
| `NationalityCode` | string | optional | ISO 3166-1 alpha-2 country code (two letter country code) of the nationality. |
| `BirthDateUtc` | string | optional | Date of birth in UTC timezone in ISO 8601 format. |
| `Email` | string | optional | Email address of the customer. |
| `Phone` | string | optional | Phone number of the customer (possibly mobile). |
| `CategoryId` | string | optional | Unique identifier of the customer category. |
| `Address` | [Address](#address) | required | Address of the customer. |
| `Passport` | [Document](#document) | optional | Passport details of the customer. |

##### Title

- `Mister`
- `Miss`
- `Misses`

##### Gender

- `Male`
- `Female`

##### Address

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Line1` | string | optional | First line of the address. |
| `Line2` | string | optional | Second line of the address. |
| `City` | string | optional | The city. |
| `PostalCode` | string | optional | Postal code. |
| `CountryCode` | string | optional | ISO 3166-1 alpha-2 country code (two letter country code). |

##### Document

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Number` | string | optional | Number of the document (e.g. passport number). |
| `ExpirationUtc` | string | optional | Expiration date in UTC timezone in ISO 8601 format. |

##### ReservationGroup

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Id` | string | required | Unique identifier of the reservation group. |
| `Name` | string | optional | Name of the reservation group, might be empty or same for multiple groups. |

### Start Reservation

Marks a reservation as `Started` (= checked in). Succeeds only if all starting conditions are met (the reservation has the `Confirmed` state, does not have start set to future, has an inspected room assigned etc).

#### Request `[PlatformAddress]/api/connector/v1/reservations/start`

```json
{
    "AccessToken": "C66EF7B239D24632943D115EDE9CB810-EA00F8FD8294692C940F6B5A8F9453D",
    "ReservationId": "e6ea708c-2a2a-412f-a152-b6c76ffad49b"
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `AccessToken` | string | required | Access token of the client application. |
| `ReservationId` | string | required | Unique identifier of the reservation to start. |

#### Response

Empty object.

### Process Reservation

Marks a reservation as `Processed` (= checked out). Succeeds only if all processing conditions are met (the reservation has the `Started` state, all customer bills are closed etc).

#### Request `[PlatformAddress]/api/connector/v1/reservations/process`

```json
{
    "AccessToken": "C66EF7B239D24632943D115EDE9CB810-EA00F8FD8294692C940F6B5A8F9453D",
    "ReservationId": "e6ea708c-2a2a-412f-a152-b6c76ffad49b"
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `AccessToken` | string | required | Access token of the client application. |
| `ReservationId` | string | required | Unique identifier of the reservation to process. |

#### Response

Empty object.

### Cancel Reservation

Cancels a reservation. Succeeds only if the reservation is cancellable

#### Request `[PlatformAddress]/api/connector/v1/reservations/cancel`

```json
{
    "AccessToken": "C66EF7B239D24632943D115EDE9CB810-EA00F8FD8294692C940F6B5A8F9453D",
    "ReservationId": "e6ea708c-2a2a-412f-a152-b6c76ffad49b",
    "ChargeCancellationFee": true,
    "Notes": "Cancellation through Connector API"
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `AccessToken` | string | required | Access token of the client application. |
| `ReservationId` | string | required | Unique identifier of the reservation to cancel. |
| `ChargeCancellationFee` | boolean | required | Whether cancellation fees should be charged according to rate conditions. |
| `Notes` | string | required | Addiotional notes describing the cancellation. |

#### Response

Empty object.

### Get Customer Balance

Returns current open balance of a customer. If the balance is positive, the customer has some unpaid items. Otherwise the customer does not owe anything to the hotel at the moment.

#### Request `[PlatformAddress]/api/connector/v1/customers/getBalance`

```json
{
    "AccessToken": "C66EF7B239D24632943D115EDE9CB810-EA00F8FD8294692C940F6B5A8F9453D",
    "CustomerId": "2a1a4315-7e6f-4131-af21-402cec59b8b9"
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `AccessToken` | string | required | Access token of the client application. |
| `CustomerId` | string | required | Unique identifier of the customer. |

#### Response

```json
{
    "Currency": "EUR",
    "Tax": null,
    "TaxRate": null,
    "Value": 100
}
```

##### Currency Value

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Currency` | string | required | ISO-4217 currency code, e.g. `EUR` or `USD`. |
| `Value` | number | required | Amount in the currency (including tax if taxed). |
| `TaxRate` | number | optional | Tax rate in case the item is taxed (e.g. `0.21`). |
| `Tax` | number | optional | Tax value in case the item is taxed. |

### Get Customers Open Items

Returns all open items of the specified customers, i.e. all unpaid items and all deposited payments. Sum of the open items is the balance of the customer.

#### Request `[PlatformAddress]/api/connector/v1/customers/getOpenItems`

```json
{
    "AccessToken": "C66EF7B239D24632943D115EDE9CB810-EA00F8FD8294692C940F6B5A8F9453D",
    "CustomerIds": [
        "2a1a4315-7e6f-4131-af21-402cec59b8b9"
    ]
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `AccessToken` | string | required | Access token of the client application. |
| `CustomerIds` | array of string | required | Unique identifiers of the customers. |

#### Response

```json
{
    "Customers": [
        {
            "CustomerId": "2a1a4315-7e6f-4131-af21-402cec59b8b9",
            "Items": [
                {
                    "AccountingCategoryId": "12345678-7e6f-4131-af21-402cec59b8b9",
                    "Amount": {
                        "Currency": "EUR",
                        "Tax": null,
                        "TaxRate": null,
                        "Value": -100
                    },
                    "ConsumptionUtc": "2016-05-25T15:56:54Z",
                    "Id": "79aa7645-fe3a-4e9e-9311-e11df4686fca",
                    "Name": "Cash Payment EUR",
                    "OrderId": null
                },
                {
                    "AccountingCategoryId": "12345678-7e6f-4131-af21-402cec59b8b9",
                    "Amount": {
                        "Currency": "GBP",
                        "Tax": 3.33,
                        "TaxRate": 0.2,
                        "Value": 20
                    },
                    "ConsumptionUtc": "2016-02-20T13:00:00Z",
                    "Id": "e90126c9-afa4-4f95-bfff-b875ecfe900f",
                    "Name": "Night 2/20/2016",
                    "OrderId": "bfee2c44-1f84-4326-a862-5289598f6e2d"
                }
            ]
        }
    ]
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Customers` | array of [Customer Items](#customer-items) | required | The customers with their items. |

##### Customer Items

| Property | Type | | Description |
| --- | --- | --- | --- |
| `CustomerId` | string | required | Unique identifier of the customer. |
| `Items` | array of [Item](#item) | required | The open items. |

##### Item

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Id` | string | required | Unique identifier of the item. |
| `OrderId` | string | optional | Unique identifier of the order (or reservation) the item belongs to. |
| `AccountingCategoryId` | string | optional | Unique identifier of the accounting category the item belongs to. |
| `Name` | string | required | Name of the item. |
| `ConsumptionUtc` | string | required | Date and time of the item consumption in UTC timezone in ISO 8601 format. |
| `Amount` | [Currency Value](#currency-value) | required | Amount the item costs, negative amount represents either rebate or a payment. |

### Update Customer

Updates personal information of a customer. Note that all fields should be provided in the update request, leaving some of them empty would cause them to be cleared (deleting some information is considered a valid update). So if e.g. only last name should be updated and all other should remain the same, the request has to contain the new last name but all other fields have to be filled with the values received from the server.

When it comes to dates provided by customer (e.g. birth date or passport expiration), they are all represented as dates in UTC timezone with time set to 12:00. That ensures that the date won't change no matter the timezone it is converted to. Practically it would be too complicated to obtain the timezone (e.g. timezone of place of birth or timezone of passport issuance) if we wanted to represent exact date and time in UTC.

#### Request `[PlatformAddress]/api/connector/v1/customers/update`

```json
{
    "AccessToken": "C66EF7B239D24632943D115EDE9CB810-EA00F8FD8294692C940F6B5A8F9453D",
    "CustomerId": "35d4b117-4e60-44a3-9580-c582117eff98",
    "FirstName": "John",
    "LastName": "Smith",
    "Phone": "00420123456789",
    "NationalityCode": "US",
    "BirthDateUtc": "2000-01-01T12:00:00Z",
    "Passport": {
        "Number": "123456",
        "ExpirationUtc": "2020-01-01T12:00:00Z"
    }
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `AccessToken` | string | required | Access token of the client application. |
| `CustomerId` | string | required | Unique identifier of the customer. |
| `FirstName` | string | optional | New first name. |
| `LastName` | string | required | New last name. |
| `BirthDateUtc` | string | optional | New birth date in UTC timezone in ISO 8601 format. |
| `NationalityCode` | string | optional | ISO 3166-1 alpha-2 country code (two letter country code) of the new nationality. |
| `Phone` | string | optional | New phone number. |
| `Passport` | [Document](#document) | optional | New passport details. |

#### Response

```json
{
    "Address": {
        "City": null,
        "CountryCode": null,
        "Line1": null,
        "Line2": null,
        "PostalCode": null
    },
    "BirthDateUtc": "2000-01-01T12:00:00Z",
    "CategoryId": null,
    "Email": null,
    "FirstName": "John",
    "Gender": null,
    "Id": "35d4b117-4e60-44a3-9580-c582117eff98",
    "LastName": "Smith",
    "NationalityCode": "US",
    "Passport": {
        "Number": "123456",
        "ExpirationUtc": "2020-01-01T12:00:00Z"
    },
    "Phone": "00420123456789",
    "Title": null
}
```

The updated [Customer](#customer) object.

### Add Credit Card Payment

Adds a new credit card payment to a customer. Returns updated balance of the customer.

#### Request `[PlatformAddress]/api/connector/v1/payments/addCreditCard`

```json
{
    "AccessToken": "C66EF7B239D24632943D115EDE9CB810-EA00F8FD8294692C940F6B5A8F9453D",
    "CustomerId": "35d4b117-4e60-44a3-9580-c582117eff98",
    "Amount": { 
        "Currency": "GBP",
        "Value": 100
    },
    "CreditCard": {
        "Type": "Visa",
        "Number": "411111******1111",
        "Expiration": "12/2016",
        "Name": "John Smith"
    },
    "Category": {
        "Code": "CCP"
    },
    "ReceiptIdentifier": "123456",
    "Notes": "Terminal A"
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `AccessToken` | string | required | Access token of the client application. |
| `CustomerId` | string | required | Unique identifier of the customer. |
| `Amount` | [Currency Value](#currency-value) | required | Amount of the credit card payment. |
| `CreditCard` | [Credit Card](#credit-card) | required | Credit card details. |
| `Category` | [Accounting Category](#accounting-category) | optional | Accounting category to be assigned to the payment. |
| `ReceiptIdentifier` | string | optional | Identifier of the payment receipt. |
| `Notes` | string | optional | Additional payment notes. |

##### Credit Card

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Type` | string | required | Type of the credit card, one of: `Visa`, `MasterCard`, `Amex`, `Discover`, `DinersClub`, `Jcb`, `EnRoute`, `Maestro`, `UnionPay`. |
| `Number` | string | required | Obfuscated credit card number. At most first six digits and last four digits can be specified, the digits in between should be replaced with `*`. It is possible to provide even more obfuscated number or just last four digits. **Never provide full credit card number**. For example `411111******1111`. |
| `Expiration` | string | required | Expiration of the credit card in format `MM/YYYY`, e.g. `12/2016` or `04/2017`. |
| `Name` | string | required | Name of the card holder. |

##### Accounting Category

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Code` | string | required | Code of the accounting category in MEWS. |
| `Name` | string | optional | Name of the category, used if no category is matched using the code. |

#### Response

```json
{
    "Currency": "GBP",
    "Tax": null,
    "TaxRate": null,
    "Value": 100
}
```

Balance ([Currency Value](#customer)) of the customer after the payment is posted.

### Add Task

Adds a new task to the enterprise, optionally to a specified department.

#### Request `[PlatformAddress]/api/connector/v1/tasks/add`

```json
{
    "AccessToken": "C66EF7B239D24632943D115EDE9CB810-EA00F8FD8294692C940F6B5A8F9453D",
    "DepartmentId": null,
    "Name": "Test",
    "Description": "Task description",
    "DeadlineUtc": "2016-01-01T14:00:00Z"
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `AccessToken` | string | required | Access token of the client application. |
| `DepartmentId` | string | optional | Unique identifier of the department the task is addressed to. |
| `Name` | string | required | Name (or title) of the task. |
| `Description` | string | optional | Further decription of the task. |
| `DeadlineUtc` | string | required | Deadline of the task in UTC timezone in ISO 8601 format. |

#### Response

Empty object.

### Get All Commands

A device command is in one of the following states:

- `Pending` - A command that is created in MEWS, but not yet received by a client application.
- `Received` - A command received by a client application.
- `Processing` - A command that is being processed.
- `Processed` - A successfully processed command.
- `Cancelled` - A command whose execution has been cancelled before (or during) processing.
- `Error` - A command whose execution was or processing was terminated by an error.

This operation returns all commands the are still active from the client application point of view. That means commands that are in either `Pending` or `Received` state.

#### Request `[PlatformAddress]/api/connector/v1/commands/getAllActive`

```json
{
    "AccessToken": "C66EF7B239D24632943D115EDE9CB810-EA00F8FD8294692C940F6B5A8F9453D"
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `AccessToken` | string | required | Access token of the client application. |

#### Response

```json
{
    "Commands": [
        {
            "Id": "aa20961f-6d9e-4b35-ad25-071213530aec",
            "State": "Pending",
            "CreatedUtc": "2015-09-02T19:25:44Z",
            "Creator": {
                "FirstName": "Sample",
                "LastName": "User",
                "ImageUrl": "..."
            },
            "Device": {
                "Id": "63efb573-fc58-4065-b687-9bdd51568529",
                "Name": "Test Printer",
                "Type": "Printer"
            },
            "Data": {
                "CopyCount": 1,
                "FileType": "application/pdf",
                "FileData": "...",
                "PrinterName": "Printer",
                "PrinterDriverName": "",
                "PrinterPortName": ""
            }
        }
    ]
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Commands` | array of [Command](#command) | required | The active commands. |

##### Command

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Id` | string | required | Unique identifier of the command. |
| `State` | string | required | State of the command. |
| `CreatedUtc` | string | required | Creation date and time of the command. |
| `Creator` | [User](#user) | optional | Creator of the command. |
| `Device` | [Device](#device) | required | Device that the command should be executed on. |
| `Data` | object | optional | Data of the command depending on device type and command type. Details in the [devices](#devices) section. |

##### User

| Property | Type | | Description |
| --- | --- | --- | --- |
| `FirstName` | string | optional | First name of the user. |
| `LastName` | string | required | Last name of the user. |
| `ImageUrl` | string | optional | URL of the profile image. |

##### Device

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Id` | string | required | Unique identifier of the device. |
| `Name` | string | required | Name of the device. |
| `Type` | string | optional | Type of the device. |

### Update Command

Updates state of a command.

#### Request `[PlatformAddress]/api/connector/v1/commands/update`

```json
{
    "AccessToken": "C66EF7B239D24632943D115EDE9CB810-EA00F8FD8294692C940F6B5A8F9453D",
    "CommandId": "aa20961f-6d9e-4b35-ad25-071213530aec",
    "State": "Processed"
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `AccessToken` | string | required | Access token of the client application. |
| `CommandId` | string | required | Identifier of the command to be updated. |
| `State` | string | required | New state of the command. |
| `Progress` | number | optional | Progress of the command processing. Only used if the `State` is `Processing`, otherwise ignored. |
| `Result` | object | optional | Result of the command depending on device type and command type. Only used if the `State` is `Processed`, otherwise ignored. Details in the [devices](#devices) section. |
| `Notes` | string | optional | Notes about command execution. Only used if the `State` is `Processed`, `Cancelled` or `Error`, otherwise ignored. |

#### Response

Empty object.

### Devices

#### Printers

Device type: `Printer`

##### Command Data

| Property | Type | | Description |
| --- | --- | --- | --- |
| `CopyCount` | number | required | Number of copies to be printed. |
| `FileType` | string | required | MIME type of the file to be printed (e.g. `application/pdf`). |
| `FileData` | string | required | Base64-encoded data of the file to be printed. |
| `PrinterName` | string | required | Name of the printer. |
| `PrinterDriverName` | string | required | Name of the printer driver. |
| `PrinterPortName` | string | required | Name of the printer port. |

##### Command Result

Not used.

#### VisiOnline Key Cutters

Device type: `VisiOnlineKeyCutter`

##### Command Data

| Property | Type | | Description |
| --- | --- | --- | --- |
| `ApiUrl` | string | required | VisiOnline API URL. |
| `UserName` | string | required | VisiOnline user name. |
| `Password` | string | required | VisiOnline password. |
| `KeyCutterId` | string | required | Identifier of the key cutter which should cut the keys. |
| `LockIds` | array of string | required | Identifiers of locks/rooms the key should open. |
| `ValidityStartUtc` | string | required | Start of the key validity interval in UTC timezone in ISO 8601 format. |
| `ValidityEndUtc` | string | required | End of the key validity interval in UTC timezone in ISO 8601 format. |
| `KeyCount` | number | required | Count of keys to cut. |
| `Reservation` | [Reservation](#reservation) | optional | Additional information about the reservation. |

##### Command Result

Not used.

## Environments

### Demo Environment

This environment is meant to be used during implementation of the client applications.

- **Platform Address** - `https://demo.mews.li`
- **Access Token** - `C66EF7B239D24632943D115EDE9CB810-EA00F8FD8294692C940F6B5A8F9453D`

The hotel is based in UK, it accepts `GBP`, `EUR` and `USD` currencies (any of them may be used), as a tax rate, either `0.0`, `0.05` or `0.20` can be used. The predefined accounting categories have codes: `FOOD`, `BVG` and `ABVG`. To sign into the system, use the following credentials:

- **Address** - `https://demo.mews.li`
- **Email** - `connector-api@mews.li`
- **Password** - `connector-api`

### Production Environment

- **Platform Address** - `https://www.mews.li`
- **Access Token** - Depends on the hotel, should be provided to you by the hotel admin.
