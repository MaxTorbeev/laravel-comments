-- Table: public.comments

-- DROP TABLE public.comments;

CREATE TABLE public.comments
(
  id integer NOT NULL DEFAULT nextval('comments_id_seq'::regclass),
  user_id integer DEFAULT 0,
  post_id integer NOT NULL,
  parent_id integer DEFAULT 0,
  karma integer DEFAULT 0,
  level integer DEFAULT 0,
  user_ip character varying(255),
  content text NOT NULL,
  published_at timestamp(0) without time zone,
  created_at timestamp(0) without time zone,
  updated_at timestamp(0) without time zone,
  CONSTRAINT comments_pkey PRIMARY KEY (id),
  CONSTRAINT comments_post_id_foreign FOREIGN KEY (post_id)
  REFERENCES public.posts (id) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT comments_user_id_foreign FOREIGN KEY (user_id)
  REFERENCES public.users (id) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE CASCADE
)
WITH (
OIDS=FALSE
);
ALTER TABLE public.comments
OWNER TO postgres;

-- Index: public.comments_karma_index

-- DROP INDEX public.comments_karma_index;

CREATE INDEX comments_karma_index
ON public.comments
USING btree
(karma);

-- Index: public.comments_level_index

-- DROP INDEX public.comments_level_index;

CREATE INDEX comments_level_index
ON public.comments
USING btree
(level);

-- Index: public.comments_parent_id_index

-- DROP INDEX public.comments_parent_id_index;

CREATE INDEX comments_parent_id_index
ON public.comments
USING btree
(parent_id);

-- Index: public.comments_user_id_index

-- DROP INDEX public.comments_user_id_index;

CREATE INDEX comments_user_id_index
ON public.comments
USING btree
(user_id);

