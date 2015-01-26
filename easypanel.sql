

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `name_database`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `articoli`
--

CREATE TABLE IF NOT EXISTS `articoli` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `titolo` text NOT NULL,
  `titolo_en` text NOT NULL,
  `body` text NOT NULL,
  `body_en` text NOT NULL,
  `data` date NOT NULL,
  `allegato` text NOT NULL,
  `category` text,
  `public` int(2) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  FULLTEXT KEY `allegato` (`allegato`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;


-- --------------------------------------------------------

--
-- Carica alcuni valori iniziati, un articolo in bozza ed un articolo pubbicato
--

INSERT INTO  `dmedia_2`.`articoli` (
`id` ,
`titolo` ,
`titolo_en` ,
`body` ,
`body_en` ,
`data` ,
`allegato` ,
`category` ,
`public`
)
VALUES (
NULL ,  'titolo in italiano',  'titolo in inglese',  'corpo del testo in italiano',  'corpo del testo in inglese',  '',  '', NULL ,  '1'
), (
NULL ,  'titolo in italiano',  'titolo in inglese',  'corpo del testo in italiano',  'corpo del testo in inglese',  '',  '', NULL ,  '0'
);

-- --------------------------------------------------------

--
-- Crea la tabella per caricare le sessioni utenti
--

CREATE TABLE sessioni (
   uid CHAR(32) NOT NULL,
   user_id INT UNSIGNED NOT NULL,
   creation_date INT UNSIGNED NOT NULL,
   INDEX(uid)
);

-- --------------------------------------------------------

--
-- Crea la tabella per salvare le informazioni degli utenti
--

CREATE TABLE utenti (
   id INT UNSIGNED NOT NULL AUTO_INCREMENT,
   name VARCHAR(30) NOT NULL,
   surname VARCHAR(30) NOT NULL,
   username VARCHAR(30) NOT NULL,
   password CHAR(32) NOT NULL,
   indirizzo VARCHAR( 100 ) NOT NULL,
   occupazione VARCHAR( 100 ) NOT NULL,
   temp SET( '0', '1' ) NOT NULL,
   regdate VARCHAR( 11 ) NOT NULL,
   uid VARCHAR( 32 ) NOT NULL;
   PRIMARY KEY(id),
   INDEX(username, password)
);


-- --------------------------------------------------------

--
-- Carica l'utente admin. cambia i dati di riferimento.
--
INSERT INTO utenti (name, surname, username, password, indirizzo, occupazione, temp) VALUES ('Super', 'Admin','admin',MD5('pwadmin'), 'null', 'null', '0')
