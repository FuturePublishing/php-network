<?php
/**
 * @copyright 2012 Future Publishing Ltd and Joseph Ray
 * @license   http://opensource.org/licenses/mit-license.php/ MIT
 */

namespace Future\Network\Connection;

/**
 * A dummy connection object that doesn't do anything. Could be used to test or in place of a real
 * connection object if it fails
 *
 * @author    Joseph Ray <joseph.ray@futurenet.com>
 */
class DummyConnection implements \Future\Network\Connection
{
    /**
     * Sends data no-where
     *
     * @param string $data The data to send
     *
     * @return void
     */
    public function send($data)
    {
    }
}