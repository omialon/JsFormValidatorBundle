<?php
namespace Fp\JsFormValidatorBundle\Form\Subscriber;

use Fp\JsFormValidatorBundle\Factory\JsFormValidatorFactory;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;

/**
 * Class FormSubscriber
 *
 * @package Fp\JsFormValidatorBundle\Form\EventSubscriber
 */
class SubscriberToQueue implements EventSubscriberInterface
{

    /**
     * @param JsFormValidatorFactory $factory
     */
    public function __construct(
        protected JsFormValidatorFactory $factory
    )
    {
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return array(FormEvents::POST_SET_DATA => array('onFormSetData', -10));
    }

    /**
     * @param FormEvent $event
     */
    public function onFormSetData(FormEvent $event): void
    {
        /** @var Form $form */
        $form         = $event->getForm();
        $globalSwitch = $this->factory->getConfig('js_validation');
        $localSwitch  = $form->getConfig()->getOption('js_validation');

        // Add only parent forms which are not disabled
        if ($globalSwitch && $localSwitch) {
            $parent = $this->getParent($form);
            if (!$this->factory->inQueue($parent)) {
                $this->factory->addToQueue($this->getParent($form));
            }
        }
    }

    /**
     * @param Form|FormInterface $element
     *
     * @return \Symfony\Component\Form\Form
     */
    protected function getParent($element): FormInterface|Form
    {
        if (!$element->getParent()) {
            return $element;
        } else {
            return $this->getParent($element->getParent());
        }
    }
} 