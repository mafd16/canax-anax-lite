<?php
$guess = $app->url->create("../../kmom01/guess/index");
?>


<h1>Redovisning</h1>
<p>Här kan du läsa mina redovisningar från de olika vecko-momenten.</p>

<h2>Kmom01</h2>

<p>Ny kurs igång, och detta blev på något sätt ett väldigt stort vecko-moment som
för mig tagit närmre dubbelt så lång tid som det ska. Det kanske är i sin ordning,
vissa moment är större, och vissa är mindre. När det gäller
<a href="<?= $guess ?>">guess-uppgiften</a> så
hade jag svårt att greppa hur session-delarna skulle lösas. Jag har tragglat på
en hel del, och det får ju åtminstone till följd att man lär sig väldigt mycket.
Det är dock inte alls kul att hamna efter i schemat. Jag får försöka jobba ikapp
det.</p>

<h4>Hur känns det att hoppa rakt in i klasser med PHP, gick det bra?</h4>
<p>Det gick fin-fint. Eftersom vi precis läst oopython så känns det som att jag
fått en bra grund att stå på. Jag får bilden av att det i stort fungerar på samma
sätt i php, bara att syntaxen är lite annorlunda. </p>


<h4>Berätta om dina reflektioner kring ramverk, anax-lite och din me-sida.</h4>
<p>Jag vet att jag under förra läsperioden tyckte det blev lite för mycket
kopierande av kod, och även här blev det en hel del kopierande av färdig kod.
Jag tycker dock att det är i sin ordning. Fokus låg på att få en bra bild av hur
ramverket fungerar och är uppbyggt, och det tycker jag artikeln om anax-lite
lyckas med skapligt bra. Sen finns det nog en hel del i ramverket som är rena
grekiskan, så jag behöver nog läsa på mer teoretiskt om hur det är uppbyggt.
Min me-sida blev nu väldigt enkel då jag ligger tidsmässigt nästan en vecka
efter. Jag har uppfyllt de krav som finns, men inte mer. Stylingen gjorde jag
lite snabbt i css, och är inte alls nöjd med. Den får jag förbättra framöver.
Jag kommer nog ge mig på att använda bootstrap igen, jag gillade det i
python-kursen. I min navbar hade jag problem att få till en nästad lista
li med li. Antar att det skulle vara bra till att göra undermenyer i
extrauppgiften. Jag gjorde nu istället en ul med li. </p>

<h4>Gick det bra att komma igång med MySQL, har du liknande erfarenheter sedan
    tidigare?</h4>
<p>Ja, det gick bra. Jag gjorde de 5 första uppgifterna av 15. Jag har tidigare
grundligt stött på SQL i ett statistikprogram som heter Qlikview. Som namnet
antyder så klickar man på det man vill visa, istället för att använda de
underliggande sql-satserna. </p>



<h2>Kmom02</h2>


<h4>Hur känns det att skriva kod utanför och inuti ramverket, ser du
fördelar och nackdelar med de olika sätten?</h4>
<p>När det gäller kod som kan komma att återanvändas flera gånger så känns det
rätt att skriva det i ramverket, som t.ex. navbaren. Den hade jag nog kunnat
använda igen i session-uppgiften. Med en vettig dokumentation så kan jag tycka
att det är en fördel att lägga kod i ramverket. Bara det inte blir alldeles
för specifika saker som man bygger in. </p>

<h4>Hur väljer du att organisera dina vyer?</h4>
<p>Hittills har jag lagt de två navbar-vyerna i navbar1 och navbar2, och så har
jag de andra vyerna i mappen take1. Med så här pass få vyer tycker jag det
går alldeles utmärkt att ha dom i en mapp, men om sidan skulle växa sig
mycket större så skulle jag nog dela upp dom i egna mappar. </p>

<h4>Berätta om hur du löste integreringen av klassen Session.</h4>
<p>Jag skapade klassen Session i mappen src/Session, och initierade den i
index.php. Jag skapade bara en view-fil, session.php i mappen view/take1.
I view-filen sätter jag key/value-paret 'count' => 0, om det inte redan finns
i sessionen. Sen skapar jag länkarna till de olika routerna, som jag skriver
ut i html. Jag skriver också ut 'Current value'. I config/route/session.php la
jag till de router som behövdes, och utförde respektive operationer,
exempelvis increment. Efter det använde jag mig av funktionen redirect (eller
sendJson), som fanns i modulen vendor/anax/response, och redirectade tillbaka
till view-filen session.php. Det känns helt klart bra att bara skapa en
view-fil för att lösa uppgiften. </p>

