-- USE melogin;
USE mafd16;

-- Ensure UTF8 as chacrter encoding within connection.
SET NAMES utf8;

--
-- Create table for Content
--
DROP TABLE IF EXISTS `content`;
CREATE TABLE `content`
(
  `id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `path` CHAR(120) UNIQUE,
  `slug` CHAR(120) UNIQUE,

  `title` VARCHAR(120),
  `data` TEXT,
  `type` CHAR(20),
  `filter` VARCHAR(80) DEFAULT NULL,

  -- MySQL version 5.6 and higher
  -- `published` DATETIME DEFAULT CURRENT_TIMESTAMP,
  -- `created` DATETIME DEFAULT CURRENT_TIMESTAMP,
  -- `updated` DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,

  -- MySQL version 5.5 and lower
  `published` DATETIME DEFAULT NULL,
  -- `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  -- `updated` DATETIME DEFAULT NULL, -- ON UPDATE CURRENT_TIMESTAMP,
  `created` DATETIME DEFAULT NULL, -- CURRENT_TIMESTAMP,
  `updated` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` DATETIME DEFAULT NULL

) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;



--
-- Create index for content.type and content.deleted
--
CREATE INDEX index_type ON content(type);

CREATE INDEX index_deleted ON content(deleted);




/*
INSERT INTO `content` (`path`, `slug`, `type`, `title`, `data`, `filter`) VALUES
    ("hem", null, "page", "Hem", "Detta är min hemsida. Den är skriven i [url=http://en.wikipedia.org/wiki/BBCode]bbcode[/url] vilket innebär att man kan formattera texten till [b]bold[/b] och [i]kursiv stil[/i] samt hantera länkar.\n\nDessutom finns ett filter 'nl2br' som lägger in <br>-element istället för \\n, det är smidigt, man kan skriva texten precis som man tänker sig att den skall visas, med radbrytningar.", "bbcode,nl2br"),
    ("om", null, "page", "Om", "Detta är en sida om mig och min webbplats. Den är skriven i [Markdown](http://en.wikipedia.org/wiki/Markdown). Markdown innebär att du får bra kontroll över innehållet i din sida, du kan formattera och sätta rubriker, men du behöver inte bry dig om HTML.\n\nRubrik nivå 2\n-------------\n\nDu skriver enkla styrtecken för att formattera texten som **fetstil** och *kursiv*. Det finns ett speciellt sätt att länka, skapa tabeller och så vidare.\n\n###Rubrik nivå 3\n\nNär man skriver i markdown så blir det läsbart även som textfil och det är lite av tanken med markdown.", "markdown"),
    ("blogpost-1", "valkommen-till-min-blogg", "post", "Välkommen till min blogg!", "Detta är en bloggpost.\n\nNär det finns länkar till andra webbplatser så kommer de länkarna att bli klickbara.\n\nhttp://dbwebb.se är ett exempel på en länk som blir klickbar.", "link,nl2br"),
    ("blogpost-2", "nu-har-sommaren-kommit", "post", "Nu har sommaren kommit", "Detta är en bloggpost som berättar att sommaren har kommit, ett budskap som kräver en bloggpost.", "nl2br"),
    ("blogpost-3", "nu-har-hosten-kommit", "post", "Nu har hösten kommit", "Detta är en bloggpost som berättar att sommaren har kommit, ett budskap som kräver en bloggpost", "nl2br");

SELECT `id`, `path`, `slug`, `type`, `title`, `created` FROM `content`;
*/


INSERT INTO `content` (`path`, `slug`, `type`, `title`, `data`, `filter`, `published`) VALUES
    ("hem", "hem", "page", "Hem", "Detta är min hemsida. Den är skriven i [url=http://en.wikipedia.org/wiki/BBCode]bbcode[/url] vilket innebär att man kan formattera texten till [b]bold[/b] och [i]kursiv stil[/i] samt hantera länkar.\n\nDessutom finns ett filter 'nl2br' som lägger in <br>-element istället för \\n, det är smidigt, man kan skriva texten precis som man tänker sig att den skall visas, med radbrytningar.", "bbcode,nl2br", 1000-01-01),
    ("om", "Om", "page", "Om", "Detta är en sida om mig och min webbplats. Den är skriven i [Markdown](http://en.wikipedia.org/wiki/Markdown). Markdown innebär att du får bra kontroll över innehållet i din sida, du kan formattera och sätta rubriker, men du behöver inte bry dig om HTML.\n\nRubrik nivå 2\n-------------\n\nDu skriver enkla styrtecken för att formattera texten som **fetstil** och *kursiv*. Det finns ett speciellt sätt att länka, skapa tabeller och så vidare.\n\n###Rubrik nivå 3\n\nNär man skriver i markdown så blir det läsbart även som textfil och det är lite av tanken med markdown.", "markdown", 1000-01-01),
    ("blogpost-1", "valkommen-till-min-blogg", "post", "Välkommen till min blogg!", "Detta är en bloggpost.\n\nNär det finns länkar till andra webbplatser så kommer de länkarna att bli klickbara.\n\nhttp://dbwebb.se är ett exempel på en länk som blir klickbar.", "link,nl2br", 1000-01-01),
    ("blogpost-2", "nu-har-sommaren-kommit", "post", "Nu har sommaren kommit", "Detta är en bloggpost som berättar att sommaren har kommit, ett budskap som kräver en bloggpost.", "nl2br", 1000-01-01),
    ("blogpost-5", "default-filter", "post", "Default filter", "Ännu en post i bloggen!\nDet är nl2br som default filter om inget annat sätts vid skapandet av ett nytt innehåll! Bra va! Annars hade det blivit tokigt fel i min textfilter-funktion, som tar en kommaseparerad sträng med filter som argument. ", "nl2br", 1000-01-01),
    ("senaste", "senaste", "page", "Senaste", "[b]Fetstil[/b] och [i]italic[/i].\nÄven en newline.\nEn länk https://dbwebb.se", "bbcode,nl2br,link", 1000-01-01),
    (null, "nytt-inlagg", "page", "Nytt inlägg", "Ett nytt inlägg.\nMed newline!\nEn till newline!", "nl2br", 1000-01-01),
    (null, "testinlagg", "page", "Testinlägg", "Lite data, eller text.", "nl2br", 1000-01-01),
    (null, "ny-slug", "page", "Testinlägg 5", "[b]Fetstil[/b] och [i]italic[/i].\nÄven en newline.", "bbcode,nl2br", 1000-01-01),
    (null, "content-for-a-block", "block", "Content for a block", "This content is meant for use in a block.\nThat could be in a sidebar, a flash, a triptych or a footer.\nEnjoy!", "nl2br", 1000-01-01),
    (null, "another-slug", "block", "Testinlägg34", "This is\na block\nwith \na lot of\nnewlines!\n\nYes,\nmany!", "nl2br", 1000-01-01),
    (null, "testslug", "block", "Testinlägg", "Skriver man [b]inget[/b] innehåll så kan det bli något [i]fel[/i] på något ställe!", "nl2br,bbcode", 1000-01-01);











-- end of file!
