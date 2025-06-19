-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2025 at 08:16 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `news`
--

-- --------------------------------------------------------

--
-- Table structure for table `news_reports`
--

CREATE TABLE `news_reports` (
  `id` int(11) NOT NULL,
  `headline` text NOT NULL,
  `body_text` text NOT NULL,
  `author` varchar(255) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `test_result` tinyint(1) DEFAULT NULL,
  `result` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `news_reports`
--

INSERT INTO `news_reports` (`id`, `headline`, `body_text`, `author`, `source`, `test_result`, `result`, `created_at`) VALUES
(1, 'Prime Minister inaugurates new AI research center in Bangalore', 'In a significant move towards technological advancement, the Prime Minister today inaugurated the National AI Research Center in Bangalore. The center aims to boost AI innovation in India and collaborate with global tech leaders.', 'Rajeev Mishra', 'The Times of India', 0, 'ðŸŸ¢ Real News', '2025-06-10 12:49:09'),
(2, 'Prime Minister inaugurates new AI research center in Bangalore', 'In a significant move towards technological advancement, the Prime Minister today inaugurated the National AI Research Center in Bangalore. The center aims to boost AI innovation in India and collaborate with global tech leaders.', 'Rajeev Mishra', 'The Times of India', 0, 'ðŸŸ¢ Real News', '2025-06-10 12:51:45'),
(3, 'Scientists discover invisible aliens living inside our brains', 'According to a secret Russian study leaked on Reddit, scientists found evidence of invisible alien organisms controlling human behavior. The report was immediately taken down by the government.', 'Unknown', 'alienbuzz24.com', 1, 'ðŸ”´ Fake News', '2025-06-10 14:19:54'),
(4, 'Govt declares pizza a national dish after viral meme campaign', 'Following a massive Twitter trend started by food influencers, the government jokingly declared pizza as Indiaâ€™s national dish. Though officials later clarified it was sarcasm, many took it seriously.', 'Priya Shah', 'ScrollDuniya.com', 0, 'ðŸŸ¢ Real News', '2025-06-10 15:26:57'),
(5, 'ISRO Successfully Launches Chandrayaan-3 to Explore Moon', 'India\'s space agency ISRO has successfully launched Chandrayaan-3, aiming to land near the lunar south pole. Scientists call it a giant leap for India\'s space exploration program.', 'Anjali Mehta', 'The Hindu', 0, 'ðŸŸ¢ Real News', '2025-06-11 04:59:19'),
(6, 'Drinking cold water turns your blood blue, scientists warn', 'A WhatsApp message claims that cold water reacts with blood and can cause the blood to turn blue temporarily, risking stroke and memory loss.', 'Unknown', 'healthmyths.ru', 1, 'ðŸ”´ Fake News', '2025-06-11 05:54:35'),
(7, 'RBI Increases Repo Rate by 25 Basis Points to Tame Inflation', 'The Reserve Bank of India has raised the repo rate to 6.50% in a bid to control rising inflation in the country. This move is expected to increase EMIs on loans.', 'Rohan Kapoor', 'Economic Times', 0, 'ðŸŸ¢ Real News', '2025-06-11 06:04:22'),
(8, 'RBI Increases Repo Rate by 25 Basis Points to Tame Inflation', 'The Reserve Bank of India has raised the repo rate to 6.50% in a bid to control rising inflation in the country. This move is expected to increase EMIs on loans.', 'Rohan Kapoor', 'Economic Times', 0, 'ðŸŸ¢ Real News', '2025-06-11 06:04:24'),
(9, 'Indian student builds time machine from junk parts', 'A 14-year-old from Bihar claims to have built a time machine using scrap materials and has allegedly traveled back to 1947.', 'Ankur Tech', 'mindblowtechz.in', 1, 'ðŸ”´ Fake News', '2025-06-11 06:06:13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(8) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`) VALUES
(1, 'praja', '1234', 'Sudhanshu Prajapati');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `news_reports`
--
ALTER TABLE `news_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `news_reports`
--
ALTER TABLE `news_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
