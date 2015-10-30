# MEWS Distributor Edge - The Widget Guide

- [Install](#install)
- [Advanced Features](#advanced)
    - [Payment Gateways](#payment)
    - [Google Analytics](#ga)
- [Options](#options)
    - [Customization](#customization)
- [API](#api)
- [Standalone Distributor](#link)

<a name="install"></a>
Install
---

### Dependencies

There are no dependencies, everything that Distributor Edge needs is bundled into its script. 

### Script

Include the following script with embed-ready version of Distributor into your website.

```html
<script src="https://www.mews.li/distributor/edge/distributor.min.js"></script>
```

### Styles

Distributor Edge doesn't use separate css files, everything is packed inside the script. For possible customizations, consult [Customization](#customization) section.

## Usage

Once required script is loaded, you can initialize Distributor Edge with the following minimal code. Do not forget to **use hotelId of your hotel** instead of the sample hotelId `aaaa-bbbb-cccc-dddd-eeeeeeee`. This will create a separate overlay in your website and loads Distributor into it. 

The overlay is not visible by default - to actually show it to your users, you should bind its opening to some action (i.e. clicking on button). Distributor can do it automatically for you if you provide second option - a string of comma separated css selectors of elements, whose click event will be binded with opening of Distributor.

```html
<!-- Distributor's initialization call, creating new instance of Distributor. Use id of your hotel. -->
<script>
    Mews.Distributor({
        hotelId: 'aaaa-bbbb-cccc-dddd-eeeeeeee',
        openElements: '.open-distributor-button'
    });
</script>
```
If you need more specific setup of opening Distributor, or you want to call some api functions on Distributor instance, you can provide a callback function as second argument to initialization call - the instance is provided as an argument to the callback.

```
<script>
    Mews.Distributor({
        hotelId: 'aaaa-bbbb-cccc-dddd-eeeeeeee'
    }, function(distributor) {
        // you can call api functions on distributor instance here
    });
</script>
```

To see a list of all available api calls, please consult [API](#api) section.

Closing of Distributor is provided in the overlay by default, so you don't have to worry about that.

#### Done!

This is all you need for the basic setup of Mews Distributor. Any other code snippet in this documentation is for advanced usage.

<a name="advanced"></a>
Advanced features (optional)
---

#### All possible options

Example with all possible options and their default values:

```html
<script>
Mews.Distributor({
    // required
    hotelId: '',

    // optionals
    openElements: '',
    language: 'en-US',
    currency: 'EUR',
    endDate: null,
    startDate: null,
    voucherCode: '',
    rooms: null,
    ecommerce: false,
    hashEvents: false,
    ecommerceTrackerName: null,
    gaTrackerName: null,
    onOpened: function(distributor){ },
    onClosed: function(distributor){ },
    onLoaded: function(distributor){ },

    // theme
    theme: {
        fontFamily: null
        primaryColor: null
    }
}, function(distributor) {
    // api calls
    distributor.open();
    distributor.setStartDate(date);
    distributor.setEndDate(date);
    distributor.setVoucherCode(code);
    distributor.setRooms(rooms);
});
</script>
```

#### Note
See that you have just one `<script>` tag containing `Mews.distributorEmbed` call in your page.

<a name="payment"></a>
### Payment Gateways

<a name="braintree"></a>
#### Braintree (credit card payment gateway)

[Braintree](https://www.braintreepayments.com/) is gateway used by Distributor Edge for making payments for reservations with credit card. This gateway is not used by default, because it must be configured specifically for each hotel. To start using it, you need to obtain *ClientKey* and *MerchantId* and fill both in Commander.

Reservations without using Braintree and providing credit card informations are possible, however these reservation will have note in Commander stating that they have been created with invalid credit card.

**Important:**
PCI Security Standard requires you to use **SSL Certificate** on you website in order to be allowed collecting any payments info. Therefore Braintree can't allow you to send credit card info from order form without using one.

#### TODO: Adyen ?

<a name="ga"></a>
### Google Analytics

If you have Google Analytics configured on your website using standard naming convention for global variable holding its object - `ga` or `_gaq` - then Distributor will automatically use it for sending events. Tracked events are:
- `Opened` - the Distributor was opened
- `Dates selected` - both start and end dates were selected
- `Room selected` - a room was selected by clicking on 'Show Rates' button, its name is send as action argument
- `Booking finished` - a booking was finished by sending out filled checkout form

You can use also get those trackings as page views with different url hashes by setting `hashEvents` to `true`. Just be aware that this can actually mess up with your website if you're already using url hashes for routing!

Also, you can enable ecommerce tracking by setting `ecommerce` option to `true`. Transaction will be send upon finishing booking, with reservation group id set as transaction id and affiliation set as *Mews Distributor*. Each room in order will be added as a transaction item, with confirmation number set as sku. Total price and prices for each room reservation in group are also included. Currency used is the hotel's default currency as set in the Commander.

#### Multiple trackers

When setting up page, multiple instances of Google Analytics can be used to track events for different accounts or for different purposes. Distributor`s initialization options allows you to specify names of trackers of ecommerce and for rest of google analytics reporting. Names can point to the same tracker, or two distinct trackers. You can also omit names of trackers. In that case, default - unnamed - tracker will be used. 

Please note, that some Google Analytics applications can set up their own named trackers. If you wish to used them to report GA events, check their configuration for correct name. This is especially important in case Google Tag Manager is in use, but no other default Google Analytics trackers are being setup on page. 

<a name="options"></a>
Options
-------

### hotelId (required)
Type: `string` Default `''`

Guid of hotel used for identification in API calls. 

Currently, you can get guid of your hotel from your hotel's detail page in Commander (under Settings > "Your hotel's name" ). The guid is shown under General Settings as Identifier.

### openElements
Type: `string` Default `''`

List of comma separated css selectors of elements which will get automatically attached click event listeners for opening Distributor. The string is given as argument to `document.querySelectorAll` function, you get more info about its resemblance [here](https://developer.mozilla.org/en-US/docs/Web/API/Document/querySelectorAll) for example.

### language
Type: `string` Default: `en-US`

Language code for default selected language of localization. Supported values corresponds to codes of allowed languages for your hotel as set in Commander. Invalid value will fallback to default language of your hotel.

### currency
Type: `string` Default: `EUR`

Currency code for default selected currency of prices. Supported values corresponds to codes of allowed currencies for your hotel as set in Commander.
Invalid value will fallback to default currency of your hotel.

### startDate
Type: `Date` Default: `today`

Default value for a reservation start date.

### endDate
Type: `Date` Default: `today + 2 days`

Default value for a reservation start date.

### voucherCode
Type: `string` Default: `''`

Default value for a voucher code.

### rooms
Type: `Array` Default: `null`

List of guids of room types to display in Distributor. If empty, all rooms are displayed.

Currently, you can get guid of room type from room type's detail page in Commander. The page can be found from room criteria's page (under Settings > "Your hotel's name" > Room criteria ) by selecting Room type criterion, and then by selecting corresponding room type from side menu. The guid is listed there as Identifier.

### ecommerce
Type: `boolean` Default: `false`

Enables Google Analytics ecommerce tracking.

### hashEvents
Type: `boolean` Default: `false`

Enables Google Analytics page view tracking with url hashes.

### theme
Type: `object`

Object used for setting custom theme values. See next section for more info.

### ecommerceTrackerName
Type: `string`

Name of the Google Analytics tracker, that should be used to report ecommerce tracking. If not used, default tracker without name will be used. 

### gaTrackerName
Type: `string`

Name of the Google Analytics tracker, that should be used to report google analytics tracking. If not used, default tracker without name will be used. 

### onOpened
Type: `function`

Callback function that will be called every time Distributor's window is opened (regardless if by API call, or by clicking `openElements`). Function has one parametr, which is reference to distributors API. 

### onClosed
Type: `function`

Callback function that will be called every time Distributor's window is closed (regardless if by API call, or by clicking close button in Distributor itself). Function has one parametr, which is reference to distributors API. 

### onLoaded
Type: `function`

Callback function that will be called once Distributor finnished loading itself into page and is ready for use. Function has one parametr, which is reference to distributors API. 

<a name="customization"></a>
## Customization

Distributor Edge has all styles written in javascript and bundled into the script. This way we can limit possibility of clashes when it's included into your website. To allow customization, we have `theme` option, taking your custom values. Currently supported are:

### fontFamily
Type: `string`

Name of the font to use, same as the CSS value `font-family`

### primaryColor
Type: `string`

Value for primary color. Accepted are all possible denominations of color in CSS, except explicit color names (i.e 'red').

<a name="api"></a>
API
---

### open()

Opens Distributor in it's overlay.

### setStartDate(date)
- `date` Type: `date` - The start date to set

Sets start date for new availability query, currently loaded availability list is not affected. If `date` is not valid Date object or its value isn't allowed as start date, nothing happens.

### setEndDate(date)
- `date` Type: `date` - The end date to set

Sets end date for new availability query, currently loaded availability list is not affected. If `date` is not valid Date object, nothing happens.

### setVoucherCode(code)
- `code` Type: `string` - The voucher code to set

Sets a new voucher code value.

### setRooms(rooms)
- `rooms` Type: `Array` - The list of guids of rooms to be displayed (see `rooms` option for more details)

Sets new list of displayed room types, overwriting initial rooms option value. Currently loaded availability list is not affected.

<a name="link"></a>
## Standalone Distributor

Distributor for your hotel is also available as standalone version, hosted on our servers. You can simply provide a link from your website and don't worry about anything else. However, you can't setup any custom option this way (other than default language). 

The url address is
```
https://www.mews.li/distributor/edge/aaaa-bbbb-cccc-dddd-eeeeeeee
```
where `aaaa-bbbb-cccc-dddd-eeeeeeee` is your hotelId.

### Customization

Customization of Standalone Distributor is done by providing url query parameters. Currently it's limited only to setting a default language.

- `language={language-code}` - Language code of a default language. Supported values corresponds to codes of allowed languages for your hotel as set in Commander. Invalid value will fallback to default language of your hotel.  
