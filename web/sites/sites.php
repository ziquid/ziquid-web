<?php

// @codingStandardsIgnoreFile

/**
 * @file
 * Configuration file for multi-site support and directory aliasing feature.
 *
 * This file is required for multi-site support and also allows you to define a
 * set of aliases that map hostnames, ports, and pathnames to configuration
 * directories in the sites directory. These aliases are loaded prior to
 * scanning for directories, and they are exempt from the normal discovery
 * rules. See default.settings.php to view how Drupal discovers the
 * configuration directory when no alias is found.
 *
 * Aliases are useful on development servers, where the domain name may not be
 * the same as the domain of the live server. Since Drupal stores file paths in
 * the database (files, system table, etc.) this will ensure the paths are
 * correct when the site is deployed to a live server.
 *
 * To activate this feature, copy and rename it such that its path plus
 * filename is 'sites/sites.php'.
 *
 * Aliases are defined in an associative array named $sites. The array is
 * written in the format: '<port>.<domain>.<path>' => 'directory'. As an
 * example, to map https://www.drupal.org:8080/mysite/test to the configuration
 * directory sites/example.com, the array should be defined as:
 * @code
 * $sites = array(
 *   '8080.www.drupal.org.mysite.test' => 'example.com',
 * );
 * @endcode
 * The URL, https://www.drupal.org:8080/mysite/test/, could be a symbolic link
 * or an Apache Alias directive that points to the Drupal root containing
 * index.php. An alias could also be created for a subdomain. See the
 * @link https://www.drupal.org/documentation/install online Drupal installation guide @endlink
 * for more information on setting up domains, subdomains, and subdirectories.
 *
 * The following examples look for a site configuration in sites/example.com:
 * @code
 * URL: http://dev.drupal.org
 * $sites['dev.drupal.org'] = 'example.com';
 *
 * URL: http://localhost/example
 * $sites['localhost.example'] = 'example.com';
 *
 * URL: http://localhost:8080/example
 * $sites['8080.localhost.example'] = 'example.com';
 *
 * URL: https://www.drupal.org:8080/mysite/test/
 * $sites['8080.www.drupal.org.mysite.test'] = 'example.com';
 * @endcode
 *
 * @see default.settings.php
 * @see \Drupal\Core\DrupalKernel::getSitePath()
 * @see https://www.drupal.org/documentation/install/multi-site
 */

// cheek.tv
$sites['cheek.tv'] = 'cheek';
$sites['dev.cheek.tv'] = 'cheek';
$sites['www.cheek.tv'] = 'cheek';
$sites['cheek.lndo.site'] = 'cheek';

// flabbierlime92.org
$sites['flabbierlime92.org'] = 'fl92';
$sites['dev.flabbierlime92.org'] = 'fl92';
$sites['www.flabbierlime92.org'] = 'fl92';
$sites['fl92.lndo.site'] = 'fl92';

// glamma.cheek.tv
$sites['glamma.cheek.tv'] = 'glamma';
$sites['dev.glamma.cheek.tv'] = 'glamma';
$sites['www.glamma.cheek.tv'] = 'glamma';
$sites['glamma.lndo.site'] = 'glamma';

// URL: http://www.zds.group/
$sites['dev.zds.group'] = 'zds';
$sites['www.zds.group'] = 'zds';
$sites['zds.group'] = 'zds';
$sites['zds.lndo.site'] = 'zds';

// pam.zds.group
$sites['dev.pam.zds.group'] = 'pam';
$sites['www.pam.zds.group'] = 'pam';
$sites['pam.zds.group'] = 'pam';
$sites['pam.lndo.site'] = 'pam';
