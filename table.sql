CREATE TABLE `calciatori` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cognome` varchar(255) NOT NULL,
  `nazionalita` varchar(255) NOT NULL
) 

CREATE TABLE `fk_partite` (
  `id_squadra` int(11) NOT NULL,
  `id_partita` int(11) NOT NULL
) 

CREATE TABLE `fk_squadre` (
  `id_calciatore` int(11) NOT NULL,
  `id_squadra` int(11) NOT NULL
) 

CREATE TABLE `partite` (
  `id` int(11) NOT NULL,
  `stadio` varchar(255) NOT NULL
) 

CREATE TABLE `squadre` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `stato` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `calciatori`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `partite`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `squadre`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `calciatori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `partite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `squadre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;
