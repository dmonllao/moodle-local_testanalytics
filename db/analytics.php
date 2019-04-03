<?php
// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Defines the plugin models.
 *
 * @package     local_testanalytics
 * @category    analytics
 * @copyright   2019 David Monllaó
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$models = [
    [
        'target' => '\local_testanalytics\analytics\target\linear_example',
        'indicators' => [
            '\local_testanalytics\analytics\indicator\set_setting',
        ],
        'timesplitting' => '\core\analytics\time_splitting\single_range',
        'enabled' => true,
    ],
    [
        'target' => '\local_testanalytics\analytics\target\discrete_example',
        'indicators' => [
            '\local_testanalytics\analytics\indicator\set_setting',
        ],
        'timesplitting' => '\core\analytics\time_splitting\single_range',
        'enabled' => true,
    ],
    [
        'target' => '\local_testanalytics\analytics\target\binary_example',
        'indicators' => [
            '\local_testanalytics\analytics\indicator\set_setting',
        ],
        'timesplitting' => '\core\analytics\time_splitting\single_range',
        'enabled' => true,
    ],
    [
        'target' => '\local_testanalytics\analytics\target\undead_users',
        'indicators' => [
            '\local_testanalytics\analytics\indicator\user_suspended',
            '\local_testanalytics\analytics\indicator\user_activity',
        ],
        'timesplitting' => '\core\analytics\time_splitting\single_range',
        'enabled' => true,
    ],
    [
        'target' => '\local_testanalytics\analytics\target\useless_categories',
        'indicators' => [
            '\local_testanalytics\analytics\indicator\category_empty',
        ],
        'timesplitting' => '\core\analytics\time_splitting\single_range',
        'enabled' => true,
    ],
    [
        'target' => '\local_testanalytics\analytics\target\without_picture',
        'indicators' => [
            '\local_testanalytics\analytics\indicator\user_suspended',
        ],
        'timesplitting' => '\core\analytics\time_splitting\single_range',
        'enabled' => true,
    ],
];
