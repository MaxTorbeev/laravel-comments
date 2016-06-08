ALTER TABLE public.comments ALTER COLUMN vote TYPE boolean USING (vote::boolean);

ALTER TABLE public.comments
   ALTER COLUMN vote TYPE integer USING (vote::integer);