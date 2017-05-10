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
<p>Text</p>

<h2>Kmom06</h2>
<p>Text</p>

<h2>Kmom10</h2>
<p>Text</p>
