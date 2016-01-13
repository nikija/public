---
title: Charging API
---
# Charging API (v1)

The Charging API allows external applications to charge hotel guests for services that were not provided directly by the hotel or that are managed by an external system. For example it allows a restaurant POS system to charge the guests on their open hotel bills.

First of all, please have a look at [MEWS API Guidelines](https://github.com/MewsSystems/public/tree/master/Api) which describe general usage guidelines of MEWS APIs.

## Contents

- [Operations](#operations)
    - [Search Customers](#search-customers)
    - [Create Customer](#create-customer)
    - [Charge Customer](#charge-customer)
    - [Settle Customer](#settle-customer)
- [Environments](#environments)
    - [Test Environment](#test-environment)
    - [Production Environment](#production-environment)
- [Use Case](#use-case)

## Operations

### Search Customers

In order to charge a person, the client application first needs to obtain full information about the customers from the hotel system. The customers may be searched by name (or part of the name), room number or both. If both room number and name are empty, then all chargeable customers are returned.

#### Request `[PlatformAddress]/api/charging/v1/customers/search`

```json
{
    "AccessToken": "0F7F56DBB8B342B08B532DF4C8A87997-D3FFAC0F8E438572A1B142B0203CAEA",
    "Name": "Smith",
    "RoomNumber": "203"
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
            "FirstName": "Jane",
            "Id": "2a1a4315-7e6f-4131-af21-402cec59b8b9",
            "LastName": "Smith",
            "RoomNumber": "203"
        },
        {
            "FirstName": "John",
            "Id": "35d4b117-4e60-44a3-9580-c582117eff98",
            "LastName": "Smith",
            "RoomNumber": "203"
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

### Create Customer

In some use cases, the client application has to be able to create customers. For example when the service can be ordered in advance without the customer having yet any reservation or profile in the hotel. This can be case of resellers of the hotel services, e.g. event space resellers, spa treatment resellers etc. Normal POS systems should not need to use this call.

In our system, the customers are uniquely identified by emails. If there is already a customer with email equal to email provided in the request, the system actually doesn't create any new customer profile. The response just contains information about the existing customer. The data of existing customer are left intact, since the data in the system are more trustworthy to the hotel than data provided by the client application.

#### Request `[PlatformAddress]/api/charging/v1/customers/create`

```json
{
    "AccessToken": "0F7F56DBB8B342B08B532DF4C8A87997-D3FFAC0F8E438572A1B142B0203CAEA",
    "Email": "john@smith.com",
    "FirstName": "Peter",
    "LastName": "Smith",
    "Telephone": "123456789"
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `AccessToken` | string | required | Access token of the client application. |
| `Email` | string | required | Email of the customer that serves as a unique identifier. |
| `FirstName` | string | optional | First name of the customer. |
| `LastName` | string | required | Last name of the customer. |
| `Telephone` | string | optional | Telephone (or mobile phone) of the customer. |

#### Response

```json
{
    "FirstName": "Peter",
    "Id": "794dbb77-0a9a-4170-9fa9-62ea4bf2a56e",
    "LastName": "Smith",
    "RoomNumber": null
}
```

The [Customer](#customer) object.

### Charge Customer

When the customer to be charged is known, the client application should use his `Id` to charge him.

#### Request `[PlatformAddress]/api/charging/v1/customers/charge`

```json
{
    "AccessToken": "0F7F56DBB8B342B08B532DF4C8A87997-D3FFAC0F8E438572A1B142B0203CAEA",
    "CustomerId": "2a1a4315-7e6f-4131-af21-402cec59b8b9",
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
                "Code": "ABVG",
                "Name": "Alcoholic Beverage"
            }
        },
        {
            "Name": "Steak",
            "UnitCount": 1,
            "UnitCost": {
                "Amount": 12.8,
                "Currency": "GBP",
                "Tax": 0.05
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
| `Category` | [Category](#category) | optional | Category of the item, e.g. "Alcoholic Beverage" category in case of "Beer" item. If the category is specified, but does not match any accounting category in the hotel system, then the category code will be added to the item name. |

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
    "ChargeId": "bd8d0d30-e213-4166-a081-37916ab8e55f"
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `ChargeId` | string | required | Identifier of the created charge. |

### Settle Customer

In case of a reseller client application, it is also possible to settle a customer by posting information about taken payments into the hotel system. Then the customer wouldn't have to pay anything (or the whole charged amount) during billing in the hotel.

#### Request `[PlatformAddress]/api/charging/v1/customers/settle`

```json
{
    "AccessToken": "0F7F56DBB8B342B08B532DF4C8A87997-D3FFAC0F8E438572A1B142B0203CAEA",
    "CustomerId": "2a1a4315-7e6f-4131-af21-402cec59b8b9",
    "PaymentValue": {
        "Amount": 100,
        "Currency": "EUR"
    },
    "PaymentIdentifier": "1234abcd",
    "Notes": "Order 42"
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `AccessToken` | string | required | Access token of the client application. |
| `CustomerId` | string | required | Identifier of the customer to be settled. |
| `PaymentValue` | [PaymentValue](#paymentvalue) | required | Value of the payment. |
| `PaymentIdentifier` | string | required | Identifier of the payment (e.g. number of the bank transaction). |
| `Notes` | string | optional | Additional notes about the payment and what is being settled. |

##### PaymentValue

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Amount` | decimal | required | Amount of the payment. |
| `Currency` | string | required | ISO-4217 currency code, e.g. "EUR" or "USD". |

#### Response

```json
{
    "PaymentId": "ec1f8523-00dd-425c-a1e7-e4d7b05300b0"
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `PaymentId` | string | required | Identifier of the created payment. |

## Environments

#### Test Environment

This environment is meant to be used during implementation of the client applications. We have prepared one hotel whose customers you should be able to charge through the API with the following setup:

- **Platform Address** - `https://demo.mews.li`
- **Access Token** - `0F7F56DBB8B342B08B532DF4C8A87997-D3FFAC0F8E438572A1B142B0203CAEA`

The test hotel is based in UK, it accepts `GBP`, `EUR` and `USD` currencies (any of them may be used), as a tax rate, either `0.0`, `0.05` or `0.20` can be used. The predefined accounting categories have codes: `FOOD`, `BVG` and `ABVG`. You will also have access into the system so it is possible for you to check whether the charges sent to the API are correctly posted to customers in the system. To sign into the system, use the following credentials:

- **Address** - `https://demo.mews.li`
- **Email** - `connector-api@mews.li`
- **Password** - `connector-api`

When you sign in, you can use the search box on top to find the customer you charged through the API. Then on the customers dashboard, there should be the charge under section "Processed Orders" in case everything went correctly.

#### Production Environment

- **Platform Address** - `https://www.mews.li`
- **Access Token** - Depends on the hotel, should be provided to you by the hotel administrator.

## Use case

A simple example: there is a restaurant that is used by hotel customers. When a customer wants to pay in this restaurant he asks for the bill. Cash or credit card can be used directly within the restaurant - in that case the API is not used at all.

Or he could say "My name is Smith, I am staying in the hotel in room 123." Or write this information on the bill. In this case the restaurant employee should check on the POS, whether there is a guest named Smith and whether they indeed stay in room 123. The POS asks Mews via the API about the customer and Mews returns a list of all customers in room 123, or all customers with provided name.

If everything is OK and chargeable customers returned from the API contain the guest, restaurant employee can charge the customer's hotel bill and should notify the customer that the bill is closed and added to his hotel account. If no chargeable customer is found, then the guest should be invited to pay in the restaurant.
