#
# Table structure for table 'tx_hisodat_archives'
#
CREATE TABLE tx_hisodat_archives (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,

	title varchar(255) DEFAULT '' NOT NULL,
	description text NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid)
);

#
# Table structure for table 'tx_hisodat_keywords'
#
CREATE TABLE tx_hisodat_keywords (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,

	title varchar(255) DEFAULT '' NOT NULL,
	description text NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid)
);

#
# Table structure for table 'tx_hisodat_literature'
#
CREATE TABLE tx_hisodat_literature (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,

	title varchar(255) DEFAULT '' NOT NULL,
	author varchar(255) DEFAULT '' NOT NULL,
	publisher varchar(255) DEFAULT '' NOT NULL,
	pub_mag varchar(255) DEFAULT '' NOT NULL,
	published varchar(255) DEFAULT '' NOT NULL,
	series varchar(255) DEFAULT '' NOT NULL,
	short varchar(255) DEFAULT '' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid)
);

#
# Table structure for table 'tx_hisodat_localities'
#
CREATE TABLE tx_hisodat_localities (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,

	title varchar(255) DEFAULT '' NOT NULL,
	namevariants varchar(255) DEFAULT '' NOT NULL,
	municipality varchar(255) DEFAULT '' NOT NULL,
	field_name varchar(255) DEFAULT '' NOT NULL,
	latitude char(10) DEFAULT '' NOT NULL,
	longitude char(10) DEFAULT '' NOT NULL,
	date_comment varchar(255) DEFAULT '' NOT NULL,
	date_start char(10) DEFAULT '' NOT NULL,
	date_end char(10) DEFAULT '' NOT NULL,
    image tinyblob NOT NULL,
	description text NOT NULL,
	persons_uids int(11) unsigned DEFAULT '0' NOT NULL,
	entities_uids int(11) unsigned DEFAULT '0' NOT NULL,
	localities_uids int(11) unsigned DEFAULT '0' NOT NULL,
	literature_uids int(11) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid)
);

#
# Table structure for table 'tx_hisodat_persons'
#
CREATE TABLE tx_hisodat_persons (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,

	gender tinyint(4) DEFAULT '0' NOT NULL,
	name varchar(255) DEFAULT '' NOT NULL,
	namevariants varchar(255) DEFAULT '' NOT NULL,
	pnd varchar(255) DEFAULT '' NOT NULL,
	titles varchar(255) DEFAULT '' NOT NULL,
	date_comment varchar(255) DEFAULT '' NOT NULL,
	date_start char(10) DEFAULT '' NOT NULL,
	date_end char(10) DEFAULT '' NOT NULL,
    image tinyblob NOT NULL,
	description text NOT NULL,
	persons_uids int(11) unsigned DEFAULT '0' NOT NULL,
	localities_uids int(11) unsigned DEFAULT '0' NOT NULL,
	entities_uids int(11) unsigned DEFAULT '0' NOT NULL,
	literature_uids int(11) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid)
);

#
# Table structure for table 'tx_hisodat_entities'
#
CREATE TABLE tx_hisodat_entities (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,

	title varchar(255) DEFAULT '' NOT NULL,
	namevariants varchar(255) DEFAULT '' NOT NULL,
	date_comment varchar(255) DEFAULT '' NOT NULL,
	date_start char(10) DEFAULT '' NOT NULL,
	date_end char(10) DEFAULT '' NOT NULL,
    image tinyblob NOT NULL,
	description text NOT NULL,
	persons_uids int(11) unsigned DEFAULT '0' NOT NULL,
	localities_uids int(11) unsigned DEFAULT '0' NOT NULL,
	entities_uids int(11) unsigned DEFAULT '0' NOT NULL,
	literature_uids int(11) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid)
);

#
# Table structure for table 'tx_hisodat_relations'
#
#CREATE TABLE tx_hisodat_relations (
#	uid int(11) NOT NULL auto_increment,
#	pid int(11) DEFAULT '0' NOT NULL,
#	tstamp int(11) DEFAULT '0' NOT NULL,
#	crdate int(11) DEFAULT '0' NOT NULL,
#	cruser_id int(11) DEFAULT '0' NOT NULL,
#	deleted tinyint(4) DEFAULT '0' NOT NULL,
#	hidden tinyint(4) DEFAULT '0' NOT NULL,
#
#	title varchar(255) DEFAULT '' NOT NULL,
#	parent_relation int(11) DEFAULT '0' NOT NULL,
#	relationtype tinyint(4) DEFAULT '0' NOT NULL,
#	description varchar(255) DEFAULT '' NOT NULL,
#
#	PRIMARY KEY (uid),
#	KEY parent (pid)
#);