<h4>Berätta om hur du löste uppgiften med Tärningsspelet 100, hur du tänkte,
planerade och utförde uppgiften samt hur du organiserade din kod?</h4>
<p>Till att börja med så missade jag att bara en spelare skulle spela själv,
utan jag gjorde från början att man spelar två spelare mot varandra. Vidare så
tyckte jag det verkade rörigt med 3 klasser som skulle samverka, och jag såg
inte framför mig hur det skulle fungera. Jag skapade därför en klass i
src/Dice/Dice.php. I den skapade jag privata variabler för spelarnas totala
summa, vems tur det är, tillfällig summa och resultat av senaste kastet. De
metoder som finns i klassen är t.ex. throwDice, changePlayer, showPlayerInTurn,
showTotalScore, stopAndSave, och några till.

I min view-fil (view/take1/dice.php) så startar jag en session skild från
sessionen i sessions-uppgiften. Om mitt dice-objekt finns sparat i sessionen
så använder jag det, annars så initierar jag ett nytt dice-objekt. Länkarna
på sidan skickar ett värde med GET, och jag fångar upp värdena och utför
de operationer som spelaren har klickat. I php-koden kollar jag även efter
om en etta har slagits, eller om någon har nått 100. Jag sparar mitt uppdaterade
dice-objekt i sessionen. Jag valde även att göra en alert-popup om en etta slås,
så att en spelare av bara farten inte spelar på den andra spelarens tur. Jag
la även till info-meddelanden. </p>


<h4>Några tankar kring SQL så här långt?</h4>
<p>Jag tycker det känns ganska så enkelt och logiskt. Som nybörjare får man ju
läsa en del i manualen och testa sig fram, men det funkar fint. Jag gjorde nu
från och med uppgift 6 till och med uppgift 10. </p>





<h2>Kmom03</h2>


<h4>Hur kändes det att jobba med PHP PDO, SQL och MySQL?</h4>
<p>PHP PDO funkade okej. Tyvärr blev koden lite icke-enhetlig, då jag både drog
nytta av mos artikel och av lews artikel, då dom kodar lite olika. Det blir väl
lätt så när man utgår från någon annans kod. Jag hade också ett problem med
teckenkodning som jag inte fick ordning på. När jag skapar användare med åäö
i användarnamnet så blir det fel i databasen, vilket får följdfel att det blir
fel vid sökning av användare och vid radering av användare. Teckenkodningen
blir dock rätt i mina andra kolumner, vilket kändes konstigt. Jag fick inte
ordning på det iaf.</p>

<p>SQL känns kul och logiskt att jobba med. Där fick vi ju även se att det går
att höja svårighetsgraden avsevärt. Övningarna kändes dock som en bra
introduktion. För admin-gränssnitts-övningen hade det varit bra om det hade
varit länkat till artikeln som beskriver BTHs sql-databas-server och hur man får
tillgång till den. </p>

<h4>Reflektera kring koden du skrev för att lösa uppgifterna, klasser,
formulär, integration Anax Lite?</h4>
<p>Min första reflektion är att jag inte känner mig helt klar över hur jag borde
koda lösningarna, eller rättare sagt vad som anses som en bra lösning. Det kanske
iofs inte är det viktiga här, bara det fungerar tillfredsställande. För
uppgifterna använde jag sessionsklassen från tidigare uppgift, och skapade en
ny databasklass. Alla vyer la jag i en egen mapp, view/login. Min kod kanske
inte är så DRY som den skulle kunna vara, men i vissa fall är det ett medvetet
val. T.ex. redigera/radera användare, där vill jag hålla isär funktionaliteten helt
och hållet. Jag tycker inte om när det ligger en redigera-knapp och en
radera-knapp precis intill varandra. En radera-funktion tycker jag ska ligga på
en helt egen sida, som tydligt särskiljer sig från andra sidor. Formulären gick
fint att skapa, men i vissa vyer blev det lite mycket kod. Det var dock inga
större svårigheter att hålla ordning. Databasklassen integrerade jag som en del
i $app, men sessionen gjorde jag så den bara nås under Profil-fliken. Jag lyckades
inte få in den i $app, och det verkade som att den på något vis krockade med
sessionen i Session-fliken. Att starta 3 sessioner på en hemsida kanske heller
inte är optimalt. </p>

