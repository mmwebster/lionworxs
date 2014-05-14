<?php

//external styles


//inclusion failed
/*
function mytheme_preprocess_html(&$variables) {
  drupal_add_css('http://fonts.googleapis.com/css?family=Open+Sans', array('type' => 'external'));
  //drupal_add_css('http://fonts.googleapis.com/css?family=Lato:300,400', array('type' => 'external'));
}
 */
 function otw_form_alter( &$form, &$form_state, $form_id )
{
    if (in_array( $form_id, array( 'user_login', 'user_login_block')))
    {
        $form['name']['#attributes']['placeholder'] = t( 'Username' );
        $form['pass']['#attributes']['placeholder'] = t( 'Password' );
    }
}

// Load the currently logged in user.
global $user;




//add teacher dash js
/*if (in_array('teacher', $user->roles) && drupal_get_path_alias($_GET['q']) == 'teachers/dashboard') {
  drupal_add_js('sites/all/themes/otw/assets/js/teacher_dashboard.js');
}*/



?>