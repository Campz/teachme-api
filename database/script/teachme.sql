create database teachme;
use teachme;

CREATE TABLE Instituicao (
  CdInstituicao INT(11) NOT NULL,
  NmInstituicao VARCHAR(200) NOT NULL,
  Endereco VARCHAR(200) NOT NULL,
  PRIMARY KEY (`CdInstituicao`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE Usuario(
  CdUsuario INT(11) NOT NULL,
  `NmUsuario` VARCHAR(200) NOT NULL,
  `Email` VARCHAR(200) NOT NULL,
  `Login` VARCHAR(200) NOT NULL,
  `Senha` VARCHAR(100) NOT NULL,
  `DtNascimento` DATE NOT NULL,
  `Avaliacao` DECIMAL(3,2) NULL DEFAULT NULL,
  `Descricao` VARCHAR(240) NULL DEFAULT NULL,
  `Foto` BLOB NULL DEFAULT NULL,
  `CdInstituicao` INT(11) NOT NULL,
  PRIMARY KEY (`CdUsuario`),
    FOREIGN KEY (`CdInstituicao`)
    REFERENCES Instituicao(`CdInstituicao`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE Tipo(
  `CdTipo` INT(11) NOT NULL,
  `NmTipo` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`CdTipo`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE Disciplina(
  `CdDisciplina` INT(11) NOT NULL,
  `NmDisciplina` VARCHAR(100) NOT NULL,
  `CdTipo` INT(11) NOT NULL,
  PRIMARY KEY (`CdDisciplina`),
    FOREIGN KEY (`CdTipo`)
    REFERENCES `Tipo` (`CdTipo`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE Anuncio(
  `CdAnuncio` INT(11) NOT NULL,
  `QtdAlunos` INT(11) NOT NULL,
  `Descricao` VARCHAR(200) NULL DEFAULT NULL,
  `CdDisciplina` INT(11) NOT NULL,
  `CdUsuario_Professor` INT(11) NOT NULL,
  `Valor` DECIMAL(3,2) NOT NULL,
  PRIMARY KEY (`CdAnuncio`),
    FOREIGN KEY (`CdDisciplina`)
    REFERENCES Disciplina (`CdDisciplina`),
    FOREIGN KEY (`CdUsuario_Professor`)
    REFERENCES Usuario(`CdUsuario`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE Aula(
  `CdAula` INT(11) NOT NULL,
  `CdUsuario_Aluno` INT(11) NOT NULL,
  `CdAnuncio` INT(11) NOT NULL,
  `Horario` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`CdAula`),
    FOREIGN KEY (`CdUsuario_Aluno`)
    REFERENCES Usuario (`CdUsuario`),
    FOREIGN KEY (`CdAnuncio`)
    REFERENCES Anuncio (`CdAnuncio`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE Disciplina_Leciona(
  `CdDisciplina` INT(11) NOT NULL,
  `CdUsuario_Professor` INT(11) NOT NULL,
    FOREIGN KEY (`CdDisciplina`)
    REFERENCES Disciplina (`CdDisciplina`),
    FOREIGN KEY (`CdUsuario_Professor`)
    REFERENCES Usuario (`CdUsuario`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;