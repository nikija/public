# MEWS Translator Guide

**Do not use Microsoft Word or anything similar.**

Localization of the system and applications works like this:

1. Whenever we (as developers) need to display some text to the user, e.g. "Hello there stranger", we define a key for that text - e.g. "WelcomeText".
2. Then for each language we have a localization table, which defines texts for all the keys. So in english table, there would be `"WelcomeText": "Hello there stranger"`. In czech, there would be `"WelcomeText": "Vitej cizince"`. And similarly for all other languages.
3. So when we want to display a text in the system or application, we use the key "WelcomeMessage" and look up the text in the localization table. The localization table is chosen according to language preferences of the user that's using the application.

## Localization files

The task for a translator is to fill in those localization tables. We'll provide them to you in form of plain text files, e.g. `es-ES.resjson`. Note that name of the file is a combination of language name and culture name. That's necessary in order to differentiate for example between american english `en-US` and british english `en-UK`. But most other languages need no such differentiation. For viewing and editation, use some simple text editor (we recommend [Notepad++](http://notepad-plus-plus.org/) (only Windows) or [Sublime Text](http://www.sublimetext.com/)).

**Do not use Microsoft Word or anything similar.**

The contents of a localization may look this (taken from french localization table):

```
{
    "AbsoluteDeadline": "", // Absolute Deadline
    "AbsoluteDiscount": "Réduction Absolue", // Absolute Discount
    "AcceptedCurrencies": "", // Accepted Currencies
    "AccessToken": "", // Access Token
    "DearTemplate": "" // Dear {name}
}
```

On each line, there is a key and the text that corresponds to that key (e.g. `"AbsoluteDeadline": ""`). Note that some may be already filled (`"AbsoluteFee": "Frais Absolu"`). But mostly, the texts would be empty and they have to be filled in. At the end of each line there's value of the text in english which you should translate (e.g. `// Absolute Deadline`). Also note that some texts (e.g. `// Dear {name}`) may contain placeholders (`{name}`). Do not translate those, because we replace them with some concrete values. Moreover, a few of the texts may contain HTML markup (e.g. `<p>`, `</div>`) which shouldn't be translated too. A general rule is not to translate parts of the texts that aren't normal text or sentences. If you're not sure, it's better to ask than translate it incorrectly.

Here's a sample of what should be the correct translation result of the table above:

```
{
    "AbsoluteDeadline": "Date limite Absolue", // Absolute Deadline
    "AbsoluteDiscount": "Réduction Absolue", // Absolute Discount
    "AcceptedCurrencies": "Monnaies Acceptées", // Accepted Currencies
    "AccessToken": "Jeton d'Accès", // Access Token
    "DearTemplate": "Cher {name}" // Dear {name}
}
```
