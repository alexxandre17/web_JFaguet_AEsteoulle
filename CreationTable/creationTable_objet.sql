CREATE TABLE objet(
	id text COLLATE pg_catalog."default",
    nom text COLLATE pg_catalog."default",
    type text COLLATE pg_catalog."default",
    "position" geometry(Point,4326),
    bloque boolean,
    bloqueur character varying COLLATE pg_catalog."default",
    image text COLLATE pg_catalog."default",
    comment character varying COLLATE pg_catalog."default",
    zoom integer
)
