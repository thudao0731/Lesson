<?php

function getLinkService($id, $slug) {
    return 'dich-vu/'.$slug.'.html';
}

function getPrefixService($module='') {
    if ($module == 'services') {
        return 'dich-vu';
    }
    return false;
}