#
# Table structure for table 'tx_wpdeqarreports_domain_model_report'
#
CREATE TABLE tx_wpdeqarreports_domain_model_report
(

    uid                       int(11)                          NOT NULL auto_increment,
    pid                       int(11)              DEFAULT '0' NOT NULL,

    report_id                 varchar(255)         DEFAULT ''  NOT NULL,
    type                      int(11)              DEFAULT '0' NOT NULL,
    agency                    varchar(255)         DEFAULT ''  NOT NULL,
    activity_local_identifier varchar(255)         DEFAULT ''  NOT NULL,
    status                    int(11)              DEFAULT '0' NOT NULL,
    valid_from                date                 DEFAULT NULL,
    valid_to                  date                 DEFAULT NULL,
    ser_report_file           int(11) unsigned                 NOT NULL default '0',
    ser_report_name           varchar(255)         DEFAULT ''  NOT NULL,
    institution_deqar_id      varchar(255)         DEFAULT ''  NOT NULL,
    institution_name          varchar(255)         DEFAULT ''  NOT NULL,
    hardcopy                  smallint(5) unsigned DEFAULT '0' NOT NULL,
    file_original_location    int(11) unsigned                 NOT NULL default '0',
    file_display_name         varchar(255)         DEFAULT ''  NOT NULL,
    file_report_language      varchar(255)         DEFAULT '0' NOT NULL,
    activity                  int(11) unsigned     DEFAULT '0',
    decision                  int(11) unsigned     DEFAULT '0',
    programs                  int(11) unsigned     DEFAULT '0' NOT NULL,

    tstamp                    int(11) unsigned     DEFAULT '0' NOT NULL,
    crdate                    int(11) unsigned     DEFAULT '0' NOT NULL,
    cruser_id                 int(11) unsigned     DEFAULT '0' NOT NULL,
    deleted                   smallint(5) unsigned DEFAULT '0' NOT NULL,
    hidden                    smallint(5) unsigned DEFAULT '0' NOT NULL,
    starttime                 int(11) unsigned     DEFAULT '0' NOT NULL,
    endtime                   int(11) unsigned     DEFAULT '0' NOT NULL,

    t3ver_oid                 int(11)              DEFAULT '0' NOT NULL,
    t3ver_id                  int(11)              DEFAULT '0' NOT NULL,
    t3ver_wsid                int(11)              DEFAULT '0' NOT NULL,
    t3ver_label               varchar(255)         DEFAULT ''  NOT NULL,
    t3ver_state               smallint(6)          DEFAULT '0' NOT NULL,
    t3ver_stage               int(11)              DEFAULT '0' NOT NULL,
    t3ver_count               int(11)              DEFAULT '0' NOT NULL,
    t3ver_tstamp              int(11)              DEFAULT '0' NOT NULL,
    t3ver_move_id             int(11)              DEFAULT '0' NOT NULL,

    sys_language_uid          int(11)              DEFAULT '0' NOT NULL,
    l10n_parent               int(11)              DEFAULT '0' NOT NULL,
    l10n_diffsource           mediumblob,
    l10n_state                text,

    PRIMARY KEY (uid),
    KEY parent (pid),
    KEY t3ver_oid (t3ver_oid, t3ver_wsid),
    KEY language (l10n_parent, sys_language_uid)

);

