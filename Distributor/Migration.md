# MEWS Distributor - Migration Guide

Migration from the old version can be done in few easy steps:

## 1. Change script file

Locate the old script file included in your website and replace it with the new one, i.e.:

Change this
```
<script src="https://www.mews.li/distributor/current/distributor.min.js"></script>
```

to
```
<script src="https://www.mews.li/distributor/edge/distributor.min.js"></script>
```

## 2. Remove unused css file

New version has css bundled with the script, so you can remove previously included css files:

Remove this
```
<link rel="stylesheet" href="https://www.mews.li/distributor/current/distributor.css" />
```
or
```
<link rel="stylesheet" href="https://www.mews.li/distributor/current/distributor-overlay.css" />
```
whichever you have used.

You can also remove any custom css rules you have added. To see how to customize the new Distributor, check installation guide [here](https://github.com/MewsSystems/public/blob/master/Distributor/Widget.md#customization).

## 3. Remove any elements used by Distributor

Previously, Distributor needed a root element in your website, and also used optional banner elements for opening. These can be removed now:

Remove
```
<div id="mews-distributor"></div>
<div class="mews-distributor-banner"></div>
```

The new version creates root element automatically. For binding an opening element, see next section.

## 4. Update initialization

The initialization function remain same, but some of previously used options are no longer used and you can remove them. The important new options is `openElements`, which specify css selectors of elements which will get click event binded to opening of Distributor. So new minimal setup is:

```
<!-- Distributor's initialization call, creating new instance of Distributor. Use id of your hotel. -->
<script>
    Mews.Distributor({
        hotelId: 'aaaa-bbbb-cccc-dddd-eeeeeeee',
        openElements: '.open-distributor-button'
    });
</script>
```

Be noted that reference to created Distributor for api call is no longer returned from initialization call, but is provided as argument to callback function taken as second parameter. 

For more details, check the full installation guide [here](https://github.com/MewsSystems/public/blob/master/Distributor/Widget.md)

