# Charging API (v1)

The Charging API allows external applications to charge hotel guests for services that were not provided directly by the hotel or that are managed by an external system. For example it allows a restaurant POS system to charge the guests on their open hotel bills.

## Contents

- [General Info](#general-info)
- [API Calls](#api-calls)
    - [Search Customers](#search-customers)
    - [Charge Customer](#charge-customer)
- [Environments](#environments) 

## General Info

In order to use the API, the client needs to know the **API base address** and an **access token** which allows the client to use the API. Both of those two values depend on the used environment, for further information see section [Environments](#environments).

### Requests

The API accepts only HTTP POST requests with `Content-Type` set to `application/json`.

### Responses

The API responds with `Content-Type` set to `application/json` and JSON content. In case of success, the HTTP status code is 200 and the content contains result according to the call. In case of error, there are multiple HTTP status codes for different types of errors:

- **400 Bad Request** - Error caused by the client, e.g. in case of malformed request.
- **401 Unauthorized** - Error caused by usage of an invalid access token.
- **403 Forbidden** - Server error that should be reported to the user of the client app. E.g. when charging a customer that is not chargeable or when trying to charge negative cost.
- **500 Internal Server Error** - Unexpectced error of the server.

In case of any error, the returned JSON object describes the error and has the following properties:

| Property | Type | | Description |
| --- | --- | --- | --- |
| `ExceptionTypeFullName` | string | required | Full type of exception that has been thrown on the server. |
| `Message` | string | required | Description of the error. |
| `Details` | string | optional | Additional details about the error (server stack trace, inner exceptions). Only available on development environment. |

## API Calls

### Search Customers

In order to charge a person, the client application first needs to obtain full information about the customers from the hotel system. The customers may be searched by name (or part of the name), room number or both. If both room number and name are empty, then all chargeable customers are returned.

#### Request `<ApiBase>/customers/search`

```json
{
    "AccessToken": "...",
    "Name": "Smith",
    "RoomNumber": "101"
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `AccessToken` | string | required | Access token of the client application. |
| `Name` | string | optional | Name or part of the name to search the customers by. |
| `RoomNumber` | string | optional | Room number to search the current hotel guests by. |

#### Response

```json
{
    "Customers": [
        {
            "Id": "4AFFC34A-F4B2-4FDF-AF7B-12DB5BD76AF3",
            "FirstName": "John",
            "LastName": "Smith",
            "RoomNumber": "101"
        },
        {
            "Id": "0DB4D808-7953-4D29-ADED-CC716D73A142",
            "LastName": "Smith",
            "RoomNumber": "101"
        }
    ]
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Customers` | array of [Customer](#customer) | required | The found customers. |

##### Customer

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Id` | string | required | Unique identifier of the customer. |
| `FirstName` | string | optional | First name of the customer. |
| `LastName` | string | required | Last name of the customer. |
| `RoomNumber` | string | optional | Number of room where the customer currently stays. |

### Charge Customer

When the customer to be charged is known, the client application may actually use his `Id` to charge him.

#### Request `<ApiBase>/customers/charge`

```json
{
    "AccessToken": "...",
    "CustomerId": "4AFFC34A-F4B2-4FDF-AF7B-12DB5BD76AF3",
    "Items": [
        {
            "Name": "Beer",
            "UnitCount": 10,
            "UnitCost": {
                "Amount": 3.50,
                "Currency": "EUR",
                "Tax": 0.21
            },
            "Category": {
                "Code": "ABVG",
                "Name": "Alcoholic Beverage"
            }
        },
        {
            "Name": "Steak",
            "UnitCount": 1,
            "UnitCost": {
                "Amount": 12.8,
                "Currency": "EUR",
                "Tax": 0.15
            },
            "Category": {
                "Code": "FOOD"
            }
        }
    ],
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `AccessToken` | string | required | Access token of the client application. |
| `CustomerId` | string | required | Identifier of the customer to be charged. |
| `Items` | array of [Item](#item) | required | Items of the charge. |
| `Notes` | string | optional | Additional notes of the charge. |

##### Item

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Name` | string | required | Name of the item. |
| `UnitCount` | integer | required | Count of units to be charged, e.g. 10 in case of 10 beers. |
| `UnitCost` | [Cost](#cost) | required | Unit cost, e.g. cost for one beer (note that total cost of the item is therefore `UnitCount` times `UnitCost`). |
| `Category` | [Category](#category) | optional | Category of the item, e.g. "Alcoholic Beverage" category in case of "Beer" item. |

##### Cost

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Amount` | decimal | required | Amount including tax. |
| `Currency` | string | required | ISO-4217 currency code, e.g. "EUR" or "USD". |
| `Tax` | decimal | required | Tax rate, e.g. 0.21 in case of 21% tax rate.  |

##### Category

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Code` | string | required | Unique code of the category (can be e.g. used to map POS categories to accounting categories in the hotel system). |
| `Name` | string | optional | Name of the category.  |

#### Response

```json
{
    "ChargeId": "BD94881A-6947-4E2F-BB24-C4EB5C3E7792"
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `ChargeId` | string | required | Identifier of the created charge. |

## Environments

#### Test Environment

This environment is meant to be used during implementation of the client applications:

- **API Base Address** - `https://mews-test.azurewebsites.net/api/charging/v1`
- **API Access Token** - `TODO`

You will also have access into the system so it is possible for you to check whether the charges sent to the API are correctly posted to customers in the system. To sign into the system, use the following credentials:

- **System Address** - `https://mews-test.azurewebsites.net/`
- **Email** - `TODO`
- **Password** - `TODO`

When you sign in, you can use the search box on top to find the customer you charged through the API. Then on the customers dashboard, there should be the charge under section "Processed Orders" in case everything went correctly.

#### Production Environment

- **API Base Address** - `https://www.mews.li/api/charging/v1`
- **API Access Token** - Depends on the hotel, should be provided to you by the hotel administrator.
