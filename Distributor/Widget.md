# MEWS Distributor - Widget Guide

- [Install](#install)
- [Usage](#usage)
    - [Braintree](#braintree)
    - [Google Analytics](#google-analytics)
- [Options](#options)
- [API](#api)

<a name="install"></a>
## Install

### Dependencies

- [jQuery](http://jquery.com/download/) >= 1.9.0 

### Script

Include one of the following scripts into your website:

```html
<!-- Current version -->
<script src="https://www.mews.li/distributor/current/distributor.js"></script>

<!-- Current version minified -->
<script src="https://www.mews.li/distributor/current/distributor.min.js"></script>
```

### Styles

Provided css styles are optional and can be completely replaced with custom css. There are two variants of the styles: **basic** and for opening in **overlay**.

```html
<!-- Current basic css -->
<link rel="stylesheet" href="https://www.mews.li/distributor/current/distributor.css" />

<!-- Current overlay css -->
<link rel="stylesheet" href="https://www.mews.li/distributor/current/distributor-overlay.css" />
```

<a name="usage"></a>
## Usage

Distributor requires at least one element in website, which will serve as its container. Additionaly, you can add multiple banner elements.

Once required files are loaded, you can initialize Distributor with the following minimal code. Do not forget to **use hotelId of your hotel** instead of the sample hotelId `aaaa-bbbb-cccc-dddd-eeeeeeee`.

```html
<!-- Distributor's element, insert anywhere in website -->
<div id="mews-distributor"></div>

<!-- Distributor's banner, you can have multiple of these -->
<div class="mews-distributor-banner"></div>

<!-- Distributor initialization script. Use id of your hotel. -->
<script>
    new Mews.Distributor({
        hotelId: "aaaa-bbbb-cccc-dddd-eeeeeeee"
    });
</script>
```

#### Done!

This is all you need for the basic setup of Mews Distributor. Any other code snippet in this documentation is for advanced usage.

### Advanced features (optional)

#### Overlay style

For using default overlay style, you need to link `distributor-overlay.css` in website and use at least these options:

```html
<script>
new Mews.Distributor({
  hotelId: {your_hotel_id},
  style: 'overlay',
});
</script>
```

#### All possible options

Example with all possible options and their default values:
```html
<script>
var distributor = new Mews.Distributor({
    // required
    hotelId: '',
    // optionals
    element: '#mews-distributor',
    banner: '.mews-distributor-banner',
    language: 'en-US',
    peopleCount: 2,
    maxPeopleCount: 0,
    rooms: [],
    loadOverlayCss: false,
    loadCss: true,
    style: 'simple',
    loaded: function() { },
    opened: function() { },
    closed: function() { },
    onStartDateChanged: function(date) { },
    onEndDateChanged: function(date) { },
    ecommerce: false,
    orderByLowestPrice: true,
    // experimental
    fragments: false,
    // development
    location: 'https://www.mews.li/',
});
</script>
```

Returned object can be used for making api calls on Distributor instance:

```html
<script>
var distributor = new Mews.Distributor({...});

distributor.toggle();
distributor.setStartDate(date);
distributor.setEndDate(date);
distributor.setPeopleCount(count);
distributor.setRoomsList(rooms);
</script>
```

#### Note
See that you have just one `<script>` tag containing `new Mews.Distributor` in your page.

<a name="braintree"></a>
### Braintree (credit card payment gateway)

[Braintree](https://www.braintreepayments.com/) is gateway used by Distributor for making payments for reservations with credit card. This gateway is not used by default, because it must be configured specifically for each hotel. To start using it, you need to obtain *ClientKey* and *MerchantId* and fill both in Commander.

Reservations without using Braintree and providing credit card informations are possible, however these reservation will have note in Commander stating that they have been created with invalid credit card.

**Important:**
PCI Security Standard requires you to use **SSL Certificate** on you website in order to be allowed collecting any payments info. Therefore Braintree can't allow you to send credit card info from order form without using one.

### Google Analytics

If you have Google Analytics configured on your website using standard naming convention for global variable holding its object - `ga` or `_gaq` - then Distributor will use it for sending events. Tracked events are:
- `Opened` - the Distributor was opened
- `Dates selected` - both start and end dates were selected
- `Room selected` - a room was selected by clicking on 'Book now' button, its name is send as action argument
- `Booking finished` - a booking was finished by clicking on 'Finish' button

Also, you can enable ecommerce tracking by setting `ecommerce` option to `true`. Transaction will be send upon finishing booking, with reservation group id set as transaction id and affiliation set as *Mews Distributor*. Each room in order will be added as transaction item, with sku set as room id. Item's price is not added, only transaction total cost is currently supported.

Options
-------

### hotelId (required)
Type: `string` Default `''`

Guid of hotel used for identification in API calls. 

Currently, you can get guid of your hotel from url of hotel's detail page in 
Commander (under Settings > "Your hotel's name" ). The url is 
`https://mews.li/Employees/Hotel/Detail/{hotelId}` and guid is the last part of 
it, i.e. 64ab5cc6-ef1f-4b1d-a421-1b5833645ce4.

### element
Type: `string` Default `#mews-distributor`

Css selector of element where will Distributor render itself. The element should
unique on website.

### banner
Type: `string` Default: `.mews-distributor-banner`

Css selector of elements for Distributor's banners rendering. These elements can
repeat on website.

### language
Type: `string` Default: `en-US`

Language code for Distributor localization. Supported values corresponds to 
codes of allowed languages for your hotel in Commander. Invalid values fallbacks
to default language.

### peopleCount
Type: `number` Default: `2`

Default number of people selected for reservation. Only positive numbers are accepted, upper limit is `maxPeopleCount` if used, or unlimited otherwise.

### maxPeopleCount
Type: `number` Default: `0`

Upper limit to allowed number of people selected for reservation. If set to `0`, upper limit is determined from maximum of number of beds among room types. Only positive numbers are accepted, upper limit is not set.

### rooms
Type: `array` Default: `[]`

List of guids of room types to display in Distributor. If empty, all rooms are 
displayed. 

Currently, you can get guid of room type from url of room type's detail page in 
Commander. The page can be found from room criteria's page (under Settings > 
"Your hotel's name" > Room criteria ) by selecting *Room type* criterion, and 
then by selecting corresponding room type from side menu. The url is
`https://mews.li/Employees/RoomCategory/Detail/{roomGuid}` and guid is the last
part of it, i.e. 64ab5cc6-ef1f-4b1d-a421-1b5833645ce4.

### loadOverlayCss
Type: `boolean` Default: `false`

Enables automatic load of css with overlay by Distributor's script. Setting to 
`true` disallows autoloading of css styles with `loadCss` option.

### loadCss
Type: `boolean` Default: `true`

Enables automatic load of basic css by Distributor's script. It is ignored when
`loadOverlayCss` is set to `true`.

### style
Type: `string` Default: `simple` Allowed: `simple|overlay`

Set it to `overlay` if you want to use css with overlay. 

This options now serves only for correct setting of click event handlers for 
overlay layer. It will be removed in future.

### loaded
Type: `function` Default: `function() { }`

Sets callback used when Distributor's instance is loaded for a first time.

### opened
Type: `function` Default: `function() { }`

Sets callback used when Distributor's instance is opened with `toggle()` api call.

### closed
Type: `function` Default: `function() { }`

Sets callback used when Distributor's instance is closed with `toggle()` api call.

### onStartDateChanged
Type: `function` Default: `function(date) { }`

Sets callback used when start date of reservation is changed either by selecting in 
calendar or through `setStartDate(date)` api call.

### onEndDateChanged
Type: `function` Default: `function(date) { }`

Sets callback used when end date of reservation is changed either by selecting in 
calendar or through `setEndDate(date)` api call.

### ecommerce
Type: `boolean` Default: `false`

Enables Google Analytics ecommerce tracking.

### orderByLowestPrice
Type: `boolean` Default: `true`

Orders available rooms by lowest price first.

### fragments (experimental)
Type: `boolean` Default: `false`

**This option is experimental and should be used on your own risk.**

**Known issue: using fragments disallows using multiple Distributor instances on same website.**

Enables using url hash fragments marking events in Distributor. The events are
equivalent to tracked GA events.

### location (development)
Type: `string` Default: `https://www.mews.li/`

Url address of server, used for making api calls and loading assets. Do not change this, unless you know what you are doing.

API
---

### togle()

Toggles opened/closed state of Distributor. The state itself is marked by setting
css classes:
- opened: element has `mews-widget-opened`, body tag has `mews-widget-is-opened`
- closed: element has `mews-widget-closed`, body tag has `mews-widget-is-closed`

When toggling, custom callbacks `opened` and `closed` are fired.

### setStartDate(date)
- `date` Type: `date` - The start date to set

**This api call works only after distributor is fully loaded (i.e in `loaded` callback)**

Sets start date of reservation without ui animations. Calendar is closed
after call.

If `date` is not valid Date object or its value isn't allowed in calendar,
nothing happens.

Be aware that setting start date always clears end date.

### setEndDate(date)
- `date` Type: `date` - The end date to set

**This api call works only after distributor is fully loaded (i.e in `loaded` callback)**

Sets end date of reservation without ui animations. Calendar is closed
after call

If `date` is not valid Date object or its value isn't allowed in calendar,
nothing happens.

### setPeopleCount(count)
- `count` Type: `number` - Default count of people selected

Sets default value for people selector, overriding `peopleCount` option value.
Accepted values are only positive numbers, however maximal number allowed is
not checked.

### setRoomsList(rooms)
- `rooms` Type: `array` - Array of guids of room types (see `rooms` option)

**Calling this function clears model and restarts booking process.**

Sets new list of displayed room types, overwriting `rooms` option value.
