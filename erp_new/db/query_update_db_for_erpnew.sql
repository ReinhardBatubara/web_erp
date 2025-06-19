/* JUMADI */
/* 18 Juni 2025*/
CREATE TABLE public.menugroup
(
  id serial,
  name character varying,
  icon_menu character varying,
  CONSTRAINT group_menu_pkey PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.menugroup
  OWNER TO postgres;

CREATE TABLE public.itemgroup
(
  id serial,
  code character varying,
  name character varying,
  description character varying,
  CONSTRAINT itemgroup_pkey PRIMARY KEY (id),
  CONSTRAINT itemgroup_code_key UNIQUE (code)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.itemgroup
  OWNER TO postgres;


ALTER TABLE public.menu ADD COLUMN optionview boolean;
ALTER TABLE public.menu ALTER COLUMN optionview SET DEFAULT false;
ALTER TABLE public.menu ADD COLUMN menugroupid bigint;
ALTER TABLE public.menu ADD COLUMN icon character varying;

ALTER TABLE public.accessmenu ADD COLUMN optionview smallint;
COMMENT ON COLUMN public.accessmenu.optionview IS '1-> Department Appropriate
2-> View All Data
';

ALTER TABLE public.customer ADD COLUMN code character varying(10);

ALTER TABLE public.vendor ADD COLUMN code character varying(32);
