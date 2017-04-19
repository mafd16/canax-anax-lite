<?php
$guess = $app->url->create("../../kmom01/guess/index");
?>

</div>

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
<p>Text</p>

<h2>Kmom04</h2>
<p>Text</p>

<h2>Kmom05</h2>
<p>Text</p>

<h2>Kmom06</h2>
<p>Text</p>

<h2>Kmom10</h2>
<p>Text</p>
