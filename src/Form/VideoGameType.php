<?php

namespace App\Form;

use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class VideoGameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('name',TextType::class , [
            'required' => true,
            'label' => 'app.form.name'
        ])
    }
}