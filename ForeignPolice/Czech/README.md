# Mews - integrace s Cizineckou Policií ČR

## Obsah

- [Úvod](#uvod)
- [Nastavení](#nastaveni)
- [Report Profily hostů](#report-profily-hostu)
   - [Neúplný report](#neuplny-report)
- [Jak automatický reporting funguje](#jak-vse-funguje)
   - [Co se děje v jeden den?](#jeden-den)
   - [Kteří hosté jsou reportováni](#kdo-je-reportovan)
- [Stanoviska Policie ČR](#stanoviska)
   - [Jak zacházet se Stanovisky](#jak-na-stanoviska)
- [Rady na závěr](#rady-na-zaver)
- [Informace od Policie ČR](#informace-policie-cr)

<a name="uvod"></a>
## Úvod

Tento dokument slouží jako návod hotelům pro používání Automatického oznamování cizinců Cizinecké Policii ČR. Základní informace, které poskytuje Policie ČR, jsou k dispozici na [zde](http://e-uby.wz.cz/INFORMACE.htm). Tento dokument počítá s tím, že se přílušní zaměstnanci s návodem Policie ČR seznámili.

<a name="nastaveni"></a>
## Nastavení

Hotel musí zařídit sám:

- Získat certifikát (digitální podpis) pro emailovou adresu hotelu - policie tím bude ověřovat přijaté emaily s reporty. Může to být přímo email hotelu, nebo nějakého zaměstnance, nebo speciálně vytvořená adresa (třeba `cizineckapolicie@hotel.com`). Jen je potřeba vzít v potaz, že asi nebude jednoduché adresu změnit v budoucnu.
- Zaregistrovat se u Cizinecké Policie ČR (viz jejich návod) a získat tak **IDUB** a **krátké IDUB** identifikátory hotelu a propojit hotel s emailovou adresou s digitálním podpisem.

Mews support pomůže s:

- Zadat do Mews **IDUB** a **krátké IDUB** identifikátory hotelu.
- Zadat do Mews tuto digitálně podepsanou emailovou adresu, pod kterou je hotel zaregistrován u Policie ČR. Na tento email bude Mews denně posílat kopii odesaného reportu a Policie ČR na tuto adresu bude posílat [Stanoviska](#stanoviska) k jednotlivým odeslaným reportům. **Je proto potřeba tuto emailovou schránku denně kontrolovat!**
- Zadat do Mews alespoň jednu emailovou adresu, na kterou bude Mews posílat připomínku pro kontrolu reportu [Profily hostů](#report-profily-hostu). **Je proto potřeba tuto emailovou schránku denně kontrolovat!** (Může to tedy být stejný email.)
- Nahrát do Mews certifikát - digitální podpis - aby jej Mews mohlo posílat Policii pro ověření odeslaného reportu (*My jsme si to nevymysleli :)*).

<a name="nastaveni-priklad"></a>
### Příklad nastavení
- Emailová adresa, na kterou hotel zařídil digitální podpis a pod kterým je hotel zaregistrován v systému Policie ČR je `hotel@hotel.com`.
- Emailové adresa, na které chodí upozornení na vyplnění hotelu jsou `recepce@hotel.com` a `manager@hotel.com`.

<a name="report-profily-hostu"></a>
## Report Profily hostů v Mews
Report Profily hostů (*Customer Profiles*) je možné otevřít přímo z úvodní stránky po přihlášení do systému Mews. Report zobrazuje seznam hostů, kteří jsou ubytovaní (či kteří přijedou) ve vybraném časovém intervalu - záleží na zvolených parametrech reportu. Správný filter pro report je období na den a mód "Příjezdy".

![Report Profily hostů](../Images/Report.png)
Takto vypadá příklad reportu Profily hostů. Ukazuje, že na pokoji `201` jsou ubytováni `Jane Smith` a `Jason Statham`, na pokoji `407` bydlí `Mena Suvari` a ještě někdo neudevený (rezervace je pro 2 osoby). 

Dále report říká, že:

- Všechny potřebné údaje pro `Jane Smith` jsou vyplněny - *profil hosta je kompletně vyplněn, proto je bílý*.
- U hostů `Jason Statham` a `Mena Suvari` **chybí** zadat *adresa* a *číslo pasu* - *proto je řádek slabě červený a chybějící pole jsou červené*.
- Společník hosta `Mena Suvari` není uveden vůbec - *tato rezervace je pro 2 hosty, ale v Mews je zadán pouze 1, proto je celý prázdný řádech označen červeně*.

Všechny chybějící (červené) údaje měly být vyplněny již běhěm Check-in procesu. Pokud i po check-inu nějaké údaje chybí, musí být vyplněny do odeslání reportu - viz [Jak automatický reporting funguje](#jak-vse-funguje). Cílem je mít všechny řádky bílé, tedy mít report vyplněn na 100%.

*Poznámka:* Je možné stáhnout si report pro vybraný den nebo jej přímo odeslat (opravený) rovnou Policii - viz [Rady na závěr](#rady-na-zaver). V případě, že v reportu bude vybráno delší období, než jeden den, report bude v obou případech vygenerován je pro první den (Start).

<a name="neuplny-report"></a>
### Neúplný report

Report [Profily hostů](#report-profily-hostu) bývá zpravidla (aspoň trošku) červený i poté, co všchni hosté již přijeli, a je potřeba jej rychle "vybílit". Pokud chybí nějaký údaj na profilu hosta (křestní jméno, národnost, datum narození, číslo cestovního dokladu, ...), stačí se podívat do registrační karty hosta, kterou měl doplnit během check-inu, a údaje podle ní doplnit. Pokud ani tam údaje nejsou, znamená to, že na recepri při check-inu tyto údaje po hostovi nechtěli. Je potřeba hosta kontaktovat a údaje od něj zjistit. Dále je potřeba informovat recepci, aby při check-inu chtěly všchny údaje, aby se toto již neopakovalo.

Složitější problém na řešení je situace s neuvedeným hostem (případ pokoje `407`) - zvláště pro nováčky se systémem Mews. Mohlo nastat hned několik různých situací:

1. Druhý host nepřijede.
2. Druhý host přijel, ale nebyl v systému vytvořen.
4. Oba hosté přijeli, oba byli vytvořeni v systému, oba hosté jsou na detilu rezervace, přesto v reportu chybí host, na kterého byla rezervace vytvořena.

#### Řešení

1. Stačí ručně upravit rezervaci tak, aby byla jen pro jednoho hosta a případně aplikovat nějaké poplatky. 
2. Stačí vytvořit nového hosta a přiřadit jej k rezervaci.
3. Nejdříve potřeba si uvědomit rozdíl mezi *vlastníkem* rezervace a *hostem* přiřazeným k rezervaci. *Vlastník* je ten, na jehož jméno je rezervace vytvořena. Může to být dokonce někdo, kdo do hotelu vůbec nepřijede, pouze pobyt pro někoho zarezervoval. *Host* je někdo, kdo přijel a kdo bydlí na daném pokoji. Názorně na obrázku:

![Group Modul](../Images/GroupModule.png)
Tento obrázek ukazuje, jak vyřešit třetí případ – pokoj `407` z prvního obrázku. `Nicolas Cage` je uveden jako *vlastník* rezervace (červená elipsa). Je potřeba jej ještě přidat na pokoj kliknutím na `>` v červeném obdélníku. Tím se host přidá na vybraný pokoj. Jeden host může totiž objednat více pokojů a systém jej automaticky nemůže přiřadit do všech zarezervovaných pokojů, protože jeden host nemůže být fyzicky ve dvou pokojích. Proto je potřeba vlastníka během Check-In procesu přiřadit do nějaké rezervace (udělat z něj hosta). Opět je potřeba nastavit na recepci check-in proces tak, aby se toto vyřešilo v den u příjezdu a nemuselo se to řešit zpětně.

<a name="jak-vse-funguje"></a>
## Jak automatický reporting funguje

Pokud je na hotelu vše nastaveno a schváleno Mews supportem, je vše připraveno pro automatické oznamování cizinců ubytovaných v hotelu. Tato operace běží na pozadí systému Mews a vždy v 9 hodin ráno udělá dvě věci:

- Pošle upomínku na uvedený email s připomínkou, že je potřeba zkontrolovat report příjezdů za **včerejší** den.
- Vygeneruje se report za **předvčerejší** den a odešle jej Policii ČR.

*Poznámka:* Před prvním spuštěním je potřeba mít na paměti, že se "bez upozornění" pošle report za **předevčírem**, ten je pořeba mít již zkontrolovaný. Dobrým dnem pro spuštění automatického reportování je tedy 3. den v měsíci, protože první odeslaný report je za první den v měsíci - to jen pro jednoduchou kontrolu, do kdy hotel posílá reporty ručně.

<a name="jeden-den"></a>
### Co se děje v jeden den?

Nyní je **17.2.2014 9:00** a stanou se následující věci (využívá emaily z [Příkladu nastavení](#nastaveni-priklad)):

- Mews pošle na uvedené adresy `recepce@hotel.com` a `manager@hotel.com` připomínku, že je potřeba zkontrolovat report [Profily hostů](#report-profily-hostu) za den **16.2.2014**. 
   - Je potřeba zkontrolovat, že report příjezdů v den **16.2.2014** je 100% (předpokládá se, že všichni hosté, kteří měli přijet **16.2.2014** již přijeli, proto se kontroluje „včerejší“ den). 
   - Pokud report není hotov na 100%, je potřeba tento report *během 24 hodin* co nejvíce dokončit ("zítra" jej totiž Mews automaticky odešle Policii v tom stavu, v jakém je).
- Mews automatiky vygeneruje report za „předvčerejší“ den **15.2.2014** (o kterém se předpokládá, že je zkontrolován z předchozího dne) a pošle Policii ČR a v kopii na uvedený email `hotel@hotel.com`. 
- Policie ČR report zpracuje a pošle odpoví na adresu (tu digitálně podepsanou) své [Stanovisko](#stanoviska) k reportu. Většinou to posílají ještě ten den, nejpozději do druhého pracovního dne.

**Je proto důležité, aby oba 2 tyto emaily někdo každý den četl a ujistil se, že Policie report přijala.**

*Poznámka:* Pokud hotel (na email `hotel@hotel.com`) kolem deváté hodiny ranní neobdržel kopii reportu odeslaného Policii (a neni ani ve Spamu ani omylem smazaný). Je možné, že report neodešel - je třeba kontakovat Mews support (dříve než report odešlete sami ručně). Problém může být jinde.

<a name="kdo-je-reportovan"></a>
### Kteří hosté jsou reportováni

Podle zákona se mají Cizinecké Polici reportovat všichní hosté s jinou než Českou národností. Takže Mews do reportu, který posílá Policii, zahrne každého hosta s vypněnou národností (jinou, než Českou) **a to bez ohledu na to, jestli má profil vyplněný na 100% nebo ne**. Je to z toho důvodu, že kdyby recepční vyplňovali report až po jeho odeslání a přišla na hotel kontrola, tak kniha hostů bude vykazovat mnohem více cizinců, než bylo nahlášeno Policii. Takže toto řešení donutí recepční vyplňovat vše včas. 

<a name="stanoviska"></a>
## Stanoviska Policie ČR
**Stanovisko** je vyjádření Policie ČR k poslanému reportu a datum v něm obsažných. **Stanovisko** může být:

- Všechna data v pořádku, oznamovací povinnost **BYLA** splněna.
- Chybí některé drobnosti (křestní jméno, datum narození, …), přesto oznamovací povinnost **BYLA** splněna.
- Byly detekovány závažné chyby, proto oznamovací povinnost **NEBYLA** splněna - **V tomto případě je potřeba rychle reagovat, je proto důležité, aby uvedený email někdo každý den kontroloval a ujistil se, že chybějící data budou opravena a hned poslána Policii zpět.**

<a name="jak-na-stanoviska"></a>
### Jak zacházet se Stanovisky

- Pokud Stanovisko Policie ČR je jedno z prvních dvou případů, je vše v pořádku (v druhém případě je dobré opravit chybějící data v systému), není potřeba posílat opravený report. 
- Ve třetím případě je potřeba chyby opravit v systému a zároveň poslat opravený report - stačí v reportu [Profily hostů](#report-profily-hostu) vybrat příslušný den (**Pozor, stanoviska chodí na reporty poslané minimálně za 2 dny v minulosti** - viz [Jak automatický reporting funguje](#jak-vse-funguje)).

<a name="rady-na-zaver"></a>
## Rady a připomínky na závěr

- Informovat všechny recepční, aby vyplňovali **všechny** potřebné údaje **při check-inu** (Jméno, Příjemní, Datum narození, Národnost, Číslo pasu a Adresu bydliště) a správně **přiřadili všechny hosty na správný pokoj**.
- Je potřeba **denně** kontrolovat včerejší report.
- Je potřeba **denně** kontrolovat [Stanoviska](#stanoviska) Policie k jednotlivým reportům a v případě **zamítavého stanoviska** důsledně a co nejrychleji vyřešit chybějící údaje. 
- Před prvním spuštění je potřeba zkontrolovat report za poslední 2 dny (od data spuštění), protože na něj nepřijde upomínkový email.
- Hosté s uvedenou národností **jsou** reportováni **s nevyplněnými dalším údaji**.
- Tlačítko v reportu [Profily hostů](#report-profily-hostu) pro odeslání reportu slouží **primárně** pro posílání **opravného** reportu Policii, *sekundárně* pro poslání reportu, pokud ho *Mews neodeslal automaticky *- to ale musí **potvrdit Mews support**.

<a name="informace-policie-cr"></a>
## Informace od Policie ČR
- Na [této adrese](http://e-uby.wz.cz/INFORMACE.htm) poskytuje Policie ČR informace pro uživatele systému **Oznamování cizinců ubytovateli**. 
- Zejména je vhodné seznámit se s články: 
   - Informace: 000, 006, 007 
   - FAQ: 008, 013, 016