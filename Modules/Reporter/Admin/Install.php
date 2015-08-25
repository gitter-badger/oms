<?php
namespace Modules\Reporter\Admin;

/**
 * Data evaluation install class.
 *
 * PHP Version 7.0
 *
 * @category   Modules
 * @package    Modules\Reporter
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Install
{
    /**
     * Install module.
     *
     * @param \phpOMS\DataStorage\Database\Pool $dbPool Database pool instance
     * @param array                             $info   Module info
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function install($dbPool, $info)
    {
        switch ($dbPool->get('core')->getType()) {
            case \phpOMS\DataStorage\Database\DatabaseType::MYSQL:
                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'reporter_report` (
                            `reporter_report_id` int(11) NOT NULL AUTO_INCREMENT,
                            `reporter_report_status` tinyint(1) NOT NULL,
                            `reporter_report_title` varchar(25) NOT NULL,
                            `reporter_report_desc` varchar(255) NOT NULL,
                            `reporter_report_media` int(11) NOT NULL,
                            `reporter_report_template` int(11) NOT NULL,
                            `reporter_report_creator` int(11) NOT NULL,
                            `reporter_report_created` datetime NOT NULL,
                            PRIMARY KEY (`reporter_report_id`),
                            KEY `reporter_report_template` (`reporter_report_template`),
                            KEY `reporter_report_creator` (`reporter_report_creator`),
                            KEY `reporter_report_media` (`reporter_report_media`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'reporter_report`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'reporter_report_ibfk_1` FOREIGN KEY (`reporter_report_template`) REFERENCES `' . $dbPool->get('core')->prefix . 'media` (`media_id`),
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'reporter_report_ibfk_2` FOREIGN KEY (`reporter_report_creator`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`),
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'reporter_report_ibfk_3` FOREIGN KEY (`reporter_report_media`) REFERENCES `' . $dbPool->get('core')->prefix . 'media` (`media_id`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'reporter_template` (
                            `reporter_template_id` int(11) NOT NULL AUTO_INCREMENT,
                            `reporter_template_status` tinyint(1) NOT NULL,
                            `reporter_template_title` varchar(25) NOT NULL,
                            `reporter_template_desc` varchar(255) NOT NULL,
                            `reporter_template_media` int(11) NOT NULL,
                            `reporter_template_creator` int(11) NOT NULL,
                            `reporter_template_created` datetime NOT NULL,
                            PRIMARY KEY (`reporter_template_id`),
                            KEY `reporter_template_media` (`reporter_template_media`),
                            KEY `reporter_template_creator` (`reporter_template_creator`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'reporter_template`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'reporter_template_ibfk_1` FOREIGN KEY (`reporter_template_media`) REFERENCES `' . $dbPool->get('core')->prefix . 'media` (`media_id`),
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'reporter_template_ibfk_2` FOREIGN KEY (`reporter_template_creator`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`);'
                )->execute();

                // Used in order to tell the template what file names+extension it is expecting (more are allowed)
                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'reporter_template_media` (
                            `reporter_template_media_id` int(11) NOT NULL AUTO_INCREMENT,
                            `reporter_template_media_template` int(11) NOT NULL,
                            `reporter_template_media_name` int(11) NOT NULL,
                            PRIMARY KEY (`reporter_template_media_id`),
                            KEY `reporter_template_media_template` (`reporter_template_media_template`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'reporter_template_media`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'reporter_template_media_ibfk_1` FOREIGN KEY (`reporter_template_media_template`) REFERENCES `' . $dbPool->get('core')->prefix . 'reporter_template` (`reporter_template_id`);'
                )->execute();
                break;
        }
    }
}