#
# Table structure for table 'tx_hisodat_sources'
#
CREATE TABLE tx_hisodat_sources (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,

	signature varchar(255) DEFAULT '' NOT NULL,
	signature_add varchar(255) DEFAULT '' NOT NULL,
	urn varchar(255) DEFAULT '' NOT NULL,
	archive_uid int(11) unsigned DEFAULT '0' NOT NULL,
	date_start char(10) DEFAULT '' NOT NULL,
	date_end char(10) DEFAULT '' NOT NULL,
	date_comment varchar(255) DEFAULT '' NOT NULL,
	date_sorting varchar(255) DEFAULT '' NOT NULL,	
	short text NOT NULL,
	sourcetext text NOT NULL,
	description text NOT NULL,
	categories_uids int(11) unsigned DEFAULT '0' NOT NULL,
	keywords_uids int(11) unsigned DEFAULT '0' NOT NULL,
	localities_uids int(11) unsigned DEFAULT '0' NOT NULL,
	persons_uids int(11) unsigned DEFAULT '0' NOT NULL,
	entities_uids int(11) unsigned DEFAULT '0' NOT NULL,
	literature_uids int(11) unsigned DEFAULT '0' NOT NULL,
	sources_uids int(11) unsigned DEFAULT '0' NOT NULL,
    image tinyblob NOT NULL,
    imagecaption text NOT NULL,
	editor_id int(11) DEFAULT '0' NOT NULL,
	editor_comment text NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid),
	INDEX tx_hisodat_signature(signature(10), signature_add(10)),
	FULLTEXT tx_hisodat_fulltext(signature, signature_add, date_comment, short, sourcetext, description, imagecaption),

) ENGINE=MyIsam;



#### MM TABLES ####


#
# Table structure for table 'tx_hisodat_mm_src_src'
#
CREATE TABLE tx_hisodat_mm_src_src (
	uid_local int(11) DEFAULT '0' NOT NULL,
	uid_foreign int(11) DEFAULT '0' NOT NULL,
	tablenames varchar(30) DEFAULT '' NOT NULL,
	sorting int(11) DEFAULT '0' NOT NULL,

	KEY uid_local (uid_local),
	KEY uid_foreign (uid_foreign)
);

#
# Table structure for table 'tx_hisodat_mm_src_key'
#
CREATE TABLE tx_hisodat_mm_src_key (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,

    uid_src int(11) unsigned DEFAULT '0' NOT NULL,
    uid_key int(11) unsigned DEFAULT '0' NOT NULL,
    keysort int(11) unsigned DEFAULT '0' NOT NULL,
    srcsort int(11) unsigned DEFAULT '0' NOT NULL,

    PRIMARY KEY (uid),
    KEY parent (pid)
);

#
# Table structure for table 'tx_hisodat_mm_src_pers'
#
CREATE TABLE tx_hisodat_mm_src_pers (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,

    uid_src int(11) unsigned DEFAULT '0' NOT NULL,
    uid_pers int(11) unsigned DEFAULT '0' NOT NULL,
    issuer tinyint(4) DEFAULT '0' NOT NULL,
    receiver tinyint(4) DEFAULT '0' NOT NULL,
    description text NOT NULL,
	parenttable varchar(255) DEFAULT '' NOT NULL,
    perssort int(11) unsigned DEFAULT '0' NOT NULL,

    PRIMARY KEY (uid),
    KEY parent (pid)
);

#
# Table structure for table 'tx_hisodat_mm_src_ent'
#
CREATE TABLE tx_hisodat_mm_src_ent (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,

    uid_src int(11) unsigned DEFAULT '0' NOT NULL,
    uid_ent int(11) unsigned DEFAULT '0' NOT NULL,
    issuer tinyint(4) DEFAULT '0' NOT NULL,
    receiver tinyint(4) DEFAULT '0' NOT NULL,
    description text NOT NULL,
	parenttable varchar(255) DEFAULT '' NOT NULL,
    entsort int(11) unsigned DEFAULT '0' NOT NULL,

    PRIMARY KEY (uid),
    KEY parent (pid)
);

