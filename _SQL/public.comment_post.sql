-- Table: public.comment_post
-- DROP TABLE public.comment_post;

CREATE TABLE public.comment_post
(
  comment_id  integer NOT NULL,
  post_id     integer NOT NULL,
  created_at  timestamp(0) without time zone,
  updated_at  timestamp(0) without time zone,
  CONSTRAINT comment_post_comment_id_foreign FOREIGN KEY (comment_id)
      REFERENCES public.comments (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT comment_post_post_id_foreign FOREIGN KEY (post_id)
      REFERENCES public.posts (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.comment_post
  OWNER TO postgres;

-- Index: public.comment_post_comment_id_index

-- DROP INDEX public.comment_post_comment_id_index;

CREATE INDEX comment_post_comment_id_index
  ON public.comment_post
  USING btree
  (comment_id);

-- Index: public.comment_post_post_id_index

-- DROP INDEX public.comment_post_post_id_index;

CREATE INDEX comment_post_post_id_index
  ON public.comment_post
  USING btree
  (post_id);