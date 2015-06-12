<?php namespace Anomaly\Streams\Platform\Support;

/**
 * Class Csv
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Platform\Support
 */
class Csv
{

    /**
     * The header flag.
     *
     * @var bool
     */
    protected $header = true;

    /**
     * The CSV escape.
     *
     * @var string
     */
    protected $escape = '\\';

    /**
     * The CSV delimiter.
     *
     * @var string
     */
    protected $delimiter = ',';

    /**
     * The CSV enclosure.
     *
     * @var string
     */
    protected $enclosure = '"';

    /**
     * Read data from a CSV.
     *
     * @param $path
     * @return array
     */
    public function read($path)
    {
        $handle = fopen($path, 'r');

        $data   = [];
        $header = null;

        while (($row = fgetcsv(
                $handle,
                99999,
                $this->getDelimiter(),
                $this->getEnclosure(),
                $this->getEscape()
            )) !== false) {

            if ($this->hasHeader() && !$header) {
                $header = $row;
            } elseif ($this->hasHeader()) {
                $data[] = array_combine($header, $row);
            } else {
                $data[] = $row;
            }
        }

        fclose($handle);

        return $data;
    }

    /**
     * Return the header flag.
     *
     * @return bool
     */
    public function hasHeader()
    {
        return $this->header;
    }

    /**
     * Set the header flag.
     *
     * @param $header
     * @return $this
     */
    public function setHeader($header)
    {
        $this->header = $header;

        return $this;
    }

    /**
     * Get the escape character.
     *
     * @return string
     */
    public function getEscape()
    {
        return $this->escape;
    }

    /**
     * Set the escape character.
     *
     * @param $escape
     * @return $this
     */
    public function setEscape($escape)
    {
        $this->escape = $escape;

        return $this;
    }

    /**
     * Get the delimiter.
     *
     * @return string
     */
    public function getDelimiter()
    {
        return $this->delimiter;
    }

    /**
     * Set the delimiter.
     *
     * @param $delimiter
     * @return $this
     */
    public function setDelimiter($delimiter)
    {
        $this->delimiter = $delimiter;

        return $this;
    }

    /**
     * Get the enclosure.
     *
     * @return string
     */
    public function getEnclosure()
    {
        return $this->enclosure;
    }

    /**
     * Set the enclosure.
     *
     * @param $enclosure
     * @return $this
     */
    public function setEnclosure($enclosure)
    {
        $this->enclosure = $enclosure;

        return $this;
    }
}