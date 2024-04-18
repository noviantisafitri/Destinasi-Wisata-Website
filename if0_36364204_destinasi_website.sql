-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql210.infinityfree.com
-- Generation Time: Apr 18, 2024 at 08:10 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_36364204_destinasi_website`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `dekripsi` text NOT NULL,
  `path_gambar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `dekripsi`, `path_gambar`) VALUES
(1, 'Menghadapi Kegiatan Liburan dengan Efektif', 'Liburan adalah waktu yang dinanti-nantikan oleh banyak orang. Ini adalah kesempatan untuk melepaskan diri dari rutinitas sehari-hari dan menjelajahi tempat baru, menciptakan kenangan yang tak terlupakan. Namun, untuk memastikan liburan berjalan lancar dan memuaskan, perlu beberapa persiapan dan perhatian khusus.\r\n\r\nPertama-tama, penting untuk merencanakan liburan dengan baik. Mulailah dengan menentukan tujuan dan durasi liburan. Apakah Anda ingin berlibur ke pantai yang indah, menjelajahi kota-kota bersejarah, atau memanjakan diri dengan liburan alam di pegunungan? Tentukan tujuan Anda dan tentukan berapa lama Anda akan berlibur. Dengan merencanakan sebelumnya, Anda dapat menghindari kebingungan dan kekhawatiran saat tiba di lokasi.\r\n\r\nSelanjutnya, pastikan untuk membuat daftar keperluan dan barang-barang yang perlu Anda bawa. Ini termasuk pakaian sesuai dengan cuaca dan aktivitas yang direncanakan, perlengkapan mandi, obat-obatan yang diperlukan, dan barang-barang lain yang mungkin Anda perlukan. Dengan membuat daftar sebelumnya, Anda dapat memastikan tidak ada yang terlupakan dan mengurangi stres saat melakukan packing.\r\n\r\nSelama liburan, penting untuk tetap fleksibel dan terbuka terhadap pengalaman baru. Jadwal liburan mungkin tidak selalu berjalan sesuai rencana, dan itu sebenarnya bagian dari petualangan. Cobalah untuk menikmati setiap momen dan memanfaatkan kesempatan untuk menjelajahi tempat baru, mencicipi makanan lokal, dan berinteraksi dengan penduduk setempat.\r\n\r\nTerakhir, ingatlah untuk beristirahat dan merawat diri Anda selama liburan. Meskipun mungkin tergoda untuk menjadwalkan setiap detik dengan aktivitas, penting untuk memberikan waktu bagi tubuh Anda untuk istirahat dan pulih. Jadwalkan waktu santai di antara aktivitas-aktivitas yang padat, dan jangan ragu untuk mengambil waktu untuk menikmati kedamaian dan ketenangan.\r\n\r\nDengan merencanakan liburan dengan baik, tetap fleksibel, dan merawat diri dengan baik, Anda dapat menikmati liburan yang menyenangkan dan memuaskan, yang akan meninggalkan kenangan indah untuk diingat selamanya.', 'Liburan.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `destinasi`
--

CREATE TABLE `destinasi` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `location` text NOT NULL,
  `description` text NOT NULL,
  `upload_path` text DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `destinasi`
--

INSERT INTO `destinasi` (`id`, `title`, `location`, `description`, `upload_path`, `date_created`) VALUES
(1, 'Pantai Melawai', 'Balikpapan', '<p>Pantai Melawai di Balikpapan merupakan salah satu pantai yang paling terkenal di Kalimantan Timur. Keistimewaan pantai ini terutama terlihat saat matahari terbenam, di mana panorama langit horizon terbuka tanpa terhalang oleh bukit atau hambatan lainnya, sesekali ditemani oleh perahu nelayan yang melintas.&nbsp; </p><p>Pantai ini menghadap langsung ke Selat Makassar dan merupakan pusat kegiatan kuliner, sehingga tetap ramai bahkan hingga larut malam. Lokasinya yang terletak di pusat kota Balikpapan membuatnya mudah diakses baik dengan transportasi umum maupun kendaraan pribadi.&nbsp;</p>', 'Pantai-Melawai.jpg', '2024-04-04 03:59:35'),
(2, 'Danau Labuan Cermin', 'Berau', '<p>Danau yang terletak di Labuan Kelambu, Kabupaten Berau, merupakan sebuah surga bawah laut yang menakjubkan. Air di danau ini sangat bening, dengan keunikan bahwa bagian atasnya merupakan air tawar sementara bagian bawahnya adalah air asin. Fenomena ini memperlihatkan bahwa kedua jenis air tersebut tetap terpisah secara visual, dibatasi oleh lapisan tipis yang mirip awan. Kehadiran kedua jenis air ini menghasilkan beragam kehidupan organisme, dengan ikan air tawar mendiami permukaan dan ikan air laut mendiami dasar danau.\r\n</p><p>\r\nDanau kecil ini dikelilingi oleh hutan dan tebing tinggi di salah satu sisinya. Nama \"Labuan Cermin\" yang melekat padanya sesuai dengan kejernihan airnya yang memungkinkan orang untuk melihat cerminan mereka di permukaannya. Lokasinya yang cukup jauh dari pusat Kabupaten Berau, membutuhkan perjalanan darat selama 6-7 jam atau menggunakan sampan nelayan tradisional yang melalui semak-semak bakau dan hutan Kalimantan yang rimbun.</p>', 'Danau-Labuan-Cermin.jpg', '2024-04-03 18:02:41'),
(3, 'Pulau Beras Basah', 'Bontang', '<p>Dengan gelombang yang tenang dan air laut yang bening, Pulau Beras Basah menjadi destinasi utama bagi para penggemar snorkeling. Bagi yang tidak tertarik dengan snorkeling, pantai berpasir putihnya yang indah dapat dinikmati dengan santai. Pulau ini terletak di Selat Makassar, Bontang, Kalimantan Timur, dan dapat dicapai dengan perjalanan sekitar 3 jam dari Samarinda ke destinasi wisata di Kalimantan Timur tersebut.</p>', 'Pulau-Beras-Basah.jpg', '2024-04-03 18:04:54'),
(4, 'Ladaya', 'Tenggarong', '<p>Destinasi wisata ini sangat sesuai untuk liburan bersama keluarga. Ladaya Tenggarong, atau Ladang Budaya Tenggarong, menawarkan berbagai fasilitas dan kegiatan menarik yang dapat dinikmati. Mulai dari area kegiatan luar ruangan, paintball, hingga area bermain anak-anak, ada banyak hal yang dapat dicoba di tempat wisata ini. Selain menikmati aktivitas yang ditawarkan, pengunjung juga dapat menginap di sini. Ada juga mini kebun binatang yang memamerkan beberapa satwa khas Kalimantan seperti burung enggang, beruang madu, dan lainnya.</p>', 'Ladaya.jpg', '2024-04-03 18:05:08'),
(5, 'Rumah Ulin Arya', 'Samarinda', '<p>Rumah Ulin Arya menawarkan beragam wahana yang menarik. Salah satunya adalah wahana alam, yang sering disebut sebagai Surganya Paru-paru, yang membantu menyediakan udara bersih dan segar untuk kebutuhan Anda. Di dalamnya, tumbuh berbagai jenis pohon seperti pohon ulin, pohon buah-buahan, serta tanaman hias yang unik.\r\n\r\nSelain itu, wahana alam juga dilengkapi dengan berbagai spot menarik seperti Rumah Ulin, Rumah Kaca, Cottages, Mini Farm yang dihuni oleh binatang-binatang lucu dan menarik seperti kelinci, burung merak, burung hantu, burung unta, burung macaw, burung merpati, binturong, rakun, meerkat, kura-kura, iguana, Hidden Café, Arya\'s Playground, Camping Ground, Meeting Room, Private Library, Labirin, Kids Playground, Sarang Burung Raksasa, Botanical Garden, serta beberapa fasilitas lainnya seperti Pendopo yang dilengkapi dengan wifi, infocus, whiteboard, dan karaoke, serta beberapa Gazebo yang tersedia untuk penggunaan.</p>', 'Rumah-Ulin-Arya.jpg', '2024-04-03 18:05:14'),
(6, 'Negeri Jahetan Layar', 'Kutai Lama', '<p>Negeri Jahetan Layar menawarkan pengalaman wisata alam yang mengagumkan. Daerah ini dikenal karena gabungan harmonis antara hutan yang lebat, sungai yang mengalir deras. Keunikan tempat ini terletak pada fakta bahwa Negeri Jahetan Layar Kutailama masih mempertahankan keasliannya dan belum banyak terpengaruh oleh perkembangan modern.\r\n\r\nSalah satu daya tarik utama Negeri Jahetan Layar Kutailama adalah keindahan alamnya yang menakjubkan. Bagi para pecinta fotografi, tempat ini juga menyediakan banyak momen menarik yang layak diabadikan.\r\n</p><p>\r\nMeskipun agak terpencil, akses ke Negeri Jahetan Layar Kutailama cukup mudah. Anda dapat mencapainya melalui perjalanan darat atau menggunakan transportasi air melalui sungai. Namun, perlu diingat bahwa infrastruktur di daerah ini mungkin tidak sebaik di kota-kota besar, jadi persiapkan diri dengan baik sebelum berkunjung.</p>', 'Negeri-Jahetan-Layar.jpg', '2024-04-03 18:03:24');

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `destination_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`id`, `user_id`, `destination_id`, `created_at`) VALUES
(80, 2, 1, '2024-04-15 13:33:48'),
(81, 2, 6, '2024-04-15 13:33:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(16) DEFAULT NULL,
  `foto` text DEFAULT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `foto`, `role`) VALUES
(1, 'Novianti', 'Safitri', 'noviantisafitri@gmail.com', 'admin1234', 'FOTO NOVI.jpg', 'Admin'),
(2, 'Uswatun ', 'Khasanah', 'uswatunk@gmail.com', 'pengguna123', 'FOTO NOVI.jpg', 'Pengguna'),
(3, 'Adinda', 'Dwini', 'adindadwini@gmail.com', 'superadmin123', '20240415_210739.jpg', 'Superadmin'),
(4, 'Novi', 'Novi', 'noviantis112@gmail.com', 'novi1234', 'FOTO NOVI.jpg', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `destinasi`
--
ALTER TABLE `destinasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `destination_id` (`destination_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `destinasi`
--
ALTER TABLE `destinasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`destination_id`) REFERENCES `destinasi` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
