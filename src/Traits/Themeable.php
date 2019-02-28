<?php declare(strict_types=1);

namespace Surda\ComponentHelpers\Traits;

use Surda\ComponentHelpers\Exception\InvalidArgumentException;

trait Themeable
{
    /** @var array */
    private $templates = [];

    /**
     * @param string $template
     */
    public function setTemplate(string $template): void
    {
        $this->setTemplateByType('default', $template);
    }

    /**
     * @param string $type
     * @param string $templateFile
     * @throws InvalidArgumentException
     */
    public function setTemplateByType(string $type, string $templateFile): void
    {
        if (!file_exists($templateFile)) {
            throw new InvalidArgumentException(sprintf("Template file '%s' does not exist.", $templateFile));
        }

        $this->templates[$type] = $templateFile;
    }

    /**
     * @param string $type
     * @return string
     * @throws InvalidArgumentException
     */
    public function getTemplateByType(string $type): string
    {
        if (array_key_exists($type, $this->templates)) {
            return $this->templates[$type];
        }

        throw new InvalidArgumentException(sprintf("Template file of type '%s' is not registered.", $type));
    }

    /**
     * @return string
     * @throws InvalidArgumentException
     */
    public function getDefaultTemplate(): string
    {
        if (array_key_exists('default', $this->templates)) {
            return $this->templates['default'];
        }

        throw new InvalidArgumentException('Default template file is not registered.');
    }
}