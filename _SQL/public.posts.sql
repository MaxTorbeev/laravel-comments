-- Table: public.posts

-- DROP TABLE public.posts;

CREATE TABLE public.posts
(
  id integer NOT NULL DEFAULT nextval('posts_id_seq'::regclass),
  user_id integer NOT NULL,
  alias character varying(255) NOT NULL,
  title character varying(255) NOT NULL,
  intro_text text,
  body text NOT NULL,
  image text,
  metakey text,
  metadesc text,
  published_at timestamp(0) without time zone,
  created_at timestamp(0) without time zone,
  updated_at timestamp(0) without time zone,
  CONSTRAINT posts_pkey PRIMARY KEY (id),
  CONSTRAINT posts_user_id_foreign FOREIGN KEY (user_id)
      REFERENCES public.users (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.posts
  OWNER TO postgres;


ALTER TABLE public.posts
-- DROP CONSTRAINT posts_comment_id_foreign,
ADD CONSTRAINT posts_comment_id_foreign FOREIGN KEY (post_id)
   REFERENCES public.comments(id)
   ON DELETE CASCADE;
