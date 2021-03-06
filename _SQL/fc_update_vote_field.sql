﻿CREATE OR REPLACE FUNCTION fc_update_vote_in_comment() RETURNS trigger AS $$
DECLARE vote_var integer;
BEGIN
    SELECT
        COALESCE(vote, 0)
    FROM public.comments
    WHERE id = NEW.comment_id
    INTO vote_var;

    IF	TG_OP = 'UPDATE' THEN
    
        IF COALESCE(OLD.vote, FALSE) THEN
	    vote_var := vote_var - 2;
        ELSE
	    vote_var := vote_var + 2;
        END IF;

        UPDATE public.comments SET
            vote = vote_var
        WHERE id = OLD.comment_id;

        RETURN OLD;
        
    ELSIF TG_OP = 'INSERT' THEN

     IF COALESCE(NEW.vote, FALSE) THEN
	    vote_var := vote_var + 1;
        ELSE
	    vote_var := vote_var - 1;
        END IF;

        UPDATE public.comments SET
            vote = vote_var
        WHERE id = NEW.comment_id;

        RETURN NEW;
    END IF;
    

END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS update_vote_row ON public.comment_votes;

CREATE TRIGGER update_vote_row
    AFTER INSERT OR UPDATE
    ON public.comment_votes
    FOR EACH ROW
    EXECUTE PROCEDURE fc_update_vote_in_comment();
