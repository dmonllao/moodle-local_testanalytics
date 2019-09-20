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

/**
 * Users without picture example.
 *
 * @package   core
 * @copyright 2016 David Monllao {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_testanalytics\analytics\target;

defined('MOODLE_INTERNAL') || die();

/**
 * Users without picture example.
 *
 * @package   core
 * @copyright 2017 David Monllao {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class without_picture extends \core_analytics\local\target\binary {

    /**
     * get_name
     *
     * @return \lang_string
     */
    public static function get_name(): \lang_string {
        return new \lang_string('withoutpic', 'local_testanalytics');
    }

    /**
     * classes_description
     *
     * @return array
     */
    protected static function classes_description() {
        return array(0 => 'With picture', 1 => 'Without picture');
    }

    /**
     * Can the provided time-splitting method be used on this target?.
     *
     * Time-splitting methods not matching the target requirements will not be selectable by models based on this target.
     *
     * @param  \core_analytics\local\time_splitting\base $timesplitting
     * @return bool
     */
    public function can_use_timesplitting(\core_analytics\local\time_splitting\base $timesplitting): bool {
        return true;
    }

    /**
     * get_analyser_class
     *
     * @return string
     */
    public function get_analyser_class() {
        return '\local_testanalytics\analytics\analyser\users';
    }

    /**
     * No ignored classes, we want to see them all.
     *
     * @return false
     */
    public function ignored_predicted_classes() {
        return array(0);
    }

    /**
     * is_valid_analysable
     *
     * @param \core_analytics\analysable $analysable
     * @param mixed $fortraining
     * @return true|string
     */
    public function is_valid_analysable(\core_analytics\analysable $analysable, $fortraining = true) {
        // The analysable is the site, so yes, it is always valid.
        return true;
    }

    /**
     *
     * @param int $sampleid
     * @param \core_analytics\analysable $analysable
     * @param bool $fortraining
     * @return true|string
     */
    public function is_valid_sample($sampleid, \core_analytics\analysable $analysable, $fortraining = true) {
        $user = $this->retrieve('user', $sampleid);
        if ($fortraining && strstr($user->username, 'prediction') != false) {
            return false;
        }
        return true;
    }

    /**
     * calculate_sample
     *
     * @param int $sampleid
     * @param \core_analytics\analysable $analysable
     * @param int $starttime
     * @param int $endtime
     * @return float
     */
    protected function calculate_sample($sampleid, \core_analytics\analysable $analysable, $starttime = false, $endtime = false) {
        $user = $this->retrieve('user', $sampleid);
        if ($user->picture) {
            return 0;
        }
        return 1;
    }
}
