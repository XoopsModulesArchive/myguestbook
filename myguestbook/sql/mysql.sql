CREATE TABLE myguestbook (
  id int(11) NOT NULL auto_increment,
  name varchar(150) default NULL,
  title varchar(150) default NULL,
  message text,
  note longtext,
  time int(10) NOT NULL default '0',
  email varchar(60) default NULL,
  url varchar(100) default NULL,
  ip varchar(15) default NULL,
  gender tinyint(4) default '3',
  facebook varchar(50) default NULL,
  twitter varchar(50) default NULL,
  icq varchar(15) default NULL,
  yim tinytext,
  aim tinytext,
  msn tinytext,
  location tinytext,
  company tinytext,
  PRIMARY KEY  (id)
) ENGINE=MyISAM;

#
# Dumping data for table `xoops_myguestbook`
#

INSERT INTO myguestbook VALUES (1, 'Narga Vault', 'Thanks for used it !', 'This is a intro for Nagra Guestbook module! You can delete it after install.\r\n\r\nSome feature for this version:\r\n\r\n          + Allow bbcode and smile code in each entry.\r\n          + Option to allow display icons and include search enginer.\r\n          + Auto fill user information when the submitter is member.\r\n          + Display Email, URL, FACEBOOK, TWITTER, ICQ, AIM, YIM, MSN and gender via icons and more field.\r\n          + Use Smarty Templates.\r\n\r\nIn the next version:\r\n\r\n          + Country flags below the gender name.\r\n          + Notificate to webmasters when the Guestbook has a new entry.\r\n\r\nAll support and resouce at :\r\n         [:: Narga Vault :-: The Land Of Dreams::]\r\n                  http://www.narga.tk\r\n                  webmaster@narga.tk\r\n  :-)', '', 1056359672, 'webmaster@narga.tk', 'http://www.narga.tk', '127.00.08',0,  'facebook','twitter','#167045011', 'ipwgc', 'ipwgc', 'ipwgc', 'Narga Vault; Narge - USA', '[:: Narga Vault ::]');