#
# Table structure for table 'tx_hisodat_mm_src_loc'
#
CREATE TABLE tx_hisodat_mm_src_loc (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,

    uid_src int(11) unsigned DEFAULT '0' NOT NULL,
    uid_loc int(11) unsigned DEFAULT '0' NOT NULL,
	issuer tinyint(4) DEFAULT '0' NOT NULL,
    receiver tinyint(4) DEFAULT '0' NOT NULL,
    description text NOT NULL,
	parenttable varchar(255) DEFAULT '' NOT NULL,
    locsort int(11) unsigned DEFAULT '0' NOT NULL,

    PRIMARY KEY (uid),
    KEY parent (pid)
);

#
# Table structure for table 'tx_hisodat_mm_lit'
#
CREATE TABLE tx_hisodat_mm_lit (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,

    uid_local int(11) unsigned DEFAULT '0' NOT NULL,
    uid_foreign int(11) unsigned DEFAULT '0' NOT NULL,
    notation varchar(255) DEFAULT '' NOT NULL,
	parenttable varchar(255) DEFAULT '' NOT NULL,
    litsort int(11) unsigned DEFAULT '0' NOT NULL,

    PRIMARY KEY (uid),
    KEY parent (pid)
);

#
# Table structure for table 'tx_hisodat_mm_loc_loc'
#
#CREATE TABLE tx_hisodat_mm_loc_loc (
#	uid int(11) NOT NULL auto_increment,
#	pid int(11) DEFAULT '0' NOT NULL,
#	tstamp int(11) DEFAULT '0' NOT NULL,
#	crdate int(11) DEFAULT '0' NOT NULL,
#	cruser_id int(11) DEFAULT '0' NOT NULL,
#	deleted tinyint(4) DEFAULT '0' NOT NULL,
#	hidden tinyint(4) DEFAULT '0' NOT NULL,

#	uid_local int(11) unsigned DEFAULT '0' NOT NULL,
#	uid_foreign int(11) unsigned DEFAULT '0' NOT NULL,
#    description text NOT NULL,
#    relations_uids varchar(255) DEFAULT '' NOT NULL,
#	parenttable varchar(255) DEFAULT '' NOT NULL,
#    localsort int(11) unsigned DEFAULT '0' NOT NULL,
#    foreignsort int(11) unsigned DEFAULT '0' NOT NULL,

#    PRIMARY KEY (uid),
#    KEY parent (pid)
#);

#
# Table structure for table 'tx_hisodat_mm_pers_loc'
#
#CREATE TABLE tx_hisodat_mm_pers_loc (
#	uid int(11) NOT NULL auto_increment,
#	pid int(11) DEFAULT '0' NOT NULL,
#	tstamp int(11) DEFAULT '0' NOT NULL,
#	crdate int(11) DEFAULT '0' NOT NULL,
#	cruser_id int(11) DEFAULT '0' NOT NULL,
#	deleted tinyint(4) DEFAULT '0' NOT NULL,
#	hidden tinyint(4) DEFAULT '0' NOT NULL,

#    uid_pers int(11) unsigned DEFAULT '0' NOT NULL,
#    uid_loc int(11) unsigned DEFAULT '0' NOT NULL,
#    relations_uids varchar(255) DEFAULT '' NOT NULL,
#    description text NOT NULL,
#	parenttable varchar(255) DEFAULT '' NOT NULL,
#    locsort int(11) unsigned DEFAULT '0' NOT NULL,
#    perssort int(11) unsigned DEFAULT '0' NOT NULL,

#    PRIMARY KEY (uid),
#    KEY parent (pid)
#);

#
# Table structure for table 'tx_hisodat_mm_pers_pers'
#
#CREATE TABLE tx_hisodat_mm_pers_pers (
#	uid int(11) NOT NULL auto_increment,
#	pid int(11) DEFAULT '0' NOT NULL,
#	tstamp int(11) DEFAULT '0' NOT NULL,
#	crdate int(11) DEFAULT '0' NOT NULL,
#	cruser_id int(11) DEFAULT '0' NOT NULL,
#	deleted tinyint(4) DEFAULT '0' NOT NULL,
#	hidden tinyint(4) DEFAULT '0' NOT NULL,

