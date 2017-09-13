<?php

namespace App\Http\Controllers;

use App\DataTables\DepartmentDataTable;
use App\Repositories\DepartmentRepository;
use Flash;
use Response;
use MongoDB\BSON\Binary;

class DepartmentController extends AppBaseController
{
    /** @var  DepartmentRepository */
    private $departmentRepository;

    public function __construct(DepartmentRepository $departmentRepo)
    {
        $this->departmentRepository = $departmentRepo;
    }

    /**
     * Display a listing of the Department.
     *
     * @param DepartmentDataTable $departmentDataTable
     * @return Response
     */
    public function index(DepartmentDataTable $departmentDataTable)
    {
        return $departmentDataTable->render('departments.index');
    }

    /**
     * Display the specified Department.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $department = $this->departmentRepository->findWithoutFail(new Binary($id, Binary::TYPE_OLD_UUID));

        if (empty($department)) {
            Flash::error('Department not found');

            return redirect(route('departments.index'));
        }

        return view('departments.show')->with('department', $department);
    }
}
