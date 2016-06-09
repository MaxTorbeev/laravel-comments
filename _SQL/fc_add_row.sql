-- Function: public.fc_add_vote_row()
-- DROP FUNCTION public.fc_add_vote_row();

-- Невостребованный триггер;

-- CREATE OR REPLACE FUNCTION fc_add_vote_row() RETURNS trigger AS $$
-- BEGIN
-- 	INSERT INTO public.comment_votes(comment_id, user_id, created_at)
-- 	VALUES(NEW.id, NEW.user_id, now());
--
-- 	RETURN NEW;
-- END;
-- $$ LANGUAGE plpgsql;
--
-- DROP TRIGGER IF EXISTS add_vote_row ON public.comments;
--
-- CREATE TRIGGER add_vote_row
-- 	AFTER INSERT ON public.comments
-- 	FOR EACH ROW
-- EXECUTE PROCEDURE fc_add_vote_row() ;
