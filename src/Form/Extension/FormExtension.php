<?php
namespace Fp\JsFormValidatorBundle\Form\Extension;

use Fp\JsFormValidatorBundle\Factory\JsFormValidatorFactory;
use Fp\JsFormValidatorBundle\Form\Subscriber\SubscriberToQueue;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class FormExtension
 *
 * @package Fp\JsFormValidatorBundle\Form\Extension
 */
class FormExtension extends AbstractTypeExtension
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
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->addEventSubscriber(new SubscriberToQueue($this->factory));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(array('js_validation' => true));
    }

    /**
     * Returns the name of the type being extended.
     *
     * @return string The name of the type being extended
     */
    public function getExtendedType(): string
    {
        return FormType::class;
    }

    /**
     * {@inheritDoc}
     */
    public static function getExtendedTypes(): iterable
    {
        yield FormType::class;
    }
}
