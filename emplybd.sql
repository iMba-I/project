-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Дек 10 2024 г., 05:01
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `emplybd`
--

-- --------------------------------------------------------

--
-- Структура таблицы `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `company_name` varchar(128) NOT NULL,
  `company_field` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `companies`
--

INSERT INTO `companies` (`id`, `company_name`, `company_field`) VALUES
(1, 'Компания смешнявок', 'Смешнявки');

-- --------------------------------------------------------

--
-- Структура таблицы `offices`
--

CREATE TABLE `offices` (
  `id` int(11) NOT NULL,
  `office_name` varchar(128) NOT NULL,
  `office_type` tinyint(1) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `tests_filename` varchar(64) NOT NULL,
  `numemployee` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `offices`
--

INSERT INTO `offices` (`id`, `office_name`, `office_type`, `company_id`, `tests_filename`, `numemployee`) VALUES
(1, 'Офис смешнявок', 0, 1, 'smeshnyavki.csv', 100);

-- --------------------------------------------------------

--
-- Структура таблицы `questions`
--

CREATE TABLE `questions` (
  `ID` int(11) NOT NULL,
  `question` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `questions`
--

INSERT INTO `questions` (`ID`, `question`) VALUES
(1, 'Вопрос 1'),
(2, 'Вопрос 2'),
(3, 'Вопрос 3'),
(4, 'Вопрос 4'),
(5, 'Вопрос 5'),
(6, 'Вопрос 6'),
(7, 'Вопрос 7'),
(8, 'Вопрос 8'),
(9, 'Вопрос 9'),
(10, 'Вопрос 10'),
(11, 'Вопрос 11'),
(12, 'Вопрос 12'),
(13, 'Вопрос 13'),
(14, 'Вопрос 14'),
(15, 'Вопрос 15'),
(16, 'Вопрос 16'),
(17, 'Вопрос 17'),
(18, 'Вопрос 18'),
(19, 'Вопрос 19'),
(20, 'Вопрос 20'),
(21, 'Насколько бы вы оценили командную работу в коллективе?'),
(22, 'Насколько бы вы оценили атмосферу в коллективе?'),
(23, 'Насколько бы вы оценили взаимоотношения с руководством?'),
(24, 'Насколько бы вы оценили взаимоотношения с коллегами?'),
(25, 'Насколько бы вы оценили эффективность вашей совместной работы?'),
(26, 'Насколько вы доверяете вашему руководителю?'),
(27, 'Насколько бы вы оценили работу в компании?'),
(28, 'Насколько бы вы оценили престижность работы?'),
(29, 'Насколько бы вы возможность карьерного роста?'),
(30, 'Насколько бы вы оценили компетентность руководства?'),
(31, 'Насколько бы вы оценили вашу вовлеченность в работу?'),
(32, 'Насколько бы вы оценили условия труда в целом?'),
(33, 'Насколько бы вы оценили санитарно-гигиенические условия труда?'),
(34, 'Насколько бы вы оценили рабочий график?'),
(35, 'Насколько бы вы оценили уровень заработной платы?'),
(36, 'Насколько бы вы оценили признание со стороны коллег?'),
(37, 'Насколько бы вы оценили результаты вашего труда?'),
(38, 'Насколько бы вы оценили компетентность руководства?');

-- --------------------------------------------------------

--
-- Структура таблицы `test_results`
--

CREATE TABLE `test_results` (
  `id` int(11) NOT NULL,
  `file_name` varchar(64) NOT NULL,
  `test_date` date NOT NULL,
  `office_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `test_results`
--

