-- add table prefix if you have one
DELETE FROM core_config_data WHERE path like 'google/analyticsplus/%';
DELETE FROM core_config_data WHERE path like 'google/analyticsplus_classic/%';
DELETE FROM core_config_data WHERE path like 'google/analyticsplus_universal/%';
DELETE FROM core_config_data WHERE path like 'google/analyticsplus_tagmanager/%';
DELETE FROM core_config_data WHERE path like 'google/analyticsplus_dynremarketing/%';
DELETE FROM core_resource WHERE code = 'googleanalyticsplus_setup';
DELETE FROM core_config_data WHERE path = 'advanced/modules_disable_output/Ffuenf_GoogleAnalyticsPlus';
