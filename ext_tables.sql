CREATE TABLE tx_mspricing_domain_model_plan (
    name varchar(255) NOT NULL DEFAULT '',
    subtitle varchar(255) NOT NULL DEFAULT '',
    price_monthly decimal(10,2) DEFAULT NULL,
    price_yearly decimal(10,2) DEFAULT NULL,
    currency varchar(10) NOT NULL DEFAULT '$',
    css_class varchar(255) NOT NULL DEFAULT ''
);

CREATE TABLE tx_mspricing_domain_model_featuregroup (
    name varchar(255) NOT NULL DEFAULT ''
);

CREATE TABLE tx_mspricing_domain_model_feature (
    name varchar(255) NOT NULL DEFAULT '',
    description text,
    feature_group int(11) NOT NULL DEFAULT 0
);

CREATE TABLE tx_mspricing_domain_model_planfeature (
    plan int(11) NOT NULL DEFAULT 0,
    feature int(11) NOT NULL DEFAULT 0,
    value_type varchar(20) NOT NULL DEFAULT 'unavailable',
    value_text varchar(255) NOT NULL DEFAULT ''
);
