# ServiceApi Draft (Work in progress)

The ServiceApi allows external applications to charge hotel guests for services that were not provided directly by the hotel or that were managed by an external system. For example it allows a restaurant POS system to charge the guests on their open hotel bills.

## Customer Search

In order to charge a customer, the client application first needs to obtain information about the customers in order to charge the correct one. The customers may be searched by name (or part of the name), room number or both.

### Request

- `URI` - `<ApiBase>/customers/search`
- `Method` - `POST`
- `Content-Type` - `application/json`

##### Content

| Name | Type | | Description |
| --- | --- | --- | --- |
| `AccessToken` | string | required | Access token of the client application. |
| `Name` | string | optional | Name or part of the name to search the customers by. |
| `RoomNumber` | string | optional | Room number to search the current hotel guests by. |


#### Sample

```json
{
    "AccessToken": "...",
    "Name": "Smith"
}
```

```json
{
    "AccessToken": "...",
    "RoomNumber": "101"
}
```

### Response

- `Content-Type` - `application/json`

##### Content

| Name | Type | | Description |
| --- | --- | --- | --- |
| `Customers` | array of [Customer](#Customer) | required | The found customers. |

<a name="Customer"></a>
##### Customer

| Name | Type | | Description |
| --- | --- | --- | --- |
| `Id` | string | required | Unique identifier of the customer. |
| `FirstName` | string | optional | First name of the customer. |
| `LastName` | string | required | Last name of the customer. |
| `RoomNumber` | string | optional | Number of room where the customer currently stays. |

#### Sample

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

## Service Charge

When the customer to be charged is known, the client application may actually charge the customer.

### Request

- `URI` - `<ApiBase>/services/charge`
- `Method` - `POST`
- `Content-Type` - `application/json`

##### Content
 
| Name | Type | | Description |
| --- | --- | --- | --- |
| `AccessToken` | string | required | Access token of the client application. |
| `CustomerId` | string | required | Identifier of the customer to be charged. |
| `Items` | array of [ChargeItem](#ChargeItem) | required | Items of the charge. |
| `Notes` | string | optional | Additional notes of the charge. |

<a name="ChargeItem"></a>
##### ChargeItem

| Name | Type | | Description |
| --- | --- | --- | --- |
| `Name` | string | required | Name of the item. |
| `UnitCount` | integer | required | Count of units to be charged, e.g. 10 in case of 10 beers. |
| `UnitCost` | [Cost](#Cost) | required | Unit cost, e.g. cost for one beer. So the total cost of the item is `UnitCount` times `UnitCost`. |

<a name="Cost"></a>
##### Cost

| Name | Type | | Description |
| --- | --- | --- | --- |
| `Amount` | decimal | required | Amount including tax. |
| `Currency` | string | required | ISO-4217 currency code, e.g. "CZK", "EUR", "USD". |
| `Tax` | decimal | required | Tax rate, e.g. 0.21 in case of 21% tax rate.  |

#### Sample

```json
{
    "AccessToken": "...",
    "CustomerId": "4AFFC34A-F4B2-4FDF-AF7B-12DB5BD76AF3",
    "Items": [
        {
            "Name": "Beer",
            "UnitCount": 10
            "UnitCost": {
                "Amount": 3.50,
                "Currency": "EUR",
                "Tax": 0.21
            }
        },
        {
            "Name": "Steak",
            "UnitCount": 1
            "UnitCost": {
                "Amount": 12.8,
                "Currency": "EUR",
                "Tax": 0.15
            }
        }
    ],
}
```

#### Sample Response

```json
{
    "ChargeId": "BD94881A-6947-4E2F-BB24-C4EB5C3E7792"
}
```
