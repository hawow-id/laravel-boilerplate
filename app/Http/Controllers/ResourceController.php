<?php

namespace App\Http\Controllers;

use App\Models\BaseModel;
use App\Models\Module;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\ArrayShape;
use Illuminate\Http\{Request, Response};

class ResourceController extends Controller
{
    /**
     * @param string $model
     * @return BaseModel|Builder
     */
    private function resolveModel(string $model): BaseModel|Builder
    {
        $singular = Str::singular($model);
        $class = Str::ucfirst($singular);

        if (class_exists($class = "App\\Models\\{$class}")) return new $class;

        if (Schema::hasTable($model)) return DB::table($model);

        abort(404);
    }

    /**
     * @param Request $request
     * @return bool
     */
    protected function isAjaxRequest(Request $request): bool
    {
        return $request->wantsJson() || $request->ajax();
    }

    /**
     * @param string $model
     * @param array|string $fields
     * @return mixed
     */
    private function getModules(string $model, array|string $fields = 'module_details.*')
    {
        return Module::join('module_details', 'modules.id', '=', 'module_details.module_id')
            ->select($fields)
            ->where('modules.table', $model)
            ->where('module_details.is_hidden', false)
            ->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param string $model
     * @return Response
     */
    public function index(Request $request, string $model)
    {
        $fields = $this->getModules(model: $model, fields: 'module_details.field')
            ->pluck('field')
            ->toArray();

        if (!$fields) $fields = '*';

        $result = $this->resolveModel($model)->select($fields)->paginate(10);

        if ($this->isAjaxRequest($request)) return $result;

        $data = array_merge([
            'data' => $result,
            'fields' => $fields,
        ], $this->getViewData($model));

        if (View::exists($view = Str::singular($model).'.index')) return view($view, $data);

        return view('crud.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @param string $model
     * @return Response
     */
    public function create(Request $request, string $model)
    {
        $fields = $this->getModules($model, [
            'module_details.field', 'module_details.type', 'module_details.attributes',
        ]);

        $data = array_merge([
            'fields' => $fields,
        ], $this->getViewData($model));

        if (View::exists($view = Str::singular($model).'.index')) return view($view, $data);

        return view('crud.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, string $model)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param string $model
     * @param string $id
     * @return Response
     */
    public function show(Request $request, string $model, string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param string $model
     * @param string $id
     * @return Response
     */
    public function edit(Request $request, string $model, string $id)
    {
        $fields = $this->getModules($model, [
            'module_details.field', 'module_details.type', 'module_details.attributes',
            'module_details.component',
        ]);

        $data = array_merge([
            'fields' => $fields,
            'model' => $this->resolveModel($model)->find($id),
        ], $this->getViewData($model));
        if (View::exists($view = Str::singular($model).'.form')) return view($view, $data);

        return view('crud.form', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param string $model
     * @param string $id
     * @return Response
     */
    public function update(Request $request, string $model, string $id): Response
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param string $model
     * @param string $id
     * @return Response
     */
    public function destroy(Request $request, string $model, string $id): Response
    {
        //
    }

    #[ArrayShape(['title' => "string"])]
    private function getViewData(string $model): array
    {
        return [
            'title' => Str::ucfirst(Str::singular($model)),
        ];
    }
}
