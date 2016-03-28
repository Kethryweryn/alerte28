
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
(2, 'Communication', 'Niveau de la comm', 'COMM');
