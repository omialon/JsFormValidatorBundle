<?php

namespace Fp\JsFormValidatorBundle\Model;

/**
 * This is the main model that describes each of the form elements
 *
 * Class JsFormElement
 *
 * @package Fp\JsFormValidatorBundle\Model
 */
class JsFormElement extends JsModelAbstract
{
    public string $id;

    public string $name;

    public string $type;

    public string $invalidMessage;

    public bool $bubbling = false;

    public array $data = array();

    public array $transformers = array();

    /**
     * @var JsFormElement[]
     */
    public array $children = array();

    public ?JsFormElement $prototype = null;
} 