INSERT INTO `test_results` (`id`, `file_name`, `test_date`, `office_id`) VALUES
(2, 'test_results_2024-12-10.csv', '2024-12-10', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `test_templates`
--

CREATE TABLE `test_templates` (
  `id` int(11) NOT NULL,
  `question_1_id` int(11) DEFAULT NULL,
  `question_2_id` int(11) DEFAULT NULL,
  `question_3_id` int(11) DEFAULT NULL,
  `question_4_id` int(11) DEFAULT NULL,
  `question_5_id` int(11) DEFAULT NULL,
  `question_6_id` int(11) DEFAULT NULL,
  `question_7_id` int(11) DEFAULT NULL,
  `question_8_id` int(11) DEFAULT NULL,
  `question_9_id` int(11) DEFAULT NULL,
  `question_10_id` int(11) DEFAULT NULL,
  `question_11_id` int(11) DEFAULT NULL,
  `question_12_id` int(11) DEFAULT NULL,
  `question_13_id` int(11) DEFAULT NULL,
  `question_14_id` int(11) DEFAULT NULL,
  `question_15_id` int(11) DEFAULT NULL,
  `question_16_id` int(11) DEFAULT NULL,
  `question_17_id` int(11) DEFAULT NULL,
  `question_18_id` int(11) DEFAULT NULL,
  `question_19_id` int(11) DEFAULT NULL,
  `question_20_id` int(11) DEFAULT NULL,
  `office_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `test_templates`
--

INSERT INTO `test_templates` (`id`, `question_1_id`, `question_2_id`, `question_3_id`, `question_4_id`, `question_5_id`, `question_6_id`, `question_7_id`, `question_8_id`, `question_9_id`, `question_10_id`, `question_11_id`, `question_12_id`, `question_13_id`, `question_14_id`, `question_15_id`, `question_16_id`, `question_17_id`, `question_18_id`, `question_19_id`, `question_20_id`, `office_id`) VALUES
(1, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(255) NOT NULL,
  `office_id` int(11) DEFAULT NULL,
  `account_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `office_id`, `account_type`) VALUES
(2, 'vkusnyashki_adm@mail.ru', 'dfe207fcdcfb3143ff4ae62444103c24', 1, 1),
(4, 'vkusnyashki_fake@mail.ru', 'dfe207fcdcfb3143ff4ae62444103c24', 1, 1),
(7, 'vkusnyashki@mail.ru', 'dfe207fcdcfb3143ff4ae62444103c24', 1, 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `offices`
--
ALTER TABLE `offices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Индексы таблицы `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `test_results`
--
ALTER TABLE `test_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `office_id` (`office_id`);

--
-- Индексы таблицы `test_templates`
--
ALTER TABLE `test_templates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_1_id` (`question_1_id`),
  ADD KEY `question_2_id` (`question_2_id`,`question_3_id`,`question_4_id`,`question_5_id`,`question_6_id`,`question_7_id`,`question_8_id`,`question_9_id`,`question_10_id`,`question_11_id`,`question_12_id`,`question_13_id`,`question_14_id`,`question_15_id`,`question_16_id`,`question_17_id`,`question_18_id`,`question_19_id`,`question_20_id`,`office_id`),
  ADD KEY `question_3_id` (`question_3_id`),
  ADD KEY `question_4_id` (`question_4_id`),
  ADD KEY `question_5_id` (`question_5_id`),
  ADD KEY `question_6_id` (`question_6_id`),
  ADD KEY `question_7_id` (`question_7_id`),
  ADD KEY `question_8_id` (`question_8_id`),
  ADD KEY `question_9_id` (`question_9_id`),
  ADD KEY `question_10_id` (`question_10_id`),
  ADD KEY `question_11_id` (`question_11_id`),
  ADD KEY `question_12_id` (`question_12_id`),
  ADD KEY `question_13_id` (`question_13_id`),
  ADD KEY `question_14_id` (`question_14_id`),
  ADD KEY `question_15_id` (`question_15_id`),
  ADD KEY `question_16_id` (`question_16_id`),
  ADD KEY `question_17_id` (`question_17_id`),
  ADD KEY `question_18_id` (`question_18_id`),
  ADD KEY `question_19_id` (`question_19_id`),
  ADD KEY `question_20_id` (`question_20_id`),
  ADD KEY `office_id` (`office_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `office_id` (`office_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `questions`
--
ALTER TABLE `questions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT для таблицы `test_results`
--
ALTER TABLE `test_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `test_templates`
--
ALTER TABLE `test_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `offices`
--
ALTER TABLE `offices`
  ADD CONSTRAINT `offices_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE SET NULL;

--
-- Ограничения внешнего ключа таблицы `test_results`
--
ALTER TABLE `test_results`
  ADD CONSTRAINT `test_results_ibfk_1` FOREIGN KEY (`office_id`) REFERENCES `offices` (`id`) ON DELETE SET NULL;

--
-- Ограничения внешнего ключа таблицы `test_templates`
--
ALTER TABLE `test_templates`
  ADD CONSTRAINT `test_templates_ibfk_1` FOREIGN KEY (`question_1_id`) REFERENCES `questions` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `test_templates_ibfk_10` FOREIGN KEY (`question_10_id`) REFERENCES `questions` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `test_templates_ibfk_11` FOREIGN KEY (`question_11_id`) REFERENCES `questions` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `test_templates_ibfk_12` FOREIGN KEY (`question_12_id`) REFERENCES `questions` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `test_templates_ibfk_13` FOREIGN KEY (`question_13_id`) REFERENCES `questions` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `test_templates_ibfk_14` FOREIGN KEY (`question_14_id`) REFERENCES `questions` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `test_templates_ibfk_15` FOREIGN KEY (`question_15_id`) REFERENCES `questions` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `test_templates_ibfk_16` FOREIGN KEY (`question_16_id`) REFERENCES `questions` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `test_templates_ibfk_17` FOREIGN KEY (`question_17_id`) REFERENCES `questions` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `test_templates_ibfk_18` FOREIGN KEY (`question_18_id`) REFERENCES `questions` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `test_templates_ibfk_19` FOREIGN KEY (`question_19_id`) REFERENCES `questions` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `test_templates_ibfk_2` FOREIGN KEY (`question_2_id`) REFERENCES `questions` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `test_templates_ibfk_20` FOREIGN KEY (`question_20_id`) REFERENCES `questions` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `test_templates_ibfk_21` FOREIGN KEY (`office_id`) REFERENCES `offices` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `test_templates_ibfk_3` FOREIGN KEY (`question_3_id`) REFERENCES `questions` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `test_templates_ibfk_4` FOREIGN KEY (`question_4_id`) REFERENCES `questions` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `test_templates_ibfk_5` FOREIGN KEY (`question_5_id`) REFERENCES `questions` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `test_templates_ibfk_6` FOREIGN KEY (`question_6_id`) REFERENCES `questions` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `test_templates_ibfk_7` FOREIGN KEY (`question_7_id`) REFERENCES `questions` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `test_templates_ibfk_8` FOREIGN KEY (`question_8_id`) REFERENCES `questions` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `test_templates_ibfk_9` FOREIGN KEY (`question_9_id`) REFERENCES `questions` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`office_id`) REFERENCES `offices` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
