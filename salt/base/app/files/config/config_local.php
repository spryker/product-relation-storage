{% from 'settings/init.sls' import settings with context %}
<?php
/**
 * !!! This file is maintained by salt. Do not modify this file, as the changes will be overwritten!
 */

/** Solr - default - used for queries */
$config['storage']['solr']['defaultEndpointSetup'] = [
    'host' => '{{ environment_details.solr.lb_hostname }}',
    'port' => 1{{ environment_details.tomcat.port_suffix }},
];

/** Solr - master - used for updates */
$config['storage']['solr']['masterEndpointSetup'] = [
    'host' => '{{ settings.host.solr_master }}',
    'port' => 1{{ environment_details.tomcat.port_suffix }},
];

/** Solr - local - used for setup */
$config['storage']['solr']['localEndpointSetup'] = [
    'host' => 'localhost',
    'port' => 1{{ environment_details.tomcat.port_suffix }},
];
$config['storage']['solr']['data_dir'] = '/data/shop/{{ environment }}/shared/data/common/solr';

/** Jenkins - job manager */
$config['jenkins'] = array(
    'base_url' => 'http://{{ settings.host.cron_master }}:1{{ environment_details.tomcat.port_suffix }}/jenkins',
    'notify_email' => '',
);

/** ActiveMQ - message queue */
$config['activemq'] = array (
  array('host' => '{{ settings.host.queue }}', 'port' => '{{ environment_details.queue.stomp_port }}')
);

/** Amazon AWS api keys - not used for rackspace projects */
// $config['productImage']['amazonS3Key'] = 'AKIAIFH6VVOUVCIUSAVA';
// $config['productImage']['amazonS3Secret'] = '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';
// $config['productImage']['amazonS3BucketName'] = 'pyz-production-upload';


/**
 * Cloud specific setup - in this case Rackspace only
 */
$config['cloud']['enabled'] = {{ environment_details.cloud.enabled }};
$config['cloud']['objectStorage']['enabled'] = {{ environment_details.cloud.object_storage.enabled }};

$config['cloud']['objectStorage']['rackspace']['username'] = '{{ environment_details.cloud.object_storage.rackspace.api_username }}';
$config['cloud']['objectStorage']['rackspace']['apiKey'] = '{{environment_details.cloud.object_storage.rackspace.api_key }}';

$config['cloud']['cdn']['enabled'] = {{ environment_details.cloud.cdn.enabled }};
$config['cloud']['cdn']['static_media']['http'] = '{{ environment_details.cloud.cdn.static_media.http }}';
$config['cloud']['cdn']['static_media']['https'] = '{{ environment_details.cloud.cdn.static_media.https }}';

$config['cloud']['cdn']['static_assets']['http'] = '{{ environment_details.cloud.cdn.static_assets.http }}';
$config['cloud']['cdn']['static_assets']['https'] = '{{ environment_details.cloud.cdn.static_assets.https }}';
