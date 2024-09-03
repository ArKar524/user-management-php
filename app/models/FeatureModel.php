<?php
class FeatureModel
{
    use Model;

    public function seedFeature()
    {
        $data = [
            ['name' => 'User'],
            ['name' => 'Role'],
        ];
        createData('FeatureModel', $data);
    }
}