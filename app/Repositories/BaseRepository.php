<?php


namespace App\Repositories;


use App\Contracts\RepositoryContract;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\ArrayShape;

abstract class BaseRepository implements RepositoryContract
{

    public function getViewName(): string
    {
        return 'crud';
    }

    abstract public function getRouteName(): string;

    abstract public function getRules(): array;

    abstract public function getModel();

    #[ArrayShape([
        'title' => 'string',
    ])]
    abstract public function getViewAttributes(): array;


    public function index(Request $request)
    {
        if (method_exists($this, 'processPaginationFilter')){
            return view($this->getViewName().'.index', array_merge(['model' => $this->processPaginationFilter($request)], $this->getViewAttributes()));
        }

        return view($this->getViewName().'.index', array_merge(['model' => $this->getModel()->paginate(10)], $this->getViewAttributes()));
    }

    protected function isAjaxRequest(Request $request): bool
    {
        return $request->wantsJson() || $request->ajax();
    }

    public function create(Request $request)
    {
        if ($this->isAjaxRequest($request)) {
            return response()->json([
                'message' => 'Welcome',
            ]);
        }

        return view($this->getViewName().'.form', $this->getViewAttributes());
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->getRules());
        $this->getModel()->create($data);

        return redirect($this->getRouteName().'.index');
    }

    public function show(Request $request, $id)
    {
        $model = $this->getModel()->findOrFail($id);

        if ($this->isAjaxRequest($request)) {
            return response()->json([
                'data' => $model,
            ]);
        }

        return view($this->getViewName().'.form', array_merge(['model' => $model], $this->getViewAttributes()));
    }

    public function edit(Request $request, $id)
    {
        if ($this->isAjaxRequest($request)) {
            return response()->json([
                'message' => 'Welcome',
            ]);
        }
        $model = $this->getModel()->findOrFail($id);
        return view($this->getViewName().'.form', array_merge(['model' => $model, ], $this->getViewAttributes()));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate($this->getRules());
        $model = $this->getModel()->findOrFail($id);
        $model->fill($data);
        $model->save();

        if ($this->isAjaxRequest($request)) {
            return response()->json([
                'data' => $model,
            ]);
        }

        return redirect($this->getRouteName().'.index');
    }

    public function destroy(Request $request, $id)
    {
        $model = $this->getModel()->findOrFail($id);
        $model->delete();
        if ($this->isAjaxRequest($request)) {
            return response()->json([
                'message' => 'deleted',
            ]);
        }

        return redirect($this->getRouteName().'.index');
    }
}
