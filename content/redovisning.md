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

Här är redovisningstexten



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
