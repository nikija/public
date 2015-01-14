# MEWS Distributor Release Notes

### 1.4.0 
- Added support for Mews Payments
- Braintree api updated to v2
- Improved validation of credit cards data in order form

### 1.3.6
- Fixed issue with Distributor not getting opened after deeplinked from other pages
- Added ticks to product selection checkboxes
- Multiple rooms booking made more clear
- Added missing LinkedIn icon
- Fixed facebook deeplink

### 1.3.5
- Fixed conflicts with use of *$* as jQuery shortcut

### 1.3.4
- Fixed text color in product tooltips (again)

### 1.3.3
- Added missing 'www' to default value of server url

### 1.3.2
- Fixed bad url in hotel link posted on social medias

### 1.3.1
- Fixed text color in product tooltips

### 1.3.0
- Fixed hiding of order form after sending it when some room in order where not available.
- Added support for error handling on client side. Error in api calls now does not block booking process, but allow you to try again.

### 1.2.2
- Fixed checking of products which are set to be included by default in Commander.

### 1.2.1
- Fixed order of months in calendar.
- Added support for showing fatal errors, which blocks the reservation process.

### 1.2.0
- Minor visual improvements. Css clash might have been created, check is recommended.
- Added button to edit room reservation after it is added to order.
- Added option `maxPeopleCount` for setting upper limit in people selector, overriding default value from server.
- `braintree` option removed. Use of Braintree gateway is now given by filling both *ClientKey* and *MerchantId* in Commander.
- Loader is now displayed after clicking on *Book now* button and after removing room from order. This gives time for UI to wait for responses from API and update itself properly, without confusing user.

### 1.1.5
- Fixed IE issue with toString method in Calendr library

### 1.1.4
- Fixed problem with maximum number of people available in people selector

### 1.1.3
- Fixed long API requests for reservation pricing and creating orders,
which were resulting in Bad request 400 responses.
- `peopleCount` option has now upper limit set to maximum of total bed count 
among all hotel room types.
- Reservation of multiple rooms is now created as group, same way as it is 
displayed on listing

### 1.1.2
- Method `setRoomsList(rooms)` is no longer experimental. Calling it 
clears model and restarts booking process.
- Behavior of methods `setStartDate(date)` and `setEndDate(date)` has changed.
The ui animations are now turned off during call.
- When using overlay styles, cross is displayed in top right corner, indicating
option to close Distributor

### 1.1.1
- Added method `setPeopleCount(count)` on *Mews.Distributor* object.

### 1.1.0
- Added options `loadOverlayCss` for loading overlay css file and `loadCss`
for loading basic css file if *loadOverlayCss* is not set. Default values are
*false* for `loadOverlayCss` and *true* for `loadCss`.
- JQuery is no longer bundled with distributor and it's stated as required
dependency. Minimal supported version should be 1.7.0, safe is version
1.9.0, which has been used for development.
- Library for calendar was replaced. This introduces some changes to css, so 
it should be revised.
- Minor visual improvements.
- Added option `onStartDateChanged: function(date) { ... }` to set callback
on change of start date. Parameter *date* is the new date set.
- Added option `onEndDateChanged: function(date) { ... }` to set callback
on change of end date. Parameter *date* is the new date set.
- Added `setStartDate(date)` and `setEndDate(date)` methods on 
*Mews.Distributor* object. They act same way as if the date was selected by
clicking through calendar, with ui animations and callbacks firing. It is 
supposed that these will be called before distributor is opened, so it 
shouldn't matter, however this behavior might change in the future.
Additionally, *setStartDate* sets calendar's focused month on *date*.
- Added `setRoomsList(rooms)` method on *Mews.Distributor* object, allowing
to set a new array of ids of rooms which should be displayed. To ensure it 
works correctly for now, the call reloads and rerender whole distributor, so
it shouldn't be used when distributor is opened.
