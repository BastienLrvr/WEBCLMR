--
-- Structure de la table `p3x_chat_message`
--

CREATE TABLE `p3x_chat_message` (
  `id_message` mediumint(7) UNSIGNED NOT NULL,
  `id_utilisateur` mediumint(7) UNSIGNED NOT NULL,
  `id_utilisateur_prive` mediumint(7) UNSIGNED NOT NULL,
  `message` varchar(250) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `p3x_chat_session`
--

CREATE TABLE `p3x_chat_session` (
  `id_session` mediumint(7) UNSIGNED NOT NULL,
  `id_utilisateur` mediumint(7) UNSIGNED NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `p3x_chat_utilisateur`
--

CREATE TABLE `p3x_chat_utilisateur` (
  `id_utilisateur` mediumint(7) UNSIGNED NOT NULL,
  `login` varchar(100) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `avatar` smallint(4) UNSIGNED NOT NULL,
  `avatar_url` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `p3x_chat_utilisateur`
--

INSERT INTO `p3x_chat_utilisateur` (`id_utilisateur`, `login`, `pass`, `avatar`, `avatar_url`) VALUES
(1, 'jean', 'e368b9938746fa090d6afd3628355133', 1, ''),
(2, 'sophie', '1066726e7160bd9c987c9968e0cc275a', 2, ''),
(3, 'pierre', '297e430d45e7bf6f65f5dc929d6b072b', 3, ''),
(4, 'marine', '7b1312a1b3e74bb174b3fbbf68ab5a92', 4, '');

--
-- Index pour la table `p3x_chat_message`
--
ALTER TABLE `p3x_chat_message`
  ADD PRIMARY KEY (`id_message`),
  ADD KEY `id_utilisateur` (`id_utilisateur`),
  ADD KEY `id_utilisateur_prive` (`id_utilisateur_prive`);

--
-- Index pour la table `p3x_chat_session`
--
ALTER TABLE `p3x_chat_session`
  ADD PRIMARY KEY (`id_session`),
  ADD KEY `id_utilisateur` (`id_utilisateur`);

--
-- Index pour la table `p3x_chat_utilisateur`
--
ALTER TABLE `p3x_chat_utilisateur`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- AUTO_INCREMENT pour la table `p3x_chat_message`
--
ALTER TABLE `p3x_chat_message`
  MODIFY `id_message` mediumint(7) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `p3x_chat_session`
--
ALTER TABLE `p3x_chat_session`
  MODIFY `id_session` mediumint(7) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `p3x_chat_utilisateur`
--
ALTER TABLE `p3x_chat_utilisateur`
  MODIFY `id_utilisateur` mediumint(7) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