<h4>Känner du dig hemma i ramverket, dess komponenter och struktur?</h4>
<p>Nja, inte helt. Det känns som att jag famlar lite i mörkret, och det jag lär
mig är det som jag stöter på under uppgifternas gång. Det som jag saknar är en
mer teoretisk förklaring av ett ramverk, och dess ingående delar. Kanske kan vara
något för kurslitteraturen i framtida versioner av kursen? Sen så kanske det inte
är så enkelt, det finns ju olika ramverk, och kanske även olika teorier om vad
som är ett ramverk, eller vad som bör ingå. </p>

<h4>Hur bedömmer du svårighetsgraden på kursens inledande kursmoment, känner
du att du lär dig något/bra saker?</h4>
<p>Svårighetsgraden tycker jag är på en lagom nivå. Däremot så har kursmomenten
kännts väldigt stora, eller åtminstone så tycker jag att dom tar längre tid att
genomföra jämfört med tidigare kurser. Jag tycker jag lär mig mycket, men ibland
kan det vara svårt att se under pågående kurs, då allt är nytt och man känner sig
överröst med ny information. När man väl avslutat kursen, och senare återgår
till ämnet så bruker man se klarare på sakerna. Jag förväntar mig samma sak för
denna kursen. </p>




<h2>Kmom04</h2>
<p></p>

<h4>Finns något att säga kring din klass för textfilter, eller rent allmänt om
formattering och filtrering av text som sparas i databasen av användaren?</h4>
<p>Jag valde att inte integrera mos färdiga modul, utan istället skrev jag
själv. Sen har jag ändå återanvänt mycket kod. Tycker det ger en större
förståelse om man ändå skriver själv. bbcode-funktionen skulle man såklart
kunna utveckla till att innehålla mycket mer, men nu har man iaf en grund att
stå på. Att integrera Michelf\markdown gav mig problem med phpmd, som klagade
på att jag använde en annan klass i min klass. Eftersom det ändå var
en del av uppgiften så har jag bara tystat den varningen. </p>

<h4>Berätta hur du tänkte när du strukturerade klasserna och databasen för
webbsidor och bloggposter?</h4>
<p>Jag skapade inga klasser för detta ändamålet som det tipsades om i
uppgiften. Jag har i stort följt beskrivningen i artikeln, och jobbat mot min
befintliga databas-klass. Databasen/tabellen är också uppbyggd enligt tabellen.
Däremot fick jag problem när jag gick över till bth´s sql-server, och min
update-kolumn fungerade inte som lokalt. Jag gjorde därför en lösning med att
inte använda mig av created-kolumnen på samma sätt som kanske var tänkt. </p>

<p>Mina vyer för detta kmom la jag i en egen mapp som heter blog. Alla vyer
där man kan utföra crud-operationer är skyddade av inloggning. Både admin och
vanliga användare kan uföra crud-operationerna. Från profil-sidan når man aktuella
sidor via länken 'Hantera innehåll'.  </p>

<h4>Förklara vilka routes som används för att demonstrera funktionaliteten
för webbsidor och blogg (så att en utomstående kan testa).</h4>
<p>För att se sidor av typen 'page' går man till /pages. Där får man en
översikt av de sidor som finns. Man kan därifrån klicka sig vidare till respektive
sida. Jag valde där att inte använda mig av path i länken, då det är ett krav
att path ska kunna vara tom. Därför använder jag mig av id i länken för att
komma till rätt sida. För att se bloggen används routen /blog. På den sidan, där
alla inlägg visas i kronologisk ordning, så klippte jag innehållet efter 100
tecken. Man kan där klicka sig vidare för att läsa respektive inlägg. Här har
jag använt mig av slug i länken. För att se block, använd /block. För att se
testrouten som visar formattering, använd /format. </p>

<h4>Hur känns det att dokumentera databasen så här i efterhand?</h4>
<p>Lite konstigt. Det känns som att man vill tänka till innan och göra en plan
för hur den ska se ut. Sen kan det ju alltid bli förändringar på vägen, så på
så sätt är ju detta ett väldigt smidigt sätt att kunna tillgå. </p>

