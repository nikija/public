# MEWS API Guidelines

All public APIs provided by the MEWS platform share a set of common properties which are described in the following document.

### Requests

The APIs accept only HTTP POST requests with `Content-Type` set to `application/json` and JSON content depending on the operation to be performed. In order to perform an operation, the client needs to know the **operation address** where to send the request. All APIs follow this operation address pattern:

```
[PlatformAddress]/api/[ApiName]/[ApiVersion]/[Resource]/[Operation]
```

- **PlatformAddress** - Base address of the MEWS platform, depends on environment (testing, staging, production).
- **ApiName** - Name of the API.
- **ApiVersion** - Version of the API, since there might be multiple versions of one API.
- **Resource** - Logical group of operations, in most cases identifies target of the operations.
- **Operation** - Name of the operation to be performed.

As an example, here is address of the "user sign in" operation in the Navigator API on production environment:

```
https://www.mews.li/api/navigator/v1/users/signIn
```

The available values that can be used in particular cases are described in documentation of the APIs.

### Responses

An API responds with `Content-Type` set to `application/json` and JSON content. In case of success, the HTTP status code is 200 and the content contains result according to the call. In case of error, there are multiple HTTP status codes for different types of errors:

- **400 Bad Request** - Error caused by the client app, e.g. in case of malformed request or invalid identifier of a resource. In most cases, such an error signifies a bug in the client app (cosnumer of the API).
- **401 Unauthorized** - Error caused by usage of invalid access token. 
- **403 Forbidden** - Server error that should be reported to the end user of the client app. Happens for example when the server-side validation fails or when a business-logic check is violated. 
- **500 Internal Server Error** - Unexpectced error of the server. In most cases, such an error signifies a bug on our side. We are logging it and on production environment, we are immediately notified when this error happens. If anything like this happens, feel free to directly contact us or raise an issue here on Github.

In case of any error, the returned JSON object describes the error and has the following properties:

| Property | Type | | Description |
| --- | --- | --- | --- |
| `Message` | string | required | Description of the error. |
| `Details` | string | optional | Additional details about the error (request, headers, server stack trace, inner exceptions etc.). Only available on development environment. |

Some errors may also contain additional information relevant to the error on top of this two properties. But that depends on the operation and is specificly described in the operation documentation.
