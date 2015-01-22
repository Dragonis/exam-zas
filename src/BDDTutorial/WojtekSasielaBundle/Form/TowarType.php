<?php

namespace BDDTutorial\WojtekSasielaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TowarType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nazwa')
            ->add('cenaJednostkowa')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BDDTutorial\WojtekSasielaBundle\Entity\Towar'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bddtutorial_wojteksasielabundle_towar';
    }
}