#    uid_local int(11) unsigned DEFAULT '0' NOT NULL,
#    uid_foreign int(11) unsigned DEFAULT '0' NOT NULL,
#    relations_uids varchar(255) DEFAULT '' NOT NULL,
#    description text NOT NULL,
#	parenttable varchar(255) DEFAULT '' NOT NULL,
#    localsort int(11) unsigned DEFAULT '0' NOT NULL,
#    foreignsort int(11) unsigned DEFAULT '0' NOT NULL,

#    PRIMARY KEY (uid),
#    KEY parent (pid)
#);

#
# Table structure for table 'tx_hisodat_mm_ent_pers'
#
#CREATE TABLE tx_hisodat_mm_ent_pers (
#	uid int(11) NOT NULL auto_increment,
#	pid int(11) DEFAULT '0' NOT NULL,
#	tstamp int(11) DEFAULT '0' NOT NULL,
#	crdate int(11) DEFAULT '0' NOT NULL,
#	cruser_id int(11) DEFAULT '0' NOT NULL,
#	deleted tinyint(4) DEFAULT '0' NOT NULL,
#	hidden tinyint(4) DEFAULT '0' NOT NULL,

#    uid_ent int(11) unsigned DEFAULT '0' NOT NULL,
#    uid_pers int(11) unsigned DEFAULT '0' NOT NULL,
#    relations_uids varchar(255) DEFAULT '' NOT NULL,
#    description text NOT NULL,
#	parenttable varchar(255) DEFAULT '' NOT NULL,
#    entsort int(11) unsigned DEFAULT '0' NOT NULL,
#    perssort int(11) unsigned DEFAULT '0' NOT NULL,

#    PRIMARY KEY (uid),
#    KEY parent (pid)
#);

#
# Table structure for table 'tx_hisodat_mm_ent_loc'
#
#CREATE TABLE tx_hisodat_mm_ent_loc (
#	uid int(11) NOT NULL auto_increment,
#	pid int(11) DEFAULT '0' NOT NULL,
#	tstamp int(11) DEFAULT '0' NOT NULL,
#	crdate int(11) DEFAULT '0' NOT NULL,
#	cruser_id int(11) DEFAULT '0' NOT NULL,
#	deleted tinyint(4) DEFAULT '0' NOT NULL,
#	hidden tinyint(4) DEFAULT '0' NOT NULL,

#    uid_ent int(11) unsigned DEFAULT '0' NOT NULL,
#    uid_loc int(11) unsigned DEFAULT '0' NOT NULL,
#    relations_uids varchar(255) DEFAULT '' NOT NULL,
#    description text NOT NULL,
#	 parenttable varchar(255) DEFAULT '' NOT NULL,
#    entsort int(11) unsigned DEFAULT '0' NOT NULL,
#    locsort int(11) unsigned DEFAULT '0' NOT NULL,

#    PRIMARY KEY (uid),
#    KEY parent (pid)
#);

#
# Table structure for table 'tx_hisodat_mm_ent_ent'
#
#CREATE TABLE tx_hisodat_mm_ent_ent (
#	uid int(11) NOT NULL auto_increment,
#	pid int(11) DEFAULT '0' NOT NULL,
#	tstamp int(11) DEFAULT '0' NOT NULL,
#	crdate int(11) DEFAULT '0' NOT NULL,
#	cruser_id int(11) DEFAULT '0' NOT NULL,
#	deleted tinyint(4) DEFAULT '0' NOT NULL,
#	hidden tinyint(4) DEFAULT '0' NOT NULL,

#    uid_local int(11) unsigned DEFAULT '0' NOT NULL,
#    uid_foreign int(11) unsigned DEFAULT '0' NOT NULL,
#    relations_uids varchar(255) DEFAULT '' NOT NULL,
#    description text NOT NULL,
#	 parenttable varchar(255) DEFAULT '' NOT NULL,
#    localsort int(11) unsigned DEFAULT '0' NOT NULL,
#    foreignsort int(11) unsigned DEFAULT '0' NOT NULL,

#    PRIMARY KEY (uid),
#    KEY parent (pid)
#);