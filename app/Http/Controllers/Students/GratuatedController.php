<?php
namespace App\Http\Controllers\Students;
use App\Http\Controllers\Controller;

use App\Models\Gratuated;
use App\Repository\GraduatedRepositoryInterface;
use Illuminate\Http\Request;

class GratuatedController extends Controller
{
    protected $Gratuated;
    public function __construct(GraduatedRepositoryInterface $Gratuated){
        $this->Gratuated = $Gratuated;
    }
    public function index()
    {
        return $this->Gratuated->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->Gratuated->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->Gratuated->softDelete($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gratuated $gratuated)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return $this->Gratuated->Returndata($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->Gratuated->Delete($request);
    }
    public function delete_one(Request $request)
    {
      return $this->Gratuated->Delete_one($request);
    }
}
