/*DROP DATABASE IF EXISTS 'leilao_md';*/

USE leilao_md;

DROP TABLE IF EXISTS t014;
DROP TABLE IF EXISTS t013;
DROP TABLE IF EXISTS t012;
DROP TABLE IF EXISTS t011;
DROP TABLE IF EXISTS t010;
DROP TABLE IF EXISTS t009;
DROP TABLE IF EXISTS t008;
DROP TABLE IF EXISTS t007;
DROP TABLE IF EXISTS t006;
DROP TABLE IF EXISTS t005;
DROP TABLE IF EXISTS t004;
DROP TABLE IF EXISTS t003;
DROP TABLE IF EXISTS t002;
DROP TABLE IF EXISTS t001;

CREATE TABLE IF NOT EXISTS  t001 (
	cd_pais bigint UNSIGNED not null AUTO_INCREMENT,
	nm_pais varchar(60) COLLATE utf8_unicode_ci not null unique,
	PRIMARY KEY (cd_pais)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Tabela País';


CREATE TABLE IF NOT EXISTS  t002 (
	cd_estado bigint UNSIGNED not null AUTO_INCREMENT,
	cd_pais bigint UNSIGNED not null,
	nm_estado varchar(60) COLLATE utf8_unicode_ci not null unique,
	uf_estado char(2) COLLATE utf8_unicode_ci not null unique,
	PRIMARY KEY (cd_estado, cd_pais),
	FOREIGN KEY (cd_pais) REFERENCES t001(cd_pais)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Tabela Estado';


CREATE TABLE IF NOT EXISTS  t003 (
	cd_cidade bigint UNSIGNED not null AUTO_INCREMENT,
	cd_estado bigint UNSIGNED not null,
	nm_cidade varchar(60) COLLATE utf8_unicode_ci not null,
	PRIMARY KEY (cd_cidade, cd_estado),
	FOREIGN KEY (cd_estado) REFERENCES t002(cd_estado)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Tabela Cidade';


CREATE TABLE IF NOT EXISTS  t004 (
	cd_cep varchar(9) not null,
	cd_cidade bigint UNSIGNED not null,
	nm_bairro varchar(60) COLLATE utf8_unicode_ci not null,
	nm_logr varchar(100) COLLATE utf8_unicode_ci not null,
	PRIMARY KEY (cd_cep),
	FOREIGN KEY (cd_cidade) REFERENCES t003(cd_cidade)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Tabela Cep';


CREATE TABLE IF NOT EXISTS  t005 (
	cd_end bigint UNSIGNED not null AUTO_INCREMENT,
	cd_cep varchar(9) not null,
	desc_comp varchar(100) COLLATE utf8_unicode_ci,
	nm_qdr varchar(8) COLLATE utf8_unicode_ci,
	nm_lote varchar(8) COLLATE utf8_unicode_ci,
	nr_lat decimal(10,8),
	nr_long decimal(10,8),
	PRIMARY KEY (cd_end),
	FOREIGN KEY (cd_cep) REFERENCES t004(cd_cep)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Tabela Endereco';


CREATE TABLE IF NOT EXISTS  t006 (
	cpf_usr char(11) not null,
	email_usr varchar(128) COLLATE utf8_unicode_ci not null,
	nm_usr varchar(150) COLLATE utf8_unicode_ci not null,
	sbr_nm_usr varchar(150) COLLATE utf8_unicode_ci not null,
	rg_usr varchar(8) not null,
	uf_rg_usr char(2) not null,
	orgao_rg_usr varchar(20) not null,
	sexo_usr int not null COMMENT '0 - masculino, 1 - Feminino',
	senha_usr text COLLATE utf8_unicode_ci not null,
	status_usr int(11) not null,
	dt_criacao_usr datetime not null,
	dt_atual_usr datetime,
	senha_reset_token varchar(32) DEFAULT NULL,
	senha_reset_token_date datetime DEFAULT NULL,
	cd_end bigint UNSIGNED,
	UNIQUE KEY email_usr_x (email_usr),
	PRIMARY KEY (cpf_usr),
	FOREIGN KEY (cd_end) REFERENCES t005(cd_end)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Tabela De Usuários';

CREATE TABLE IF NOT EXISTS  t007 (
	cd_gpr bigint UNSIGNED not null AUTO_INCREMENT,
	nm_gpr varchar(50) COLLATE utf8_unicode_ci not null unique,
	desc_atua_gpr text COLLATE utf8_unicode_ci,
	desc_empresa_gpr text COLLATE utf8_unicode_ci not null,
	desc_missao_gpr text COLLATE utf8_unicode_ci not null,
	desc_visao_gpr text COLLATE utf8_unicode_ci not null,
	desc_valor_gpr text COLLATE utf8_unicode_ci not null,
	PRIMARY KEY (cd_gpr)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Tabela Grupo de lojas';

CREATE TABLE IF NOT EXISTS  t008 (
	cd_tel bigint UNSIGNED not null AUTO_INCREMENT,
	nm_tel varchar(30) COLLATE utf8_unicode_ci,
	tp_tel int not null COMMENT '0 - Fixo, 1 - Celular, 2 - whatsapp',
	ddd_tel char(3) not null,
	nr_tel varchar(9) not null,
	PRIMARY KEY (cd_tel)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Tabela de telefones';

CREATE TABLE IF NOT EXISTS  t009 (
	cd_gpr bigint UNSIGNED not null,
	cd_tel bigint UNSIGNED not null,
	PRIMARY KEY(cd_gpr, cd_tel),
	UNIQUE INDEX (cd_gpr, cd_tel),
	FOREIGN KEY (cd_gpr) REFERENCES t007(cd_gpr),
	FOREIGN KEY (cd_tel) REFERENCES t008(cd_tel)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Tabela Grupo x Telefone';

CREATE TABLE IF NOT EXISTS  t010 (
	cd_md_soc bigint UNSIGNED not null AUTO_INCREMENT,
	link_md_soc varchar(150) COLLATE utf8_unicode_ci,
	desc_md_soc varchar(60) COLLATE utf8_unicode_ci,
	PRIMARY KEY (cd_md_soc)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Tabela de Midias Sociais';

CREATE TABLE IF NOT EXISTS  t011 (
	cd_gpr bigint UNSIGNED not null,
	cd_md_soc bigint UNSIGNED not null,
	PRIMARY KEY(cd_gpr, cd_md_soc),
	UNIQUE INDEX (cd_gpr, cd_md_soc),
	FOREIGN KEY (cd_gpr) REFERENCES t007(cd_gpr),
	FOREIGN KEY (cd_md_soc) REFERENCES t010(cd_md_soc)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Tabela Grupo x Midias Sociais';

CREATE TABLE IF NOT EXISTS  t012 (
	cd_email bigint UNSIGNED not null AUTO_INCREMENT,
	desc_email varchar(50) COLLATE utf8_unicode_ci not null,
	end_email varchar(128) COLLATE utf8_unicode_ci not null,
	PRIMARY KEY (cd_email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Tabela de Emails';

CREATE TABLE IF NOT EXISTS  t013 (
	cd_gpr bigint UNSIGNED not null,
	cd_email bigint UNSIGNED not null,
	PRIMARY KEY(cd_gpr, cd_email),
	UNIQUE INDEX (cd_gpr, cd_email),
	FOREIGN KEY (cd_gpr) REFERENCES t007(cd_gpr),
	FOREIGN KEY (cd_email) REFERENCES t012(cd_email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Tabela Grupo x Emails';

CREATE TABLE IF NOT EXISTS  t014 (
	cd_loja bigint UNSIGNED not null AUTO_INCREMENT,
	cd_gpr bigint UNSIGNED not null,
	nm_loja varchar(50) COLLATE utf8_unicode_ci not null unique,
	desc_atua_loja text COLLATE utf8_unicode_ci,
	desc_empresa_loja text COLLATE utf8_unicode_ci not null,
	desc_missao_loja text COLLATE utf8_unicode_ci not null,
	desc_visao_loja text COLLATE utf8_unicode_ci not null,
	desc_valor_loja text COLLATE utf8_unicode_ci not null,
	cd_cidade bigint UNSIGNED not null,
	PRIMARY KEY (cd_loja),
	FOREIGN KEY (cd_gpr) REFERENCES t007(cd_gpr)
	FOREIGN KEY (cd_cidade) REFERENCES t004(cd_cidade)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Tabela Lojas';










