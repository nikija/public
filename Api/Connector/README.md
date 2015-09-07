# Connector API (v1)

The Connector API allows external applications to fetch device commands from the MEWS, execute them on physical devices that are locally accessible to the applications and send the command results back to MEWS.

First of all, please have a look at [MEWS API Guidelines](https://github.com/MewsSystems/public/tree/master/Api) which describe general usage guidelines of MEWS APIs.

## Contents

- [Operations](#operations)
    - [Sign in](#sign-in)
    - [Get Active Commands](#get-active-commands)
    - [Update Command](#update-command)
- [Devices](#devices)
    - [Printers](#printers)

## Operations

### Sign in

Signs in the client application to MEWS using a `ConnectorToken`. Returns `AccessToken` that has to be passed to all other operations in order for the application to be authorized. Note that the `AccessToken` is valid only until the `ConnectorToken` is used again. After that, the `AccessToken` returned by the first sign in operation is no longer valid.

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
| `AccessToken` | string | required | An access token representing the client application session. |

### Get Active Commands

A device command is in one of the following states:

- `Pending` - A command that is created in MEWS, but not yet received by a client application.
- `Received` - A command received by a client application.
- `Processing` - A command that is being processed.
- `Processed` - A successfully processed command.
- `Cancelled` - A command whose execution has been cancelled before (or during) processing.
- `Error` - A command whose execution was or processing was terminated by an error.

This operation returns all commands the are still active from the client application point of view. That means commands that are in either of `Pending`, `Received` or `Processing` states.

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

## Devices

### Printers (device type `Printer`)

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
