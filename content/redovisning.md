---
---
Reports
=========================


Kmom01
-------------------------

####Hur känns det att hoppa rakt in i objekt och klasser med PHP, gick det bra och kan du relatera till andra objektorienterade språk?

Det har känts ganska OK eftersom vi har kommit i kontakt med klasser och objekt tidigare (i oopythonkursen) och eftersom jag tycker att php är ett språk som är roligt att programmera i. Började med att göra övningen 'Kom igång med objektorienterad php' vilken gav en bra introduktion till klasser och objekt i php. Den uppgift i detta kursmoment tagit mest tid har varit 'Guess my number'-spelet. Formulär och sessioner har vi också använt tidigare men det är ingen garanti på att allt fungerar som man vill.

####Berätta hur det gick det att utföra uppgiften “Gissa numret” med GET, POST och SESSION?

Det gick ganska bra eftersom jag utgick från det som jag redan gjort i oophp-v3 kmom01, men det har tagit sin tid ändå! Förändringar som gjorts jämfört med tidigare version:  
    + Har lagt till en fuskknapp som man kan klicka på om man vill se det rätta numret (ett krav som tillkommit i oophp-v4).    
    + Har gjort alla (dvs två stycken) medlemsvariablerna privata (förut var endast 'det korrekta numret' privat), detta för att kapsla in informationen lite mer.    
    + Har förbättrat stylingen, görs endast med css nu, förut hade jag 'fuskat' lagt in flera hårdkodade radbrytningar i min html-kod.  
    + Har gjort så att nerräkningen (i alla fall utåt sett) stoppar när det finns 0 antal gissningar kvar.  
    + Har stuvat om koden i `index-session` och `index-session-object` så att saker skrivs ut i samma ordning som i `index-get` & `index-post`.  
    + Formuläret, `submit guess`- och `cheat`-knappen låses utifall att rätt siffra gissats.  

Prövade att spara enstaka variabler (index-session.php) och hela guess-objektet (index-session-object.php) i session.
Det var knepigt att få till session-varianterna: Utgick från `index-post` och tjuvkikade på min gamla `index-session`, men det var svårt att få flödet på session-sidorna att se likadant ut som på index-get/index-post-sidorna. Fick många `undefined variable/undefined index`, `call to a member function on null` och `a non-numeric value encountered` innan jag äntligen fick det att fungera..


####Har du några inledande reflektioner kring me-sidan och dess struktur?

I förra kursversionen fick vi kasta oss in i ramverksprogrammering på en gång eftersom vi fick börja med bygga upp vårt 'egna' lilla ramverk, om än med lånade klasser/moduler, nu blev det mer utav en mjukstart. Ramverket har säkert ändrats något sedan förra kursversionen och jag har inte hunnit titta så mycket på ramverkets olika delar ännu. Sidorna delas upp i olika regioner och endast main-regionen verkar skrivas i markdown-kod, de övriga regionerna som t ex navbaren och  bylinen är i php-format. Stylingen av sidorna har gjorts i ren CSS, skulle velat styla med LESS men har inte haft tid till det, bla eftersom jag 'fastnade' lite på 'Guess my number'-uppgiften, men det kanske kan bli lite LESS i kommande kursmoment, i vilket fall ser jag fram emot att jobba mer med ramverket och stylingen i kommande kursmoment. Har lagt till en flashvy och en (mycket primitiv) byline-vy. Bägge vyerna syns på alla sidor.


####Vilken är din TIL för detta kmom?

Har väl inte haft någon direkt aha-upplevelse i detta kursmoment. Kanske för att jag i princip gjort denna en gång redan, men jag kan återigen konstatera att hur 'färdig' en uppgift än är (såsom 'Guess my number uppgiften' i princip var) så kan jag inte låta bli att gå in och rota i koden ändå, och när man väl satt igång med att ändra något så tar det tid att få allt att fungera igen.

Kmom02
-------------------------

####Hur gick det att överföra spelet “Gissa mitt nummer” in i din me-sida?

