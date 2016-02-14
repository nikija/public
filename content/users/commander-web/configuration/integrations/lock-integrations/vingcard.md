---
title: Vingcard
---

VingCard integration lets you issue key cutting commands. In order to use this integration, it needs to be correctly set up in Commander. Make sure the VingCard integration is enabled and enter the following information:

- Source Address - Unless you have multiple VingCard server instances running on a single system, enter `01`
- User Type - In VingCard server software, this is called `Keycard Types`, e.g. `Single Room`. You can view the list of keycard types by launching the VingCard server app, entering the System Setup, click on the Keycard Types button, in the action box, select Change Existing Keycard Type - this enables the dropdown button beneath the box, where you can view existing types. The type needs to exactly match the name of the keycard type in VingCard, case sensitive.
- User Group - User group, e.g. `Regular Guest`. You can view the list of user groups by launching the VingCard server app, entering the System Setup, click on the User Groups button, in the action box, select Change Existing User Group - this enables the dropdown button beneath the box, where you can view existing groups. The type needs to exactly match the name of the user group in VingCard, case sensitive.
- Vision Server IP Address - IP address of the machine the server is installed on. Instructions for this are system-specific and differ on various Windows versions.
- Vision Server Port Number - Unless you've changed this, enter `3015`.
- Vision Server License Number - Enter the license number for your VingCard server installation.
- Devices - Enter all your devices here. To find out the destination address, open the VingCard server software, enter System Setup → System Parameters → PMS - TCP/IP → Address Mapping. This will display a window with a table of device-to-address mappings. In Commander, click on New Device, enter the name of the device (it doesn't have to match the name in VingCard this time) and for Destination Address, enter the value that is in the PMS Address column.
- Key Cutters (Rooms) - You need to define a mapping between rooms in Commander and the rooms in VingCard. Start by pressing the New Key Cutter Mapping button in Commander. For `Key System Room ID`, enter the room name that is displayed in VingCard and then select a corresponding room from the menu below.
