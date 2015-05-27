<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use AdminBundle\Entity\Schedule;

class ScheduleType extends AbstractType
{
    private $container;

    public function __construct($container)
    {
        $this->container = $container;
    }
    
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('timeFrom', 'datetime', array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd hh:mm:ss',
                'model_timezone' => $this->container->getParameter('model_timezone'),
                'view_timezone' => $this->container->getParameter('view_timezone'),
                'attr'   => array('class' => 'datepicker')))
            ->add('timeTo', 'datetime', array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd hh:mm:ss',
                'model_timezone' => $this->container->getParameter('model_timezone'),
                'view_timezone' => $this->container->getParameter('view_timezone'),
                'attr'   => array('class' => 'datepicker')))
            ->add('bgImageUrl')
            ->add('room', 'choice', array(
                'choices' => Schedule::$rooms
                ))
            ->add('speaker')
            ->add('mySpeaker')
            ->add('topic')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AdminBundle\Entity\Schedule'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'adminbundle_schedule';
    }
}