<h4>Om du är självkritisk till koden du skriver i Anax Lite, ser du
förbättringspotential och möjligheter till alternativ struktur av din kod?</h4>
<p>Nja, vet inte riktigt. Jag tycker nog strukturen på koden i stort är okej, men
visst, det går förbättra säkert en massa saker. Något som jag däremot inte tycker
har blivit bra, är strukturen på själva me-sidan. Eftersom det byggs på mer och
mer sidor och funktionalitet för varje kmom så tycker jag inte att det är någon
vettig ordning/struktur. Det är nog lättare att rita upp hur man vill att det
ska se ut, om man har hela bilden klar för sig. Det skulle ju visserligen gå
att ändra i efterhand, men jag lämnar det till en senare övning i så fall. </p>




<h2>Kmom05</h2>

<h4>Gick det bra att komma igång med det vi kallar programmering av databas,
med transaktioner, lagrade procedurer, triggers, funktioner?</h4>
<p>Ja, det tycker jag. Visst får man traggla lite när man lär sig nytt, men
i det stora hela så tycker jag att det har gått bra. Jag valde att utgå från
sql-koden vi fick i exemplet, och byggde vidare på den. </p>
<p>Jag använde en hel del lagrade procedurer t.ex. för att ta bort order, visa
order och skapa order. Inbyggd funktion hade jag svårt att se något naturligt ställe
att utnyttja på, men jag skapade en funktion som anger hur många produkter som ska
beställas, utifrån vilket kvartal det blir tomt på lagret. Trigger använder jag en,
när det blir lågt med items på lagret. </p>
<p>Transaktioner använder jag på några ställen,
t.ex. när kund tar en produkt från lagret och lägger i varukorgen. Här har jag
frångått kravet om att produkten ska flyttas från lager till order. Jag anser att
rätt kundbemötande är att produkten flyttas, eller åtminstone reserveras, när den
läggs i varukorgen. Tänk dig själv om du är på matbutiken, och när du kommer till
kassan så säger expediten att någon annan var snabbare, och säljer ditt mjölkpaket
till personen framför dig i kassan. Snopet! Jag tycker ändå att jag uppfyller
meningen med kravet, att vi ska flytta en produkt från lagret, och lägga den
någon annanstans, i en transaktion. Mitt flöde ställer dock andra krav, t.ex.
att produkten måste läggas tillbaka i lagret om kunden lämnar sidan med produkter
i varukorgen. Det känns dock som att det problemet ligger utanför denna
uppgift. </p>
<p>Som produkter har jag pennor, och mitt gränssnitt gick skapligt enkelt att
bygga, då jag kunde återanvända mycket kod från tidigare kmom. </p>

<h4>Hur är din syn på att programmera på detta viset i databasen?</h4>
<p>Programmering på detta viset i databasen känns väldigt nytt för mig. Men jag
tycker det känns smart och ibland logiskt. Jag tänker mig att många olika sorters
klienter, t.ex. kund, kundservice, lagerarbetare, kan ofta använda samma metoder/api.
Det bör förenkla och snabba upp byggandet av allt som ett företag skulle tänkas
behöva.</p>

<h4>Några reflektioner kring din kod för backenden till webbshopen</h4>
<p>Jag tänker att man måste fundera både en och två gånger på struktur och flöden.
Ett exempel, som kanske kan synas som ett misstag eller fel, har jag stött på
medans jag kodat. Jag kan lägga samma produkt, ex. flera lådor med samma
produkter, på olika hyllor i lagret. Får då webbshopen rätt lagerstatus? Vad
händer när en produkt läggs tillbaka på lagret? Vilken hylla hamnar den på? Så
reflektionen är att det känns smart att tänka till innan man bygger.</p>

<h4>Något du vill säga om koden generellt i och kring Anax Lite?</h4>
<p>Svår fråga! Även om vi lär oss en massa under kursens gång, så känner jag
ändå en viss osäkerhet kring ramverket. Jag har inte översikts-bilden klar
för mig. Jag tycker att en teoretisk framläggning av ett ramverk och dess
eventuella delar skulle vara en bra ide för kursen, speciellt med tanke på att
det har varit ganska så knapert med kurslitteratur. </p>






<h2>Kmom06</h2>

<!--Jag började söka i min sql-kod efter kolumner som kunde indexeras. Det var dock
ganska så svårt att finna något som inte redan nyttjade t.ex. id. Till slut fann
jag i tabellen users, kolumn name. Den söker vi i på adminsidan, och här gick
det att förbättra från full table scan till en rad. Jag fann även i tabellen
content kolumnerna type och deleted. Även här gick det att förbättra resultatet
från full table scan till en rad. Dock bara, som det verkar, om t.ex. sökning
görs på type på ett värde som är unikt i kolumnen. -->



