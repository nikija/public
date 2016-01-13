---
title: Distributor Standalone
---
Distributor for your hotel is available as standalone version, hosted on our servers. You can simply provide a link from your website and not worry about anything else. However, you cannot setup any custom option this way (other than default language).

Address of the Distributor standalone page has the following format:
```
https://www.mews.li/distributor/edge/aaaa-bbbb-cccc-dddd-eeeeeeee
```

The `aaaa-bbbb-cccc-dddd-eeeeeeee` part should be replaced with id of your hotel.

### Customization

Customization of standalone Distributor is done by url query parameters. Currently it's limited only to a default language.

| Parameter | Example | Description |
| --- | --- | --- |
| `language` | `language=en-US` | Language the Distributor should be opened in. Supported values correspond to codes of allowed languages for your hotel as set in Commander. Invalid value will fallback to default language of your hotel. |
