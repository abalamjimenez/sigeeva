SET AUTOCOMMIT = 0;
START TRANSACTION;

--
-- Estructura de tabla para la tabla `temp_listado_docentes`
--

CREATE TABLE `temp_listado_docentes` (
     `id` bigint(255) NOT NULL,
     `email` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
     `apellido_paterno` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
     `apellido_materno` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
     `nombre` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
     `sexo` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
     `rfc` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
     `curp` varchar(18) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `temp_listado_docentes`
--

INSERT INTO `temp_listado_docentes` (`id`, `email`,`apellido_paterno`, `apellido_materno`, `nombre`, `sexo`, `rfc`, `curp`) VALUES
(1,'yomara.ake@evasamano.edu.mx', 'AKE', 'CAAMAL', 'YOMARA', 'M', 'AECY911119QM8', 'AECY911119MQRKMM05'),
(2,'jose.albornoz@evasamano.edu.mx', 'ALBORNOZ', 'CASTILLO', 'JOSE ENRIQUE', 'H', 'AOCE730406D39', 'AOCE730406HQRLSN05'),
(3,'emanuel.alvarado@evasamano.edu.mx', 'ALVARADO', 'ALCOCER', 'CHRISTIAN EMANUEL', 'H', 'AAAC8108311U1', 'AAAC810831HYNLLH09'),
(4,'jose.amaro@evasamano.edu.mx', 'AMARO', 'HERNANDEZ', 'JOSE FERNANDO', 'H', 'AAHF800603MZ2', 'AAHF800603HQRMRR09'),
(5,'rafael.anzures@evasamano.edu.mx', 'ANZURES', 'MARISCAL', 'RAFAEL SPENCER', 'H', 'AUMR831031432', 'AUMR831031HMCNRF05'),
(6,'celia.arana@evasamano.edu.mx', 'ARANA', 'ARGUELLES', 'CELIA DEL CARMEN', 'M', 'AAAC6711256F1', 'AAAC671125MQRRRL09'),
(7,'laura.arevalo@evasamano.edu.mx', 'AREVALO', 'FLORES', 'LAURA ESTHER', 'M', 'AEFL760712BH7', 'AEFL760712MMCRLR06'),
(8,'lucy.avila@evasamano.edu.mx', 'AVILA', 'GONZÁLEZ', 'LUCY GABRIELA', 'M', 'AIGL880408LV5', 'AIGL880408MQRVNC00'),
(9,'maria.barrera@evasamano.edu.mx', 'BARRERA', 'MENDOZA', 'MARIA FERNANDA', 'M', 'BAMF950911TF9', 'BAMF950911MQRRNR15'),
(10,'gibran.basulto@evasamano.edu.mx', 'BASULTO', 'FIGUEROA', 'GIBRAN GILBERTO', 'H', 'BAFG850401FAA', 'BAFG850401HQRSGB07'),
(11,'julia.briceno@evasamano.edu.mx', 'BRICEÑO', 'VALDEZ', 'JULIA CAROLINA', 'M', 'BIVJ820427CD9', 'BIVJ820427MQRRLL04'),
(12,'lidize.calderon@evasamano.edu.mx', 'CALDERON', 'MARIN', 'LIDIZE FLORADELFA', 'M', 'CAML761224AH9', 'CAML761224MQRLRD02'),
(13,'glenda.camara@evasamano.edu.mx', 'CAMARA', 'CASTILLO', 'GLENDA MARINA', 'M', 'CACG830731LK8', 'CACG830731MPLMSL02'),
(14,'jose.espinosa@evasamano.edu.mx', 'CAMARA', 'ESPINOSA', 'JOSE EDUARDO', 'H', 'CAEE710907VA8', 'CAEE710907HDFMSD05'),
(15,'mario.duarte@evasamano.edu.mx', 'CANTO', 'DUARTE', 'MARIO EFRAIN', 'H', 'CADM7701253Q1', 'CADM770125HYNNRR01'),
(16,'deanela.castillo@evasamano.edu.mx', 'CASTILLO', 'VILLANUEVA', 'DEANELA', 'M', 'CAVD711022KWA', 'CAVD711022MQRSLN05'),
(17,'ramon.cuevas@evasamano.edu.mx', 'CUEVAS', 'DOMINGUEZ', 'RAMON ALFREDO', 'H', 'CUDR6610116G3', 'CUDR661011HQRVMM09'),
(18,'maria.diaz@evasamano.edu.mx', 'DIAZ', 'CRUZ', 'MARIA DEL CARMEN', 'M', 'DICC6505065Q4', 'DICC650506MTCZRR06'),
(19,'dulce.gomez@evasamano.edu.mx', 'GOMEZ', 'BUENFIL', 'DULCE ARACELY', 'M', 'GOBD8206198I6', 'GOBD820619MYNMNL07'),
(20,'mario.gongora@evasamano.edu.mx', 'GONGORA', 'VAZQUEZ', 'MARIO HUMBERTO', 'H', 'GOVM550210HBA', 'GOVM550210HYNNZR06'),
(21,'jose.gonzalez@evasamano.edu.mx', 'GONZALEZ', 'FERNANDEZ', 'JOSE MANUEL ALEJANDRO', 'H', 'GOFM620424I27', 'GOFM620424HQRNRN16'),
(22,'yanet.gonzalez@evasamano.edu.mx', 'GONZALEZ', 'MORENO', 'YANET MADELIN', 'M', 'GOMY780618AM1', 'GOMY780618MQRNRN01'),
(23,'luisa.gonzalez@evasamano.edu.mx', 'GONZALEZ', 'SOUZA', 'LUISA DE LOS ANGELES', 'M', 'GOSL690425NG2', 'GOSL690425MQRNZS17'),
(24,'karina.herrera@evasamano.edu.mx', 'HERRERA', 'MAZU', 'KARINA IZEBEL', 'M', 'HEMK8505221C5', 'HEMK850522MDFRZR09'),
(25,'giuliani.hoil@evasamano.edu.mx', 'HOIL', 'ALONZO', 'GIULIANI ELIZABETH', 'M', 'HOAG900422MD6', 'HOAG900422MQRLLL06'),
(26,'blanca.jimenez@evasamano.edu.mx', 'JIMENEZ', 'PAT', 'BLANCA ANGELICA', 'M', 'JIPB770120BS4', 'JIPB770120MQRMTL05'),
(27,'ariel.jimenez@evasamano.edu.mx', 'JIMENEZ', 'RODRIGUEZ', 'CASTULO ARIEL', 'H', 'JIRC700502QX3', 'JIRC700502HQRMDS01'),
(28,'luisfelipe.martin@evasamano.edu.mx', 'MARTIN', 'PEREZ', 'LUIS FELIPE DE JESUS', 'H', 'MAPL740709IP7', 'MAPL740709HQRRRS03'),
(29,'adda.medina@evasamano.edu.mx', 'MEDINA', 'PEREZ', 'ADDA LIZBETH', 'M', 'MEPA6609222V5', 'MEPA660922MQRDRD02'),
(30,'david.monroy@evasamano.edu.mx', 'MONROY', 'LOPEZ', 'DAVID EMIGDIO', 'H', 'MOLD9703024HA', 'MOLD970302HTCNPV07'),
(31,'lida.novelo@evasamano.edu.mx', 'NOVELO', 'MARIN', 'LIDA MARIA', 'M', 'NOML900715HC2', 'NOML900715MQRVRD02'),
(32,'victor.novelo@evasamano.edu.mx', 'NOVELO', 'VANEGAS', 'VICTOR MANUEL', 'H', 'NOVV680911BY7', 'NOVV680911HQRVNC02'),
(33,'rodolfo.ocampo@evasamano.edu.mx', 'OCAMPO', 'RUIZ', 'RODOLFO', 'H', 'OARR6101083C0', 'OARR610108HMSCZD05'),
(34,'carlos.palma@evasamano.edu.mx', 'PALMA', 'TAMAY', 'CARLOS EDUARDO', 'H', 'PATC690321G16', 'PATC690321HQRLMR09'),
(35,'mariela.pastrana@evasamano.edu.mx', 'PASTRANA', 'BARRERA', 'ILSE MARIELA', 'M', 'PABI881028BU6', 'PABI881028MQRSRL03'),
(36,'maria.pech@evasamano.edu.mx', 'PECH', 'VALDEZ', 'MARIA ELENA', 'M', 'PEVE760818420', 'PEVE760818MQRCLL06'),
(37,'erikc.percastre@evasamano.edu.mx', 'PERCASTRE', 'CANUL', 'ERIKC FERNELLY', 'H', 'PECE7802252H3', 'PECE780225HQRRNR04'),
(38,'july.pinto@evasamano.edu.mx', 'PINTO', 'DOMINGUEZ', 'JULY ARGELIA', 'M', 'PIDJ7704169R2', 'PIDJ770416MYNNML01'),
(39,'gladys.prieto@evasamano.edu.mx', 'PRIETO', 'MONTALVO', 'GLADYS EDITH', 'M', 'PIMG6104285L3', 'PIMG610428MVZRNL18'),
(40,'adda.rangel@evasamano.edu.mx', 'RANGEL', 'AQUINO', 'ADDA ISELA', 'M', 'RAAA660611FA7', 'RAAA660611MCCNQD05'),
(41,'marco.rosetti@evasamano.edu.mx', 'ROSETTI', 'CASTILLO', 'MARCO ANTONIO', 'H', 'ROCM6605301B0', 'ROCM660530HVZSSR01'),
(42,'samantha.sala@evasamano.edu.mx', 'SALA', 'CEBALLOS', 'SAMANTHA', 'M', 'SACS931205586', 'SACS931205MYNLBM03'),
(43,'xochiquetzal.sandoval@evasamano.edu.mx', 'SANDOVAL', 'FLORES', 'XOCHIQUETZAL MONICA', 'M', 'SAFX8908169N2', 'SAFX890816MQRNLC09'),
(44,'julio.sosa@evasamano.edu.mx', 'SOSA', 'GOMEZ', 'JULIO RUBEN', 'H', 'SOGJ700806P84', 'SOGJ700806HCCSML04'),
(45,'ligia.torres@evasamano.edu.mx', 'TORRES', 'ABAN', 'LIGIA BEATRIZ', 'M', 'TOAL860509577', 'TOAL860509MQRRBG09'),
(46,'enrique.vargas@evasamano.edu.mx', 'VARGAS', 'PEREZ', 'ENRIQUE ALEJANDRO', 'H', 'VAPE761106', 'VAPE761106HDFRRN15'),
(47,'juan.varguez@evasamano.edu.mx', 'VARGUEZ', 'EK', 'JUAN ANTONIO', 'H', 'VAEJ830612N08', 'VAEJ830612HQRRKN08'),
(48,'reyna.vela@evasamano.edu.mx', 'VELA', 'HERNANDEZ', 'REYNA YAZULY', 'M', 'VEHR930106EE9', 'VEHR930106MQRLRY09'),
(49,'leny.velasco@evasamano.edu.mx', 'VELASCO', 'GONGORA', 'LENY LUCRECIA', 'M', 'VEGL650524KY4', 'VEGL650524MCCLNN07'),
(50,'elda.xix@evasamano.edu.mx', 'XIX', 'EUAN', 'ELDA MARIA', 'M', 'XIEE661222PT3', 'XIEE661222MQRXNL06'),
(51,'fatima.yerves@evasamano.edu.mx', 'YERVES', 'PERAZA', 'FATIMA VIANEY', 'M', 'YEPF7608211N6', 'YEPF760821MYNRRT07'),
(52,'karina.munoz@evasamano.edu.mx', 'MUÑOZ', 'CHAVEZ', 'KARINA', 'M', 'MUCK780313CN9', 'MUCK780313MDFXHR04');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `temp_listado_docentes`
--
ALTER TABLE `temp_listado_docentes`
    ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `temp_listado_docentes`
--
ALTER TABLE `temp_listado_docentes`
    MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

COMMIT;
SET AUTOCOMMIT = 1;
