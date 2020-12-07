<?php
function transient_check() {
    if ( false === get_transient( 'query_transient' ) ) {
        $midnight_time = strtotime('tomorrow') - time(); // https://wordpress.stackexchange.com/questions/306547/set-transient-to-end-at-midnight
        $query_data = wp_remote_get('http://api.tapahtumat.ekarjala.fi/json/anonymized');
        $query_parsed = json_decode($query_data['body']);
        set_transient( 'query_transient', $query_parsed, $midnight_time );
        return $query_parsed;
    }
    else {
        $query_parsed = get_transient( 'query_transient' );
        delete_transient( 'query_transient' );
        // $localization = array(
        //     'test' => __('Test'),
        // );
        // wp_localize_script( 'main-js', 'localization', $localization );
        return $query_parsed;
    }
}
?>
