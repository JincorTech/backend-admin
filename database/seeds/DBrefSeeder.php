<?php

use Illuminate\Database\Seeder;
use App\Repositories\CompanyRepository;
use Doctrine\ODM\MongoDB\DocumentManager;
use App\Models\EconomicalActivityType;
use MongoDB\BSON\Binary;
use App\Models\CompanyType;
use App\Repositories\DepartmentRepository;
use App\Repositories\EmployeeRepository;
use App\Models\Department;

class DBrefSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companyRepository = App::make(CompanyRepository::class);
        $companies = $companyRepository->all();

        foreach ($companies as $company) {
            $companyType = $this->getRandomCompanyType();
            $company->companyTypeId = $companyType->id;
            $profile = $company->profile;
            $profile['address']['countryId'] = $profile['address']['country']['$id'];
            $company->profile = $profile;

            $activityType = $this->getRandomActivityType();
            $company->economicalActivityTypesIds = [
                new Binary($activityType->getId(), Binary::TYPE_OLD_UUID),
            ];
            $company->save();
        }

        $departmentsRepository = App::make(DepartmentRepository::class);
        $departments = $departmentsRepository->all();

        foreach ($departments as $department) {
            $department->companyId = $department->company['$id'];
            $department->save();
        }

        $employeeRepository = App::make(EmployeeRepository::class);
        $employees = $employeeRepository->all();

        foreach ($employees as $employee) {
            $dep = $this->getRandomDepartment();
            $employee->departmentId = $dep->_id;
            $employee->save();
        }
    }

    public function getRandomActivityType()
    {
        /**
         * @var $dm DocumentManager
         */
        $dm = App::make(DocumentManager::class);
        $qb = $dm->createQueryBuilder(EconomicalActivityType::class);
        $count =  $qb->getQuery()->count();
        $skip_count = random_int(0, $count);
        $qb->skip($skip_count);

        return $qb->getQuery()->getSingleResult();
    }

    public function getRandomCompanyType()
    {
        return CompanyType::limit(-1)->skip(rand(0, CompanyType::count() - 1))->first();
    }

    public function getRandomDepartment()
    {
        return Department::limit(-1)->skip(rand(0, Department::count() - 1))->first();
    }
}
