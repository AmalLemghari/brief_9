CREATE TABLE `projet` (
  `idpro` int(10) PRIMARY KEY AUTO_INCREMENT,
  `nompro` varchar(100),
  `descpro` varchar(200),
  `iduser` int(10)
);

CREATE TABLE `user` (
  `iduser` int(10) PRIMARY KEY AUTO_INCREMENT,
  `nom` varchar(100),
  `prenom` varchar(100),
  `email` varchar(100) UNIQUE,
  `pass` varchar(100),
  `tel` varchar(20),
  `role` varchar(100)
);

CREATE TABLE `tache` (
  `idta` int(10) PRIMARY KEY AUTO_INCREMENT,
  `nomta` varchar(100),
  `descta` varchar(100),
  `datedeb` varchar(100),
  `datefin` varchar(100),
  `etat` int(10),
  `statut` varchar(100),
  `iduser` int(10),
  `idpro` int(10)
);

INSERT INTO `projet` (`idpro`, `nompro`, `descpro`, `iduser`) VALUES
(41, 'test test', 'hello hello ', 9),
(43, 'salam', 'jchbsq', 9),
(44, 'Kaye Juarez', 'Officia laudantium ', 4),
(47, 'Jemima Hopkins', 'Aliquip quos iure re', 4);


INSERT INTO `tache` (`idta`, `nomta`, `descta`, `datedeb`, `datefin`, `etat`, `statut`, `iduser`, `idpro`) VALUES
(11, '23-Jan-1992', 'Porro nesciunt aut ', '2012-03-08', '1978-10-16', NULL, 'doing', 9, 38),
(12, '04-Mar-1989', 'Officia quaerat quis', '1996-12-22', '2000-03-22', NULL, 'doing', 9, 38),
(17, 'scscsfq', 'Et ut facilis perspi', '1976-05-20', '2012-10-02', NULL, 'to do', 9, 38),
(18, 'Hanna Knox', 'Nobis in debitis in ', '1981-11-18', '2007-09-04', NULL, 'doing', 4, 33),
(22, 'Plato Jarvis', 'Facilis illum exped', '1995-08-07', '2007-11-22', NULL, 'done', 4, 37),
(23, 'Germaine Austin', 'Enim aut odio culpa', '1987-10-28', '1999-08-22', NULL, 'to do', 4, 37);


ALTER TABLE tache
add iduser int(10),
ADD FOREIGN KEY (iduser) REFERENCES user(iduser) ON DELETE CASCADE;

ALTER TABLE tache
add idpro int(10),
ADD FOREIGN KEY (idpro) REFERENCES projet(idpro) ON DELETE CASCADE;

ALTER TABLE projet
add iduser int(10),
ADD FOREIGN KEY (iduser) REFERENCES user(iduser);



