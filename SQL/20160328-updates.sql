
--
-- Table structure for table `a28_counter`
--

CREATE TABLE IF NOT EXISTS `a28_counters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `counter_ref_id` int(11) NOT NULL,
  `event_on` datetime NOT NULL,
  `value` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `a28_counters_ref`
--

CREATE TABLE IF NOT EXISTS `a28_counters_ref` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `unique_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `a28_counters_ref`
--

INSERT INTO `a28_counters_ref` (`id`, `name`, `description`, `unique_name`) VALUES
(1, 'StockMarket', 'Cours de la bourse du CIUB', 'STOCK_MARKET'),
(2, 'Communication', 'Niveau de la comm', 'COMM'),
(NULL, 'Cure', 'Cure progress', 'CURE');

CREATE TABLE `a28_params` ( `id` INT NOT NULL AUTO_INCREMENT , `event_name` TEXT NOT NULL , `event_value` TEXT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
INSERT INTO `a28_params` (`id`, `event_name`, `event_value`) VALUES (NULL, 'start_date', '2016-04-13 21:00:00'); 



CREATE TABLE `a28_country_list` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `a28_country_list`
--
ALTER TABLE `a28_country_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `a28_country_list`
--
ALTER TABLE `a28_country_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
  
  
  
INSERT INTO `a28_country_list` (`id`, `name`, `code`) VALUES
(1, 'AFRIQUE DU SUD', 'ZA'),
(2, 'ÅLAND, ÎLES', 'AX'),
(3, 'ALBANIE', 'AL'),
(4, 'ALGERIE', 'DZ'),
(5, 'ALLEMAGNE', 'DE'),
(6, 'ANDORRE', 'AD'),
(7, 'ANGOLA', 'AO'),
(8, 'ANGUILLA', 'AI'),
(9, 'ANTARCTIQUE', 'AQ'),
(10, 'ANTIGUA ET BARBUDA', 'AG'),
(11, 'ARABIE SAOUDITE', 'SA'),
(12, 'ARGENTINE', 'AR'),
(13, 'ARMENIE', 'AM'),
(14, 'ARUBA', 'AW'),
(15, 'AUSTRALIE', 'AU'),
(16, 'AUTRICHE', 'AT'),
(17, 'AZERBAIDJAN', 'AZ'),
(18, 'BAHAMAS', 'BS'),
(19, 'BAHREIN', 'BH'),
(20, 'BANGLADESH', 'BD'),
(21, 'BARBADE', 'BB'),
(22, 'BELARUS', 'BY'),
(23, 'BELGIQUE', 'BE'),
(24, 'BELIZE', 'BZ'),
(25, 'BENIN', 'BJ'),
(26, 'BERMUDES', 'BM'),
(27, 'BHOUTAN', 'BT'),
(28, 'BOLIVIE, ETAT PLURINATIONAL DE', 'BO'),
(29, 'BONAIRE, SAINT-EUSTACHE ET SABA', 'BQ'),
(30, 'BOSNIE-HERZEGOVINE', 'BA'),
(31, 'BOTSWANA', 'BW'),
(32, 'BOUVET, ILE', 'BV'),
(33, 'BRESIL', 'BR'),
(34, 'BRUNEI DARUSSALAM', 'BN'),
(35, 'BULGARIE', 'BG'),
(36, 'BURKINA FASO', 'BF'),
(37, 'BURUNDI', 'BI'),
(38, 'CAIMANES, ILES', 'KY'),
(39, 'CAMBODGE', 'KH'),
(40, 'CAMEROUN', 'CM'),
(41, 'CANADA', 'CA'),
(42, 'CAP-VERT', 'CV'),
(43, 'CENTRAFRICAINE, REPUBLIQUE', 'CF'),
(44, 'CHILI', 'CL'),
(45, 'CHINE', 'CN'),
(46, 'CHRISTMAS, ILE', 'CX'),
(47, 'CHYPRE', 'CY'),
(48, 'COCOS (KEELING), ILES', 'CC'),
(49, 'COLOMBIE', 'CO'),
(50, 'COMORES', 'KM'),
(51, 'CONGO', 'CG'),
(52, 'CONGO, LA REPUBLIQUE DEMOCRATIQUE DU', 'CD'),
(53, 'COOK, ILES', 'CK'),
(54, 'COREE, REPUBLIQUE DE', 'KR'),
(55, 'COREE, REPUBLIQUE POPULAIRE DEMOCRATIQUE DE', 'KP'),
(56, 'COSTA RICA', 'CR'),
(57, 'COTE D IVOIRE', 'CI'),
(58, 'CROATIE', 'HR'),
(59, 'CUBA', 'CU'),
(60, 'CURACAO', 'CW'),
(61, 'DANEMARK', 'DK'),
(62, 'DJIBOUTI', 'DJ'),
(63, 'DOMINICAINE, REPUBLIQUE', 'DO'),
(64, 'DOMINIQUE', 'DM'),
(65, 'EGYPTE', 'EG'),
(66, 'EL SALVADOR', 'SV'),
(67, 'EMIRATS ARABES UNIS', 'AE'),
(68, 'EQUATEUR', 'EC'),
(69, 'ERYTHREE', 'ER'),
(70, 'ESPAGNE', 'ES'),
(71, 'ESTONIE', 'EE'),
(72, 'ETATS-UNIS', 'US'),
(73, 'ETHIOPIE', 'ET'),
(74, 'FALKLAND, ILES (MALVINAS)', 'FK'),
(75, 'FEROE, ILES', 'FO'),
(76, 'FIDJI', 'FJ'),
(77, 'FINLANDE', 'FI'),
(78, 'FRANCE', 'FR'),
(79, 'GABON', 'GA'),
(80, 'GAMBIE', 'GM'),
(81, 'GEORGIE', 'GE'),
(82, 'GEORGIE DU SUD ET LES ILES SANDWICH DU SUD', 'GS'),
(83, 'GHANA', 'GH'),
(84, 'GIBRALTAR', 'GI'),
(85, 'GRECE', 'GR'),
(86, 'GRENADE', 'GD'),
(87, 'GROENLAND', 'GL'),
(88, 'GUADELOUPE', 'GP'),
(89, 'GUAM', 'GU'),
(90, 'GUATEMALA', 'GT'),
(91, 'GUERNESEY', 'GG'),
(92, 'GUINEE', 'GN'),
(93, 'GUINEE-BISSAU', 'GW'),
(94, 'GUINEE EQUATORIALE', 'GQ'),
(95, 'GUYANA', 'GY'),
(96, 'GUYANE FRANCAISE', 'GF'),
(97, 'HAITI', 'HT'),
(98, 'HEARD, ILE ET MCDONALD, ILES', 'HM'),
(99, 'HONDURAS', 'HN'),
(100, 'HONG KONG', 'HK'),
(101, 'HONGRIE', 'HU'),
(102, 'ILE DE MAN', 'IM'),
(103, 'ILES MINEURES ELOIGNEES DES ETATS-UNIS', 'UM'),
(104, 'ILES VIERGES BRITANNIQUES', 'VG'),
(105, 'ILES VIERGES DES ETATS-UNIS', 'VI'),
(106, 'INDE', 'IN'),
(107, 'INDONESIE', 'ID'),
(108, 'IRAN, REPUBLIQUE ISLAMIQUE D', 'IR'),
(109, 'IRAQ', 'IQ'),
(110, 'IRLANDE', 'IE'),
(111, 'ISLANDE', 'IS'),
(112, 'ISRAEL', 'IL'),
(113, 'ITALIE', 'IT'),
(114, 'JAMAIQUE', 'JM'),
(115, 'JAPON', 'JP'),
(116, 'JERSEY', 'JE'),
(117, 'JORDANIE', 'JO'),
(118, 'KAZAKHSTAN', 'KZ'),
(119, 'KENYA', 'KE'),
(120, 'KIRGHIZISTAN', 'KG'),
(121, 'KIRIBATI', 'KI'),
(122, 'KOWEIT', 'KW'),
(123, 'LAO, REPUBLIQUE DEMOCRATIQUE POPULAIRE', 'LA'),
(124, 'LESOTHO', 'LS'),
(125, 'LETTONIE', 'LV'),
(126, 'LIBAN', 'LB'),
(127, 'LIBERIA', 'LR'),
(128, 'LIBYENNE, JAMAHIRIYA ARABE', 'LY'),
(129, 'LIECHTENSTEIN', 'LI'),
(130, 'LITUANIE', 'LT'),
(131, 'LUXEMBOURG', 'LU'),
(132, 'M', 'LU'),
(133, 'MACAO', 'MO'),
(134, 'MACEDOINE, EX-REPUBLIQUE YOUGOSLAVE DE', 'MK'),
(135, 'MADAGASCAR', 'MG'),
(136, 'MALAISIE', 'MY'),
(137, 'MALAWI', 'MW'),
(138, 'MALDIVES', 'MV'),
(139, 'MALI', 'ML'),
(140, 'MALTE', 'MT'),
(141, 'MARIANNES DU NORD, ILES', 'MP'),
(142, 'MAROC', 'MA'),
(143, 'MARSHALL, ILES', 'MH'),
(144, 'MARTINIQUE', 'MQ'),
(145, 'MAURICE', 'MU'),
(146, 'MAURITANIE', 'MR'),
(147, 'MAYOTTE', 'YT'),
(148, 'MEXIQUE', 'MX'),
(149, 'MICRONESIE, ETATS FEDERES DE', 'FM'),
(150, 'MOLDOVA, REPUBLIQUE DE', 'MD'),
(151, 'MONACO', 'MC'),
(152, 'MONGOLIE', 'MN'),
(153, 'MONTENEGRO', 'ME'),
(154, 'MONTSERRAT', 'MS'),
(155, 'MOZAMBIQUE', 'MZ'),
(156, 'MYANMAR', 'MM'),
(157, 'NAMIBIE', 'NA'),
(158, 'NAURU', 'NR'),
(159, 'NEPAL', 'NP'),
(160, 'NICARAGUA', 'NI'),
(161, 'NIGER', 'NE'),
(162, 'NIGERIA', 'NG'),
(163, 'NIUE', 'NU'),
(164, 'NORFOLK, ILE', 'NF'),
(165, 'NORVEGE', 'NO'),
(166, 'NOUVELLE-CALEDONIE', 'NC'),
(167, 'NOUVELLE-ZELANDE', 'NZ'),
(168, 'OCEAN INDIEN, TERRITOIRE BRITANNIQUE DE L', 'IO'),
(169, 'OMAN', 'OM'),
(170, 'OUGANDA', 'UG'),
(171, 'OUZBEKISTAN', 'UZ'),
(172, 'PAKISTAN', 'PK'),
(173, 'PALAOS', 'PW'),
(174, 'PALESTINIEN OCCUPE, TERRITOIRE', 'PS'),
(175, 'PANAMA', 'PA'),
(176, 'PAPOUASIE-NOUVELLE-GUINEE', 'PG'),
(177, 'PARAGUAY', 'PY'),
(178, 'PAYS-BAS', 'NL'),
(179, 'PEROU', 'PE'),
(180, 'PHILIPPINES', 'PH'),
(181, 'PITCAIRN', 'PN'),
(182, 'POLOGNE', 'PL'),
(183, 'POLYNESIE FRANCAISE', 'PF'),
(184, 'PORTO RICO', 'PR'),
(185, 'PORTUGAL', 'PT'),
(186, 'QATAR', 'QA'),
(187, 'REUNION', 'RE'),
(188, 'ROUMANIE', 'RO'),
(189, 'ROYAUME-UNI', 'GB'),
(190, 'RUSSIE, FEDERATION DE', 'RU'),
(191, 'RWANDA', 'RW'),
(192, 'SAHARA OCCIDENTAL', 'EH'),
(193, 'SAINT-BARTHELEMY', 'BL'),
(194, 'SAINTE-HELENE, ASCENSION ET TRISTAN DA CUNHA', 'SH'),
(195, 'SAINTE-LUCIE', 'LC'),
(196, 'SAINT-KITTS-ET-NEVIS', 'KN'),
(197, 'SAINT-MARIN', 'SM'),
(198, 'SAINT-MARTIN (PARTIE FRANCAISE)', 'MF'),
(199, 'SAINT-MARTIN (PARTIE NEERLANDAISE)', 'SX'),
(200, 'SAINT-PIERRE-ET-MIQUELON', 'PM'),
(201, 'SAINT-SIEGE (ETAT DE LA CITE DU VATICAN)', 'VA'),
(202, 'SAINT-VINCENT-ET-LES GRENADINES', 'VC'),
(203, 'SALOMON, ILES', 'SB'),
(204, 'SAMOA', 'WS'),
(205, 'SAMOA AMERICAINES', 'AS'),
(206, 'SAO TOME-ET-PRINCIPE', 'ST'),
(207, 'SENEGAL', 'SN'),
(208, 'SERBIE', 'RS'),
(209, 'SEYCHELLES', 'SC'),
(210, 'SIERRA LEONE', 'SL'),
(211, 'SINGAPOUR', 'SG'),
(212, 'SLOVAQUIE', 'SK'),
(213, 'SLOVENIE', 'SI'),
(214, 'SOMALIE', 'SO'),
(215, 'SOUDAN', 'SD'),
(216, 'SRI LANKA', 'LK'),
(217, 'SUEDE', 'SE'),
(218, 'SUISSE', 'CH'),
(219, 'SURINAME', 'SR'),
(220, 'SVALBARD ET ILE JAN MAYEN', 'SJ'),
(221, 'SWAZILAND', 'SZ'),
(222, 'SYRIENNE, REPUBLIQUE ARABE', 'SY'),
(223, 'TADJIKISTAN', 'TJ'),
(224, 'TAIWAN, PROVINCE DE CHINE', 'TW'),
(225, 'TANZANIE, REPUBLIQUE-UNIE DE', 'TZ'),
(226, 'TCHAD', 'TD'),
(227, 'TCHEQUE, REPUBLIQUE', 'CZ'),
(228, 'TERRES AUSTRALES FRANCAISES', 'TF'),
(229, 'THAILANDE', 'TH'),
(230, 'TIMOR-LESTE', 'TL'),
(231, 'TOGO', 'TG'),
(232, 'TOKELAU', 'TK'),
(233, 'TONGA', 'TO'),
(234, 'TRINITE-ET-TOBAGO', 'TT'),
(235, 'TUNISIE', 'TN'),
(236, 'TURKMENISTAN', 'TM'),
(237, 'TURKS ET CAIQUES, ILES', 'TC'),
(238, 'TURQUIE', 'TR'),
(239, 'TUVALU', 'TV'),
(240, 'UKRAINE', 'UA'),
(241, 'URUGUAY', 'UY'),
(242, 'VANUATU', 'VU'),
(243, 'VENEZUELA, REPUBLIQUE BOLIVARIENNE DU', 'VE'),
(244, 'VIET NAM', 'VN'),
(245, 'WALLIS ET FUTUNA', 'WF'),
(246, 'YEMEN', 'YE'),
(247, 'ZAMBIE', 'ZM'),
(248, 'ZIMBABWE', 'ZW');

--
-- Index pour les tables exportées
--

--
-- AUTO_INCREMENT pour les tables exportées
--
  
ALTER TABLE `a28_country_list` ADD `infected` INT NOT NULL DEFAULT '0' AFTER `code`;
  
  
CREATE TABLE `a28_stock_exchange` ( `id` INT NOT NULL AUTO_INCREMENT , `stock_on` DATETIME NOT NULL , `stock_value` FLOAT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;  
  
  
  
