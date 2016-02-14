---
title: Services
---

To create a new service, press the "New Service" button.

To create services, you have to follow the following logic, as the system of services is set up in 3 layers, and you must follow these layers for the services to work in the Navigator

Level 1: Service Category (For example "Room Service)
  Level 2: Product Category (For example "Starters" or "Main Courses")
    Level 3: Products (For example: "Coca Cola Light"

If you follow this logic, the services will be built according to the structure of the system, and they will display beautifully in the Navigator, but also on the billing screen in the Mews Commander.

## Service Settings

When setting a "New Service" it will provide the user with a number of general settings:

- **Name**: Select the name of the service, as you would like it to display on guest bills.
- **Description**: This field is important when you want to sell the product on the Navigator, as this is the description that is displayed to your guests.
- **Ordering**: This will allow ordering of the items in the menu. Items with the lowest ordering number will display first, items with higher ordering numbers will appear later in the selection.
- **Currency**: A service can be set up in different currencies. Note that if you set the main product in a currency (i.e. Minibar) then all the items that fall within this product category (Coca Cola, beer, etc.) are priced in the same currency.
- **Amount**: The price of the product.
- **Tax Rate**: Set the correct tax rate for the product. If you are unsure, it is recommended to check this with your accountant/financial department.
- **E-mail**: if you would like a confirmation of the order to be sent to guests, this field is the e-mail field from which the confirmation e-mail will be sent. So the guest will respond to that e-mail if he/she has any questions with regards to the service.

## Service Options

- **Bill Packaged**: if you want items which are posted as part of this Service to be packaged, select this option, and then on each item that you would like to package, you select again "package" and it will merge these items together on guest bills (but not in internal reports)
- **Has Expanded Bill Items**: if you want to display all sub products ordered, on guest bills, as individual items. If you tick this, it will print each product as 1 line item on the bill, if you untick this option, the bill will display 1 line with a summary header only and a total amount. Again, in your internal reporting all products will still be split out separately.
- **Has Overridable Price**: if you would like to allow your reception to override the standard price set for this service and its sub-products, when they manually post items against this service.
- **Has Overridable Tax**: this will allow your reception to change the VAT level on a product posting. We would recommend against using this, as often the reception team is not aware which VAT is used on which product, and this needs to be set up as black-and-white as possible to avoid errors.
- **Is Directly Orderable By Customer**: if you select this, it makes the prodcut available on the Navigator for sale.
- **Is Externally Chargeable**: if you select this, and have a connected POS system, the Point Of Sales system can charge items against this service.
- **Is Retrospectively Orderable**: this option is important if you want to allow reception to post this item manually on bills, if you do not tick this, the product does not become available for manual postings.
- **New Order Is Processed**: this option is important to have ticked if the item is used by reception to post items manually on bills. If you do not tick this option, once the service is posted, you will be asked to manually "process the order" creating additional unnecessary work. This is only important for order from the Navigator, which require an employee to pick up the order and process it.
- **Orderable only with products**: if you select this option, it will not be possible for someone in the team (or a guest on the Navigator) to order the Service, without having selected any of its sub-products. (Its like ordering Room Service, without selecting the menu items that you have, so there is nothing to deliver)  
- **Order Generates E-mail**: if you have set up a Responsible Employee, and you select this option, the employee who is set up as responsible  will be receiving e-mail confirmation once the product is ordered.
- **Order Generates Notification**: if you have set up a Responsible Employee, and you select this option, the employee who is set up as responsible will be receiving dashboard notifications directly in the Mews Commander every time the service is ordered.
- **Order Has End**: this option is ONLY applicable for Accommodation, which must have a start and end date. Ignore this setting for any other services.
- **Order Has Start**: this option is applicable to services that have a start date. This is especially important for products in the Navigator, that are being ordered by the guest, and the reception needs to be informed of the start date/time of the serivce. So for example if the guest ordered a City Tour, Spa Treatment or Taxi, the reception will need to know at what time this service is requested. Ticking it, makes the time field a "obligatory field" not allowing anyone to order the service without setting the time/date first.
- **Order Requires Completed Notes**: some products, when posted require notes to be filled in. This is again mostly applicable for products from the Navigator. For example if a guest orders a taxi, we require him to specify the location/details of his pickup, thus it makes sense to make the "notes" field obligatory.

### Responsibility

In this field you can select the Employee who is responsible for this service. So when in the aforementioned options, you have selected that you want to receive notifications or e-mails, the system will send these to the responsible person automatically upon the ordering of the product.

### E-mail

### Order E-mail

If you would like to send your customer an e-mail at the time of the order of the Service, you can type the e-mail in HTML in this field. Once the product is ordered by the customer (via Navigator or directly in the Commander), the system will trigger to send an e-mail to the guest. Of course we can only send confirmation e-mail to guests who have a valid e-mail address in their Guest Profile.

### End E-mail

For some services, such as Accommodation, you may want to send an e-mail as a follow up once the service ends, to ask them how the service was enjoyed, or ask for feedback. Note that we can only send an end-email for services that have an end-date. At this moment, we only recommend setting this for Accommodation Services.

### Accounting
All products can be assigned Accounting Categories, which are the revenue buckets to which the product is being processed. There are 4 categories for which accounting categories are requestes:

- **Accounting Category**: this is the most important field to complete, as this is the accounting category for normal posting of the products
- **Cancellation Fee Accounting Category**: this is only applicable to products that have an automatic cancellation fee set up. Currently only Accommodation can have a cancellation fee set up automatically. So ignore this field for all other services.
- **Refund Accounting Category**: this is only applicable to products that have an automatic refund possibility set up. Currently only Accommodation can have a refunds set up automatically. So ignore this field for all other services.
- **Positive & Negative Deposit Accounting Category**: again, this is only applicable for Accommodation, and only in countries where the "deposit" functionality is used such as in Czech Republic and Germany (where VAT is paid at the time of deposits). So ignore this field for all other services.

### Promotions

Currently only the option "After Check-in" has live functionality in the Navigator. If you tick this option, in the Navigator, once you complete your online check-in, we will promote that service to the customer. This will help promote services such as a taxi pickup from the airport.

### Image
All Services / Product Categories / Products have the possibility to upload an image. If you are setting up the Navigator we highly recommend setting up photos for all 3 sections, because it will really personalize the Navigator to your hotel, rather than just showing generic images for different services.

## Creating Product Categories and Products

### Product Category

Within the “Product,” you can create a "New Product Category" or a "New Product.” To give an example:

1. Service: Minibar
2. Product Category: Food Items
3. Product: Mars Bar

### Product Category

When you create a new category, you have the following options:

- Name & Description: Should your hotel have the Mews Navigator, then the description field is important as this will appear on the Navigator.
- Parent Category: If you would like to make a sub-division in the categories.
Once you have created the category, you can create products inside the category by pressing "New Product"

### Product

When setting the “Product,” there are a few options:

- **Consumed Before Night**: This product has been “consumed” (read: posted) prior to midnight of the accommodation posting. For example, this could be a halfboard package where a customer has dinner before the accommodation.
- **Always Included**: If this option is selected, it will be an obligatory product that is packaged with the rate. For example, this could be the case if a hotel only sells rooms inclusive of breakfast.
- **Included By Default**: This option is only applicable if you have the Mews Distributor implemented. If this option is selected, the product will be included by default but can be removed from the rate-package. This could be the case if you mostly sell rooms inclusive of breakfast, so you pre-tick the breakfast, but if a customer books, they can remove the tick from this box to exclude breakfast.
- **Cost Included In Night**: This feature will allow you to absorb a product (such as breakfast) into the night cost. It will not display this item (that is being absorbed) on the bill of the guest.
- **Include When**: Here you can determine whether you would like the product to be included when it is a specific type of customer (for example a "Leisure" or "Business" customer). An example of this could be a city tax, which is charged as part of the price.
- **Product Charging**: “Once” would charge the item only once during a stay. “Per Room Night” would charge the product each room night, independent of how many people are staying in the room. “Per Bed Night” charges the product per person per night.
- **Channel Manager ID**: This is only applicable if the channel manager supports the product and sells both inclusive and exclusive options of this product online.


