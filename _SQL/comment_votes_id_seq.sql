-- Sequence: public.comment_votes_id_seq

-- DROP SEQUENCE public.comment_votes_id_seq;

CREATE SEQUENCE public.comment_votes_id_seq
  INCREMENT 1
  MINVALUE 1
  MAXVALUE 9223372036854775807
  START 104
  CACHE 1;
ALTER TABLE public.comment_votes_id_seq
  OWNER TO postgres;
