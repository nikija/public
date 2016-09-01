---
title: Connector API (v1)
---

The Connector API serves as en endpoint for communication between MEWS and external systems. Or for applications that mediate communication between MEWS and the third party systems. Typically the external systems are running on site in the enterprise (e.g. POS systems, printers and other physical devices, kiosks etc), but the API may also be used by other cloud systems (e.g. revenue management systems, cloud POS systems).

First of all, please have a look at [API Guidelines](../api.html) which describe general usage guidelines of MEWS APIs. If you are interested in changes and updates of this API, check [Changelog](#changelog).

## Contents

- [Authorization](#authorization)
    - [Environments](#environments)
- [Enterprises](#enterprises)
    - [Get All Companies](#get-all-companies)
    - [Get All Spaces](#get-all-spaces)
    - [Get All Space Blocks](#get-all-space-blocks)
    - [Add Task](#add-task)
- [Services](#services)
    - [Get All Business Segments](#get-all-business-segments)
    - [Get All Rates](#get-all-rates)
    - [Update Rate Base Price](#update-rate-base-price)
- [Reservations](#reservations)
    - [Get All Reservations](#get-all-reservations)
    - [Get All Reservation Items](#get-all-reservation-items)
    - [Start Reservation](#start-reservation)
    - [Process Reservation](#process-reservation)
    - [Cancel Reservation](#cancel-reservation)
    - [Add Companion](#add-companion)
- [Customers](#customers)
    - [Search Customers](#search-customers)
    - [Get Customer Balance](#get-customer-balance)
    - [Get Customers Open Items](#get-customers-open-items)
    - [Add Customer](#add-customer)
    - [Update Customer](#update-customer)
    - [Charge Customer](#charge-customer)
- [Finance](#finance)
    - [Get All Accounting Categories](#get-all-accounting-categories)
    - [Get All Accounting Items](#get-all-accounting-items)
    - [Add Credit Card Payment](#add-credit-card-payment)
- [Commands](#commands)   
    - [Get All Commands](#get-all-commands)
    - [Update Command](#update-command)
    - [Devices](#devices)

## Authorization

All operations of the API require `AccessToken` to be present in the request. In production environment, the `AccessToken` will be provided to you by the enterprise admin. For development purposes, use the  [Demo Environment](#demo-environment).

### Environments

#### Demo Environment

This environment is meant to be used during implementation of the client applications.

- **Platform Address** - `https://demo.mews.li`
- **Access Token** - `C66EF7B239D24632943D115EDE9CB810-EA00F8FD8294692C940F6B5A8F9453D`

The enterprise is based in UK, it accepts `GBP`, `EUR` and `USD` currencies (any of them may be used), as a tax rate, either `0.0`, `0.05` or `0.20` can be used. The predefined accounting categories have codes: `FOOD`, `BVG` and `ABVG`. To sign into the system, use the following credentials:

- **Address** - `https://demo.mews.li`
- **Email** - `connector-api@mews.li`
- **Password** - `connector-api`

#### Production Environment

- **Platform Address** - `https://www.mews.li`
- **Access Token** - Depends on the enterprise, should be provided to you by the enterprise admin.

## Enterprises

### Get All Companies

Returns all company profiles of the enterprise, possible filtered by their identifiers.

#### Request `[PlatformAddress]/api/connector/v1/companies/getAll`

```json
{
    "AccessToken": "C66EF7B239D24632943D115EDE9CB810-EA00F8FD8294692C940F6B5A8F9453D"
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `AccessToken` | string | required | Access token of the client application. |
| `Ids` | array of string | optional | If specified, returns only companies with the specified identifiers.  |

#### Response

```json
{
    "Companies": [
        {
            "Id": "207b9da3-1c2a-45df-af20-54e57a13368c",
            "Name": "IBM"
        },
        {
            "Id": "217b9da3-1c2a-45df-af20-54e57a13368c",
            "Name": "Booking.com"
        }
    ]
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Companies` | array of [Company](#company) | required | The company profiles of the enterprise. |

##### Company

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Id` | string | required | Unique identifier of the company. |
| `Name` | string  | required | Name of the company. |

### Get All Spaces

Returns all spaces of an enterprise associated with the connector integration.

#### Request `[PlatformAddress]/api/connector/v1/spaces/getAll`

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
| `Type` | string [Space Type](#space-type) | required | Type of the space. |
| `Number` | string | required | Number of the space (e.g. room number). |
| `ParentSpaceId` | string | optional | Identifier of the parent [Space](#space) (e.g. room of a bed). |
| `CategoryId` | string | required | Identifier of the [Space Category](#space-category) assigned to the space. |
| `State` | string [Space State](#space-state) | required | State of the room. |

##### Space Type

- `Room`
- `Dorm`
- `Bed`
- ...

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

### Get All Space Blocks

Returns all space blocks (out of order blocks or house use blocks) colliding with the specified interval.

#### Request `[PlatformAddress]/api/connector/v1/spaceBlocks/getAll`

```json
{
    "AccessToken": "C66EF7B239D24632943D115EDE9CB810-EA00F8FD8294692C940F6B5A8F9453D",
    "StartUtc": "2016-01-01T00:00:00Z",
    "EndUtc": "2017-01-01T00:00:00Z"
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `AccessToken` | string | required | Access token of the client application. |
| `StartUtc` | string | required | Start of the interval in UTC timezone in ISO 8601 format. |
| `EndUtc` | string | required | End of the interval in UTC timezone in ISO 8601 format. |

#### Response

```json
{
    "SpaceBlocks": [
        {
            "AssignedSpaceId": "5ee074b1-6c86-48e8-915f-c7aa4702086f",
            "CreatedUtc": "2016-03-29T22:02:34Z",
            "EndUtc": "2016-01-01T16:00:00Z",
            "Id": "5ab9d519-2485-4d77-85c4-2a619cbdc4e7",
            "StartUtc": "2016-01-01T10:00:00Z",
            "Type": "HouseUse",
            "UpdatedUtc": "2016-03-29T22:02:34Z"
        },
        {
            "AssignedSpaceId": "f7c4b4f5-ac83-4977-a41a-63d27cc6e3e9",
            "CreatedUtc": "2016-03-29T15:14:06Z",
            "EndUtc": "2016-01-01T16:00:00Z",
            "Id": "4d98ad40-a726-409e-8bf3-2c12ff3c0331",
            "Type": "OutOfOrder",
            "StartUtc": "2016-01-01T10:00:00Z",
            "UpdatedUtc": "2016-03-29T15:14:06Z"
        }
    ]
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `SpaceBlocks` | array of [Space Block](#space-block) | required | The space blocks colliding with the interval. |

##### Space Block

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Id` | string | required | Unique identifier of the block. |
| `AssignedSpaceId` | string | required | Unique identifier of the assigned [Space](#space). |
| `Type` | string [Space Block Type](#space-block-type) | required | Type of the space block. |
| `StartUtc` | string | required | Start of the block in UTC timezone in ISO 8601 format. |
| `EndUtc` | string | required | End of the block in UTC timezone in ISO 8601 format. |
| `CreatedUtc` | string | required | Creation date and time of the block in UTC timezone in ISO 8601 format. |
| `UpdatedUtc` | string | required | Last update date and time of the block in UTC timezone in ISO 8601 format. |

##### Space Block Type

- `OutOfOrder`
- `HouseUse`

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

## Services

### Get All Business Segments

Returns all business segments of the default service provided by the enterprise.

#### Request `[PlatformAddress]/api/connector/v1/businessSegments/getAll`

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
    "BusinessSegments": [
        {
            "Id": "7760b5cb-a666-41bb-9758-76bf5d1df399",
            "IsActive": true,
            "Name": "Business"
        },
        {
            "Id": "54ec08b6-e6fc-48e9-b8ae-02943e0ac693",
            "IsActive": true,
            "Name": "Leisure"
        }
    ]
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `BusinessSegments` | array of [Business Segment](#business-segment) | required | Business segments of the default service. |

##### Business Segment

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Id` | string | required | Unique identifier of the segment. |
| `IsActive` | boolean | required | Whether the business segment is still active. |
| `Name` | string | required | Name of the segment. |

### Get All Rates

Returns all rates (pricing setups) and rate groups (condition settings) of the default service provided by the enterprise.

#### Request `[PlatformAddress]/api/connector/v1/rates/getAll`

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
    "Rates": [
        {
            "GroupId": "c8b866b3-be2e-4a47-9486-034318e9f393",
            "Id": "ed4b660b-19d0-434b-9360-a4de2ea42eda",
            "IsActive": true,
            "Name": "Fully Flexible"
        }
    ],
    "RateGroups": [
        {
            "Id": "c8b866b3-be2e-4a47-9486-034318e9f393",
            "IsActive": true,
            "Name": "Default"
        }
    ]
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Rates` | array of [Rate](#rate) | required | Rates of the default service. |
| `RateGroups` | array of [Rate Group](#rate-group) | required | Rate groups of the default service. |

##### Rate

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Id` | string | required | Unique identifier of the rate. |
| `GroupId` | string | required | Unique identifier of [Rate Group](#rate-group) where the rate belongs. |
| `IsActive` | boolean | required | Whether the rate is still active. |
| `Name` | string | required | Name of the rate. |

##### Rate Group

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Id` | string | required | Unique identifier of the group. |
| `IsActive` | boolean | required | Whether the rate group is still active. |
| `Name` | string | required | Name of the rate group. |

### Update Rate Base Price

Updates base price of a rate in the specified intervals. Note that prices are defined daily, so when the server receives the UTC interval, it first converts it to enterprise timezone and updates the price on all dates that the interval intersects.

#### Request `[PlatformAddress]/api/connector/v1/rates/updateBasePrice`

```json
{
    "AccessToken": "C66EF7B239D24632943D115EDE9CB810-EA00F8FD8294692C940F6B5A8F9453D",
    "RateId": "ed4b660b-19d0-434b-9360-a4de2ea42eda",
    "BasePriceUpdates": [
        {
            "StartUtc": "2016-09-01T00:00:00Z",
            "EndUtc": "2016-09-02T00:00:00Z",
            "Value": 100
        },
        {
            "StartUtc": "2016-09-04T00:00:00Z",
            "EndUtc": "2016-09-05T00:00:00Z",
            "Value": 50
        }
    ]
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `AccessToken` | string | required | Access token of the client application. |
| `AccessToken` | string | required | Unique identifier of the [Rate](#rate) to update. |
| `BasePriceUpdates` | array of [Base Price Update](#base-price-update) | required | Intervals with new prices. |

##### Base Price Update

| Property | Type | | Description |
| --- | --- | --- | --- |
| `StartUtc` | string | required | Start of the interval in UTC timezone in ISO 8601 format. |
| `EndUtc` | string | required | End of the interval in UTC timezone in ISO 8601 format. |
| `Value` | number | required | New value of the rate on the interval. |

#### Response

Empty object.

## Reservations

### Get All Reservations

Returns all reservations that from the specified interval according to the time filter (e.g. colliding with that interval or created in that interval).

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
| `TimeFilter` | string [Reservation Time Filter](#reservation-time-filter) | optional | Time filter of the interval. If not specified, reservations `Colliding` with the interval are returned. |
| `StartUtc` | string | required | Start of the interval in UTC timezone in ISO 8601 format. |
| `EndUtc` | string | required | End of the interval in UTC timezone in ISO 8601 format. |
| `States` | array of string [Reservation State](#reservation-state) | optional | States the reservations should be in. If not specified, reservations in `Confirmed`, `Started` or `Processed` states are returned. |

##### Reservation Time Filter

- `Colliding`
- `Created`
- `Updated`

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
            "CompanionIds": [
                "35d4b117-4e60-44a3-9580-c582117eff98"
            ],
            "CompanyId": null,
            "CreatedUtc": "2016-02-20T14:58:02Z",
            "CustomerId": "35d4b117-4e60-44a3-9580-c582117eff98",
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
    ],
    "Customers": [
        {
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
    ]
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Reservations` | array of [Reservation](#reservation) | required | The reservations that collide with the specified interval. |
| `ReservationGroups` | array of [Reservation Group](#reservation-group) | required | Reservation groups that the reservations are members of. |
| `Customers` | array of [Customer](#customer) | required | Customers that are members of the reservations. |

##### Reservation

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Id` | string | required | Unique identifier of the reservation. |
| `GroupId` | string | required | Unique identifier of the [Reservation Group](#reservation-group). |
| `Number` | string | required | Confirmation number of the reservation. |
| `ChannelNumber` | string | optional | Confirmation number of the reservation within a channel in case the reservation originates there (e.g. Booking.com confirmation number). |
| `ChannelManagerId` | string | optional | Identifier of the reservation within a channel manager in case the reservation came through it (e.g. Siteminder identifier). |
| `State` | string [Reservation State](#reservation-state) | required | State of the reservation. |
| `CreatedUtc` | string | required | Creation date and time of the reservation in UTC timezone in ISO 8601 format. |
| `UpdatedUtc` | string | required | Last update date and time of the reservation in UTC timezone in ISO 8601 format. |
| `StartUtc` | string | required | Start of the reservation (arrival) in UTC timezone in ISO 8601 format. |
| `EndUtc` | string | required | End of the reservation (departure) in UTC timezone in ISO 8601 format. |
| `RequestedCategoryId` | string | required | Identifier of the requested [Space Category](#space-category). |
| `AssignedSpaceId` | string | optional | Identifier of the assigned [Space](#space). |
| `BusinessSegmentId` | string | optional | Identifier of the reservation [Business Segment](#business-segment). |
| `CompanyId` | string | optional | Identifier of the [Company](#company) on behalf of which the reservation was made. |
| `TravelAgencyId` | string | optional | Identifier of the [Company](#company) that mediated the reservation. |
| `RateId` | string | required | Identifier of the reservation [Rate](#rate). |
| `AdultCount` | number | required | Count of adults the reservation was booked for. |
| `ChildCount` | number | required | Count of children the reservation was booked for. |
| `CustomerId` | string | required | Unique identifier of the [Customer](#customer) who owns the reservation. |
| `Customer` | [Customer](#customer) | required | **DEPRECATED** Owner of the reservation. |
| `CompanionIds` | array of string | required | Unique identifiers of [Customer](#customer)s that will occupy the space. |
| `Companions` | array of [Customer](#customer) | required | **DEPRECATED** Customers that will occupy the space. |

##### Reservation State

- `Enquired` - Confirmed neither by the customer or enterprise.
- `Requested` - Confirmed by the customer but not by the enterprise (waitlist).
- `Optional` - Confirmed by enterprise but not by the guest (the enterprise is holding space for the guest).
- `Confirmed` - Confirmed by both parties, before check-in.
- `Started` - Checked in.
- `Processed` - Checked out.
- `Canceled` - Canceled, not active anymore.

##### Reservation Group

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Id` | string | required | Unique identifier of the reservation group. |
| `Name` | string | optional | Name of the reservation group, might be empty or same for multiple groups. |

### Get All Reservation Items

Returns all revenue items associated with the specified reservations.

#### Request `[PlatformAddress]/api/connector/v1/reservations/getAllItems`

```json
{
    "AccessToken": "C66EF7B239D24632943D115EDE9CB810-EA00F8FD8294692C940F6B5A8F9453D",
    "ReservationIds": [
        "e6ea708c-2a2a-412f-a152-b6c76ffad49b"
    ]
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `AccessToken` | string | required | Access token of the client application. |
| `ReservationIds` | array of string | required | Unique identifiers of the [Reservation](#reservation)s. |
| `Currency` | string | optional | ISO-4217 currency code the item costs should be converted to. |

#### Response

```json
{
    "Reservations": [
        {
            "Items": [
                {
                    "AccountingCategoryId": "0cf7aa90-736f-43e9-a7dc-787704548d86",
                    "Amount": {
                        "Currency": "GBP",
                        "Tax": 3.33,
                        "TaxRate": 0.2,
                        "Value": 20
                    },
                    "ConsumptionUtc": "2016-03-10T13:00:00Z",
                    "Id": "784a29df-6196-4402-96a0-58695a881239",
                    "Name": "Night 3/10/2016",
                    "OrderId": "e6ea708c-2a2a-412f-a152-b6c76ffad49b"
                }
            ],
            "ReservationId": "e6ea708c-2a2a-412f-a152-b6c76ffad49b"
        }
    ]
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Reservations` | array of [Reservation Items](#reservation-items) | required | The reservations with their items. |

##### Reservation Items

| Property | Type | | Description |
| --- | --- | --- | --- |
| `ReservationId` | string | required | Unique identifier of the [Reservation](#reservations). |
| `Items` | array of [Accounting Item](#accounting-item) | required | The items associated with the reservation. |

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
| `ReservationId` | string | required | Unique identifier of the [Reservation](#reservation) to start. |

#### Response

Empty object.

### Process Reservation

Marks a reservation as `Processed` (= checked out). Succeeds only if all processing conditions are met (the reservation has the `Started` state, balance of all reservation members is zero etc).

#### Request `[PlatformAddress]/api/connector/v1/reservations/process`

```json
{
    "AccessToken": "C66EF7B239D24632943D115EDE9CB810-EA00F8FD8294692C940F6B5A8F9453D",
    "ReservationId": "e6ea708c-2a2a-412f-a152-b6c76ffad49b",
    "CloseBills": false
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `AccessToken` | string | required | Access token of the client application. |
| `ReservationId` | string | required | Unique identifier of the [Reservation](#reservation) to process. |
| `CloseBills` | bool | optional | Whether closable bills of the reservation members should be automatically closed. |

#### Response

Empty object.

### Cancel Reservation

Cancels a reservation. Succeeds only if the reservation is cancellable.

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
| `ReservationId` | string | required | Unique identifier of the [Reservation](#reservation) to cancel. |
| `ChargeCancellationFee` | boolean | required | Whether cancellation fees should be charged according to rate conditions. |
| `Notes` | string | required | Addiotional notes describing the cancellation. |

#### Response

Empty object.

### Add Companion

Adds a customer as a companion to the reservation. Succeeds only if there is space for the new companion (count of current companions is less than `AdultCount + ChildCount`).

#### Request `[PlatformAddress]/api/connector/v1/reservations/addCompanion`

```json
{
    "AccessToken": "C66EF7B239D24632943D115EDE9CB810-EA00F8FD8294692C940F6B5A8F9453D",
    "ReservationId": "e6ea708c-2a2a-412f-a152-b6c76ffad49b",
    "CustomerId": "35d4b117-4e60-44a3-9580-c582117eff98"
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `AccessToken` | string | required | Access token of the client application. |
| `ReservationId` | string | required | Unique identifier of the [Reservation](#reservation). |
| `CustomerId` | boolean | required | Unique identifier of the [Customer](#customer). |

#### Response

Empty object.

## Customers

### Search Customers

Searches for customers that are active at the moment in the enterprise (e.g. companions of on checked-in reservations or paymasters).

#### Request `[PlatformAddress]/api/connector/v1/customers/search`

```json
{
    "AccessToken": "C66EF7B239D24632943D115EDE9CB810-EA00F8FD8294692C940F6B5A8F9453D",
    "Name": "Smith"
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `AccessToken` | string | required | Access token of the client application. |
| `Name` | string | optional | Name to search by (applies to first name, last name and full name). |
| `SpaceId` | string | optional | Identifier of [Space](#space) to search by (members of [Reservation](#reservation) assigned there will be returned) . |

#### Response

```json
{
    "Customers": [
        {
            "Customer": {
                "Address": null,
                "BirthDateUtc": null,
                "CategoryId": null,
                "Email": "john@smith.com",
                "FirstName": "Peter",
                "Gender": null,
                "Id": "794dbb77-0a9a-4170-9fa9-62ea4bf2a56e",
                "LastName": "Smith",
                "NationalityCode": null,
                "Passport": null,
                "Phone": "123456789",
                "Title": null
            },
            "Reservation": null
        }
    ]
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Customers` | array of [Customer Search Result](#customer-search-result) | required | The customer search results. |

##### Customer Search Result

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Customer` | [Customer](#customer) | required | The found customer. |
| `Reservation` | [Reservation](#reservation) | optional | Reservation of the customer in case he currently stays in the enterprise. |

### **DEPRECATED** Get Customer Balance

Returns current open balance of a customer. If the balance is positive, the customer has some unpaid items. Otherwise the customer does not owe anything to the enterprise at the moment.

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
| `CustomerId` | string | required | Unique identifier of the [Customer](#customer). |

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

Returns all open items of the specified customers, i.e. all unpaid items and all deposited payments. Sum of the open items is the balance of the customer. If the `Currency` is specified, costs of the items are converted to that currency.

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
| `CustomerIds` | array of string | required | Unique identifiers of the [Customer](#customer)s. |
| `Currency` | string | optional | ISO-4217 currency code the item costs should be converted to, e.g. `EUR` or `USD`. |

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
| `CustomerId` | string | required | Unique identifier of the [Customer](#customer). |
| `Items` | array of [Accounting Item](#accounting-item) | required | The open items. |

### Add Customer

Adds a new customer to the system and returns details of the added customer. If a customer with the specified email already exists, nothing is added to the system and profile information of the existing customer, which are left intact, are returned.

When it comes to dates in the customer data (e.g. birth date or passport expiration), they are all represented as dates in UTC timezone with time set to 12:00. That ensures that the date won't change no matter the timezone it is converted to. Practically it would be too complicated to obtain the timezone (e.g. timezone of place of birth or timezone of passport issuance) if we wanted to represent exact date and time in UTC.

#### Request `[PlatformAddress]/api/connector/v1/customers/add`

```json
{
    "AccessToken": "C66EF7B239D24632943D115EDE9CB810-EA00F8FD8294692C940F6B5A8F9453D",
    "FirstName": "John",
    "LastName": "Doe",
    "Title": "Mister",
    "NationalityCode": "US",
    "BirthDateUtc": "2000-01-01T12:00:00Z",
    "Email": "john@doe.com",
    "Phone": "00420123456789"
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `AccessToken` | string | required | Access token of the client application. |
| `FirstName` | string | optional | First name of the customer. |
| `LastName` | string | required | Last name of the customer. |
| `Title` | string [Title](#title) | optional | Title prefix of the customer. |
| `NationalityCode` | string | optional | ISO 3166-1 alpha-2 country code (two letter country code) of the nationality. |
| `BirthDateUtc` | string | optional | Date of birth in UTC timezone in ISO 8601 format. |
| `Email` | string | optional | Email address of the customer. |
| `Phone` | string | optional | Phone number of the customer (possibly mobile). |
| `Passport` | [Document](#document) | optional | Passport details of the customer. |
| `Address` | [Address](#address) | optional | Address of the customer. |

#### Response

```json
{
    "BirthDateUtc": "2000-01-01T12:00:00Z",
    "CategoryId": null,
    "Email": "john@doe.com",
    "FirstName": "John",
    "Gender": "Male",
    "Id": "5fca71c5-5f7a-4c30-b3cc-7d4679a79a44",
    "LastName": "Doe",
    "NationalityCode": "US",
    "Phone": "00420123456789",
    "Title": "Mister"
}
```

The created [Customer](#customer) or an existing [Customer](#customer) with the specified email. 

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
| `Passport` | [Document](#document) | optional | Passport details of the customer. |
| `Address` | [Address](#address) | optional | Address of the customer. |

##### Title

- `Mister`
- `Miss`
- `Misses`

##### Gender

- `Male`
- `Female`

##### Document

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Number` | string | optional | Number of the document (e.g. passport number). |
| `ExpirationUtc` | string | optional | Expiration date in UTC timezone in ISO 8601 format. |

##### Address

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Line1` | string | optional | First line of the address. |
| `Line2` | string | optional | Second line of the address. |
| `City` | string | optional | The city. |
| `PostalCode` | string | optional | Postal code. |
| `CountryCode` | string | optional | ISO 3166-1 alpha-2 country code (two letter country code). |

### Update Customer

Updates personal information of a customer. Note that all fields should be provided in the update request, leaving some of them empty would cause them to be cleared (deleting some information is considered a valid update). So if e.g. only last name should be updated and all other should remain the same, the request has to contain the new last name but all other fields have to be filled with the values received from the server.

#### Request `[PlatformAddress]/api/connector/v1/customers/update`

```json
{
    "AccessToken": "C66EF7B239D24632943D115EDE9CB810-EA00F8FD8294692C940F6B5A8F9453D",
    "CustomerId": "35d4b117-4e60-44a3-9580-c582117eff98",
    "FirstName": "John",
    "LastName": "Smith",
    "Title": "Mister",
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
| `CustomerId` | string | required | Unique identifier of the [Customer](#customer). |
| `FirstName` | string | optional | New first name. |
| `LastName` | string | required | New last name. |
| `Title` | string [Title](#title) | optional | New title. |
| `BirthDateUtc` | string | optional | New birth date in UTC timezone in ISO 8601 format. |
| `NationalityCode` | string | optional | ISO 3166-1 alpha-2 country code (two letter country code) of the new nationality. |
| `Phone` | string | optional | New phone number. |
| `Passport` | [Document](#document) | optional | New passport details. |
| `Address` | [Address](#address) | optional | New address details. |

#### Response

The updated [Customer](#customer).

### Charge Customer

Charges a customer, i.e. creates a new order attached to his profile with the specified items.

#### Request `[PlatformAddress]/api/connector/v1/customers/charge`

```json
{
    "AccessToken": "C66EF7B239D24632943D115EDE9CB810-EA00F8FD8294692C940F6B5A8F9453D",
    "CustomerId": "794dbb77-0a9a-4170-9fa9-62ea4bf2a56e",
    "Items": [
        {
            "Name": "Beer",
            "UnitCount": 10,
            "UnitCost": {
                "Amount": 2.50,
                "Currency": "GBP",
                "Tax": 0.20
            },
            "Category": {
                "Code": "ABVG"
            }
        },
        {
            "Name": "Steak",
            "UnitCount": 1,
            "UnitCost": {
                "Amount": 12.8,
                "Currency": "GBP",
                "Tax": 0.05
            }
        }
    ]
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `AccessToken` | string | required | Access token of the client application. |
| `CustomerId` | string | required | Identifier of the [Customer](#customer) to be charged. |
| `Items` | array of [Charge Item](#charge-item) | required | Items of the charge. |
| `Notes` | string | optional | Additional notes of the charge. |

##### Charge Item

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Name` | string | required | Name of the item. |
| `UnitCount` | number | required | Count of units to be charged, e.g. 10 in case of 10 beers. |
| `UnitCost` | [Charge Cost](#charge-cost) | required | Unit cost, e.g. cost for one beer (note that total cost of the item is therefore `UnitCount` times `UnitCost`). |
| `Category` | [Accounting Category Parameters](#accounting-category-parameters) | optional | Category of the item. |

##### Charge Cost

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Amount` | decimal | required | Amount including tax. |
| `Currency` | string | required | ISO-4217 currency code, e.g. `EUR` or `USD`. |
| `Tax` | decimal | required | Tax rate, e.g. `0.21` in case of 21% tax rate.  |

#### Response

```json
{
    "ChargeId": "cdfd5caa-2868-411b-ba95-322e70035f1a"
}
```


| Property | Type | | Description |
| --- | --- | --- | --- |
| `ChargeId` | string | required | Unique identifier of the created charge. |

## Finance

### Get All Accounting Categories

Returns all accounting categories of the enterprise associated with the connector integration.

#### Request `[PlatformAddress]/api/connector/v1/accountingCategories/getAll`

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
    "AccountingCategories": [
        {
            "Id": "0b9560fb-055d-47d3-a6d4-e579c44ca558",
            "IsActive": true,
            "Name": "Alcoholic Beverage"
        },
        {
            "Id": "19ba0729-0e88-4354-9131-e5b6a1afba4f",
            "IsActive": true,
            "Name": "Beverage"
        }
    ]
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `AccountingCategories` | array of [Accounting Category](#accounting-category) | required | Accounting categories of the enterprise. |

##### Accounting Category

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Id` | string | required | Unique identifier of the category. |
| `IsActive` | boolean | required | Whether the accounting category is still active. |
| `Name` | string | required | Name of the category. |

### Get All Accounting Items

Returns all accounting items of the enterprise that were consumed (posted) or will be consumed within the specified interval. If the `Currency` is specified, costs of the items are converted to that currency.

#### Request `[PlatformAddress]/api/connector/v1/accountingItems/getAll`

```json
{
    "AccessToken": "C66EF7B239D24632943D115EDE9CB810-EA00F8FD8294692C940F6B5A8F9453D",
    "StartUtc": "2016-01-01T00:00:00Z",
    "EndUtc": "2017-01-01T00:00:00Z"
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `AccessToken` | string | required | Access token of the client application. |
| `StartUtc` | string | required | Start of the consumption interval in UTC timezone in ISO 8601 format. |
| `EndUtc` | string | required | End of the consumption interval in UTC timezone in ISO 8601 format. |
| `Currency` | string | optional | ISO-4217 currency code the item costs should be converted to, e.g. `EUR` or `USD`. |

#### Response

```json
{
    "AccountingItems": [
        {
            "AccountingCategoryId": "4ac8ce68-5732-4f1d-bf0d-e557072c926f",
            "Amount": {
                "Currency": "GBP",
                "Tax": 0.42,
                "TaxRate": 0.2,
                "Value": 2.5
            },
            "ConsumptionUtc": "2016-07-27T12:48:39Z",
            "Id": "89b93f7c-5c63-4de2-bd17-ec5fee5e3120",
            "Name": "Caramel, Pepper & Chilli Popcorn",
            "OrderId": "810b8c3a-d358-4378-84a9-534c830016fc"
        }
    ]
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `AccountingItems` | array of [Accounting Item](#accounting-item) | required | The consumed accounting items. |

##### Accounting Item

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Id` | string | required | Unique identifier of the item. |
| `OrderId` | string | optional | Unique identifier of the order (or [Reservation](#reservation)) the item belongs to. |
| `AccountingCategoryId` | string | optional | Unique identifier of the [Accounting Category](#accounting-category) the item belongs to. |
| `Name` | string | required | Name of the item. |
| `ConsumptionUtc` | string | required | Date and time of the item consumption in UTC timezone in ISO 8601 format. |
| `Amount` | [Currency Value](#currency-value) | required | Amount the item costs, negative amount represents either rebate or a payment. |

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
| `CustomerId` | string | required | Unique identifier of the [Customer](#customer). |
| `Amount` | [Currency Value](#currency-value) | required | Amount of the credit card payment. |
| `CreditCard` | [Credit Card](#credit-card) | required | Credit card details. |
| `Category` | [Accounting Category Parameters](#accounting-category-parameters) | optional | Accounting category to be assigned to the payment. |
| `ReceiptIdentifier` | string | optional | Identifier of the payment receipt. |
| `Notes` | string | optional | Additional payment notes. |

##### Credit Card

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Type` | string | required | Type of the credit card, one of: `Visa`, `MasterCard`, `Amex`, `Discover`, `DinersClub`, `Jcb`, `EnRoute`, `Maestro`, `UnionPay`. |
| `Number` | string | required | Obfuscated credit card number. At most first six digits and last four digits can be specified, the digits in between should be replaced with `*`. It is possible to provide even more obfuscated number or just last four digits. **Never provide full credit card number**. For example `411111******1111`. |
| `Expiration` | string | required | Expiration of the credit card in format `MM/YYYY`, e.g. `12/2016` or `04/2017`. |
| `Name` | string | required | Name of the card holder. |

##### Accounting Category Parameters

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

## Commands

### Get All Commands

Returns all commands the are still active from the client application point of view. That means commands that are in either `Pending` or `Received` state.

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
| `State` | string [Command State](#command-state) | required | State of the command. |
| `CreatedUtc` | string | required | Creation date and time of the command. |
| `Creator` | [User](#user) | optional | Creator of the command. |
| `Device` | [Device](#device) | required | Device that the command should be executed on. |
| `Data` | object | optional | Data of the command depending on device type and command type. Details in the [devices](#devices) section. |

##### Command State

- `Pending` - Created in MEWS, but not yet received by the client application.
- `Received` - Received by the client application.
- `Processing` - Being processed by the client application.
- `Processed` - Successfully processed command.
- `Cancelled` - A command whose execution has been cancelled before (or during) processing.
- `Error` - A command whose execution or processing was terminated by an error.

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
| `CommandId` | string | required | Identifier of the [Command](#command) to be updated. |
| `State` | string [Command State](#command-state) | required | New state of the command. |
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

## Changelog

#### 1st September 2016 23:00 CET

- Added operation [Update Rate Base Price](#update-rate-base-price) that allows e.g. revenue management systems to provide recommended rates to MEWS.
- Added operation [Get All Reservation Items](#get-all-reservation-items) that returns revenue items of selected reservations.
- Added `Currency` parameter to operations [Get Customers Open Items](#get-customers-open-items) and [Get All Accounting Items](#get-all-accounting-items).
- Deprecated operation [Get Customer Balance](#get-customer-balance). Operation [Get Customer Open Items](#get-customer-open-items) should be used instead, since it provides more complete information.
- Deprecated properties `Customer` and `Companions` on [Reservation](#reservation). `CustomerId` an `CompanionIds` should be used instead. The customer data are part of the result of [Get All Reservations](#get-all-reservations). This removes redundancy in the response data, especially in hostels where the customer is mostly the only companion and currently the customer data were twice in the result.
- We plan to make `Address` on [Customer](#customer) optional in order to reduce response sizes, in many cases the customers do not have address details filled in.
