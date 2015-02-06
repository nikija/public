# ServiceApi Draft (Work in progress)

## Customer Search

### Sample

#### Request

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
            "FirstName": "Jane",
            "LastName": "Smith",
            "RoomNumber": "101"
        }
    ]
}
```


## Service Charge
