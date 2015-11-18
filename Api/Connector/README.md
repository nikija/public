# Connector API (v1)

The Connector API allows external applications to mediate communication between devices that or accessible over local network on the hotel site and the MEWS. There may be several types of connector clients. For example a client that would fetch device commands from the MEWS, execute them on physical devices that are locally accessible and send the command results back to MEWS. Or different client can retrieve some information from MEWS and forward the data to some other system (e.g. heating system, lock system).

First of all, please have a look at [MEWS API Guidelines](https://github.com/MewsSystems/public/tree/master/Api) which describe general usage guidelines of MEWS APIs.

## Contents

- [Authorization](#authorization)
- [Operations](#operations)
    - [Get All Commands](#get-all-commands)
    - [Update Command](#update-command)
    - [Get All Spaces](#get-all-spaces)
    - [Get All Reservations](#get-all-reservations)
    - [Sign in](#sign-in)
- [Devices](#devices)
    - [Printers](#printers)
- [Environments](#environments)
    - [Demo Environment](#demo-environment)
    - [Production Environment](#production-environment)

## Authorization

All operations of the API require `AccessToken` to be present in the request. In production environment, the `Token` will be provided to you by the hotel admin. For development purposes, consult the  [Demo Environment](#demo-environment) section.

The API also supports more advanced scenario with session management, which makes it simple to ensure that only one client is active at a time. That is particulary useful if the client communicates with a physical device that does not support parallel connections/communication. For more information, see the [Sign in](#sign-in) operation.

## Operations

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
    "AccessToken": "210F2620DDAE4A988D26DEB3A5B75B2F-77EB7EA147D2EAB4863054EB85FFACE"
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
    "AccessToken": "210F2620DDAE4A988D26DEB3A5B75B2F-77EB7EA147D2EAB4863054EB85FFACE",
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

### Get All Spaces

Returns all spaces of an enterprise associated with the connector integration.

#### Request `[PlatformAddress]/api/connector/v1/spaces/getAll`

```json
{
    "AccessToken": "210F2620DDAE4A988D26DEB3A5B75B2F-77EB7EA147D2EAB4863054EB85FFACE"
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
            "Number": "101",
            "ParentSpaceId": null
        },
        {
            "Id": "c32386aa-1cd2-414a-a823-489325842fbe",
            "Number": "102",
            "ParentSpaceId": null
        }
    ]
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Spaces` | array of [Space](#space) | required | The spaces of the enterprise. |

##### Space

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Id` | string | required | Unique identifier of the space. |
| `Number` | string | required | Number of the space (e.g. room number). |
| `ParentSpaceId` | string | optional | Identifier of the parent space (e.g. room of a bed). |

### Get All Reservations

Returns all reservations that collide with the specified interval.

#### Request `[PlatformAddress]/api/connector/v1/spaces/getAll`

```json
{
    "AccessToken": "210F2620DDAE4A988D26DEB3A5B75B2F-77EB7EA147D2EAB4863054EB85FFACE",
    "StartUtc": "2016-01-01T00:00:00Z",
    "EndUtc": "2016-01-07T00:00:00Z"
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
    "Reservations": [
        {
            "AssignedSpaceId": "5ee074b1-6c86-48e8-915f-c7aa4702086f",
            "Companions": [
                {
                    "Email": null,
                    "FirstName": "Jane",
                    "Id": "2a1a4315-7e6f-4131-af21-402cec59b8b9",
                    "LastName": "Smith",
                    "Phone": null
                },
                {
                    "Email": "john.smith@mews.li",
                    "FirstName": "John",
                    "Id": "35d4b117-4e60-44a3-9580-c582117eff98",
                    "LastName": "Smith",
                    "Phone": null
                }
            ],
            "Customer": {
                "Email": "john.smith@mews.li",
                "FirstName": "John",
                "Id": "35d4b117-4e60-44a3-9580-c582117eff98",
                "LastName": "Smith",
                "Phone": null
            },
            "EndUtc": "2019-12-30T23:00:00Z",
            "Id": "2bbb5d8a-0492-4271-9941-cd6d89b81d43",
            "StartUtc": "2015-07-07T00:00:00Z",
            "State": "Started"
        }
    ]
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Reservations` | array of [Reservation](#reservation) | required | The reservations that collide with the specified interval. |

##### Reservation

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Id` | string | required | Unique identifier of the reservation. |
| `State` | string | required | State of the reservation. One of: `Confirmed` (before check-in), `Started` (checked-in) or `Processed` (checked-out). |
| `StartUtc` | string | required | Start of the reservation (arrival) in UTC timezone in ISO 8601 format. |
| `EndUtc` | string | required | End of the reservation (departure) in UTC timezone in ISO 8601 format. |
| `AssignedSpaceId` | string | optional | Identifier of the assigned space. |
| `Customer` | [Customer](#customer) | required | Owner of the reservation. |
| `Companions` | array of [Customer](#customer) | required | Customers that will occupy the space. |

##### Customer

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Id` | string | required | Unique identifier of the customer. |
| `FirstName` | string | optional | First name of the customer. |
| `LastName` | string | required | Last name of the customer. |
| `Email` | string | optional | Email address of the customer. |
| `Phone` | string | optional | Phone number of the customer (possibly mobile). |

### Sign in

Signs in the client application to MEWS using a token that you would normally use as the `AccessToken` in all operations as described in [Authorization](#authorization) section. Returns a new `AccessToken` that should be passed to all other operations. Note that the returned `AccessToken` has limited validity - only until next successful sign in operation. After that, the `AccessToken` returned by the first sign in operation is no longer valid. As a consequence, there is always at most one client with valid `AccessToken`, i.e. the client that signed in last.

#### Request `[PlatformAddress]/api/connector/v1/app/signIn`

```json
{
    "ConnectorToken": "0F7F56DBB8B342B08B532DF4C8A87997-D3FFAC0F8E438572A1B142B0203CAEA"
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `ConnectorToken` | string | required | Unique token identifying the client application. Can be obtained from MEWS from enterprise settings. |

#### Response

```json
{
    "AccessToken": "210F2620DDAE4A988D26DEB3A5B75B2F-77EB7EA147D2EAB4863054EB85FFACE"
}
```

| Property | Type | | Description |
| --- | --- | --- | --- |
| `AccessToken` | string | required | An access token representing the client application session.

## Devices

### Printers

Device type: `Printer`

#### Command Data

| Property | Type | | Description |
| --- | --- | --- | --- |
| `CopyCount` | number | required | Number of copies to be printed. |
| `FileType` | string | required | MIME type of the file to be printed (e.g. `application/pdf`). |
| `FileData` | string | required | Base64-encoded data of the file to be printed. |
| `PrinterName` | string | required | Name of the printer. |
| `PrinterDriverName` | string | required | Name of the printer driver. |
| `PrinterPortName` | string | required | Name of the printer port. |

#### Command Result

Not used.

## Environments

#### Demo Environment

This environment is meant to be used during implementation of the client applications.

- **Platform Address** - `https://demo.mews.li`
- **Access Token** - `5F18C5C09ABE3773`

The hotel is based in UK, it accepts `GBP`, `EUR` and `USD` currencies (any of them may be used), as a tax rate, either `0.0`, `0.05` or `0.20` can be used. The predefined accounting categories have codes: `FOOD`, `BVG` and `ABVG`. To sign into the system, use the following credentials:

- **Address** - `https://demo.mews.li`
- **Email** - `connector-api@mews.li`
- **Password** - `connector-api`

#### Production Environment

- **Platform Address** - `https://www.mews.li`
- **Access Token** - Depends on the hotel, should be provided to you by the hotel admin.

