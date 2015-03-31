# Charging API (v1)

The Charging API allows external applications to charge hotel guests for services that were not provided directly by the hotel or that are managed by an external system. For example it allows a restaurant POS system to charge the guests on their open hotel bills. 

First of all, please have a look at [MEWS API Guidelines](https://github.com/MewsSystems/public/tree/master/Api) which describe general usage guidelines of MEWS APIs.

## Contents

- [Operations](#operations)
    - [Search Customers](#search-customers)
    - [Charge Customer](#charge-customer)
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
    "AccessToken": "2BEC1AC810DB4983BA996174827BB259-85AEFF6419BAF4BE76E0270A9FA1E20",
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
            "FirstName": "Nicolas",
            "Id": "e92f12f3-96ad-449d-a0ff-053fd5e78157",
            "LastName": "Cage",
            "RoomNumber": "206"
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

When the customer to be charged is known, the client application should use his `Id` to charge him.

#### Request `[PlatformAddress]/api/charging/v1/customers/charge`

```json
{
    "AccessToken": "2BEC1AC810DB4983BA996174827BB259-85AEFF6419BAF4BE76E0270A9FA1E20",
    "CustomerId": "e92f12f3-96ad-449d-a0ff-053fd5e78157",
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

This environment is meant to be used during implementation of the client applications. We have prepared one hotel whose customers you should be able to charge through the API with the following setup:

- **Platform Address** - `https://mews-test.azurewebsites.net`
- **Access Token** - `2BEC1AC810DB4983BA996174827BB259-85AEFF6419BAF4BE76E0270A9FA1E20`

The test hotel is based in UK, it accepts `GBP`, `EUR` and `USD` currencies (any of them may be used), as a tax rate, either `0.0`, `0.05` or `0.20` can be used. You will also have access into the system so it is possible for you to check whether the charges sent to the API are correctly posted to customers in the system. To sign into the system, use the following credentials:

- **Address** - `https://mews-test.azurewebsites.net/`
- **Email** - `charging-api@mews.li`
- **Password** - `charging-api`

When you sign in, you can use the search box on top to find the customer you charged through the API. Then on the customers dashboard, there should be the charge under section "Processed Orders" in case everything went correctly.

#### Production Environment

- **Platform Address** - `https://www.mews.li`
- **Access Token** - Depends on the hotel, should be provided to you by the hotel administrator.

## Use case

A simple example: there is a restaurant that is used by hotel customers. When a customer wants to pay in this restaurant he asks for the bill. Cash or credit card can be used directly within the restaurant - in that case the API is not used at all.

Or he could say "My name is Smith, I am staying in the hotel in room 123." Or write this information on the bill. In this case the restaurant employee should check on the POS, whether there is a guest named Smith and whether they indeed stay in room 123. The POS asks Mews via the API about the customer and Mews returns a list of all customers in room 123, or all customers with provided name.

If everything is OK and chargeable customers returned from the API contain the guest, restaurant employee can charge the customer's hotel bill and should notify the customer that the bill is closed and added to his hotel account. If no chargeable customer is found, then the guest should be invited to pay in the restaurant.
