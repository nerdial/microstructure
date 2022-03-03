<?php

namespace App\Controller;

use App\Repository\FamilyRepository;

class FamilyController extends BaseController
{

    private FamilyRepository $familyRepository;

    public function __construct()
    {
        $this->familyRepository = new FamilyRepository();
    }

    public function index()
    {

        if (!$this->familyRepository->countFamilyRecords()) {
            $this->familyRepository->insertFamilyRecords();
        }

        $families = $this->familyRepository->getFamilies();
        $total = array_sum(array_column($families, 'members'));


        return view()->render('family/index.html.twig', [
            'families' => $families,
            'total' => $total
        ]);
    }
}
