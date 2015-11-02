### Google Analytics

If you have Google Analytics configured on your website using standard naming convention for global variable holding its object - `ga` or `_gaq` - then Distributor will use it for sending events. Tracked events are:
- `Opened` - the Distributor was opened
- `Dates selected` - both start and end dates were selected
- `Room selected` - a room was selected by clicking on 'Book now' button, its name is send as action argument
- `Booking finished` - a booking was finished by clicking on 'Finish' button

Also, you can enable ecommerce tracking by setting `ecommerce` option to `true`. Transaction will be send upon finishing booking, with reservation group id set as transaction id and affiliation set as *Mews Distributor*. Each room in order will be added as transaction item, with sku set as room id. Item's price is not added, only transaction total cost is currently supported.

If you have issues with Google Analytics Ecommerce tracking, please consult following troubleshooting guide first: 

* Ensure, that E-commerce is turned on in Google Analytics - Conversion -> Ecommerce -> Overview should look like picture below

![schranka-2](https://cloud.githubusercontent.com/assets/13900491/9854066/28bae7c8-5b07-11e5-8e44-e111b4405bf1.jpg)

* If it does not, Ecommerce feature needs to be turned on in Google Analytics profile Admin -> Account -> Property -> View -> Ecommerce Settings

![schranka-3](https://cloud.githubusercontent.com/assets/13900491/9854120/74380546-5b07-11e5-94d7-100b7b196594.jpg)

Than Enable Ecommerce

![schranka-5](https://cloud.githubusercontent.com/assets/13900491/9854166/ab5775c0-5b07-11e5-9201-b53c9c846097.jpg)

**Please note! We do not currently support Enhanced Ecommerce, so do not turn it on.**

* If Google Tag Manager is in use, ensure, that Tag Managers `<script>` code is valid and current and also ensure, that latest version of Tag Manager Container is **published** 

![schranka-6](https://cloud.githubusercontent.com/assets/13900491/9854268/421cd6f8-5b08-11e5-84b3-67173d6d6eac.jpg)

* Ensure, that Google Analytics can see other data from webpage like Events and pages views, also verify, that Realtime data from page are working. 

* If all of above is setup correctly, and data still does not show up, than inspection of network communication between google analytics and webpage is needed. This can be done in multiple tools. Google Chrome Developer Tools is used in pictures below. 

After booking is finished, webbrowser should send 3 request starting with 'collect?v1'. These calls transports data from page to Google Analytics, so make sure they can be found in network communication. 

![schranka-8](https://cloud.githubusercontent.com/assets/13900491/9854679/4b522c4e-5b0a-11e5-879b-19e790ca2b91.jpg)

Be aware that data in Ecommerce overview can be delayed by 24-48 hours depanding on amount of request from webpage to Google Analytics.
