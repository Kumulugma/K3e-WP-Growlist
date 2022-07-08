<?php

class GrowlistWidget {

    public static function run() {

        self::SeedsDashboardBox();
        self::SownDashboardBox();
        self::InFlightDashboardBox();
    }

    public static function SeedsDashboardBox() {
        add_action('wp_dashboard_setup', 'seeds_dashboard_widget');

        function seeds_dashboard_widget() {
            global $wp_meta_boxes;

            wp_add_dashboard_widget('seeds_help_widget', 'Lista nasion', 'seeds_dashboard');
        }

        function seeds_dashboard() {
            include plugin_dir_path(__FILE__) . 'templates/seeds.php';
        }

    }

    public static function SownDashboardBox() {
        add_action('wp_dashboard_setup', 'sown_dashboard_widget');

        function sown_dashboard_widget() {
            global $wp_meta_boxes;

            wp_add_dashboard_widget('sown_help_widget', 'Wysiane', 'sown_dashboard');
        }

        function sown_dashboard() {
            include plugin_dir_path(__FILE__) . 'templates/sown.php';
        }

    }

    public static function InFlightDashboardBox() {
        add_action('wp_dashboard_setup', 'in_flight_dashboard_widget');

        function in_flight_dashboard_widget() {
            global $wp_meta_boxes;

            wp_add_dashboard_widget('in_flight_help_widget', 'W drodze', 'in_flight_dashboard');
        }

        function in_flight_dashboard() {
            include plugin_dir_path(__FILE__) . 'templates/in_flight.php';
        }

    }

}
?>