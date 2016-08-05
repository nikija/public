---
title: D2O integration through IFTTT
---
D2O is a 3rd-party supplier who has created a report called PMI which is used in the Nordics to track thvcce performance of a hotel property. It is usually the export that is looked at by the top-level management of the hotel and one of the major metrics used by the group management in our chain properties. If you ever need to discuss anything with D2O, it is good to note our two contacts at d2o - eric@d2o.com and andreas@d2o.com.

This integration works via two services (both of whom have passwords saved in LastPass) - IFTTT and Dropbox. IFTTT is a webhook service which works through the use of "recipes" - a recipe is created when certain actions take place. In this case, the recipe is that a specific attachment (the D2O export)

sub-title: Setting up the connection

Go to the Settings of the hotel, and select "Integrations"
From the drop-down menu, choose "New d2o Integration"
Click on the "Is Enabled" checkbox
Enter the email "trigger@recipe.ifttt.com"
Click "Save"

sub-title: Checking the recipe

We use a service called IFTTT to deliver the attachment to dropbox and we use the following recipe: https://ifttt.com/recipes/10516-save-e-mail-attachment-file-to-dropbox-folder-named-e-mail-subject
The login details for the account can be foud in LastPass in the "Ops" files
On the settings of the recipe it should show the following:
Tag: dropbox
File URL: {{AttachmentUrl}}
File Name: {{Body}} 
Dropbox Folder Path: {{Subject}}

NOTE - You do not need to set up a new recipe for each new hotel - this is a generic recipe for delivery of the files.

sub-title: Dropbox

We use Dropbox to deliver the files to the hotels from our account info@mews.li - account is in LastPass in the "Ops" file.

The IFTTT recipe should deliver the files to the respective hotel file names (eg "The Hub") and in there, the attachments should have been uploaded. The format should be like the following: MEWS_PMS_-_25-06-2016_00-00-00_-_17-11-2017_00-00-00 

If there is a new hotel being created, a new folder should be created unde the name.