Trodde att det skulle bli en rätt lätt uppgift men tji fick jag. Mycket berodde det nog på att jag inte varit så noga med att separera html-kod från php-kod i mina spel, så jag blev i princip TVUNGEN att refaktorera mina spel för att inte behöva ha all kod i vyerna. Förutom de redan befintliga Guess-, GuessException- och Sessionklasserna, så har det tillkommit två nya klasser: en formulärsklass (Form) och en resultatsklass (Result). Formulärsklassen har en konstruktor och ett antal metoder för att skapa och rita ut formuläret (som ser lite olika ut beroende på om det är get/post-spelet eller om det är session/session-object-spelet). Alla variabler och så gott som alla metoder i denna klass (förutom konstruktorn och displayForm-metoden) är privata. Resultatsklassen innehåller endast tre statiska metoder. Bägge klasserna har jag försökt att göra så allmänna som möjligt och lösa skillnaderna mellan de olika spel-varianterna med if/else-satser intuti metoderna. Alla spelen använder sig av samma vy.

För att få bort flash-bild och byline på spelsidorna (som jag lagt till i kmom01) skapade jag en ny sida page2 i redovisa/config/di/page2.php: (kopierade page.php)

Trots min refaktorering så innehåller routerna rätt mycket kod och vyerna innehåller en del logik MEN jag är ändå nöjd med resultatet, eftersom koden har en bättre struktur nu än tidigare.

####Berätta om din syn på modellering likt UML jämfört med verktyg som phpDocumentor. Fördelar, nackdelar, användningsområde? Vad tycker du om konceptet make doc?

UML (Unified Modelling Language ) kan användas för att visa upp/dokumentera olika aspekter av ett system/program (t ex visar ett klassdiagram upp systemets statiska struktur medan ett sekvensdiagram visar hur olika processer (=objekt i oophp) kommunicerar med varandra inom en tidssekvens och i vilken ordning.). Ett UML-klassdiagram visar på ett kompakt och överskådligt sätt upp vilka klasser som ingår i systemet, klassernas attribut och metoder, och relationen mellan klasserna. UML-diagram kan vara bra för att styra upp analys- och designfasen i ett projekt och sedan kan man allteftersom modifiera diagrammen om det visar sig behövas. Själv föredrar jag nog nästan papper och penna-till detta, tycker det är lite bökigt att använda draw.io, men det kanske är en vanesak. Nackdelen med (handritade) UML-diagram är väl att det lätt kan bli fel och att alla förändringar som görs i koden under arbetets gång inte återspeglas i UML-diagrammen (för att man inte bemödar sig med att gå tillbaka och införa dessa. ändringar i diagrammen). I oopythonkursen använde vi oss av ett verktyg som automatgenererade (mycket enkla) klassdiagram utifrån koden.

phpDoc gick väldigt smidigt att installera och använda tack vare make doc, och därmed är det väldigt lätt att under arbetets gång uppdatera sin dokumetation. phpDoc uppmanar en också att kommentera sin kod, vilket ju annars lätt rationaliseras bort. Nackdelen med phpDoc skulle väl kunna vara att den dokumentation som skapas ligger utspridd i flera mappar, och att inte all denna information är tillgänglig via index.html-filen (vad jag har kunnat se).  

####Hur känns det att skriva kod utanför och inuti ramverket, ser du fördelar och nackdelar med de olika sätten?  

Fördelen med att skriva kod inuti ramverket torde vara att man får tillgång till dess klasser och metoder, interfaces och traits och slipper skriva allt själv, och att man 'tvingas' till att ha en viss struktur på sin kod.
Nackdelen är väl det kanske inte alltid är helt lätt att sätta sig in i hur ramverket fungerar, och att det är lite mer uppstyrt vad man kan göra och hur man ska göra det.
Har inte utnyttjat ramverket och dess resurser i någon större omfattning ännu.

####Vilken är din TIL för detta kmom?  





Kmom03
-------------------------

Här är redovisningstexten



Kmom04
-------------------------

Här är redovisningstexten



Kmom05
-------------------------

Här är redovisningstexten



Kmom06
-------------------------

Här är redovisningstexten



Kmom07-10
-------------------------

Här är redovisningstexten
