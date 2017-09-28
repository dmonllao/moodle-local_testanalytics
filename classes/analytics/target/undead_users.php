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
 * Undead users example.
 *
 * @package   core
 * @copyright 2016 David Monllao {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_testanalytics\analytics\target;

defined('MOODLE_INTERNAL') || die();

/**
 * Undead users example.
 *
 * @package   core
 * @copyright 2017 David Monllao {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class undead_users extends \core_analytics\local\target\binary {

    /**
     * based_on_assumptions
     *
     * @return
     */
    public static function based_on_assumptions() {
        return true;
    }

    /**
     * get_name
     *
     * @return \lang_string
     */
    public static function get_name(): \lang_string {
        return new \lang_string('undeadusers', 'local_testanalytics');
    }

    /**
     * classes_description
     *
     * @return array
     */
    protected static function classes_description() {
        return array(0 => 'Alive', 1 => 'Undead');
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
        return array();
    }

    /**
     * Overwritten to display returned values nicely.
     *
     * @param string $value
     * @param string $ignoredsubtype
     * @return int
     */
    public function get_calculation_outcome($value, $ignoredsubtype = false) {
        if ($value == 1) {
            return self::OUTCOME_VERY_NEGATIVE;
        } else if ($value == 0) {
            return self::OUTCOME_VERY_POSITIVE;
        } else {
            throw new \coding_exception('Only one of this class classes (0 and 1) should be returned');
        }
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
        $suspended = $this->retrieve('\local_testanalytics\analytics\indicator\user_suspended', $sampleid);
        $activity = $this->retrieve('\local_testanalytics\analytics\indicator\user_activity', $sampleid);
        if ($suspended == 1 || $activity == -1) {
            return 1;
        }
        return 0;
    }
}
