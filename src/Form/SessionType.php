<?php

namespace App\Form;
use App\Entity\Formation;
use App\Entity\Session;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class SessionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {  
        $builder
            ->add('date_d')
            ->add('date_f')
            ->add('nomSession')
            /* 
            ->add('users')
            */
            ->add('formations',EntityType::class,[
                'class' => Formation::class,
                'choice_label'=>'nom',
                'multiple' => true,
                'expanded' => true,
    
                
        ]);
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Session::class,
        
        ]);
    }
}