#
# Table structure for table 'tx_wpdeqarreports_domain_model_program'
#
CREATE TABLE tx_wpdeqarreports_domain_model_program
(

    uid                             int(11)                          NOT NULL auto_increment,
    pid                             int(11)              DEFAULT '0' NOT NULL,

    report                          int(11) unsigned     DEFAULT '0' NOT NULL,

    programme_identifier            int(11)              DEFAULT '0' NOT NULL,
    programme_name_primary          varchar(255)         DEFAULT ''  NOT NULL,
    programme_qualification_primary varchar(255)         DEFAULT ''  NOT NULL,
    programme_nqf_level             varchar(255)         DEFAULT ''  NOT NULL,
    programme_gf_ehea_level         int(11)              DEFAULT '0' NOT NULL,

    tstamp                          int(11) unsigned     DEFAULT '0' NOT NULL,
    crdate                          int(11) unsigned     DEFAULT '0' NOT NULL,
    cruser_id                       int(11) unsigned     DEFAULT '0' NOT NULL,
    deleted                         smallint(5) unsigned DEFAULT '0' NOT NULL,
    hidden                          smallint(5) unsigned DEFAULT '0' NOT NULL,
    starttime                       int(11) unsigned     DEFAULT '0' NOT NULL,
    endtime                         int(11) unsigned     DEFAULT '0' NOT NULL,

    t3ver_oid                       int(11)              DEFAULT '0' NOT NULL,
    t3ver_id                        int(11)              DEFAULT '0' NOT NULL,
    t3ver_wsid                      int(11)              DEFAULT '0' NOT NULL,
    t3ver_label                     varchar(255)         DEFAULT ''  NOT NULL,
    t3ver_state                     smallint(6)          DEFAULT '0' NOT NULL,
    t3ver_stage                     int(11)              DEFAULT '0' NOT NULL,
    t3ver_count                     int(11)              DEFAULT '0' NOT NULL,
    t3ver_tstamp                    int(11)              DEFAULT '0' NOT NULL,
    t3ver_move_id                   int(11)              DEFAULT '0' NOT NULL,

    sys_language_uid                int(11)              DEFAULT '0' NOT NULL,
    l10n_parent                     int(11)              DEFAULT '0' NOT NULL,
    l10n_diffsource                 mediumblob,
    l10n_state                      text,

    PRIMARY KEY (uid),
    KEY parent (pid),
    KEY t3ver_oid (t3ver_oid, t3ver_wsid),
    KEY language (l10n_parent, sys_language_uid)

);

#
# Table structure for table 'tx_wpdeqarreports_domain_model_decision'
#
CREATE TABLE tx_wpdeqarreports_domain_model_decision
(

    uid              int(11)                          NOT NULL auto_increment,
    pid              int(11)              DEFAULT '0' NOT NULL,

    title            varchar(255)         DEFAULT ''  NOT NULL,
    dequar_decision  int(11)              DEFAULT '0' NOT NULL,

    tstamp           int(11) unsigned     DEFAULT '0' NOT NULL,
    crdate           int(11) unsigned     DEFAULT '0' NOT NULL,
    cruser_id        int(11) unsigned     DEFAULT '0' NOT NULL,
    deleted          smallint(5) unsigned DEFAULT '0' NOT NULL,
    hidden           smallint(5) unsigned DEFAULT '0' NOT NULL,
    starttime        int(11) unsigned     DEFAULT '0' NOT NULL,
    endtime          int(11) unsigned     DEFAULT '0' NOT NULL,

    t3ver_oid        int(11)              DEFAULT '0' NOT NULL,
    t3ver_id         int(11)              DEFAULT '0' NOT NULL,
    t3ver_wsid       int(11)              DEFAULT '0' NOT NULL,
    t3ver_label      varchar(255)         DEFAULT ''  NOT NULL,
    t3ver_state      smallint(6)          DEFAULT '0' NOT NULL,
    t3ver_stage      int(11)              DEFAULT '0' NOT NULL,
    t3ver_count      int(11)              DEFAULT '0' NOT NULL,
    t3ver_tstamp     int(11)              DEFAULT '0' NOT NULL,
    t3ver_move_id    int(11)              DEFAULT '0' NOT NULL,

    sys_language_uid int(11)              DEFAULT '0' NOT NULL,
    l10n_parent      int(11)              DEFAULT '0' NOT NULL,
    l10n_diffsource  mediumblob,
    l10n_state       text,

    PRIMARY KEY (uid),
    KEY parent (pid),
    KEY t3ver_oid (t3ver_oid, t3ver_wsid),
    KEY language (l10n_parent, sys_language_uid)

);

