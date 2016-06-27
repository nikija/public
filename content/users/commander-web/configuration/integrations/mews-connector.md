---
title: Mews Connector 
---

The Mews Connector integration allows our Cloud System to connect with local printers that are connected to the hotel network. 

## Download the Connector App
Firstly select a computer on the network, which never shuts down. It might be best to chose one of the backoffice computers where some of your other software runs. If the computer is shut down, the connector application will no longer work.

Visit http://www.store.mews.li

Once downloaded install the application.

## Install a Printer Connection

### Setup a new printer integratino

If you would like to connect a printer to the system, that would allow you to press "print" and instantly send the job to the printer, rather than printing via a PDF service. Then you will need to set up the following

In the Mews Commander open the settings, and select the “Enterprise Integrations” and follow these steps:

- Select to create a “New Printer Integrations” from the possible integrations list.
- Set the name to “Printer List” and enable the integration
- Select the “printers menu to set up the individual printers
- Select “New Printer” button. 
 - Name: this is the name that your team will see, so set it for example to “Printer Backoffice”, etc
 - Printer Name: set this to the exact name as the printer is names in the settings of your windows computer. See next slide.
 - Driver & Port Name – leave these fields blank

### Setup a new connector integration

Once you have set up all individual printers you would like to connect, return to the “Enterprise Integrations” menu in the Mews Commander
- Select a new integration “Connector Integration” and select “create”
- Enable the connection
- Select from the list of connected devices which ones you would like to switch on
- Copy the token as provided

### Setthe token into the Mews Connector

Return to the previously installed Mews Connector Application.

Paste the token in the application. 

Then return to the Mews Commander, and try to print a test report. Print jobs are executed within 5 seconds of receiving the command. 
