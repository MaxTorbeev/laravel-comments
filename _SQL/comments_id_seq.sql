-- Sequence: public.comments_id_seq

-- DROP SEQUENCE public.comments_id_seq;

CREATE SEQUENCE public.comments_id_seq
  INCREMENT 1
  MINVALUE 1
  MAXVALUE 9223372036854775807
  START 30
  CACHE 1;
ALTER TABLE public.comments_id_seq
  OWNER TO postgres;