#
# Table structure for table 'tx_wpdeqarreports_domain_model_activity'
#
CREATE TABLE tx_wpdeqarreports_domain_model_activity
(

    uid              int(11)                          NOT NULL auto_increment,
    pid              int(11)              DEFAULT '0' NOT NULL,

    identifier       int(11)              DEFAULT '0' NOT NULL,
    title            varchar(255)         DEFAULT ''  NOT NULL,

    tstamp           int(11) unsigned     DEFAULT '0' NOT NULL,
    crdate           int(11) unsigned     DEFAULT '0' NOT NULL,
    cruser_id        int(11) unsigned     DEFAULT '0' NOT NULL,
    deleted          smallint(5) unsigned DEFAULT '0' NOT NULL,
    hidden           smallint(5) unsigned DEFAULT '0' NOT NULL,
    starttime        int(11) unsigned     DEFAULT '0' NOT NULL,
    endtime          int(11) unsigned     DEFAULT '0' NOT NULL,

    t3ver_oid        int(11)              DEFAULT '0' NOT NULL,
    t3ver_id         int(11)              DEFAULT '0' NOT NULL,
    t3ver_wsid       int(11)              DEFAULT '0' NOT NULL,
    t3ver_label      varchar(255)         DEFAULT ''  NOT NULL,
    t3ver_state      smallint(6)          DEFAULT '0' NOT NULL,
    t3ver_stage      int(11)              DEFAULT '0' NOT NULL,
    t3ver_count      int(11)              DEFAULT '0' NOT NULL,
    t3ver_tstamp     int(11)              DEFAULT '0' NOT NULL,
    t3ver_move_id    int(11)              DEFAULT '0' NOT NULL,

    sys_language_uid int(11)              DEFAULT '0' NOT NULL,
    l10n_parent      int(11)              DEFAULT '0' NOT NULL,
    l10n_diffsource  mediumblob,
    l10n_state       text,

    PRIMARY KEY (uid),
    KEY parent (pid),
    KEY t3ver_oid (t3ver_oid, t3ver_wsid),
    KEY language (l10n_parent, sys_language_uid)

);

#
# Table structure for table 'tx_wpdeqarreports_domain_model_membership'
#
CREATE TABLE tx_wpdeqarreports_domain_model_membership
(

    uid              int(11)                          NOT NULL auto_increment,
    pid              int(11)              DEFAULT '0' NOT NULL,

    title            varchar(255)         DEFAULT ''  NOT NULL,
    institutions     varchar(255)         DEFAULT ''  NOT NULL,

    tstamp           int(11) unsigned     DEFAULT '0' NOT NULL,
    crdate           int(11) unsigned     DEFAULT '0' NOT NULL,
    cruser_id        int(11) unsigned     DEFAULT '0' NOT NULL,
    deleted          smallint(5) unsigned DEFAULT '0' NOT NULL,
    hidden           smallint(5) unsigned DEFAULT '0' NOT NULL,
    starttime        int(11) unsigned     DEFAULT '0' NOT NULL,
    endtime          int(11) unsigned     DEFAULT '0' NOT NULL,

    t3ver_oid        int(11)              DEFAULT '0' NOT NULL,
    t3ver_id         int(11)              DEFAULT '0' NOT NULL,
    t3ver_wsid       int(11)              DEFAULT '0' NOT NULL,
    t3ver_label      varchar(255)         DEFAULT ''  NOT NULL,
    t3ver_state      smallint(6)          DEFAULT '0' NOT NULL,
    t3ver_stage      int(11)              DEFAULT '0' NOT NULL,
    t3ver_count      int(11)              DEFAULT '0' NOT NULL,
    t3ver_tstamp     int(11)              DEFAULT '0' NOT NULL,
    t3ver_move_id    int(11)              DEFAULT '0' NOT NULL,

    sys_language_uid int(11)              DEFAULT '0' NOT NULL,
    l10n_parent      int(11)              DEFAULT '0' NOT NULL,
    l10n_diffsource  mediumblob,
    l10n_state       text,

    PRIMARY KEY (uid),
    KEY parent (pid),
    KEY t3ver_oid (t3ver_oid, t3ver_wsid),
    KEY language (l10n_parent, sys_language_uid)

);

#
# Table structure for table 'tx_wpdeqarreports_domain_model_program'
#
CREATE TABLE tx_wpdeqarreports_domain_model_program
(

    report int(11) unsigned DEFAULT '0' NOT NULL,

);
