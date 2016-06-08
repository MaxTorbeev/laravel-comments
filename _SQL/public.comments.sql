-- Sequence: public.posts_id_seq

-- DROP SEQUENCE public.posts_id_seq;

CREATE SEQUENCE public.comments_id_seq
INCREMENT 1
MINVALUE 1
MAXVALUE 9223372036854775807
START 1
CACHE 1;
ALTER TABLE public.comments_id_seq
OWNER TO postgres;

-- Table: public.comments

-- DROP TABLE public.comments;

CREATE TABLE public.comments
(
  id           INTEGER                NOT NULL DEFAULT nextval('comments_id_seq' :: REGCLASS), -- id комментария
  user_id      INTEGER                NOT NULL, -- id пользователя, создавший комментарий
  post_id      INTEGER                NOT NULL, -- id поста, к которому создан комментарий
  parent_id    INTEGER                NOT NULL, -- id родительского комментария
  karma        CHARACTER VARYING(255) NOT NULL, -- карма комментария
  user_ip      CHARACTER VARYING(255) NOT NULL, -- ip адресс, пользователя, создавшего комментарий
  content      TEXT                   NOT NULL, -- содержимое комментария
  published_at TIMESTAMP(0) WITHOUT TIME ZONE, -- дата публикации комментария
  created_at   TIMESTAMP(0) WITHOUT TIME ZONE, -- дата создания
  updated_at   TIMESTAMP(0) WITHOUT TIME ZONE, -- дата обновления
  CONSTRAINT comments_pkey PRIMARY KEY (id),
  CONSTRAINT comments_user_id_foreign FOREIGN KEY (user_id)
  REFERENCES public.users (id) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE CASCADE
)
WITH ( OIDS =FALSE );
ALTER TABLE public.comments
OWNER TO postgres;


CREATE TABLE public.comment_post
(
  id         INTEGER NOT NULL DEFAULT nextval('comments_id_seq' :: REGCLASS), -- id комментария
  comment_id INTEGER NOT NULL, -- id пользователя, создавший комментарий
  post_id    INTEGER NOT NULL -- id поста, к которому создан комментарий
)
WITH ( OIDS =FALSE );
ALTER TABLE public.comment_post
OWNER TO postgres;