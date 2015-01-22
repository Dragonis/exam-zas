<?php

namespace BDDTutorial\WojtekSasielaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ZamowieniaType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nazwaTowaru')
            ->add('ilosc')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BDDTutorial\WojtekSasielaBundle\Entity\Zamowienia'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bddtutorial_wojteksasielabundle_zamowienia';
    }
}
