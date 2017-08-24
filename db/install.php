<?php
// This file is part of Moodle - http://moodle.org/
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


defined('MOODLE_INTERNAL') || die();

function xmldb_local_testanalytics_install() {

    \core\session\manager::set_user(get_admin());

    $indicator = \core_analytics\manager::get_indicator('\local_testanalytics\analytics\indicator\set_setting');
    $indicators = array($indicator->get_id() => $indicator);

    $target = \core_analytics\manager::get_target('\local_testanalytics\analytics\target\linear_example');
    $model = \core_analytics\model::create($target, $indicators, '\core\analytics\time_splitting\single_range');
    $model->enable();


    $target = \core_analytics\manager::get_target('\local_testanalytics\analytics\target\discrete_example');
    $model = \core_analytics\model::create($target, $indicators, '\core\analytics\time_splitting\single_range');
    $model->enable();

    $target = \core_analytics\manager::get_target('\local_testanalytics\analytics\target\binary_example');
    $model = \core_analytics\model::create($target, $indicators, '\core\analytics\time_splitting\single_range');
    $model->enable();

    $indicator = \core_analytics\manager::get_indicator('\local_testanalytics\analytics\indicator\user_suspended');
    $indicators = array($indicator->get_id() => $indicator);
    $target = \core_analytics\manager::get_target('\local_testanalytics\analytics\target\undead_users');
    $model = \core_analytics\model::create($target, $indicators, '\core\analytics\time_splitting\single_range');
    $model->enable();

    $indicator = \core_analytics\manager::get_indicator('\local_testanalytics\analytics\indicator\category_empty');
    $indicators = array($indicator->get_id() => $indicator);
    $target = \core_analytics\manager::get_target('\local_testanalytics\analytics\target\useless_categories');
    $model = \core_analytics\model::create($target, $indicators, '\core\analytics\time_splitting\single_range');
    $model->enable();
}
