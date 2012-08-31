<?php
/**
 * @copyright 2012 Future Publishing Ltd and Joseph Ray
 * @license   http://opensource.org/licenses/mit-license.php/ MIT
 */

namespace Future\Network\Connection;

/**
 * Implements a connection to a socket. Can only send data, not receive it.
 *
 * @author    Joseph Ray <joseph.ray@futurenet.com>
 */
class SocketConnection implements \Future\Network\Connection
{
    const TYPE_TCP = 'tcp';

    const TYPE_UDP = 'udp';

    /**
     * @var string
     */
    protected $host;

    /**
     * @var int
     */
    protected $port;

    /**
     * @var resource
     */
    protected $connection;

    /**
     * @var boolean
     */
    protected $connected = false;

    /**
     * Constructs SocketConnection
     *
     * @param string $host     The host to connect to
     * @param int    $port     The port number
     * @param string $protocol The protocol to use in the socket connection (use
     *                         SocketConnection::TYPE_UDP or SocketConnection::TYPE_TCP). Defaults
     *                         to UDP.
     *
     * @return void
     */
    public function __construct($host, $port, $protocol = self::TYPE_UDP)
    {
        $this->host         = $host;
        $this->port         = $port;
        $connectionString   = '';
        $errorNumber        = 0;
        $errorString        = '';

        switch ($protocol) {
            case self::TYPE_TCP:
                $connectionString .= 'tcp://' . $host . ':' . $port;
                break;
            case self::TYPE_UDP:
            default:
                $connectionString .= 'udp://' . $host . ':' . $port;
                break;
        }

        $this->connection = stream_socket_client($connectionString, $errorNumber, $errorString);

        if (!$this->connection) {
            $message = 'Error connecting to ' . $host . ' on port ' . $port;
            $message .= ': (' . $errorNumber . ') ' . $errorString;
            throw new \Future\Network\Exception($message, $errorNumber);
        } else {
            $this->connected = true;
        }
    }

    /**
     * Sends the given data over the network
     *
     * @param string $data The data to send
     *
     * @return string
     */
    public function send($data)
    {
        if ($this->connected) {
            fwrite($this->connection, $data);
        }
    }

    /**
     * Closes the network connection on destruction of the class
     *
     * @return void
     */
    public function __destruct()
    {
        if ($this->connected) {
            fclose($this->connection);
        }
    }
}