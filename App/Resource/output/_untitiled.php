<?php
/**
 * App
 *
 */

/**
 * Untitledアウトプットフィルター
 *
 * @param array $values
 * @param array $options
 *
 * @return BEAR_Ro
 */
function outputUntitled($values, $options = null)
{
    $headers = ['X-BEAR-Output: untitled', 'Content-Type: text/html; charset=utf-8'];

    return new BEAR_Ro('<pre>' . print_r($values, true) . '</pre>', $headers);
}
