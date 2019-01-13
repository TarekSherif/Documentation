
CREATE TABLE `Branch` (
  `BID` int(11) NOT NULL,
  `BName` varchar(50) CHARACTER SET utf8 NOT NULL,
  `Baddress` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `BFB` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `BWhats` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `BMail` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `BWebSite` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `BFax` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `BPhones` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `SOrder` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- بنية الجدول `Company`
--

CREATE TABLE `Company` (
  `CID` varchar(50) CHARACTER SET utf8 NOT NULL,
  `CName` varchar(100) CHARACTER SET utf8 NOT NULL,
  `SOrder` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- بنية الجدول `Document`
--

CREATE TABLE `Document` (
  `DID` int(11) NOT NULL,
  `DOName` varchar(100) CHARACTER SET utf8 NOT NULL,
  `priority` tinyint(1) NOT NULL DEFAULT '0',
  `OrderID` int(11) NOT NULL,
  `DTypeID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- إرجاع أو استيراد بيانات الجدول `Document`
--


-- --------------------------------------------------------

--
-- بنية الجدول `DocumentServes`
--

CREATE TABLE `DocumentServes` (
  `DSID` int(11) NOT NULL,
  `SID` int(11) NOT NULL,
  `DID` int(11) NOT NULL,
  `CID` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `SOrder` int(11) NOT NULL,
  `SDate` date DEFAULT NULL,
  `EDate` date DEFAULT NULL,
  `Successfully` tinyint(1) DEFAULT NULL,
  `price` decimal(10,0) NOT NULL,
  `Cost` decimal(10,0) NOT NULL,
  `currentServe` tinyint(1) NOT NULL DEFAULT '0',
  `INCode` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Notes` varchar(255) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- بنية الجدول `DocumentType`
--

CREATE TABLE `DocumentType` (
  `DTypeID` int(11) NOT NULL,
  `DName` varchar(100) CHARACTER SET utf8 NOT NULL,
  `SOrder` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;






CREATE TABLE `OnlinePayment` (
  `OnlinePaymentID` int(11) NOT NULL,
  `OCode` int(11) NOT NULL,
  `ODate` date NOT NULL,
  `TCode` int(11) NOT NULL,
  `address` varchar(50)  CHARACTER SET utf8 NOT NULL,
  `passportID` varchar(50)  CHARACTER SET utf8 NOT NULL,
  `OName` varchar(150)  CHARACTER SET utf8 NOT NULL,
  `DType` varchar(50)  CHARACTER SET utf8 NOT NULL,
  `ActionType` varchar(50) CHARACTER SET utf8 NOT NULL,
  `Cost` decimal(10,0) NOT NULL,
  `ReceiptCode` varchar(50)  CHARACTER SET utf8 NOT NULL,
  `Locked` tinyint(1) NOT NULL DEFAULT '0',
  `BID` int(11) NOT NULL,
  `createby` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- بنية الجدول `Role`
--

CREATE TABLE `Role` (
  `RID` int(11) NOT NULL,
  `RName` varchar(100) CHARACTER SET utf8 NOT NULL,
  `SOrder` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- بنية الجدول `Serves`
--

CREATE TABLE `Serves` (
  `SID` int(11) NOT NULL,
  `Serves` varchar(100) CHARACTER SET utf8 NOT NULL,
  `Nprice` decimal(10,0) NOT NULL,
  `Qprice` decimal(10,0) NOT NULL,
  `NCost` decimal(10,0) NOT NULL,
  `QCost` decimal(10,0) NOT NULL,
  `SOrder` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- إرجاع أو استيراد بيانات الجدول `Serves`
--


--
-- بنية الجدول `TOrder`
--
 
CREATE TABLE `TOrder` (
  `OrderID` int(11) NOT NULL,
  `RecipientName` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(150)CHARACTER SET utf8 DEFAULT NULL,
  `Otherphone` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `price` decimal(10,0) DEFAULT '0',
  `paid` decimal(10,0) DEFAULT '0',
  `createby` int(11) NOT NULL,
  `Recipientby` int(11)  NULL,
  `BID` int(11) NOT NULL,
  `EDate` date DEFAULT NULL,
  `Locked` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) DEFAULT NULL,
  `BID` int(11) NOT NULL,
  `api_token` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



--
-- بنية الجدول `ViewName`
--

CREATE TABLE `ViewName` (
  `ViewName` varchar(100) CHARACTER SET utf8 NOT NULL,
  `ViewPath` varchar(100) CHARACTER SET utf8 NOT NULL,
  `ViewIcon` varchar(50) CHARACTER SET utf8 NOT NULL,
  `ARName` varchar(100) CHARACTER SET utf8 NOT NULL,
  `ViewGroup` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `SOrder` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- بنية الجدول `ViewRolePermission`
--

CREATE TABLE `ViewRolePermission` (
  `RVPID` int(11) NOT NULL,
  `RID` int(11) NOT NULL,
  `ViewName` varchar(100) CHARACTER SET utf8 NOT NULL,
  `ShowData` tinyint(1) NOT NULL DEFAULT '0',
  `InsertData` tinyint(1) NOT NULL DEFAULT '0',
  `UpdateData` tinyint(1) NOT NULL DEFAULT '0',
  `DeleteData` tinyint(1) NOT NULL DEFAULT '0',
  `DataToExcel` tinyint(1) NOT NULL DEFAULT '0',
  `DataToPrint` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- إرجاع أو استيراد بيانات الجدول `ViewRolePermission`
--

--
-- Indexes for table `Branch`
--
ALTER TABLE `Branch`
  ADD PRIMARY KEY (`BID`);

--
-- Indexes for table `Company`
--
ALTER TABLE `Company`
  ADD PRIMARY KEY (`CID`);

--
-- Indexes for table `Document`
--
ALTER TABLE `Document`
  ADD PRIMARY KEY (`DID`);

--
-- Indexes for table `DocumentServes`
--
ALTER TABLE `DocumentServes`
  ADD PRIMARY KEY (`DSID`);

--
-- Indexes for table `DocumentType`
--
ALTER TABLE `DocumentType`
  ADD PRIMARY KEY (`DTypeID`);

--
-- Indexes for table `OnlinePayment`
--
ALTER TABLE `OnlinePayment`
  ADD PRIMARY KEY (`OnlinePaymentID`);

--
-- Indexes for table `Role`
--
ALTER TABLE `Role`
  ADD PRIMARY KEY (`RID`);

--
-- Indexes for table `Serves`
--
ALTER TABLE `Serves`
  ADD PRIMARY KEY (`SID`);

--
-- Indexes for table `TOrder`
--
ALTER TABLE `TOrder`
  ADD PRIMARY KEY (`OrderID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ViewName`
--
ALTER TABLE `ViewName`
  ADD PRIMARY KEY (`ViewName`);

--
-- Indexes for table `ViewRolePermission`
--
ALTER TABLE `ViewRolePermission`
  ADD PRIMARY KEY (`RVPID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Branch`
--
ALTER TABLE `Branch`
  MODIFY `BID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Document`
--
ALTER TABLE `Document`
  MODIFY `DID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `DocumentServes`
--
ALTER TABLE `DocumentServes`
  MODIFY `DSID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `DocumentType`
--
ALTER TABLE `DocumentType`
  MODIFY `DTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `OnlinePayment`
--
ALTER TABLE `OnlinePayment`
  MODIFY `OnlinePaymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Role`
--
ALTER TABLE `Role`
  MODIFY `RID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Serves`
--
ALTER TABLE `Serves`
  MODIFY `SID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `TOrder`
--
ALTER TABLE `TOrder`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ViewRolePermission`
--
ALTER TABLE `ViewRolePermission`
  MODIFY `RVPID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

-- --------------------------------------------------------


-- =================================================================================

-- Constraints FK

-- =================================================================================
-- [CONSTRAINT [symbol]] FOREIGN KEY
--     [index_name] (col_name, ...)
--     REFERENCES tbl_name (col_name,...)
--     [ON DELETE reference_option]
--     [ON UPDATE reference_option]

-- reference_option:
--     RESTRICT | CASCADE | SET NULL | NO ACTION | SET DEFAULT
--  RESTRICT      منع مسح الاب لو فيه اطفال
--  CASCADE    اللى هيتم على الاب هيتم عل الاطفال
--  SET NULL   مسح الاب مع وضع قيمة فارغه عند الاطفال

ALTER TABLE `TOrder`
 ADD CONSTRAINT `TOrder_FK_BID` FOREIGN KEY (`BID`) REFERENCES `Branch`(`BID`) ON DELETE  NO ACTION  ON UPDATE CASCADE,
 ADD CONSTRAINT `TOrder_FK_createby` FOREIGN KEY (`createby`) REFERENCES `users`(`id`) ON DELETE  NO ACTION  ON UPDATE CASCADE;


ALTER TABLE  `Document` 
 ADD CONSTRAINT `Document_FK_OrderID` FOREIGN KEY (`OrderID`) REFERENCES `TOrder`(`OrderID`) ON DELETE CASCADE  ON UPDATE CASCADE,
 ADD CONSTRAINT `Document_FK_DTypeID` FOREIGN KEY (`DTypeID`) REFERENCES `DocumentType`(`DTypeID`) ON DELETE  NO ACTION  ON UPDATE CASCADE;
 


ALTER TABLE   `ViewRolePermission`
 ADD CONSTRAINT `ViewRolePermission_FK_RID` FOREIGN KEY (`RID`) REFERENCES  `Role`(`RID`) ON DELETE CASCADE  ON UPDATE CASCADE,
 ADD CONSTRAINT `ViewRolePermission_FK_ViewName` FOREIGN KEY (`ViewName`) REFERENCES  `ViewName`(`ViewName`) ON DELETE  CASCADE  ON UPDATE CASCADE;
 


-- ALTER TABLE   `users`
--   ADD CONSTRAINT `users_FK_role` FOREIGN KEY (`role`) REFERENCES  `Role`(`RID`) ON DELETE CASCADE  ON UPDATE CASCADE;
--  ADD CONSTRAINT `users_FK_BID` FOREIGN KEY (`BID`) REFERENCES `Branch`(`BID`) ON DELETE  SET NULL  ON UPDATE CASCADE;
 



ALTER TABLE   `DocumentServes`
 ADD CONSTRAINT `DocumentServes_FK_SID` FOREIGN KEY (`SID`) REFERENCES  `Serves`(`SID`) ON DELETE NO ACTION   ON UPDATE CASCADE,
 ADD CONSTRAINT `DocumentServes_FK_DID` FOREIGN KEY (`DID`) REFERENCES `Document`(`DID`) ON DELETE  CASCADE  ON UPDATE CASCADE,
 ADD CONSTRAINT `DocumentServes_FK_CID` FOREIGN KEY (`CID`) REFERENCES `Company`(`CID`) ON DELETE  NO ACTION   ON UPDATE CASCADE;
 



CREATE VIEW `ordertotalprice` AS
    select `TOrder`.`OrderID`,sum(`DocumentServes`.`price`)+IFNULL(`TOrder`.`price`, 0) as price
    from `DocumentServes` 
    join `Document` on `DocumentServes`.`DID`=`Document`.`DID`
    join `TOrder` on `TOrder`.`OrderID`=`Document`.`OrderID`
    GROUP by `TOrder`.`OrderID`,`TOrder`.`price`;




CREATE VIEW `ListOfDocumentsNeedin` AS 
                        SELECT 
                            `DocumentServes`.`DSID` , 
                            `DocumentServes`.`SID`,
                            `DocumentServes`.`CID` , 
                            `DocumentServes`.`INCode`,
                            `TOrder`.`phone`,
                            `TOrder`.`BID`,
                            `Document`.`DOName`,
                            `DocumentServes`.`Notes`,
                            `Document`.`priority`
                        FROM `DocumentServes` 
                        JOIN `Document`  on `Document`.`DID`=`DocumentServes`.`DID` 
                        JOIN `TOrder`    on `TOrder`.`OrderID`= `Document`.`OrderID` 
                       WHERE
                            `DocumentServes`.`SDate`  IS NULL  and
                            `DocumentServes`.`currentServe`=1  ;


CREATE VIEW `ListOfDocumentsNeedout` AS 
                        SELECT 
                            `DocumentServes`.`DSID` , 
                            `DocumentServes`.`SID`,
                            `TOrder`.`phone`,
                            `TOrder`.`BID`,
                            `Document`.`DOName`,
                            `DocumentServes`.`SDate`,
                            `DocumentServes`.`Notes`
                        FROM `DocumentServes` 
                        JOIN `Document`  on `Document`.`DID`=`DocumentServes`.`DID` 
                        JOIN `TOrder`    on `TOrder`.`OrderID`= `Document`.`OrderID` 
                       WHERE
                            `DocumentServes`.`SDate`  IS NOT NULL and 
                            `DocumentServes`.`EDate` IS  NULL  ;

 



--
-- إرجاع أو استيراد بيانات الجدول `Branch`
--

INSERT INTO `Branch` (`BID`, `BName`, `Baddress`, `BFB`, `BWhats`, `BMail`, `BWebSite`, `BFax`, `BPhones`, `SOrder`) VALUES
(1, 'الفهد الهندي', '3 ش ابن كثير امام مديرية امن الجيزة', 'AlHendyGroup', '01019501528', 'fahdhendy763@gmail.com', 'www.alhendy.com', '37624894', '37624895/37624896', 1),
(3, 'الفهد الدولى ', '30 شارع هارون الدقى امام الملحق الثقافى السعودي', 'https://www.facebook.com/alhendygroup/', '01019501528', 'elfahdeldawly@alhendy.com', 'alhendy.com', '0237624894', '0237624898', 2),
(4, 'مركز فهد ', '1 شارع الحديقه جاردن سيتى امام نقابه الاطباء ', 'https://www.facebook.com/alhendygroup/', '01014435587', 'fahd@alhendy.com', 'alhendy.com', '-', '01014435587', 3),
(5, 'المصطفى ', '2 ش اتحاد المحامين العرب امام مدرسة الابراهيميه جاردن سيتى ', 'https://www.facebook.com/alhendygroup/', '01118251650', ' ', ' ', '  ', '01095579966', 4);

-- --------------------------------------------------------

--
-- إرجاع أو استيراد بيانات الجدول `Company`
--

INSERT INTO `Company` (`CID`, `CName`, `SOrder`) VALUES
('124324', 'الفهد الدولي', 1),
('156', 'الجواهر ', 5),
('414', 'الحرمين الشريفين', 3),
('470', 'الهندي', 4),
('763', 'الفهد الهندي', 2);

-- --------------------------------------------------------

--
-- إرجاع أو استيراد بيانات الجدول `DocumentType`
--

INSERT INTO `DocumentType` (`DTypeID`, `DName`, `SOrder`) VALUES
(1, 'مؤهل', 15),
(2, 'بيان ميلاد ', 1),
(3, 'بيان وفاه', 3),
(4, 'بيان زواج', 2),
(5, 'شهاده خبره', 17),
(9, 'شهاده', 14),
(10, 'بيان نجاح مصرى', 16),
(11, 'بيان نجاح سعودى ', 8),
(12, 'تسلسل دراسى ', 9),
(13, 'توكيل', 10),
(14, 'وكاله', 11),
(15, 'افاده', 12),
(16, 'قرار', 13),
(17, 'اقرار معاش', 14),
(18, 'شهاده جمارك', 15),
(19, 'خطاب تعريف', 16),
(20, 'خطاب', 17),
(21, 'شهاده تأمينات', 18),
(22, 'عقد عمره', 19),
(23, 'سجل تجارى ', 20),
(24, 'ترخيص سياحه', 21),
(25, 'ماجستير', 22),
(26, 'درجات ماجستير', 23),
(27, 'دكتوراه', 24),
(28, 'درجات دكتوراه', 25),
(29, 'بكالوريوس ', 26),
(30, 'درجات بكالوريوس', 27),
(31, 'امتياز', 28),
(32, 'شهاده منشأ', 29),
(33, 'فاتوره', 30),
(34, 'محضر اجتماع', 31),
(35, 'اعلام شرعى ', 32),
(36, 'قرار وصايه', 33),
(37, 'شهاده بنكيه', 34),
(38, 'شهاده مزاوله مهنه', 35),
(39, 'صحيفه استثمار', 36),
(40, 'قسيمه زواج', 4),
(41, ' شهاد طلاق', 6),
(42, 'صك نكاح', 7),
(43, 'صك حصر ورثه', 40),
(44, 'عقد عمل', 41),
(45, 'شهاده ميلاد سعودى', 3),
(46, 'شهاد وفاه ووراثه', 44),
(47, 'بيان طلاق', 45),
(48, 'شهاده وفاه سعودى', 5),
(49, 'تقرير طبى ', 47),
(50, 'ميزانيه', 48),
(51, 'قيد عائلى ', 49),
(52, 'شهاده نقابه', 50),
(53, 'صحيفه حاله جنائيه', 51),
(54, 'شهاده صحيه', 52),
(55, 'عقد تأسيس', 53),
(56, 'دبلوم فنى ', 54),
(57, 'دبلوم صناعى ', 55),
(58, 'دبلوم تجارى ', 56),
(59, 'دبلومه', 57),
(60, 'ثانوى عام', 58),
(61, 'ثانوى ازهرى ', 59),
(62, 'بيان رسوب', 60);

-- --------------------------------------------------------

--
-- إرجاع أو استيراد بيانات الجدول `Role`
--

INSERT INTO `Role` (`RID`, `RName`, `SOrder`) VALUES
(1, 'Admin', NULL),
(2, 'user', NULL);

-- --------------------------------------------------------

INSERT INTO `Serves` (`SID`, `Serves`, `Nprice`, `Qprice`, `NCost`, `QCost`, `SOrder`) VALUES
(1, 'استعلام', '0', '0', '0', '0', 1),
(2, 'خارجية', '60', '60', '25', '25', 2),
(3, 'ملحقية', '140', '250', '0', '0', 3),
(4, 'قنصلية', '260', '500', '144', '130', 4);

-- --------------------------------------------------------
--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `BID`, `api_token`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Hany Said', 'hanysaid@alhendy.com', NULL, '$2y$10$Sv7d.I9DJ3Dc/pTiLBcgO.Ts/MywyGmuAV64aBhpdM80T7POQX3Ru', 1, 1, NULL, 'n1t9v82lwL3tiDiIdzRwiB7lPVFGARohMPXfQbnmm2aprTvtslXaQGbZ3naB', NULL, NULL),
(2, 'Tarek Sherif ', 'Eng.tarek.sherif@gmail.com', NULL, '$2y$10$ran/TIR4AZMyEnFTzcZ9rOv3m/FTklt1hWv7JcmIAhcQU1GjMreZO', 1, 1, NULL, 'WModdoIEfnBSj5Bg2ImR5yaPkfW3uR0K7imD5DpECusT0txwOZLna7JgQwlx', NULL, NULL),
(3, 'TestManager', 'TestManager@alhendy.com', NULL, '$2y$10$M4X4C8ygIah2OJhOAiHsgO2sC2nxqc.BMt98X4iNZL9XzsxmRYpNq', 2, 1, NULL, 'sakeTnTurnjsqn4MZaUZVDgsO5lyAxF1GrdejzL2Y4AnQxwRLd8PfbBlDwct', NULL, NULL),
(4, 'hady', 'hady@alhendy.com', NULL, '$2y$10$qadpqmNsyh/1yg1EVgP9jOWcRao3LwLfXKIqKJ63HH8WL7IaS.a9O', 2, 1, NULL, 'uIy0e5HJi3dTkBfkh4WPTXYI7Y1c22F1QIQSH0yFfJC9pnehKfY1aSecavPS', NULL, NULL),
(5, 'Hany Said', 'mr.hany@alhendy.com', NULL, '$2y$10$B8k0BiOXqWUY.9joFiiGnutTEr724rqY5zQIcf0L1zmOGiqLPNZTq', 1, 4, NULL, NULL, NULL, NULL),
(6, 'Abdallah Fathy', 'abdallafathy82@gmail.com', NULL, '$2y$10$Z/zEl0PVVb.NH8PZhziSBOA2nFtzl6Su2UuQPFhTAoAefwAeXech2', 2, 1, NULL, NULL, NULL, NULL),
(7, 'mohamed mostafa', 'midooooo3553@gmail.com', NULL, '$2y$10$ImWX0LMCHfSetVw7mjvosuwvxY1tkesxXaoQACpi2P3GHFHhQAWPS', 2, 3, NULL, NULL, NULL, NULL),
(8, 'Ahmed Fawzi', 'af-meteora@live.com', NULL, '$2y$10$N685WvaYIkcnP0P6xlzHPOrhI9nv0aWL9VDRNucQ9qcLKrlSeEqTC', 2, 1, NULL, 'AcPRyd2Ri2m3lmfObIqdCGbFoMIBjMB2hU0R7JtWT65TecO7tHCplpwP4Z64', NULL, NULL),
(9, 'mohamed mansour', 'mohamed.01014993790@gmail.com', NULL, '$2y$10$ymo3AvKuwAzuyjj7y6pFye8hmomwYfB.36kkYBTUj2HfeFLza3bUe', 2, 3, NULL, NULL, NULL, NULL),
(10, 'Mohammed Hussien', 'MHussien0100@gmail.com', NULL, '$2y$10$CdvfrVHoN7NxOLy/jI0Loe/YgTgr.VHrSLtuLFzUSgTufHaYygy2m', 2, 1, NULL, 'M5tOxBg0bFZ0IOLP2k1dYjNATk0YZs8i5osHDasoCHXWxJEOX4XYKEDBgWSS', NULL, NULL),
(11, 'ahmed hassan', 'ahmedhassan100@alhendy.com', NULL, '$2y$10$kmNu6LtMqbRuroTLC3g5PeLfYGA6A5yns3XtamJg7hs3.pPvdkria', 2, 5, NULL, 'vRoYrBrNe863aqZptxCiylRlnxH3dBPnKnTrLWwolR1EHsR0GiFsqATPsqUW', NULL, NULL);

-- --------------------------------------------------------
--
-- إرجاع أو استيراد بيانات الجدول `ViewName`
--

INSERT INTO `ViewName` (`ViewName`, `ViewPath`, `ViewIcon`, `ARName`, `ViewGroup`, `SOrder`) VALUES
('Branchs', 'LookupTables.Branchs', 'fa fa-building-o ', 'الفروع', 'Settings', 2),
('Company', 'LookupTables.Company', 'fa fa-building-o', 'الشركات', 'Settings', 7),
('CompanyReport/3', 'Reports.CompanyReport', 'fa fa-print sidebar-nav-icon', ' تقرير  دخول ملحقية', 'Reports', 0),
('CompanyReport/4', 'Reports.CompanyReport', 'fa fa-print sidebar-nav-icon', ' تقرير  دخول القنصلية', 'Reports', 0),
('DocumentIN', 'DocumentIN', '', 'فى المكتب', '', 0),
('DocumentOUT', 'DocumentOUT', '', 'فى الداخل', '', 0),
('DocumentTypes', 'LookupTables.DocumentTypes', 'fa fa-file-text', 'نوع المستند', 'Settings', 5),
('OnlinePayment', 'OnlinePayment.Create', 'fa fa-credit-card sidebar-nav-icon', 'دفع الكتروني', '', 1),
('Order', 'Order.create,Order.edit', 'fa fa-plus sidebar-nav-icon', 'الطلب', '', 1),
('Permission', 'LookupTables.Permission', 'fa fa-lock', 'الصلاحيات', 'Settings', 3),
('Serves', 'LookupTables.Serves', 'fa fa-handshake-o', 'الخدمات', 'Settings', 6),
('users', 'LookupTables.users', 'fa fa-users', 'المستخدمين', 'Settings', 4);


INSERT INTO `ViewRolePermission` ( `RID`, `ViewName`, `ShowData`, `InsertData`, `UpdateData`, `DeleteData`, `DataToExcel`, `DataToPrint`) VALUES
( 1, 'Order', 1, 1, 1, 1, 1, 1),
( 1, 'OnlinePayment', 1, 1, 1, 1, 1, 1),
( 1, 'CompanyReport/3', 1, 1, 1, 1, 1, 1),
( 1, 'CompanyReport/4', 1, 1, 1, 1, 1, 1),
( 1, 'Branchs', 1, 1, 1, 1, 1, 1),
( 1, 'users', 1, 1, 1, 1, 1, 1),
( 1, 'Serves', 1, 1, 1, 1, 1, 1),
( 1, 'DocumentTypes', 1, 1, 1, 1, 1, 1),
( 1, 'Company', 1, 1, 1, 1, 1, 1),
( 1, 'DocumentIN', 1, 1, 1, 1, 1, 1),
( 1, 'DocumentOUT', 1, 1, 1, 1, 1, 1),
( 1, 'Permission', 1, 1, 1, 1, 1, 1),
(2, 'Order', 1, 1, 1, 1, 1, 1),
(2, 'OnlinePayment', 1, 1, 1, 1, 1, 1),
( 2, 'CompanyReport/3', 1, 1, 1, 1, 1, 1),
( 2, 'CompanyReport/4', 1, 1, 1, 1, 1, 1),
( 2, 'Branchs', 0, 0, 0, 0, 0, 0),
( 2, 'users', 0, 0, 0, 0, 0, 0),
( 2, 'Serves', 0, 0, 0, 0, 0, 0),
( 2, 'DocumentTypes', 1, 1, 1, 1, 1, 1),
( 2, 'Company', 0, 0, 0, 0, 0, 0),
( 2, 'DocumentIN', 1, 1, 1, 1, 1, 1),
( 2, 'DocumentOUT', 1, 1, 1, 1, 1, 1),
( 2, 'Permission', 0, 0, 0, 0, 0, 0);

