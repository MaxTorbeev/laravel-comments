-- Table: public.comment_votes

-- DROP TABLE public.comment_votes;

CREATE TABLE public.comment_votes
(
  id integer NOT NULL DEFAULT nextval('comment_votes_id_seq'::regclass),
  comment_id integer NOT NULL,
  user_id integer NOT NULL,
  user_ip integer,
  vote boolean,
  created_at timestamp(0) without time zone,
  updated_at timestamp(0) without time zone,
  CONSTRAINT comment_votes_pkey PRIMARY KEY (id),
  CONSTRAINT comment_votes_comment_id_foreign FOREIGN KEY (comment_id)
      REFERENCES public.comments (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.comment_votes
  OWNER TO postgres;

-- Trigger: update_vote_row on public.comment_votes

-- DROP TRIGGER update_vote_row ON public.comment_votes;

CREATE TRIGGER update_vote_row
  AFTER INSERT OR UPDATE
  ON public.comment_votes
  FOR EACH ROW
  EXECUTE PROCEDURE public.fc_update_vote_in_comment();
