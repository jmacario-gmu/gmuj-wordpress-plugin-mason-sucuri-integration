<?php

/**
 * Summary: php file which contains branding-related functions
 */


// Function to return Mason SVG icon. If this shared function does not exists already, define it now.

if (!function_exists('gmuj_mason_svg_icon')) {

  function gmuj_mason_svg_icon() {

    // Store svg data
    $svg='data:image/svg+xml;base64,' . base64_encode('<svg version="1.1" id="Layer_2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="196.5px" height="196.5px" viewBox="0 0 196.5 196.5" enable-background="new 0 0 196.5 196.5" xml:space="preserve"><g>
    <path fill="#FFCC33" d="M171.885,36.712L184.417,14c-2.979,2.791-4.476,3.668-7.241,5.566   c-15.152,10.403-33.801,12.875-52.541,28.291c-12.711,10.459-18.579,25.615-18.579,25.615s17.062-19.163,42.862-28.721   C159.326,40.896,166.585,38.778,171.885,36.712z"/>
    <path fill="#FFFFFF" d="M165.202,48.83c-13.579,4.331-29.757,8.452-46.328,19.634c-12.909,8.713-20.405,23.578-20.405,23.578   s18.198-18.205,44.658-24.419c5.323-1.248,9.793-2.291,13.538-3.162L165.202,48.83z"/>
    <path fill="#FFFFFF" d="M119.988,162.81V94.45c18.294-14.499,30.119-17.437,30.089-17.437c-6.501,0.59-20.083,1.81-35.962,10.658   c-10.447,5.818-18.692,13.773-18.692,13.773l-0.02,0.056l-0.01-0.017c-3.101,5.821-7.4,15.503-11.611,25.906L62.833,89.15H35.372   l8.78,8.784v64.688l-8.78,8.78h30.035l-8.924-8.78v-50.188l19.624,35.114c-2.926,8.251-5.231,15.623-6.19,20.36l6.314-7.332   c0,0,5.124-24.407,25.319-48.359v51.178l-8.782,8.198h31.223l3.644,0.002L119.988,162.81z"/>
  </g></svg>');

    // Return value
    return $svg;

  }

}
