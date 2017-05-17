Dokumentation för SQL-API
=========================

Dokumentation för SQL-API gällande mafd16 sql-databas för webshop i kursen
OOPHP, kmom05.
Dokumentationen följer steg för steg de krav som ställs i uppgiften, där kravet behöver dokumenteras.

### Krav 5. Skapa ren SQL för att implementera en varukorg. Man skall kunna lägga till/ta bort en produkt i en varukorg. Man skall kunna visa varukorgens innehåll.

1. Implementera en varukorg. Detta är gjort i tabellerna ShopCart och ShopCartRow.

2. Lägg till en produkt i varukorgen. Utförs genom proceduren addProdToCart(shopCartId, productId), där shopCartId (INT) är id-nummer på varukorgen, och productId (INT) är id-nummer  på produkten. (Observera att proceduren även tar produkten från lagret. Om kunden dröjer för länge med att betala, eller lämnar webshopen, så bör produkten läggas tillbaka i lagret.)

3. Ta bort en produkt från varukorgen. Utförs genom proceduren dropProdFromCart(shopCartRowId), där shopCartRowId (INT) är id-nummer i ShopCartRow. (Observera att produkten läggs tillbaka på lagret.)

4. Visa varukorgens innehåll. Utförs genom proceduren showCart(shopCartId), där shopCartId (INT) är id-nummer på varukorgen.

### Krav 6. Skapa ren SQL för att göra en order baserat på en varukorg. Man skall kunna visa innehållet i en order och ta bort en order. När en varukorg övergår till en order skall du även “flytta” motsvarande antal produkter från lagret till ordern.

1. Gör en order baserat på en varukorg. Utförs genom proceduren createOrderFromCart(shopCartId), där shopCartId (INT) är id-nummer på varukorgen.

2. Visa innehållet i en order. Utförs genom proceduren showOrder(idOfOrder), där idOfOrder (INT) är id-nummer på ordern.

3. Ta bort en order. Utförs genom proceduren deleteOrder(idOfOrder), där idOfOrder (INT) är id-nummer på ordern. Ordern tas inte bort från databasen. Istället får kolumnen deleted en tidsstämpel.

(Observera att kravet att flytta en produkt från lagret till ordern inte utförs. Istället flyttas produkten från lagret till varukorgen.)

### Krav 7. Lägg in stöd så att databasen har koll på när du behöver beställa nya produkter. När en produkt har färre än 5 produkter i lagret så lägger du in en rad, tillsammans med en tidsstämpel för när det hände, i en speciell tabell där du kan se vilka produkter som behövs beställas. Skapa SQL för en rapport som visar de produkter du skall beställa.

1. Titta på rapport som visar de produkter som skall beställas. Utförs genom vyn VOrderToInventory.
