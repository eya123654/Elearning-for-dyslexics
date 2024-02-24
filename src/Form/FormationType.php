<?php

namespace App\Form;

use App\Entity\Formation;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class FormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',ChoiceType::class,[
                'choices'=>[
                    'parole en public '=>'parole en public ',
                    'gestion de stress & temps ' => 'gestion de stress & temps ',
                    'gestion de prononciation'=>'gestion de prononciation',
                    'Management & gestion equipes'=>'Management & gestion equipes',
                    'developpement de competences numeriques'=>'developpement de competences numeriques'

                ],
            ] )
            ->add('description',TextareaType::class ,['attr'=>['row'=>20 ,'cols'=>60]])
            ->add('thematique',TextareaType::class ,['attr'=>['row'=>20 ,'cols'=>60]])
            ->add('nbr_participant')
            ->add('niveau',ChoiceType::class,[
                'choices'=>[
                    'beginner '=>'beginner',
                    'intermediaire ' => 'intermediaire ',
                    'advanced'=>'advanced',
                ],
            ] );
            }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Formation::class,
        ]);
    }
}