<h4>Vad du bekant med begreppet index i databaser sedan tidigare?</h4>
<p>Nej, det är helt nytt för mig. Man blir lite nyfiken på hur det fungerar,
rent programmeringsmässigt. Eller kanske mer algoritm-mässigt. Tror faktiskt
jag måste läsa på lite någon dag. </p>

<h4>Berätta om hur du jobbade i uppgiften om index och vilka du valde att
lägga till och skillnaden före/efter.</h4>
<p>Jag började söka i min sql-kod efter kolumner som kunde indexeras. Det var dock
ganska så svårt att finna något som inte redan nyttjade t.ex. id. Till slut fann
jag i tabellen users, kolumn name. Den söker vi i på adminsidan, och här gick
det att förbättra från full table scan till en rad. Jag fann även i tabellen
content kolumnerna type och deleted. Även här gick det att förbättra resultatet
från full table scan till en rad. Dock bara, som det verkar, om t.ex. sökning
görs på type på ett värde som är unikt i kolumnen.</p>

<h4>Har du tidigare erfarenheter av att skriva kod som testar annan kod?</h4>
<p>Bara det som vi stött på i tidigare kurser här på programmet. När jag till
slut väl fick ordning på test-miljön så gick det skapligt enkelt att skriva
testerna. Det var kul också att se sin code coverage, och att se hur man
förbättrades för varje test man skrev. </p>

<h4>Hur ser du på begreppet enhetstestning och att skriva testbar kod?</h4>
<p>Det beror lite på sammanhanget, men överlag tycker jag att det verkar vettigt.
Om man har kod som är, eller ska bli, väldigt stor, eller om man har kod som
kommer utsättas för förändring över tid, så känns det extremt nyttigt med tester.
Sen gäller det väl att hitta bra testfall. Det tror jag kan vara svårt. </p>

<h4>Hur gick det att hitta testbar kod bland dina klasser i Anax Lite?</h4>
<p>Det var lite svårt. Min Dice-klass kändes enklast att jobba med, så jag gav
mig på den. Jag fick efter ganska lite arbete ihop 100% på code coverage, vilket
är kul! Annars hade jag mest problem med att få till test-miljön. Jag hade en
gammal version av phpunit som följde med xampp. När jag installerade ny version
av phpunit, så krånglade det, och jag fick experimentera lite med .bat-ändelse
på en fil. Fick då även ändra i make-filen. Sen fick jag felet att 'class
PHPUnit_Framework_TestCase not found'. Fick lägga till
'require_once phpunit/autoload.php'. Då 'funkade' phpunit, men inga tester kördes.
Ändrade då i class-definitionen 'extends \phpunit_framework_testcase' till
'extends \phpunit\framework\testcase'. Sökmotorer är bra ibland! </p>




<h2>Kmom10</h2>
<p>Då var ännu en kurs till ända. Jag har byggt en websida som i sin webshop säljer
pennor. Företaget, som ligger i Örebro, hette Närke pennor. Efter en satsning på den
internationella marknaden heter man numera Narke pens. Därmed så är även all text
på hemsidan på engelska.</p>

<h4>1. För varje krav jag implementerat</h4>

<h4>Krav 1: Struktur och innehåll</h4>
<p>Webplatsen består av följande sidor. Home, med en enklare välkomsttext. Products,
där produkterna visas. News, en nyhetsblogg. About, kort om företaget, och Profile,
där kunder och administratörer kan logga in för att få tillgång till ytterligare
funktionalitet. Om en administratör är inloggad så finns det på Profile-sidan
länk till att administrera innehåll på webplatsen (Admin content). Där kan man
skapa helt nytt innehåll, eller redigera/radera de poster som finns i listan.
Poster av typen 'post' visas som ett inlägg på News-sidan. Poster av typen
'about' visas på About-sidan, och poster av typen 'footer' visas i footern.
Footern och headern är såklart gemensam för alla sidor. Tillbaka på Profile-sidan
så hittar administratören även en länk till att hantera de produkter som visas i
webshopen (Admin products). Där finns det två listor. Först listan med produkterna,
där man kan redigera och radera. Det finns även en länk till att lägga till nya
produkter. Sen listan med lagerhyllorna. Där kopplar man en befintlig produkt
till en hylla i lagret, och anger antalet som finns av produkten. Produkten syns
i webshopen först efter att den är skapad och har fått en hylla i lagret.</p>

