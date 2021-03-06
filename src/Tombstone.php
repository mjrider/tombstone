<?php
namespace Scheb\Tombstone;

class Tombstone
{
    /**
     * @var string
     */
    private $tombstoneDate;

    /**
     * @var string
     */
    private $author;

    /**
     * @var string|null
     */
    private $label;

    /**
     * @var string
     */
    private $file;

    /**
     * @var int
     */
    private $line;

    /**
     * @var string
     */
    private $method;

    /**
     * @var Vampire[]
     */
    private $vampires = array();

    /**
     * @param string $tombstoneDate
     * @param string $author
     * @param string|null $label
     * @param string $file
     * @param int $line
     * @param string $method
     */
    public function __construct($tombstoneDate, $author, $label, $file, $line, $method)
    {
        $this->tombstoneDate = $tombstoneDate;
        $this->author = $author;
        $this->file = $file;
        $this->line = $line;
        $this->method = $method;
        $this->label = $label;
    }

    /**
     * @return string
     */
    public function __toString() {
        $label = $this->label ? ', "' . $this->label . '"' : '';
        return sprintf('tombstone("%s", "%s"%s)', $this->tombstoneDate, $this->author, $label);
    }

    /**
     * @return string
     */
    public function getHash()
    {
        return md5($this->tombstoneDate . "\n" . $this->author . "\n" . $this->label . "\n" . $this->file . "\n" . $this->line);
    }

    /**
     * @param Tombstone $tombstone
     *
     * @return bool
     */
    public function inscriptionEquals(Tombstone $tombstone)
    {
        return $tombstone->getAuthor() === $this->author && $tombstone->getTombstoneDate() === $this->tombstoneDate && $tombstone->getLabel() === $this->label;
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return string
     */
    public function getTombstoneDate()
    {
        return $this->tombstoneDate;
    }

    /**
     * @return string|null
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @return int
     */
    public function getLine()
    {
        return $this->line;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param Vampire $vampire
     */
    public function addVampire(Vampire $vampire)
    {
        $this->vampires[] = $vampire;
    }

    /**
     * @return Vampire[]
     */
    public function getVampires()
    {
        return $this->vampires;
    }

    /**
     * @return bool
     */
    public function hasVampires()
    {
        return !!$this->vampires;
    }
}
