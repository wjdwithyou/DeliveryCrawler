<?php

use Aws\Laravel\AwsServiceProvider;

return [

    /*
    |--------------------------------------------------------------------------
    | AWS SDK Configuration
    |--------------------------------------------------------------------------
    |
    | The configuration options set in this file will be passed directly to the
    | `Aws\Sdk` object, from which all client objects are created. The minimum
    | required options are declared here, but the full set of possible options
    | are documented at:
    | http://docs.aws.amazon.com/aws-sdk-php/v3/guide/guide/configuration.html
    |
    */
	'credentials' => [
		'key' => 'AKIAIEYDVVL4BCWZOFCQ',
		'secret' => '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',
	],
    'region' => 'ap-northeast-1',
    'version' => 'latest',
	'Ses' => [
		'region' => 'ap-northeast-1',
	],
	
	// test
	'http' => [
		'verify' => false,//'cacert.pem',
	],
	
	'defaults' => [
		'verify' => false,
	],
];
