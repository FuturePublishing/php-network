<?php
/**
 * @copyright 2012 Future Publishing Ltd and Joseph Ray
 * @license   http://opensource.org/licenses/mit-license.php/ MIT
 */

namespace Future\Network;

/**
 * An interface for a connection
 *
 * @author    Joseph Ray <joseph.ray@futurenet.com>
 */
interface Connection
{
    /**
     * Sends data over the connection
     *
     * @param string $data The data to send
     *
     * @return void
     */
    public function send($data);
}