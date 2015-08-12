# MEWS Distributor Edge - The Next Version Widget Guide

- [Install](#install)
- [Advanced Features](#advanced)
    - [Braintree](#braintree)
    - [Google Analytics](#ga)
- [Options](#options)
    - [Customization](#customization)
- [API](#api)

<a name="install"></a>
Install
---

### Dependencies

There are no dependencies, everything that Distributor Edge needs is bundled into its script. 

### Script

Include one of the following scripts into your website. We strongly suggest using minified one, as unminified is nearly two times bigger!

```html
<!-- Current version -->
<script src="https://www.mews.li/distributor/edge/distributor.js"></script>

<!-- Current version minified -->
<script src="https://www.mews.li/distributor/edge/distributor.min.js"></script>
```

### Styles

Distributor Edge doesn't use separate css files, everything is packed inside the script. For possible customizations, consult [Customization](#customization) section.

## Usage

Distributor requires at least one element in website, which will serve as its container.

Once required file is loaded, you can initialize Distributor Edge with the following minimal code. Do not forget to **use hotelId of your hotel** instead of the sample hotelId `aaaa-bbbb-cccc-dddd-eeeeeeee`.

```html
<!-- Distributor's element, insert anywhere in website -->
<div id="mews-distributor"></div>

<!-- Distributor's initialization script, creating new instance of Distributor. Use id of your hotel. -->
<script>
    var distributor = new Mews.Distributor({
        hotelId: "aaaa-bbbb-cccc-dddd-eeeeeeee",
        embed: true
    });
</script>
```

This will initialize an embedded version of Distributor, which is not visible by default. To actually show it to your users, you should bind its opening to some action - i.e. clicking on button - like this:

```
('#open-distributor-button').on('click', function() {
    distributor.open();
})
```

```
document.getElementById('open-distributor-button').addEventListener('click', function() {
    distributor.open();
})
```

Closing is done from inside of Distributor, so you don't have to worry about that.

#### Done!

This is all you need for the basic setup of Mews Distributor. Any other code snippet in this documentation is for advanced usage.

<a name="advanced"></a>
Advanced features (optional)
---

#### All possible options

Example with all possible options and their default values:

```html
<script>
var distributor = new Mews.Distributor({
    // required
    hotelId: '',

    // optionals
    element: '#mews-distributor',
    embed: false,
    language: 'en-US',
    currency: 'EUR',
    endDate: null,
    startDate: null,
    voucherCode: '',
    ecommerce: false,

    // theme
    theme: {
        font: ''
        primaryColor: ''
    }
});
</script>
```

Returned object can be used for making api calls on Distributor instance:

```html
<script>
var distributor = new Mews.Distributor({...});

distributor.open();
distributor.setStartDate(date);
distributor.setEndDate(date);
</script>
```

#### Note
See that you have just one `<script>` tag containing `new Mews.Distributor` in your page.

<a name="braintree"></a>
### Braintree (credit card payment gateway)

[Braintree](https://www.braintreepayments.com/) is gateway used by Distributor Edge for making payments for reservations with credit card. This gateway is not used by default, because it must be configured specifically for each hotel. To start using it, you need to obtain *ClientKey* and *MerchantId* and fill both in Commander.

Reservations without using Braintree and providing credit card informations are possible, however these reservation will have note in Commander stating that they have been created with invalid credit card.

**Important:**
PCI Security Standard requires you to use **SSL Certificate** on you website in order to be allowed collecting any payments info. Therefore Braintree can't allow you to send credit card info from order form without using one.

### TODO: Adyen ?

<a name="ga"></a>
### Google Analytics

If you have Google Analytics configured on your website using standard naming convention for global variable holding its object - `ga` or `_gaq` - then Distributor will use it for sending events. Tracked events are:
- `Opened` - the Distributor was opened
- `Dates selected` - both start and end dates were selected
- `Room selected` - a room was selected by clicking on 'Book now' button, its name is send as action argument
- `Booking finished` - a booking was finished by clicking on 'Finish' button

Also, you can enable ecommerce tracking by setting `ecommerce` option to `true`. Transaction will be send upon finishing booking, with reservation group id set as transaction id and affiliation set as *Mews Distributor*. Each room in order will be added as transaction item, with sku set as room id. Prices are send for every transaction item and total price for transaction is also included. Currency used is the hotel's default currency as set in Commander.

<a name="options"></a>
Options
-------

### hotelId (required)
Type: `string` Default `''`

Guid of hotel used for identification in API calls. 

Currently, you can get guid of your hotel from your hotel's detail page in Commander (under Settings > "Your hotel's name" ). The guid is shown under General Settings as Identifier.

### element
Type: `string` Default `#mews-distributor`

Css selector of element where will Distributor render itself. The element should be unique on the website.

### embed
Type: `boolean` Default `false`

Flag enabling embedded version of Distributor, which supports opening and closing. Use this option when including Distributor on your website. 

### language
Type: `string` Default: `en-US`

Language code for default selected language of localization. Supported values corresponds to codes of allowed languages for your hotel as set in Commander. Invalid value will fallback to default language of your hotel.

### currency
Type: `string` Default: `EUR`

Currency code for default selected currency of prices. Supported values corresponds to codes of allowed currencies for your hotel as set in Commander.
Invalid value will fallback to default currency of your hotel.

### voucherCode
Type: `string` Default: ``

Default value for a voucher code.

### ecommerce
Type: `boolean` Default: `false`

Enables Google Analytics ecommerce tracking.

### theme
Type: `object`

Object used for setting custom theme values. See next section for more info.

<a name="customization"></a>
## Customization

Distributor Edge has all styles written in javascript and bundled into the script. This way we can limit possibility of clashes when it's included into your website. To allow customization, we have `theme` option, taking your custom values. Currently supported are:

### fontFamily
Type: `string`

Name of the font to use, same as the CSS value `font-family`

### primaryColor
Type: `string`

Value for primary color. Any CSS color value is valid.

<a name="api"></a>
API
---

### open()

Opens Distributor in it's overlay. Used only when Distributor is in embed mode.

### setStartDate(date)
- `date` Type: `date` - The start date to set

Sets start date for new availability query, currently loaded availability list is not affected. If `date` is not valid Date object or its value isn't allowed as start date, nothing happens.

### setEndDate(date)
- `date` Type: `date` - The end date to set

Sets end date for new availability query, currently loaded availability list is not affected. If `date` is not valid Date object, nothing happens.
