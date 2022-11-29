CREATE TABLE scuole (
    PRIMARY KEY (id),
    nome varchar NOT NULL,
);

CREATE TABLE studenti (
    PRIMARY KEY (id),
    nome varchar NOT NULL,
    cognome varchar NOT NULL,
    FOREIGN KEY (scuola_fk) REFERENCES Scuola(id)
);