<p>När det gäller enhetstesterna så skrev jag några testfall för filen function.php
som ligger i src/Database. Dokumentation är gjord med phpdoc. Sql-koden och
er-diagrammet ligger i mappen sql. </p>

<h4>Krav 2: Skapa kundkonto</h4>
<p>Kunder som besöker webplatsen kan gå till Profile-fliken för att logga in
eller registrera sig (skapa konto). Väl inloggade kan dom från Profile-fliken
även logga ut, byta lösenord och redigera detaljer om sitt konto. Kunder kan inte
redigera övriga delar, som administratörer enligt ovan kan redigera. När kunderna
är inloggade så har dom också fått köp-knappar (add to cart), vid produkterna i
Products-fliken.</p>

<p>Det finns två förskapade konton, admin/admin och doe/doe. Inloggade administratörer
hittar under Profile-fliken länken 'Admin users'. Där kan administratören utföra
crud-operationer på alla användare, kunder som administratörer. </p>

<h4>Krav 3: Sida - Produkter</h4>
<p>I lagret finns det 12 produkter (pennor) i tre olika kategorier. På Products-sidan
visas produkterna med namn, kategori, bild, text, pris och antal. Är kunden inloggad
så visas även en köpknapp. Längst upp på Products-sidan finns det länkar för att
sortera, och visa olika antal produkter per sida. Där finns även en sök-ruta. Längst
ner på sidan finns det länkar för paginering. Om kunden är inloggad och trycker på
köp-knappen för en produkt, så läggs produkten i varukorgen. Kunden kan därefter
handla fler produkter, eller följa länken längst upp på Products-sidan till sin
varukorg (shopping cart). I varukorgen visas de produkter som lagts till. Har man
köpt två likadana produkter, så får dom ändå en rad var. Här kan man ta bort
produkter från varukorgen, och även se det totala priset. Varukorgen är implementerad
i sql-databasen. Längst ner finns en order-knapp. Trycker kunden på den så skapas
ordern, och order-detaljerna visas för kunden. Då uppdateras även lagret med
rätt antal produkter. Kunden kan sen gå till sin Profile-sida, och där välja
'Order history', för att se alla sina tidigare ordrar. Kunden kan även gå in på
varje order för att se order-detaljerna. </p>

<h4>2. Om projektet</h4>
<p>Detta projektet har gått över förväntan fort. Kanske blir så när man har
begränsat med tid också. I stort så har jag använt mig av de lösningar som vi
har jobbat med under kursens gång. Jag har fått justera lite i sql-databasen
för att det skulle passa med hemsidan, och de krav som den ställde. En sak som
blev lite redundant är att jag har users som inloggade användare av hemsidan, och
customers som köpare i webshopen. Dessa kopplas sen ihop av en tredje tabell,
user2customer. Här hade jag kunnat använda samma tabell för inloggning/köp, men
det hade krävt lite mer ombyggnation av koden. Hade ett problem där admin
tappade sin admin-status när admin redigerade sig själv via den redigerings-sidan
som vanliga kunder använder. Det var dock lättlöst. I övrigt så har allt flutit
på väldigt bra, och utan några egentliga svårigheter. Jag tycker projektet har
varit en bra examination på kursen. Det blev ganska mycket som skulle göras i
projektet, men det var inga större problem, då allt tidigare hade gjorts under
kursens gång, och vi hade mycket färdig kod. Alternativet hade väl varit ett
projekt med mindre delar/uppgifter och att man fick skriva mer kod från scratch.</p>


<h4>3. Om kursen</h4>
<p>Jag har haft svårt att se om kursen handlar om objekt-orienterad programmering
i php, eller om den handlar om ramverk i php, eller om det kanske faller in
under samma kategori? Hur som helst, så har jag gillat kursen. Artiklarna
har hållt hög kvalitet. Föreläsningar och genomgångar har jag tyvärr inte sett
mycket av den här läsperioden. Som förbättringsförslag skulle jag vilja se en mer
teoretisk framläggning av ramverk, och vad som kan tänkas ingå i ett sånt. Hur
funkar de ingående delarna? Kan tänka mig att det kanske är svårt, det finns ju
massor av ramverk, och alla ser dom väl olika ut. Men vissa delar bör dom ju ha
gemensamt. Kanske kan vara något för framtida läshänvisningar. Jag är dock
mycket nöjd med kursen. Det har varit kul att skriva php igen. Jag ger kursen
betyget 8 av 10.</p>
